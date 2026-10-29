<?php
namespace Cloudytek;
use WHMCS\Database\Capsule;

/** Read-only registration-data search. A missing RDAP record is not a registrar purchase guarantee. */
class Domains
{
    const BOOTSTRAP='https://data.iana.org/rdap/dns.json';
    public static function directory() {
        $dir=rtrim(sys_get_temp_dir(),DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'ctk-domain-'.substr(hash('sha256',__DIR__),0,16);
        if(!is_dir($dir)&&!mkdir($dir,0700,true)&&!is_dir($dir))throw new \RuntimeException('Lookup cache unavailable');
        return $dir;
    }
    private static function read($key,$stale=false) {
        $file=self::directory().'/'.hash('sha256',$key).'.json';
        if(!is_file($file)||filesize($file)>1048576)return null;
        $data=json_decode(file_get_contents($file),true);
        return is_array($data)&&isset($data['expires'],$data['data'])&&($stale||$data['expires']>=time())?$data['data']:null;
    }
    private static function save($key,$data,$ttl) {
        $file=self::directory().'/'.hash('sha256',$key).'.json';
        $tmp=tempnam(self::directory(),'write-');
        file_put_contents($tmp,json_encode(array('expires'=>time()+$ttl,'data'=>$data)),LOCK_EX);
        if(!rename($tmp,$file)){@unlink($tmp);return;}
        @chmod($file,0600);
    }
    public static function throttle($ip,$count) {
        $path=self::directory().'/rate-'.hash('sha256',$ip).'.json';$file=fopen($path,'c+');
        if(!$file||!flock($file,LOCK_EX))throw new \RuntimeException('Lookup busy');
        try {
            $data=json_decode(stream_get_contents($file),true);$minute=(int)floor(time()/60);
            if(!is_array($data)||$data['minute']!==$minute)$data=array('minute'=>$minute,'count'=>0);
            if($data['count']+$count>60)return false;
            $data['count']+=$count;ftruncate($file,0);rewind($file);fwrite($file,json_encode($data));return true;
        } finally {flock($file,LOCK_UN);fclose($file);}
    }
    public static function extensions() {
        $items=Capsule::table('tbldomainpricing')->orderBy('order')->orderBy('id')->pluck('extension');
        if(!is_array($items))$items=$items->all();
        $items=array_values(array_filter($items,function($x){return preg_match('/^\.[a-z0-9.-]{2,60}$/D',$x);}));
        return $items?:array('.com','.net','.org','.info','.biz','.online','.store','.tech');
    }
    public static function parse($input) {
        if(!is_string($input)||strlen($input)>1024)throw new \InvalidArgumentException('invalid_domain');
        $name=rtrim(trim($input),'.');
        if(strpos($name,'.')===false)$name.='.com';
        if(function_exists('idn_to_ascii'))$name=idn_to_ascii($name,0,INTL_IDNA_VARIANT_UTS46);
        $name=strtolower((string)$name);
        if(!$name||strlen($name)>253||!preg_match('/^[a-z0-9.-]+$/D',$name)||filter_var($name,FILTER_VALIDATE_IP))throw new \InvalidArgumentException('invalid_domain');
        $suffixes=array_merge(self::extensions(),array('.com.vn','.net.vn','.org.vn','.edu.vn','.gov.vn','.info.vn','.biz.vn','.name.vn','.health.vn','.pro.vn','.int.vn','.ac.vn','.co.uk','.org.uk','.com.au','.co.nz','.co.jp','.com.sg','.com.my','.com.tw','.co.in'));
        usort($suffixes,function($a,$b){return strlen($b)-strlen($a);});$suffix='';
        foreach($suffixes as $s)if(substr($name,-strlen($s))===$s){$suffix=$s;break;}
        if(!$suffix)$suffix=substr($name,strrpos($name,'.'));
        $label=substr($name,0,-strlen($suffix));
        if(!preg_match('/^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$/D',$label)||!preg_match('/^\.[a-z0-9.-]+$/D',$suffix))throw new \InvalidArgumentException('invalid_domain');
        foreach(explode('.',$name) as $part)if(strlen($part)>63||!preg_match('/^[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/D',$part))throw new \InvalidArgumentException('invalid_domain');
        return array('domain'=>$name,'label'=>$label,'extension'=>$suffix);
    }
    /** HTTPS only; pin a public IPv4 address, disallow redirects and arbitrary browser-provided hosts. */
    private static function handle($url) {
        $u=parse_url($url);
        if(!$u||$u['scheme']!=='https'||!empty($u['user'])||!empty($u['pass'])||(!empty($u['port'])&&$u['port']!==443)||empty($u['host']))return false;
        $host=$u['host'];$ips=gethostbynamel($host);$ip=null;
        foreach($ips?:array() as $candidate)if(filter_var($candidate,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4|FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)){$ip=$candidate;break;}
        if(!$ip)return false;
        $ch=curl_init($url);
        curl_setopt_array($ch,array(CURLOPT_RETURNTRANSFER=>true,CURLOPT_CONNECTTIMEOUT=>3,CURLOPT_TIMEOUT=>8,CURLOPT_FOLLOWLOCATION=>false,
            CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2,CURLOPT_RESOLVE=>array($host.':443:'.$ip),CURLOPT_PROTOCOLS=>CURLPROTO_HTTPS,
            CURLOPT_HTTPHEADER=>array('Accept: application/rdap+json, application/json'),CURLOPT_USERAGENT=>'Cloudytek-DomainSearch/1.0',CURLOPT_BUFFERSIZE=>16384));
        // All responses are bounded; registry registration data is never forwarded to the browser.
        $body='';curl_setopt($ch,CURLOPT_WRITEFUNCTION,function($ch,$chunk)use(&$body){if(strlen($body)+strlen($chunk)>1048576)return 0;$body.=$chunk;return strlen($chunk);});
        return array('handle'=>$ch,'body'=>function()use(&$body){return $body;});
    }
    private static function bootstrap() {
        $cached=self::read('bootstrap');if($cached)return $cached;
        $request=self::handle(self::BOOTSTRAP);$parsed=null;
        if($request){curl_exec($request['handle']);$status=curl_getinfo($request['handle'],CURLINFO_HTTP_CODE);curl_close($request['handle']);$data=json_decode($request['body'](),true);
            if($status===200&&is_array($data)&&!empty($data['services'])){
                $parsed=array();foreach($data['services']as$service)foreach($service[0]as$tld)foreach($service[1]as$url)if(strpos($url,'https://')===0){$parsed[strtolower($tld)]=rtrim($url,'/').'/';break;}
                self::save('bootstrap',$parsed,86400);
            }
        }
        return $parsed?:self::read('bootstrap',true)?:array();
    }
    private static function registrar($parsed) {
        if(\WHMCS\Config\Setting::getValue('domainLookupProvider')!=='Registrar')return null;
        $name=\WHMCS\Config\Setting::getValue('domainLookupRegistrar');
        if(!$name||!preg_match('/^[a-z0-9_]+$/D',$name))return null;
        try {
            $module=new \WHMCS\Module\Registrar();
            if(!$module->load($name)||!$module->functionExists('CheckAvailability'))return null;
            $results=$module->call('CheckAvailability',array('sld'=>$parsed['label'],'tlds'=>array($parsed['extension']),'searchTerm'=>$parsed['label'],'tldsToInclude'=>array($parsed['extension']),'isIdnDomain'=>strpos($parsed['label'],'xn--')===0,'punyCodeSearchTerm'=>$parsed['label'],'premiumEnabled'=>(bool)\WHMCS\Config\Setting::getValue('PremiumDomains')));
            foreach($results as$result)if(strtolower($result->getDomain())===$parsed['domain']){
                $map=array('registered'=>'registered','reserved'=>'reserved','available for registration'=>'available');
                return array('status'=>isset($map[$result->getStatus()])?$map[$result->getStatus()]:'unknown','source'=>'registrar','premium'=>(bool)$result->isPremiumDomain());
            }
        } catch(\Throwable $e) {return null;}
        return null;
    }
    public static function lookup(array $names) {
        $bootstrap=self::bootstrap();$out=array();$pending=array();$multi=curl_multi_init();
        foreach($names as$name){
            $parsed=self::parse($name);$provider=\WHMCS\Config\Setting::getValue('domainLookupProvider').':'.\WHMCS\Config\Setting::getValue('domainLookupRegistrar');$key='lookup:'.$provider.':'.$name;
            $cached=self::read($key);if($cached){$out[$name]=$cached;continue;}
            $via=self::registrar($parsed);if($via&&$via['status']!=='unknown'){$out[$name]=$via;self::save($key,$via,120);continue;}
            $tld=substr($name,strrpos($name,'.')+1);
            if(!isset($bootstrap[$tld])){$out[$name]=array('status'=>'unknown','source'=>'unavailable','premium'=>false);continue;}
            $request=self::handle($bootstrap[$tld].'domain/'.rawurlencode($name));
            if(!$request){$out[$name]=array('status'=>'unknown','source'=>'unavailable','premium'=>false);continue;}
            curl_multi_add_handle($multi,$request['handle']);$pending[]=array('name'=>$name,'key'=>$key,'request'=>$request);
        }
        if($pending){do{$code=curl_multi_exec($multi,$running);if($running&&curl_multi_select($multi,.5)===-1)usleep(10000);}while($running&&$code===CURLM_OK);}
        foreach($pending as$item){$request=$item['request'];$ch=$request['handle'];$http=curl_getinfo($ch,CURLINFO_HTTP_CODE);$data=json_decode($request['body'](),true);$status='unknown';
            if(!curl_errno($ch)&&$http===200&&is_array($data)&&isset($data['objectClassName'],$data['ldhName'])&&$data['objectClassName']==='domain'&&strtolower($data['ldhName'])===$item['name'])$status='registered';
            // Some IANA-listed registries return an empty 404 rather than an RDAP error object.
            // This means no registry record, never a guarantee that a registrar can sell the name.
            elseif(!curl_errno($ch)&&$http===404&&(trim($request['body']())===''||(is_array($data)&&isset($data['errorCode'])&&(int)$data['errorCode']===404)))$status='unregistered';
            $value=array('status'=>$status,'source'=>'registry','premium'=>false);$out[$item['name']]=$value;self::save($item['key'],$value,$status==='unknown'?30:180);
            curl_multi_remove_handle($multi,$ch);curl_close($ch);
        }
        curl_multi_close($multi);return $out;
    }
    public static function price($parsed,$premium=false) {
        if($premium)return null;
        $tld=Capsule::table('tbldomainpricing')->where('extension',$parsed['extension'])->first();if(!$tld)return null;
        $ledger=getCurrency(\WHMCS\Session::get('uid'),\WHMCS\Session::get('currency'));
        $row=Capsule::table('tblpricing')->where('type','domainregister')->where('relid',$tld->id)->where('currency',$ledger['id'])->first();
        if(!$row||!is_numeric($row->msetupfee)||(float)$row->msetupfee<0)return null;
        require_once __DIR__.'/currency.php';return Currency::display($row->msetupfee,$ledger);
    }
    public static function search($input,$offset=0) {
        $parsed=self::parse($input);$extensions=self::extensions();
        $preferred=array('.com','.net','.org','.info','.biz','.online','.store','.tech','.vn','.com.vn');
        usort($extensions,function($a,$b)use($preferred){$ai=array_search($a,$preferred,true);$bi=array_search($b,$preferred,true);return ($ai===false?999:$ai)-($bi===false?999:$bi);});
        $extensions=array_values(array_filter($extensions,function($x)use($parsed){return $x!==$parsed['extension'];}));
        $slice=array_slice($extensions,max(0,min(24,(int)$offset)),6);$names=array($parsed['domain']);
        foreach($slice as$tld)$names[]=$parsed['label'].$tld;
        if(!self::throttle(isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'local',count($names)))throw new \OverflowException('rate_limit');
        $statuses=self::lookup($names);$items=array();
        foreach($names as$name){$state=$statuses[$name];$state['domain']=$name;$state['price']=self::price(self::parse($name),$state['premium']);
            $state['orderable']=$state['status']==='available'&&$state['price']!==null&&(bool)\WHMCS\Config\Setting::getValue('AllowRegister');$items[]=$state;}
        return array('primary'=>array_shift($items),'suggestions'=>$items,'nextOffset'=>$offset+count($slice),'hasMore'=>$offset+count($slice)<min(30,count($extensions)),'checkedAt'=>gmdate('c'));
    }
}

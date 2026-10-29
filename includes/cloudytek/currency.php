<?php
namespace Cloudytek;
use WHMCS\Database\Capsule;

/** VND ledger, daily cached market FX for secondary currency presentation/pricing. */
class Currency
{
    const ENABLED='CloudytekVndBaseV1';
    const CACHE='CloudytekExchangeRatesV1';
    const URL='https://open.er-api.com/v6/latest/USD';
    public static function enabled(){return (bool)Capsule::table('tblconfiguration')->where('setting',self::ENABLED)->value('value');}
    public static function cache(){ $s=Capsule::table('tblconfiguration')->where('setting',self::CACHE)->value('value');$v=$s?json_decode($s,true):array();return is_array($v)?$v:array(); }
    public static function validate($data,$now=null){
        $now=$now===null?time():$now;
        if(!is_array($data) || !isset($data['result'],$data['base_code'],$data['rates']['USD'],$data['rates']['VND'],$data['time_last_update_unix'],$data['time_next_update_unix'])
            || $data['result']!=='success' || $data['base_code']!=='USD' || (float)$data['rates']['USD']!==1.0)
            throw new \RuntimeException('Invalid exchange-rate response.');
        $rate=$data['rates']['VND'];$date=$data['time_last_update_unix'];
        if(!is_numeric($rate) || $rate<10000 || $rate>100000 || !is_numeric($date) || $date>$now+300 || $date<$now-7*86400)
            throw new \RuntimeException('Invalid or stale USD/VND exchange rate.');
        return $data;
    }
    public static function fetch(){
        $ch=curl_init(self::URL);curl_setopt_array($ch,array(CURLOPT_RETURNTRANSFER=>true,CURLOPT_CONNECTTIMEOUT=>3,CURLOPT_TIMEOUT=>6,
            CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2,CURLOPT_FOLLOWLOCATION=>false,CURLOPT_USERAGENT=>'Cloudytek-Currency/1.0'));
        $raw=curl_exec($ch);$status=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);
        if($status!==200 || !is_string($raw) || strlen($raw)>131072)throw new \RuntimeException('Exchange-rate provider unavailable.');
        return self::validate(json_decode($raw,true));
    }
    public static function refresh($force=false,$fetcher=null){
        if(!self::enabled())return false;
        $old=self::cache();$now=time();
        if(!$force && !empty($old['next_check']) && $old['next_check']>$now)return false;
        $pdo=Capsule::connection()->getPdo();$lock='ctk-fx-'.substr(hash('sha256',Capsule::connection()->getDatabaseName()),0,24);
        $q=$pdo->prepare('SELECT GET_LOCK(?,0)');$q->execute(array($lock));if((int)$q->fetchColumn()!==1)return false;
        try{
            $old=self::cache();if(!$force && !empty($old['next_check']) && $old['next_check']>$now)return false;
            try{
                $data=self::validate($fetcher?call_user_func($fetcher):self::fetch());
                if(!empty($old['source_time']) && $data['time_last_update_unix']<$old['source_time'])throw new \RuntimeException('Rate feed is older than the stored rate.');
                $new=array('usd_vnd'=>(float)$data['rates']['VND'],'rates'=>$data['rates'],'source_time'=>(int)$data['time_last_update_unix'],
                    'fetched_at'=>$now,'next_check'=>max($now+3600,min($now+86400,(int)$data['time_next_update_unix']+60)),'last_error'=>'');
                Capsule::connection()->transaction(function()use($new){
                    foreach(Capsule::table('tblcurrencies')->get()as$row){
                        if(!isset($new['rates'][$row->code]))continue;
                        if(!is_numeric($new['rates'][$row->code]) || $new['rates'][$row->code]<=0)throw new \RuntimeException('Invalid configured currency rate.');
                        $rate=$row->code==='VND'?1:$new['rates'][$row->code]/$new['usd_vnd'];
                        Capsule::table('tblcurrencies')->where('id',$row->id)->update(array('rate'=>number_format($rate,12,'.','')));
                    }
                    Capsule::table('tblconfiguration')->updateOrInsert(array('setting'=>self::CACHE),array('value'=>json_encode($new)));
                    // Native pricing sync preserves disabled prices and domain-year metadata.
                    if(!function_exists('currencyUpdatePricing'))require_once ROOTDIR.'/includes/currencyfunctions.php';
                    currencyUpdatePricing();
                });
                return true;
            }catch(\Throwable$e){
                $old['next_check']=$now+3600;$old['last_error']='Rate refresh failed; keeping the last verified rate.';
                Capsule::table('tblconfiguration')->updateOrInsert(array('setting'=>self::CACHE),array('value'=>json_encode($old)));
                return false;
            }
        }finally{$q=$pdo->prepare('SELECT RELEASE_LOCK(?)');$q->execute(array($lock));}
    }
    public static function displayCurrency(){
        $code=\Lang::getName()==='vietnamese'?'VND':'USD';
        $row=Capsule::table('tblcurrencies')->where('code',$code)->first();return $row?(array)$row:null;
    }
    public static function convert($amount,array$from,array$to){
        if((int)$from['id']===(int)$to['id'])return (float)$amount;
        if((float)$from['rate']<=0 || (float)$to['rate']<=0)throw new \RuntimeException('Exchange rate is not configured.');
        return round((float)$amount/(float)$from['rate']*(float)$to['rate'],$to['code']==='VND'?0:2);
    }
    public static function display($amount,array$from){
        $to=self::displayCurrency();if(!$to)$to=$from;
        return (string)new \WHMCS\View\Formatter\Price(self::convert($amount,$from,$to),$to);
    }
}

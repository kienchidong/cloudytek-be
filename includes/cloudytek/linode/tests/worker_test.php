<?php
if(PHP_SAPI!=='cli')exit;
require dirname(__DIR__,4).'/init.php';
require dirname(__DIR__).'/bootstrap.php';
use Cloudytek\Linode\Web;
use Cloudytek\Linode\Api;
use Cloudytek\Linode\Catalog;
use Cloudytek\Linode\Worker;
use Cloudytek\Linode\Vault;
$config=DI::make('config');
if($config['db_name']!=='whmcs78_cloudytek_demo')throw new RuntimeException('This fixture test only runs against the isolated local demo');
$store=Web::store();$db=WHMCS\Database\Capsule::connection()->getPdo();$catalog=new Catalog();$checks=0;
function ok($value,$message){global $checks;$checks++;if(!$value)throw new RuntimeException($message);}
function cloneRow($store,$table,array $overrides) {
    if(!in_array($table,array('tblproducts','tblhosting','tblinvoices','tblinvoiceitems'),true))throw new RuntimeException('Invalid fixture table');
    $row=$store->run('SELECT * FROM '.$table.' LIMIT 1')->fetch(PDO::FETCH_ASSOC);if(!$row)throw new RuntimeException('Missing demo fixture');
    unset($row['id']);$row=array_merge($row,$overrides);$columns=array_keys($row);
    $store->run('INSERT INTO '.$table.' (`'.implode('`,`',$columns).'`) VALUES ('.implode(',',array_fill(0,count($columns),'?')).')',array_values($row));
    return WHMCS\Database\Capsule::connection()->getPdo()->lastInsertId();
}
$store->install();
if($store->run('SELECT COUNT(*) FROM ctk_linode_jobs')->fetchColumn()||$store->run('SELECT COUNT(*) FROM ctk_linode_resources')->fetchColumn())throw new RuntimeException('Integration data exists; fixture run refused');
$db->beginTransaction();
try {
    $cipher=Vault::seal('local-test-token');ok(Vault::open($cipher)==='local-test-token','Vault roundtrip');
    $tampered=substr($cipher,0,-4).'AAAA';$rejected=false;try{Vault::open($tampered);}catch(Throwable $e){$rejected=true;}ok($rejected,'Vault tamper detection');
    $store->saveAccount(0,'Fixture only','local-test-token',true,'v4');$account=$db->lastInsertId();
    $store->saveAccount($account,'Fixture only','',true,'v4',array('api_url'=>'https://api.linode.com/v4','username'=>'fixture-user','prefix'=>'cloudytek-','backup_price'=>'12.5000'));
    $settings=$store->account($account);
    ok($settings['username']==='fixture-user'&&$settings['prefix']==='cloudytek'&&$settings['backup_price']==='12.5000','Extended account settings persist');
    ok(Vault::open($settings['token_cipher'])==='local-test-token','Blank API Key preserves encrypted credential');
    $invalid=false;try{$store->saveAccount($account,'Fixture only','',true,'v4',array('api_url'=>'https://example.org/v4'));}catch(Throwable $e){$invalid=true;}ok($invalid,'Custom API host must be rejected');
    $invalid=false;try{$store->saveAccount($account,'Fixture only','',true,'v4',array('backup_price'=>'-1'));}catch(Throwable $e){$invalid=true;}ok($invalid,'Negative backup price must be rejected');
    $client=$store->run('SELECT id FROM tblclients LIMIT 1')->fetchColumn();
    $product=cloneRow($store,'tblproducts',array('name'=>'Cloudytek Linode fixture only','servertype'=>'','autosetup'=>''));
    $service=cloneRow($store,'tblhosting',array('userid'=>$client,'packageid'=>$product,'orderid'=>0,'domainstatus'=>'Pending','domain'=>'fixture.example.org','password'=>encrypt('Test-password-not-a-real-credential')));
    $invoice=cloneRow($store,'tblinvoices',array('userid'=>$client,'status'=>'Paid'));
    cloneRow($store,'tblinvoiceitems',array('invoiceid'=>$invoice,'userid'=>$client,'type'=>'Hosting','relid'=>$service));
    $store->saveProduct($product,$account,'linode',array('region'=>'us-east','type'=>'fixture','image'=>'linode/test','root_pass'=>'{{password}}'),true,array('post-boot-linode-instance'));
    $calls=array();$fail=false;
    $factory=function()use($catalog,&$calls,&$fail){return new Api($catalog,'fixture',true,function($method,$url,$headers,$payload)use(&$calls,&$fail){
        $calls[]=array($method,$url);
        if($fail&&$method==='POST')throw new RuntimeException('Network timeout; result unknown',599);
        return array('status'=>200,'body'=>json_encode(array('id'=>910001,'status'=>'running','ipv4'=>array('192.0.2.10'))));
    });};
    $worker=new Worker($store,$catalog,$factory);
    ok($worker->queueInvoice($invoice)===1,'Paid service queued');ok($worker->queueInvoice($invoice)===0,'Duplicate invoice event deduplicated');
    $label=$store->run('SELECT correlation FROM ctk_linode_jobs WHERE service_id=?',array($service))->fetchColumn();
    ok(strpos($label,'cloudytek-s'.$service.'-')===0&&strlen($label)<=32,'Configured prefix used in bounded resource label');
    $worker->tick(1);ok((bool)$store->resource($service),'Resource binding saved');ok($store->service($service)['domainstatus']==='Active','Service waits for confirmed readiness');
    $worker->tick(1);ok(count(array_filter($calls,function($call){return $call[0]==='POST';}))===1,'Repeated tick cannot recreate resource');
    $service2=cloneRow($store,'tblhosting',array('userid'=>$client,'packageid'=>$product,'orderid'=>0,'domainstatus'=>'Pending','domain'=>'uncertain.example.org','password'=>encrypt('Fixture-password')));
    cloneRow($store,'tblinvoiceitems',array('invoiceid'=>$invoice,'userid'=>$client,'type'=>'Hosting','relid'=>$service2));
    ok($worker->queueInvoice($invoice)===1,'Second service queued');$fail=true;$worker->tick(1);
    $state=$store->run('SELECT status FROM ctk_linode_jobs WHERE service_id=?',array($service2))->fetchColumn();ok($state==='reconcile','Unknown write outcome held for reconciliation');
    $before=count($calls);$worker->tick(1);ok(count($calls)===$before,'Uncertain write never automatically retried');
    $store->run('UPDATE ctk_linode_jobs SET status="pending" WHERE service_id=?',array($service2));
    $store->run('UPDATE tblinvoices SET status="Cancelled" WHERE id=?',array($invoice));$worker->tick(1);
    ok($store->run('SELECT status FROM ctk_linode_jobs WHERE service_id=?',array($service2))->fetchColumn()==='failed','Invoice eligibility rechecked before provider call');
    ok(count($calls)===$before,'Cancelled invoice caused no provider mutation');
    echo json_encode(array('checks'=>$checks,'status'=>'passed','network'=>'mock only','fixture_cleanup'=>'transaction rollback')).PHP_EOL;
} finally { $db->rollBack(); }

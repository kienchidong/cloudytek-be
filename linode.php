<?php
define('CLIENTAREA',true);
require __DIR__.'/init.php';
require ROOTDIR.'/includes/cloudytek/linode/bootstrap.php';
use Cloudytek\Linode\Web;
use Cloudytek\Linode\Catalog;
use Cloudytek\Linode\Families;
use Cloudytek\Linode\Policy;
use Cloudytek\Linode\Api;
$ca=new WHMCS\ClientArea();$ca->setPageTitle('Cloud service management');$ca->initPage();$ca->requireLogin();
header('Cache-Control: no-store');
$store=Web::store();$catalog=new Catalog();$error='';$result=null;$operations=array();$serviceId=(int)$whmcs->get_req_var('serviceid');
try {
    if(!$store->installed())throw new RuntimeException('Cloud management is not configured');
    $resource=$store->resource($serviceId);$service=$store->service($serviceId);$clientId=(int)$ca->getUserID();
    if(!$resource || (int)$service['userid']!==$clientId || (int)$resource['client_id']!==$clientId) { http_response_code(403);throw new RuntimeException('Access denied'); }
    $mapping=$store->product($service['packageid']);$allowed=$mapping?json_decode($mapping['actions_json'],true):array();
    $root='/{apiVersion}'.Families::get($resource['family'])['root'];
    foreach($catalog->all() as $id=>$op)if((($op['path']===$root||strpos($op['path'],$root.'/')===0)&&($op['method']==='GET'||in_array($id,$allowed,true)))||($resource['family']==='linode'&&$id==='put-ip'&&in_array($id,$allowed,true)))$operations[$id]=$op;
    if($_SERVER['REQUEST_METHOD']==='POST') {
        Web::csrf();
        if(isset($_POST['action'])&&$_POST['action']==='access_password') {
            if($resource['family']!=='linode'||$service['domainstatus']!=='Active'||$_POST['confirm']!=='REVEAL PASSWORD')throw new RuntimeException('Password reveal is not permitted');
            $result=array('initial_root_password'=>decrypt($service['password']),'note'=>'Provider-side password changes outside this portal may differ.');
            $store->audit('client:'.$clientId,'reveal-access-password','service:'.$serviceId,'Owner requested credentials');
        } else {
        $id=$_POST['operation'];$op=$catalog->operation($id);
        if(($op['method']!=='GET'||isset($_POST['reveal'])) && (!isset($_POST['confirm'])||!hash_equals($id,$_POST['confirm'])))throw new RuntimeException('Type the selected operation ID to confirm');
        $body=trim($_POST['body'])!==''?json_decode($_POST['body']):null;
        if(trim($_POST['body'])!==''&&json_last_error()!==JSON_ERROR_NONE)throw new RuntimeException('Invalid JSON body');
        $path=Policy::authorize($catalog,$resource,$service,$clientId,$id,Web::json($_POST['path']),$body,$allowed);
        $api=$store->api($resource['account_id'],$catalog);
        if($id==='put-ip') {
            $instance=$api->call($catalog->find('GET',Families::get('linode')['root']),json_decode($resource['path_json'],true))['data'];
            if(!isset($path['address'])||!in_array($path['address'],isset($instance['ipv4'])?$instance['ipv4']:array(),true))throw new RuntimeException('This IP does not belong to the service');
        }
        if(isset(((array)$body)['config_id']))$api->call($catalog->find('GET',Families::get('linode')['root'].'/configs/{configId}'),array_merge(json_decode($resource['path_json'],true),array('configId'=>((array)$body)['config_id'])));
        $raw=$api->call($id,$path,Web::json($_POST['query']),$body);
        $result=Api::present($raw['data'],isset($_POST['reveal']));$store->audit('client:'.$clientId,$id,'service:'.$serviceId,'HTTP '.$raw['status']);
        if(in_array($id,array('post-reset-linode-password','post-rebuild-linode-instance'),true)&&isset(((array)$body)['root_pass']))$store->run('UPDATE tblhosting SET password=? WHERE id=? AND userid=?',array(encrypt(((array)$body)['root_pass']),$serviceId,$clientId));
        }
    } else {
        $result=Api::redact($store->api($resource['account_id'],$catalog)->call($catalog->find('GET',Families::get($resource['family'])['root']),json_decode($resource['path_json'],true))['data']);
    }
} catch(Throwable $e) { $error=$e instanceof PDOException?'Cloud integration is temporarily unavailable.':$e->getMessage(); }
$ca->assign('ctkError',$error);
$ca->assign('ctkResult',$result!==null?json_encode($result,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES):'');
$ca->assign('ctkServiceId',$serviceId);
$ca->assign('ctkOperations',$operations);
$ca->assign('ctkResource',isset($resource)?$resource:array());
$ca->assign('ctkToken',generate_token('plain'));
$ca->setTemplate('cloudytek-linode');$ca->output();

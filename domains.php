<?php
define('CLIENTAREA',true);
require __DIR__.'/init.php';
require_once ROOTDIR.'/includes/cloudytek/domains.php';
use Cloudytek\Domains;
use WHMCS\Database\Capsule;
header('Cache-Control: no-store');
if($_SERVER['REQUEST_METHOD']==='POST'){
    header('Content-Type: application/json; charset=utf-8');
    try{
        if(!isset($_POST['token'])||!is_string($_POST['token'])||!hash_equals(generate_token('plain'),$_POST['token'])){http_response_code(403);echo json_encode(array('error'=>'csrf'));exit;}
        $data=Domains::search(isset($_POST['domain'])?$_POST['domain']:'',isset($_POST['offset'])?max(0,min(24,(int)$_POST['offset'])):0);
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }catch(InvalidArgumentException $e){http_response_code(422);echo '{"error":"invalid_domain"}';}
    catch(OverflowException $e){http_response_code(429);header('Retry-After: 60');echo '{"error":"rate_limit"}';}
    catch(Throwable $e){http_response_code(503);echo '{"error":"lookup_unavailable"}';}
    exit;
}
if($_SERVER['REQUEST_METHOD']!=='GET'){http_response_code(405);header('Allow: GET, POST');exit;}
$ca=new WHMCS\ClientArea();$ca->setPageTitle(Lang::getName()==='vietnamese'?'Tên miền':'Domains');$ca->initPage();
$ca->assign('displayTitle','');$ca->assign('skipMainBodyContainer',true);
$ca->assign('domainSearchToken',generate_token('plain'));
$groups=Capsule::table('tblproductgroups')->where('hidden',0)->orderBy('order')->get(array('id','name'));
$categories=array();foreach($groups as$g){
    $key=preg_match('/vps/i',$g->name)?'vps':(preg_match('/storage|backup|s3/i',$g->name)?'storage':(preg_match('/cloud|gpu/i',$g->name)?'cloud':(preg_match('/col+ocation|dedicated|physical|bare.?metal/i',$g->name)?'servers':(preg_match('/ssl|certificate/i',$g->name)?'ssl':(preg_match('/hosting|wordpress/i',$g->name)?'hosting':'other')))));
    if(isset($categories[$key]))continue;
    $labels=array('vps'=>'VPS','storage'=>Lang::trans('portalStorage'),'cloud'=>'Cloud','servers'=>Lang::trans('portalServers'),'ssl'=>'SSL Certificates','hosting'=>Lang::trans('portalHosting'),'other'=>Lang::trans('portalOther'));
    $icons=array('vps'=>'server','storage'=>'database','cloud'=>'cloud','servers'=>'building','ssl'=>'shield-alt','hosting'=>'globe','other'=>'layer-group');
    $categories[$key]=array('key'=>$key,'gid'=>$g->id,'label'=>$labels[$key],'icon'=>$icons[$key]);
}
$ca->assign('domainCategories',array_values($categories));
$ca->assign('domainSearchMode',isset($_GET['mode'])&&$_GET['mode']==='transfer'?'transfer':'register');
$copy=array();foreach(array('checking','check','registered','unregistered','available','reserved','unknown','contact','register','pricePending','year','invalid','failed','rate','session','more','transferContact')as$key)$copy[$key]=Lang::trans('ctkDomain_'.$key);
$ca->assign('domainSearchCopy',json_encode($copy,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_UNICODE));
$ca->setTemplate('domain-search');$ca->output();

<?php
if(PHP_SAPI!=='cli') { http_response_code(403); exit; }
define('CLOUDYTEK_LINODE_TEST',true);
require dirname(__DIR__).'/bootstrap.php';
use Cloudytek\Linode\Catalog;
use Cloudytek\Linode\Api;
use Cloudytek\Linode\Families;
use Cloudytek\Linode\Policy;
$catalog=new Catalog();$checks=0;$operations=array();$requests=array();
function verify($condition,$message) { global $checks;$checks++;if(!$condition)throw new RuntimeException($message); }
function rejected($call,$message) { try{$call();}catch(Throwable $e){verify(true,$message);return;}verify(false,$message); }
$transport=function($method,$url,$headers,$payload)use(&$requests){$requests[]=array($method,$url,$headers,$payload);return array('status'=>200,'body'=>'{"id":123,"status":"running"}');};
$api=new Api($catalog,'test-only-token',true,$transport);
$temp=tempnam(sys_get_temp_dir(),'ctk-upload-');file_put_contents($temp,'test attachment');
try {
    foreach($catalog->all() as $id=>$op) {
        $path=array();preg_match_all('/\{([^}]+)\}/',$op['path'],$matches);
        foreach($matches[1] as $key)if($key!=='apiVersion')$path[$key]='123';
        $query=array();$headers=array();
        foreach($catalog->parameters($id) as $param) {
            if(empty($param['required']))continue;
            if($param['in']==='query')$query[$param['name']]='123';
            if($param['in']==='header')$headers[$param['name']]='{}';
        }
        $body=null;$encoding='application/json';
        if(!empty($op['body']['content'])) {
            $encoding=isset($op['body']['content']['application/json'])?'application/json':key($op['body']['content']);
            $body=$encoding==='image/png'?"\x89PNG\r\n\x1a\nfixture":($encoding==='multipart/form-data'?array('file'=>new CURLFile($temp)):new stdClass());
        }
        $response=$api->call($id,$path,$query,$body,$headers,$encoding);
        $request=end($requests);
        verify($response['status']===200&&$request[0]===$op['method'],'Operation dispatch failed: '.$id);
        verify(strpos($request[1],'https://api.linode.com/v4/')===0,'Unexpected host: '.$id);
        $operations[$id]=array('method'=>$op['method'],'path'=>$op['path'],'mock_dispatch'=>'passed','live_verified'=>false);
    }
    verify(count($operations)===count($catalog->all()),'Catalogue coverage mismatch');
    rejected(function()use($catalog){$catalog->path('get-linode-instance',array('linodeId'=>'../account'));},'Path traversal must fail');
    rejected(function()use($catalog){$catalog->path('get-linode-instance',array());},'Missing ID must fail');
    rejected(function()use($api){$api->call('get-profile',array(),array('not_declared'=>'x'));},'Undeclared query must fail');
    rejected(function()use($api){$api->call('get-profile',array(),array(),null,array('Authorization'=>'evil'));},'Token override must fail');
    rejected(function()use($catalog,$transport){(new Api($catalog,'test-token',false,$transport))->call('post-shutdown-linode-instance',array('linodeId'=>123));},'Read-only account mutation must fail');
    rejected(function()use($catalog,$transport){(new Api($catalog,"token\r\nInjected: true",true,$transport));},'Header injection must fail');
    verify(strpos($catalog->path('get-image',array('imageId'=>'private/123')),'private%2F123')!==false,'Image IDs must be encoded');
    $reads=0;$retryApi=new Api($catalog,'test',false,function()use(&$reads){$reads++;return array('status'=>$reads<3?503:200,'body'=>'{}');});
    $retryApi->call('get-profile');verify($reads===3,'GET retry handling failed');
    $writes=0;$writeApi=new Api($catalog,'test',true,function()use(&$writes){$writes++;return array('status'=>503,'body'=>'{"errors":[{"reason":"secret"}]}');});
    rejected(function()use($writeApi){$writeApi->call('post-shutdown-linode-instance',array('linodeId'=>123));},'Failed mutation must throw');verify($writes===1,'Mutation must not retry');
    $redacted=Api::redact(array('root_pass'=>'secret','nested'=>array('token'=>'secret'),'status'=>'running'));
    verify($redacted['root_pass']==='[REDACTED]'&&$redacted['nested']['token']==='[REDACTED]'&&$redacted['status']==='running','Secret redaction failed');
    foreach(Families::all() as $family=>$def) {
        verify((bool)$catalog->find('POST',$def['collection']),'Missing create operation '.$family);
        verify((bool)$catalog->find('GET',$def['root']),'Missing read operation '.$family);
        verify((bool)$catalog->find('DELETE',$def['root']),'Missing delete operation '.$family);
    }
    foreach(Policy::possibleWrites() as $id=>$fields)verify((bool)$catalog->operation($id),'Unknown client action');
    $resource=array('service_id'=>5,'client_id'=>10,'family'=>'linode','path_json'=>'{"linodeId":"123"}');
    $service=array('id'=>5,'userid'=>10,'domainstatus'=>'Active');
    $bound=Policy::authorize($catalog,$resource,$service,10,'get-linode-instance',array(),null,array());
    verify($bound['linodeId']==='123','Root binding was not applied');
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,11,'get-linode-instance',array(),null,array());},'Cross-customer access must fail');
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'get-profile',array(),null,array());},'Account API must not be exposed to client');
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'get-linode-instance',array('linodeId'=>999),null,array());},'Root substitution must fail');
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'delete-linode-instance',array(),null,array('delete-linode-instance'));},'Client deletion must not be enabled');
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'post-rebuild-linode-instance',array(),(object)array('authorized_users'=>array('other-user')),array('post-rebuild-linode-instance'));},'Undeclared write fields must fail');
    $service['domainstatus']='Suspended';
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'post-boot-linode-instance',array(),null,array('post-boot-linode-instance'));},'Suspended client cannot boot');
    $service['domainstatus']='Active';
    rejected(function()use($catalog,$resource,$service){Policy::authorize($catalog,$resource,$service,10,'post-restore-backup',array('backupId'=>45),(object)array('linode_id'=>999),array('post-restore-backup'));},'Cross-service backup restore must fail');
    $report=array('api_version'=>$catalog->version(),'checks'=>$checks,'operations'=>count($operations),'resource_families'=>count(Families::all()),'live_verified'=>false,'coverage'=>$operations);
    file_put_contents(dirname(__DIR__).'/resources/coverage.json',json_encode($report,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
    echo json_encode(array('checks'=>$checks,'mock_operations'=>count($operations),'families'=>count(Families::all()),'status'=>'passed')).PHP_EOL;
} finally { unlink($temp); }

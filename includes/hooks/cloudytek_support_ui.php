<?php
if (!defined('WHMCS')) { exit; }
// Read only the tickets already selected by WHMCS, within the signed-in account.
add_hook('ClientAreaPage',40,function($vars){
    $uid=(int)WHMCS\Session::get('uid');
    if (!$uid || !isset($vars['templatefile']) || $vars['templatefile']!=='supportticketslist' || empty($vars['tickets'])) return array();
    $ids=array();foreach($vars['tickets'] as $ticket)$ids[]=(int)$ticket['id'];
    $rows=WHMCS\Database\Capsule::table('tbltickets')->where('userid',$uid)->whereIn('id',$ids)->get(array('id','name','service'));
    $services=array();$domains=array();$meta=array();$labels=array();
    foreach($rows as $row){
        $meta[$row->id]=array('sender'=>$row->name,'service'=>'');
        if(preg_match('/^S([0-9]+)$/',$row->service,$m))$services[]=(int)$m[1];
        if(preg_match('/^D([0-9]+)$/',$row->service,$m))$domains[]=(int)$m[1];
    }
    if($services){
        $hosting=WHMCS\Database\Capsule::table('tblhosting')->join('tblproducts','tblproducts.id','=','tblhosting.packageid')->where('tblhosting.userid',$uid)->whereIn('tblhosting.id',$services)->get(array('tblhosting.id','tblhosting.domain','tblproducts.name'));
        foreach($hosting as $row)$labels['S'.$row->id]=$row->name.($row->domain?' — '.$row->domain:'');
    }
    if($domains){foreach(WHMCS\Database\Capsule::table('tbldomains')->where('userid',$uid)->whereIn('id',$domains)->get(array('id','domain')) as $row)$labels['D'.$row->id]=$row->domain;}
    foreach($rows as $row)if(isset($labels[$row->service]))$meta[$row->id]['service']=$labels[$row->service];
    return array('portalTicketMeta'=>$meta);
});
add_hook('AdminAreaHeadOutput',40,function(){
    if(basename(isset($_SERVER['SCRIPT_NAME'])?$_SERVER['SCRIPT_NAME']:'')!=='supporttickets.php')return '';
    return '<link rel="stylesheet" href="../assets/css/cloudytek-support.css?v=20261016-2">';
});

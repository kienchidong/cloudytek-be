<?php
if (!defined('WHMCS')) { exit; }
add_hook('ClientAreaPageProductsServices',30,function($vars){
    $uid=(int)WHMCS\Session::get('uid');
    if(!$uid||empty($vars['services'])||!is_array($vars['services']))return array();
    $ids=array();foreach($vars['services'] as $service)if(isset($service['id']))$ids[]=(int)$service['id'];
    if(!$ids)return array();
    $rows=WHMCS\Database\Capsule::table('tblhosting')->where('userid',$uid)->whereIn('id',$ids)->get(array('id','dedicatedip'));
    $ips=array();foreach($rows as $row)$ips[$row->id]=$row->dedicatedip;
    return array('portalServiceIps'=>$ips);
});

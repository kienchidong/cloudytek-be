<?php
if(!defined('WHMCS'))exit;
require_once ROOTDIR.'/includes/cloudytek/currency.php';
// Daily cache checked on requests as well as cron, so the local app needs no open browser worker.
if(\Cloudytek\Currency::enabled())\Cloudytek\Currency::refresh();
add_hook('AfterCronJob',5,function(){\Cloudytek\Currency::refresh();});
add_hook('ClientAreaPage',1200,function($vars){
    if(!\Cloudytek\Currency::enabled())return array();
    $cache=\Cloudytek\Currency::cache();
    $result=array('ctkFxEnabled'=>true,'ctkFxRate'=>isset($cache['usd_vnd'])?$cache['usd_vnd']:0,
        'ctkFxUpdated'=>isset($cache['source_time'])?gmdate('Y-m-d H:i',$cache['source_time']).' UTC':'',
        'ctkFxStale'=>!empty($cache['last_error']) || empty($cache['source_time']) || $cache['source_time']<time()-3*86400);
    if(isset($vars['templatefile']) && $vars['templatefile']==='clientareaaddfunds'){
        $from=getCurrency(WHMCS\Session::get('uid'));$to=\Cloudytek\Currency::displayCurrency();
        $result['walletInputCode']=$to['code'];
        if(isset($vars['amount']) && is_numeric($vars['amount']))$result['amount']=number_format(\Cloudytek\Currency::convert($vars['amount'],$from,$to),$to['code']==='VND'?0:2,'.','');
    }
    if(isset($vars['creditamount']) && is_numeric($vars['creditamount'])){
        $from=getCurrency(WHMCS\Session::get('uid'));$to=\Cloudytek\Currency::displayCurrency();
        $result['creditamount']=number_format(\Cloudytek\Currency::convert($vars['creditamount'],$from,$to),$to['code']==='VND'?0:2,'.','');
    }
    return $result;
});

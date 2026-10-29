<?php
if (!defined('WHMCS')) exit;
require_once ROOTDIR.'/includes/cloudytek/wallet.php';
use Cloudytek\Wallet;
add_hook('ClientAreaPage',1100,function($vars){
    $uid=(int)WHMCS\Session::get('uid'); if(!$uid)return array();
    if(WHMCS\Session::get('cid')) {
        $contact=WHMCS\User\Client\Contact::find(WHMCS\Session::get('cid'));
        if(!$contact || !in_array('invoices',$contact->permissions,true))return array();
    }
    try { return array('ctkWallet'=>Wallet::view($uid,\Cloudytek\Currency::displayCurrency())); } catch(Throwable $e) { return array('ctkWalletError'=>true); }
});
add_hook('AdminAreaClientSummaryPage',30,function($vars){
    if(!checkPermission('View Credit Log',true))return '';
    try {
        $s=Wallet::view((int)$vars['userid']);
        return '<div class="alert alert-info"><strong>Tài khoản chính:</strong> '.Wallet::esc($s['main_formatted']).' &nbsp; <strong>Khuyến mãi:</strong> '.Wallet::esc($s['promo_formatted']).' &nbsp; <a class="btn btn-default btn-sm" href="cloudytek-wallet.php?userid='.(int)$vars['userid'].'">Quản lý số dư</a></div>';
    } catch(Throwable $e) { return '<p class="alert alert-warning">Ví cần được đối soát.</p>'; }
});
add_hook('AdminAreaClientSummaryActionLinks',30,function($vars){
    return checkPermission('View Credit Log',true)?array('<a href="cloudytek-wallet.php?userid='.(int)$vars['userid'].'">Số dư</a>'):array();
});

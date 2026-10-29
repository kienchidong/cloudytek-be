<?php
define('CLIENTAREA',true);
require __DIR__.'/init.php';
require_once ROOTDIR.'/includes/cloudytek/wallet.php';
use Cloudytek\Wallet;
use WHMCS\Database\Capsule;
$ca=new WHMCS\ClientArea();$ca->setPageTitle('Số dư');$ca->initPage();$ca->requireLogin();
header('Cache-Control: no-store');
$uid=(int)$ca->getUserID();
if(WHMCS\Session::get('cid')) {
    $contact=WHMCS\User\Client\Contact::find(WHMCS\Session::get('cid'));
    if(!$contact || !in_array('invoices',$contact->permissions,true)){http_response_code(403);exit('Access denied');}
}
if($_SERVER['REQUEST_METHOD']!=='GET'){http_response_code(405);header('Allow: GET');exit;}
try {
    $ca->assign('walletBalances',Wallet::view($uid,\Cloudytek\Currency::displayCurrency()));
    $rows=Capsule::table('tblcredit')->where('clientid',$uid)->orderBy('id','desc')->limit(50)->get();$history=array();
    foreach($rows as $row)$history[]=array('date'=>$row->date,'description'=>$row->description,'amount'=>\Cloudytek\Currency::display($row->amount,getCurrency($uid)));
    $ca->assign('walletHistory',$history);
}catch(Throwable $e){$ca->assign('walletError','Ví cần được admin kiểm tra số dư. Vui lòng liên hệ hỗ trợ.');}
$ca->setTemplate('wallet');$ca->output();

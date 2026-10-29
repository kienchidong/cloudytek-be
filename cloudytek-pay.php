<?php
require __DIR__.'/init.php';
require_once ROOTDIR.'/includes/cloudytek/payments.php';
use Cloudytek\Payments;
header('Cache-Control: no-store');
try {
    if ($_SERVER['REQUEST_METHOD']!=='POST') { http_response_code(405); header('Allow: POST'); exit; }
    check_token('WHMCS.default');
    Payments::csrf();
    $id=isset($_POST['invoiceid'])?(int)$_POST['invoiceid']:0;
    $invoice=WHMCS\Billing\Invoice::find($id);
    if (!$invoice || !WHMCS\Session::get('uid') || (int)$invoice->userid!==(int)WHMCS\Session::get('uid')) { http_response_code(403); exit('Access denied'); }
    if (WHMCS\Session::get('cid')) {
        $contact=WHMCS\Database\Capsule::table('tblcontacts')->where('id',WHMCS\Session::get('cid'))->where('userid',$invoice->userid)->first();
        if (!$contact || !in_array('invoices',explode(',',$contact->permissions),true)) { http_response_code(403); exit('Access denied'); }
    }
    $row=Payments::intent($id,'ctkcard');
    header('Location: '.Payments::stripeCheckout($row),true,303);
} catch (Throwable $e) { http_response_code(400); echo Payments::esc($e->getMessage()); }

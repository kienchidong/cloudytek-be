<?php
require __DIR__.'/../../../init.php';
require_once ROOTDIR.'/includes/cloudytek/payments.php';
require_once ROOTDIR.'/includes/invoicefunctions.php';
use Cloudytek\Payments;
use WHMCS\Database\Capsule;
header('Content-Type: application/json'); header('Cache-Control: no-store');
try {
    if ($_SERVER['REQUEST_METHOD']!=='POST') { http_response_code(405); header('Allow: POST'); exit('{"success":false}'); }
    $c=Payments::config(); $auth=isset($_SERVER['HTTP_AUTHORIZATION'])?$_SERVER['HTTP_AUTHORIZATION']:'';
    if (!$c['sepay_enabled'] || !Payments::sepayAuth($auth,$c['sepay_key'])) { http_response_code(401); exit('{"success":false}'); }
    $raw=file_get_contents('php://input',false,null,0,65537);
    $data=strlen($raw)<=65536?json_decode($raw,true):null;
    if (!is_array($data) || !isset($data['content']) || !is_string($data['content'])) throw new RuntimeException('Invalid payload');
    // Ignore unrelated bank transfers; never guess an invoice from a number alone.
    if (!preg_match('/(?<![A-Z0-9])CTK([A-F0-9]{24})(?![A-Z0-9])/i',$data['content'],$match)) exit('{"success":true}');
    $row=Capsule::table('ctk_payment_intents')->where('token',strtoupper($match[1]))->where('gateway','ctksepay')->first();
    if (!$row || !Payments::sepayMatch($data,$row)) throw new RuntimeException('Transfer does not match payment intent');
    // Late bank transfers are held for review, including a transfer after a replacement QR was issued.
    if (!Payments::sepayWindow(isset($data['transactionDate'])?$data['transactionDate']:null,$row)) throw new RuntimeException('Transfer outside payment window');
    Payments::settle($row,'sepay-'.(string)$data['id']);
    echo '{"success":true}';
} catch (Throwable $e) {
    logActivity('SePay callback held for review'.(isset($row) && $row?' for invoice #'.$row->invoice_id:'').': '.($e instanceof PDOException?'Database error':$e->getMessage()));
    http_response_code(422); echo '{"success":false,"message":"Payment requires review"}';
}

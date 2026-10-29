<?php
require __DIR__.'/../../../init.php';
require_once ROOTDIR.'/includes/cloudytek/payments.php';
require_once ROOTDIR.'/includes/invoicefunctions.php';
use Cloudytek\Payments;
use WHMCS\Database\Capsule;
header('Content-Type: application/json'); header('Cache-Control: no-store');
try {
    if ($_SERVER['REQUEST_METHOD']!=='POST') { http_response_code(405); header('Allow: POST'); exit('{"success":false}'); }
    $c=Payments::config(); $raw=file_get_contents('php://input',false,null,0,262145);
    $signature=isset($_SERVER['HTTP_STRIPE_SIGNATURE'])?$_SERVER['HTTP_STRIPE_SIGNATURE']:'';
    if (!$c['card_enabled'] || strlen($raw)>262144 || !Payments::stripeSignature($raw,$signature,$c['stripe_webhook'])) { http_response_code(401); exit('{"success":false}'); }
    $event=json_decode($raw,true);
    if (!is_array($event) || empty($event['type'])) throw new RuntimeException('Invalid payload');
    if ($event['type']!=='checkout.session.completed') exit('{"success":true}');
    $s=isset($event['data']['object'])?$event['data']['object']:array();
    $token=isset($s['metadata']['ctk_token'])?$s['metadata']['ctk_token']:'';
    if (!is_string($token) || !preg_match('/^[A-F0-9]{24}$/D',$token)) throw new RuntimeException('Invalid intent token');
    $row=Capsule::table('ctk_payment_intents')->where('token',$token)->where('gateway','ctkcard')->first();
    if (!$row || !Payments::stripeMatch($s,$row)) throw new RuntimeException('Session does not match payment intent');
    // Test payments must NEVER mark a real WHMCS invoice paid or provision a service.
    if ($row->testmode) { logActivity('Stripe TEST payment verified for invoice #'.$row->invoice_id.'; invoice not credited.'); exit('{"success":true,"test":true}'); }
    Payments::settle($row,'stripe-'.$s['payment_intent']);
    echo '{"success":true}';
} catch (Throwable $e) {
    logActivity('Stripe callback held for review'.(isset($row) && $row?' for invoice #'.$row->invoice_id:'').': '.($e instanceof PDOException?'Database error':$e->getMessage()));
    http_response_code(422); echo '{"success":false,"message":"Payment requires review"}';
}

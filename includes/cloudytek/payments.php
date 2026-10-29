<?php
namespace Cloudytek;

use WHMCS\Database\Capsule;

/** Hosted payments only. No card numbers or CVVs pass through WHMCS. */
class Payments
{
    const CONFIG = 'CloudytekPaymentsV1';
    public static function esc($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
    public static function defaults() {
        return array('sepay_enabled'=>false, 'bank'=>'', 'account'=>'', 'holder'=>'', 'sepay_key'=>'',
            'usd_vnd'=>'', 'card_enabled'=>false, 'stripe_key'=>'', 'stripe_webhook'=>'', 'testmode'=>true);
    }
    public static function config() {
        $value = Capsule::table('tblconfiguration')->where('setting', self::CONFIG)->value('value');
        $data = $value ? json_decode(decrypt($value), true) : array();
        $config=array_merge(self::defaults(), is_array($data) ? $data : array());
        require_once __DIR__.'/currency.php';
        if(Currency::enabled()){$fx=Currency::cache();if(!empty($fx['usd_vnd']))$config['usd_vnd']=number_format($fx['usd_vnd'],4,'.','');}
        return $config;
    }
    public static function base() { return rtrim(\WHMCS\Config\Setting::getValue('SystemURL'), '/'); }
    public static function csrf() {
        if (!isset($_POST['token']) || !is_string($_POST['token']) || !hash_equals(generate_token('plain'),$_POST['token']))
            throw new \RuntimeException('Invalid CSRF Protection Token');
    }
    public static function installed() { return Capsule::schema()->hasTable('ctk_payment_intents'); }
    public static function install() {
        if (!self::installed()) Capsule::schema()->create('ctk_payment_intents', function($t) {
            $t->string('token', 32)->primary(); $t->integer('invoice_id')->index();
            $t->string('gateway', 16); $t->string('currency', 3); $t->bigInteger('invoice_minor');
            $t->bigInteger('provider_minor'); $t->string('account', 64)->default('');
            $t->string('bank', 64)->default(''); $t->string('session_id', 255)->default('')->index();
            $t->text('checkout_url')->nullable(); $t->boolean('testmode')->default(true);
            $t->dateTime('expires_at'); $t->dateTime('created_at');
        });
        if (!Capsule::schema()->hasTable('ctk_payment_receipts')) Capsule::schema()->create('ctk_payment_receipts', function($t) {
            $t->string('transaction_id', 191)->primary(); $t->integer('invoice_id')->index();
            $t->string('token', 32); $t->string('state', 24); $t->dateTime('created_at');
        });
    }
    public static function save($input) {
        $c = self::config();
        foreach (array('bank','account','holder','usd_vnd') as $key) {
            $c[$key] = trim(isset($input[$key]) && is_string($input[$key]) ? $input[$key] : '');
            if (strlen($c[$key]) > 100) throw new \RuntimeException('Thông tin quá dài: '.$key);
        }
        foreach (array('sepay_key','stripe_key','stripe_webhook') as $key) {
            if (!empty($input[$key]) && is_string($input[$key])) $c[$key] = trim($input[$key]);
        }
        foreach (array('sepay_enabled','card_enabled','testmode') as $key) $c[$key] = !empty($input[$key]);
        if ($c['sepay_enabled']) {
            if (!preg_match('/^[A-Za-z0-9]{2,64}$/D', $c['bank']) || !preg_match('/^[A-Za-z0-9]{3,64}$/D', $c['account']) || !$c['holder'])
                throw new \RuntimeException('Nhập ngân hàng, số tài khoản và tên chủ tài khoản hợp lệ.');
            if (strlen($c['sepay_key']) < 24 || preg_match('/\s/', $c['sepay_key'])) throw new \RuntimeException('API Key webhook SePay cần ít nhất 24 ký tự, không chứa khoảng trắng.');
            if (!preg_match('/^[0-9]{4,6}(\.[0-9]{1,4})?$/D', $c['usd_vnd']) || (float)$c['usd_vnd'] < 1000)
                throw new \RuntimeException('Nhập tỷ giá thanh toán USD → VND (VND cho 1 USD).');
        }
        if ($c['card_enabled']) {
            $prefix = $c['testmode'] ? 'sk_test_' : 'sk_live_';
            if (strpos($c['stripe_key'], $prefix) !== 0 || strpos($c['stripe_webhook'], 'whsec_') !== 0)
                throw new \RuntimeException('Stripe Secret Key / Webhook Signing Secret không hợp lệ hoặc sai chế độ Test/Live.');
        }
        if ($c['sepay_enabled'] || ($c['card_enabled'] && !$c['testmode'])) {
            if (strpos(self::base(), 'https://') !== 0) throw new \RuntimeException('Cần cấu hình System URL là HTTPS công khai trước khi bật nhận tiền thật.');
        }
        self::install();
        Capsule::connection()->transaction(function() use ($c) {
            Capsule::table('tblconfiguration')->updateOrInsert(array('setting'=>self::CONFIG), array('value'=>encrypt(json_encode($c))));
            foreach (array('ctksepay'=>array('SePay QR', $c['sepay_enabled']), 'ctkcard'=>array('Visa / Mastercard'.($c['testmode']?' (Test)':''), $c['card_enabled'])) as $name=>$item) {
                foreach (array('name'=>$item[0], 'type'=>'Invoices', 'visible'=>$item[1]?'on':'') as $setting=>$value) {
                    Capsule::table('tblpaymentgateways')->updateOrInsert(array('gateway'=>$name,'setting'=>$setting), array('value'=>$value, 'order'=>30));
                }
            }
        });
        logActivity('Cloudytek payment settings updated by admin #'.(int)\WHMCS\Session::get('adminid').' (credentials omitted)');
    }
    public static function minor($amount, $currency) {
        $digits = $currency === 'VND' ? 0 : 2;
        if (!in_array($currency, array('VND','USD','EUR','GBP','AUD','CAD','SGD'), true)) throw new \RuntimeException('Loại tiền này chưa được hỗ trợ.');
        if (!is_numeric($amount) || (float)$amount <= 0 || (float)$amount > 1000000000) throw new \RuntimeException('Số tiền không hợp lệ.');
        $scaled = (float)$amount * pow(10, $digits);
        if (abs($scaled-round($scaled)) > 0.001) throw new \RuntimeException('Số tiền có phần thập phân không hợp lệ.');
        return (int)round($scaled);
    }
    public static function invoice($id, $gateway) {
        $invoice = \WHMCS\Billing\Invoice::find((int)$id);
        if (!$invoice || $invoice->status !== 'Unpaid' || $invoice->paymentmethod !== $gateway || (float)$invoice->balance <= 0)
            throw new \RuntimeException('Hóa đơn không còn chờ thanh toán bằng phương thức này.');
        $currency = Capsule::table('tblclients')->join('tblcurrencies','tblclients.currency','=','tblcurrencies.id')
            ->where('tblclients.id', $invoice->userid)->value('tblcurrencies.code');
        return array($invoice, strtoupper($currency), self::minor($invoice->balance, strtoupper($currency)));
    }
    public static function intent($id, $gateway) {
        $c = self::config();
        if (empty($c[$gateway === 'ctksepay' ? 'sepay_enabled' : 'card_enabled']) || !self::installed()) throw new \RuntimeException('Phương thức thanh toán chưa được cấu hình.');
        list($invoice, $currency, $minor) = self::invoice($id, $gateway);
        $provider = $minor;
        if ($gateway === 'ctksepay') {
            if ($currency !== 'VND' && $currency !== 'USD') throw new \RuntimeException('SePay chỉ hỗ trợ hóa đơn VND hoặc USD có tỷ giá cấu hình.');
            $provider = $currency === 'USD' ? (int)round($minor / 100 * (float)$c['usd_vnd']) : $minor;
        }
        $row = Capsule::table('ctk_payment_intents')->where('invoice_id', $id)->where('gateway',$gateway)
            ->where('invoice_minor',$minor)->where('currency',$currency)->where('provider_minor',$provider)
            ->where('account',$gateway==='ctksepay'?$c['account']:'')->where('bank',$gateway==='ctksepay'?$c['bank']:'')
            ->where('testmode',$c['testmode']?1:0)->where('expires_at','>',gmdate('Y-m-d H:i:s',time()+60))->orderBy('created_at','desc')->first();
        if ($row) return $row;
        $data = array('token'=>strtoupper(bin2hex(random_bytes(12))), 'invoice_id'=>(int)$id, 'gateway'=>$gateway,
            'currency'=>$currency, 'invoice_minor'=>$minor, 'provider_minor'=>$provider,
            'account'=>$gateway==='ctksepay'?$c['account']:'', 'bank'=>$gateway==='ctksepay'?$c['bank']:'',
            'testmode'=>$c['testmode']?1:0, 'created_at'=>gmdate('Y-m-d H:i:s'), 'expires_at'=>gmdate('Y-m-d H:i:s',time()+($gateway==='ctkcard'?3600:1800)));
        Capsule::table('ctk_payment_intents')->insert($data);
        return Capsule::table('ctk_payment_intents')->where('token',$data['token'])->first();
    }
    public static function link($params, $gateway) {
        try {
            $c=self::config();
            if ($gateway === 'ctkcard') {
                if (!$c['card_enabled']) throw new \RuntimeException('Thanh toán thẻ chưa được bật.');
                return '<form method="post" action="'.self::esc(self::base().'/cloudytek-pay.php').'"><input type="hidden" name="token" value="'.self::esc(generate_token('plain')).'"><input type="hidden" name="invoiceid" value="'.(int)$params['invoiceid'].'"><button class="btn btn-primary">Thanh toán Visa / Mastercard'.($c['testmode']?' — TEST':'').'</button><p>Nhập thẻ tại trang thanh toán bảo mật của Stripe.</p></form>';
            }
            $row = self::intent($params['invoiceid'], $gateway);
            $memo = 'CTK'.$row->token;
            $qr = 'https://vietqr.app/img?'.http_build_query(array('acc'=>$row->account,'bank'=>$row->bank,'amount'=>$row->provider_minor,'des'=>$memo,'template'=>'compact','holder'=>$c['holder']));
            return '<div class="ctk-qr-payment"><h3>Quét QR để thanh toán</h3><img style="width:280px;max-width:100%;height:auto" referrerpolicy="no-referrer" src="'.self::esc($qr).'" alt="QR chuyển khoản SePay"><p><strong>'.number_format($row->provider_minor,0,',','.').' VND</strong></p><p>'.self::esc($row->bank.' • '.$row->account.' • '.$c['holder']).'</p><p>Nội dung: <strong>'.self::esc($memo).'</strong></p><p>Chuyển đúng số tiền và nội dung. QR có hiệu lực 30 phút. Hóa đơn được cập nhật sau khi SePay xác nhận tiền vào.</p><a class="btn btn-default" href="'.self::esc(self::base().'/viewinvoice.php?id='.$row->invoice_id).'">Kiểm tra thanh toán</a></div>';
        } catch (\Throwable $e) { return '<p class="alert alert-warning">'.self::esc($e->getMessage()).'</p>'; }
    }
    public static function stripeSignature($raw, $header, $secret, $now=null) {
        if (!$secret || strlen($header)>2048) return false;
        $timestamp=null; $signatures=array();
        foreach (explode(',', $header) as $item) {
            $parts=explode('=',trim($item),2);
            if (count($parts)!==2) continue;
            if ($parts[0]==='t' && ctype_digit($parts[1])) $timestamp=(int)$parts[1];
            if ($parts[0]==='v1') $signatures[]=$parts[1];
        }
        if (!$timestamp || abs(($now===null?time():$now)-$timestamp)>300) return false;
        $expected=hash_hmac('sha256', $timestamp.'.'.$raw, $secret);
        foreach ($signatures as $signature) if (hash_equals($expected,$signature)) return true;
        return false;
    }
    public static function sepayAuth($header, $key) { return strlen($key)>=24 && hash_equals('Apikey '.$key,$header); }
    public static function sepayMatch($data, $row) {
        return isset($data['transferType'],$data['accountNumber'],$data['gateway'],$data['transferAmount'],$data['id'],$data['content'])
            && $data['transferType']==='in' && (string)$data['accountNumber']===$row->account
            && strcasecmp((string)$data['gateway'],$row->bank)===0
            && preg_match('/^[1-9][0-9]{0,18}$/D',(string)$data['id'])
            && is_numeric($data['transferAmount']) && (float)$data['transferAmount']===(float)$row->provider_minor
            && preg_match('/(?<![A-Z0-9])CTK'.preg_quote($row->token,'/').'(?![A-Z0-9])/i',(string)$data['content']);
    }
    public static function sepayWindow($date, $row) {
        if (!is_string($date) || !preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/D',$date)) return false;
        $when=\DateTimeImmutable::createFromFormat('!Y-m-d H:i:s',$date,new \DateTimeZone('Asia/Ho_Chi_Minh'));
        return $when && $when->format('Y-m-d H:i:s')===$date
            && $when->getTimestamp()>=strtotime($row->created_at.' UTC')-300
            && $when->getTimestamp()<=strtotime($row->expires_at.' UTC');
    }
    public static function stripeMatch($session, $row) {
        return isset($session['id'],$session['payment_status'],$session['mode'],$session['currency'],$session['amount_total'],$session['livemode'],$session['metadata']['ctk_token'],$session['client_reference_id'])
            && $session['id']===$row->session_id && $session['payment_status']==='paid' && $session['mode']==='payment'
            && strtoupper($session['currency'])===$row->currency && (string)$session['amount_total']===(string)$row->provider_minor
            && $session['metadata']['ctk_token']===$row->token && (string)$session['client_reference_id']===(string)$row->invoice_id
            && (bool)$session['livemode']===!(bool)$row->testmode && !empty($session['payment_intent']) && is_string($session['payment_intent']);
    }
    public static function stripeCheckout($row) {
        if (!empty($row->checkout_url)) return $row->checkout_url;
        $c=self::config();
        $back=self::base().'/viewinvoice.php?id='.$row->invoice_id;
        $body=array('mode'=>'payment','payment_method_types'=>array('card'),'client_reference_id'=>(string)$row->invoice_id,
            'metadata'=>array('ctk_token'=>$row->token),'success_url'=>$back.'&payment_return=1','cancel_url'=>$back,
            'expires_at'=>strtotime($row->expires_at.' UTC'), 'line_items'=>array(array('quantity'=>1,'price_data'=>array(
                'currency'=>strtolower($row->currency),'unit_amount'=>$row->provider_minor,'product_data'=>array('name'=>'Invoice #'.$row->invoice_id)))));
        $ch=curl_init('https://api.stripe.com/v1/checkout/sessions');
        curl_setopt_array($ch,array(CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>http_build_query($body),CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_TIMEOUT=>20,CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2,
            CURLOPT_USERPWD=>$c['stripe_key'].':',CURLOPT_HTTPHEADER=>array('Idempotency-Key: ctk-'.$row->token,'Stripe-Version: 2024-06-20')));
        $raw=curl_exec($ch); $status=curl_getinfo($ch,CURLINFO_HTTP_CODE); curl_close($ch);
        $data=json_decode((string)$raw,true);
        if ($status!==200 || empty($data['id']) || empty($data['url']) || parse_url($data['url'],PHP_URL_HOST)!=='checkout.stripe.com' || parse_url($data['url'],PHP_URL_SCHEME)!=='https')
            throw new \RuntimeException('Chưa tạo được phiên thanh toán Stripe. Kiểm tra API key, kết nối và nhật ký nhà cung cấp.');
        Capsule::table('ctk_payment_intents')->where('token',$row->token)->update(array('session_id'=>$data['id'],'checkout_url'=>$data['url']));
        return $data['url'];
    }
    /** Serialize per invoice, persist the receipt before WHMCS hooks can cause side effects. */
    public static function settle($row, $transaction) {
        if ($row->gateway==='ctkcard' && $row->testmode) throw new \RuntimeException('Test payments cannot credit invoices.');
        $db=Capsule::connection()->getPdo(); $lock='ctk-pay-'.$row->invoice_id;
        $stmt=$db->prepare('SELECT GET_LOCK(?, 5)'); $stmt->execute(array($lock));
        if ((int)$stmt->fetchColumn()!==1) throw new \RuntimeException('Payment busy; retry later.');
        try {
            $receipt=Capsule::table('ctk_payment_receipts')->where('transaction_id',$transaction)->first();
            if ($receipt && ($receipt->token!==$row->token || (int)$receipt->invoice_id!==(int)$row->invoice_id)) throw new \RuntimeException('Transaction already assigned elsewhere.');
            if ($receipt && $receipt->state==='succeeded') return;
            $recorded=Capsule::table('tblaccounts')->where('transid',$transaction)->where('invoiceid',$row->invoice_id)->where('gateway',$row->gateway)->exists();
            if ($receipt && $recorded) { Capsule::table('ctk_payment_receipts')->where('transaction_id',$transaction)->update(array('state'=>'succeeded')); return; }
            if ($receipt) throw new \RuntimeException('Payment requires administrator reconciliation; do not charge again.');
            list($invoice,$currency,$minor)=self::invoice($row->invoice_id,$row->gateway);
            if ($currency!==$row->currency || $minor!==(int)$row->invoice_minor) throw new \RuntimeException('Invoice balance changed; manual reconciliation required.');
            Capsule::table('ctk_payment_receipts')->insert(array('transaction_id'=>$transaction,'invoice_id'=>$row->invoice_id,'token'=>$row->token,'state'=>'processing','created_at'=>gmdate('Y-m-d H:i:s')));
            $amount=$row->invoice_minor / ($currency==='VND'?1:100);
            addInvoicePayment($row->invoice_id,$transaction,$amount,0,$row->gateway);
            if (!Capsule::table('tblaccounts')->where('transid',$transaction)->where('invoiceid',$row->invoice_id)->where('gateway',$row->gateway)->exists()) throw new \RuntimeException('WHMCS payment not recorded; manual reconciliation required.');
            Capsule::table('ctk_payment_receipts')->where('transaction_id',$transaction)->update(array('state'=>'succeeded'));
        } finally { $stmt=$db->prepare('SELECT RELEASE_LOCK(?)'); $stmt->execute(array($lock)); }
    }
}

<?php
namespace Cloudytek;
use WHMCS\Database\Capsule;

/** Native credit is the aggregate; promotional credit is a tracked subset. */
class Wallet
{
    const MAX_MINOR = 9999999999; // Native WHMCS decimal(10,2) credit column.
    public static function installed() { return Capsule::schema()->hasTable('ctk_wallets'); }
    public static function install() {
        if (!self::installed()) Capsule::schema()->create('ctk_wallets',function($t){
            $t->engine='InnoDB';
            $t->integer('client_id')->primary(); $t->integer('currency_id'); $t->bigInteger('promo_minor')->default(0);
        });
        if (!Capsule::schema()->hasTable('ctk_wallet_entries')) Capsule::schema()->create('ctk_wallet_entries',function($t){
            $t->engine='InnoDB';
            $t->increments('id'); $t->integer('client_id')->index(); $t->integer('currency_id');
            $t->bigInteger('main_minor'); $t->bigInteger('promo_minor'); $t->integer('invoice_id')->default(0)->index();
            $t->string('kind',20); $t->string('request_id',64)->unique(); $t->integer('admin_id')->default(0);
            $t->string('description',255); $t->dateTime('created_at');
        });
    }
    public static function esc($v) { return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8'); }
    public static function minor($amount,$allowZero=false) {
        $s=(string)$amount;
        if (!preg_match('/^[0-9]{1,10}(\.[0-9]{1,2})?$/D',$s)) throw new \RuntimeException('Nhập số tiền hợp lệ, tối đa 2 chữ số thập phân, không dùng dấu phân cách hàng nghìn.');
        $parts=explode('.',$s); $n=(int)$parts[0]*100+(isset($parts[1])?(int)str_pad($parts[1],2,'0'):0);
        if ((!$allowZero && $n<=0) || $n>100000000000) throw new \RuntimeException('Số tiền phải lớn hơn 0 và không vượt quá 1 tỷ.');
        return $n;
    }
    public static function money($minor) { return number_format($minor/100,2,'.',''); }
    public static function snapshot($id,$locked=false) {
        $q=Capsule::table('tblclients')->where('id',(int)$id); if($locked)$q->lockForUpdate(); $client=$q->first();
        if (!$client) throw new \RuntimeException('Không tìm thấy khách hàng.');
        $total=self::minor($client->credit,true); $promo=0;
        if(self::installed()) {
            $q=Capsule::table('ctk_wallets')->where('client_id',(int)$id); if($locked)$q->lockForUpdate(); $wallet=$q->first();
            if($wallet) {
                if((int)$wallet->currency_id!==(int)$client->currency && $wallet->promo_minor>0)throw new \RuntimeException('Tiền tệ của ví đã thay đổi; cần đối soát trước khi sử dụng.');
                $promo=(int)$wallet->promo_minor;
            }
        }
        if($promo<0 || $promo>$total)throw new \RuntimeException('Số dư cần được admin đối soát; không thể sử dụng ví lúc này.');
        return array('client'=>$client,'total'=>$total,'promo'=>$promo,'main'=>$total-$promo,'currency'=>(int)$client->currency);
    }
    private static function persist($id,$s,$total,$promo) {
        if($total<0 || $total>self::MAX_MINOR || $promo<0 || $promo>$total)throw new \RuntimeException('Số dư vượt giới hạn sổ tín dụng WHMCS.');
        Capsule::table('tblclients')->where('id',$id)->update(array('credit'=>self::money($total)));
        Capsule::table('ctk_wallets')->updateOrInsert(array('client_id'=>$id),array('currency_id'=>$s['currency'],'promo_minor'=>$promo));
    }
    private static function entry($id,$s,$main,$promo,$kind,$invoice,$description,$request,$admin=0) {
        Capsule::table('ctk_wallet_entries')->insert(array('client_id'=>$id,'currency_id'=>$s['currency'],'main_minor'=>$main,'promo_minor'=>$promo,
            'kind'=>$kind,'invoice_id'=>$invoice,'description'=>$description,'request_id'=>$request,'admin_id'=>$admin,'created_at'=>gmdate('Y-m-d H:i:s')));
    }
    public static function add($id,$bucket,$amount,$description,$request,$admin) {
        if(!in_array($bucket,array('main','promo'),true))throw new \RuntimeException('Loại tài khoản không hợp lệ.');
        $minor=self::minor($amount); $description=trim($description);
        if(!$description || mb_strlen($description)>200)throw new \RuntimeException('Nhập lý do cộng tiền, tối đa 200 ký tự.');
        if(!preg_match('/^[a-f0-9]{32}$/D',$request))throw new \RuntimeException('Mã yêu cầu không hợp lệ.');
        if(!self::installed())throw new \RuntimeException('Ví chưa được cài đặt.');
        return Capsule::connection()->transaction(function()use($id,$bucket,$minor,$description,$request,$admin){
            $s=self::snapshot($id,true);
            $prior=Capsule::table('ctk_wallet_entries')->where('request_id',$request)->first();
            if($prior) {
                if((int)$prior->client_id!==(int)$id || $prior->kind!=='admin_add' || (int)$prior->admin_id!==(int)$admin
                    || (int)$prior->main_minor!==($bucket==='main'?$minor:0) || (int)$prior->promo_minor!==($bucket==='promo'?$minor:0) || $prior->description!==$description)
                    throw new \RuntimeException('Mã yêu cầu đã được dùng cho giao dịch khác.');
                return false;
            }
            if($s['total']+$minor>self::MAX_MINOR)throw new \RuntimeException('Tổng số dư vượt giới hạn sổ tín dụng WHMCS.');
            self::persist($id,$s,$s['total']+$minor,$s['promo']+($bucket==='promo'?$minor:0));
            self::entry($id,$s,$bucket==='main'?$minor:0,$bucket==='promo'?$minor:0,'admin_add',0,$description,$request,$admin);
            Capsule::table('tblcredit')->insert(array('clientid'=>$id,'admin_id'=>$admin,'date'=>date('Y-m-d'),'description'=>'[Wallet '.($bucket==='promo'?'promotion':'main').'] '.$description,'amount'=>self::money($minor)));
            return true;
        });
    }
    /** Used by manual invoice payment, API credit, checkout and renewal invoice creation. */
    public static function spend($invoiceId,$id,$amount,$cap=false) {
        $requested=self::minor($amount,true); if(!$requested)return 0;
        return Capsule::connection()->transaction(function()use($invoiceId,$id,$requested,$cap){
            $s=self::snapshot($id,true);
            $invoice=Capsule::table('tblinvoices')->where('id',$invoiceId)->lockForUpdate()->first();
            if(!$invoice || (int)$invoice->userid!==(int)$id || $invoice->status!=='Unpaid')throw new \RuntimeException('Hóa đơn không hợp lệ hoặc đã được thanh toán.');
            if(Capsule::table('tblinvoiceitems')->where('invoiceid',$invoiceId)->whereIn('type',array('AddFunds','Invoice'))->exists())throw new \RuntimeException('Không dùng ví cho hóa đơn nạp tiền hoặc gộp hóa đơn; hãy thanh toán từng hóa đơn dịch vụ.');
            $paid=Capsule::table('tblaccounts')->where('invoiceid',$invoiceId)->selectRaw('COALESCE(SUM(amountin),0)-COALESCE(SUM(amountout),0) AS paid')->first();
            $balance=self::minor($invoice->total,true)-(int)round($paid->paid*100);
            $take=$cap?min($requested,$balance,$s['total']):$requested;
            if($take<=0) return 0;
            if($take>$s['total'] || $take>$balance)throw new \RuntimeException('Số dư không đủ hoặc số tiền vượt số còn phải trả.');
            $promo=min($s['promo'],$take);$main=$take-$promo;
            self::persist($id,$s,$s['total']-$take,$s['promo']-$promo);
            Capsule::table('tblinvoices')->where('id',$invoiceId)->update(array('credit'=>self::money(self::minor($invoice->credit,true)+$take)));
            self::entry($id,$s,-$main,-$promo,'invoice_spend',$invoiceId,'Thanh toán hóa đơn #'.$invoiceId,bin2hex(random_bytes(16)));
            Capsule::table('tblcredit')->insert(array('clientid'=>$id,'date'=>date('Y-m-d'),'description'=>'Credit Applied to Invoice #'.$invoiceId.' [Wallet promo '.self::money($promo).'; main '.self::money($main).']','amount'=>self::money(-$take)));
            updateInvoiceTotal($invoiceId);
            return $take;
        });
    }
    public static function refundInvoice($invoiceId,$description,$requested=null) {
        $existing=Capsule::table('tblinvoices')->where('id',$invoiceId)->first(); if(!$existing)return 0;
        return Capsule::connection()->transaction(function()use($invoiceId,$description,$existing,$requested){
            $id=$existing->userid;$s=self::snapshot($id,true);
            $invoice=Capsule::table('tblinvoices')->where('id',$invoiceId)->lockForUpdate()->first();
            $credit=self::minor($invoice->credit,true); if(!$credit)return 0;
            $amount=$requested===null?$credit:self::minor($requested);
            if($amount>$credit)throw new \RuntimeException('Số tiền hoàn vượt số dư đã dùng cho hóa đơn.');
            $spent=-(int)Capsule::table('ctk_wallet_entries')->where('client_id',$id)->where('invoice_id',$invoiceId)->sum('promo_minor');
            $promo=min($amount,max(0,$spent));
            self::persist($id,$s,$s['total']+$amount,$s['promo']+$promo);
            Capsule::table('tblinvoices')->where('id',$invoiceId)->update(array('credit'=>self::money($credit-$amount)));
            self::entry($id,$s,$amount-$promo,$promo,'invoice_refund',$invoiceId,$description,bin2hex(random_bytes(16)));
            Capsule::table('tblcredit')->insert(array('clientid'=>$id,'date'=>date('Y-m-d'),'description'=>$description,'amount'=>self::money($amount)));
            updateInvoiceTotal($invoiceId); return $amount;
        });
    }
    public static function view($id,$displayCurrency=null) {
        $s=self::snapshot($id); $currency=getCurrency($id);
        require_once __DIR__.'/currency.php';
        $target=$displayCurrency?:$currency;
        foreach(array('main','promo','total')as$key)$s[$key.'_formatted']=(string)new \WHMCS\View\Formatter\Price(Currency::convert(self::money($s[$key]),$currency,$target),$target);
        $s['display_code']=$target['code'];
        $s['code']=$currency['code'];unset($s['client']);return $s;
    }
    public static function mainAdjustment($id,$signedAmount,$description,$date,$admin) {
        $minor=(int)round($signedAmount*100);
        return Capsule::connection()->transaction(function()use($id,$minor,$description,$date,$admin){
            $s=self::snapshot($id,true);
            if($minor<0 && -$minor>$s['main'])throw new \RuntimeException('Tài khoản chính không đủ số dư; không được trừ vào khuyến mãi.');
            self::persist($id,$s,$s['total']+$minor,$s['promo']);
            self::entry($id,$s,$minor,0,'main_adjust',0,mb_substr((string)$description,0,200),bin2hex(random_bytes(16)),$admin);
            Capsule::table('tblcredit')->insert(array('clientid'=>$id,'admin_id'=>$admin,'date'=>$date==='now()'?date('Y-m-d'):$date,'description'=>$description,'amount'=>self::money($minor)));
        });
    }
}

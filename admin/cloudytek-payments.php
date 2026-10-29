<?php
define('ADMINAREA', true);
require dirname(__DIR__).'/init.php';
$aInt = new WHMCS\Admin('Configure Payment Gateways', false);
$aInt->title='Cấu hình thanh toán'; $aInt->sidebar='config'; $aInt->icon='offlinecc';
$aInt->requireAuthConfirmation();
require_once ROOTDIR.'/includes/cloudytek/payments.php';
use Cloudytek\Payments;
use WHMCS\Database\Capsule;
header('Cache-Control: no-store');
$error=''; $notice='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    check_token('WHMCS.admin.default');
    try { Payments::csrf(); Payments::save($_POST); $notice='Đã lưu cấu hình thanh toán. Các khóa bí mật được mã hóa và không hiển thị lại.'; }
    catch (Throwable $e) { $error=$e instanceof PDOException?'Không lưu được cấu hình. Kiểm tra nhật ký máy chủ.':$e->getMessage(); }
}
$c=Payments::config();
function ctk_pay_field($name,$label,$value,$type='text',$hint='') {
    echo '<label>'.Payments::esc($label).'<input class="form-control" type="'.Payments::esc($type).'" name="'.Payments::esc($name).'" value="'.Payments::esc($value).'" autocomplete="off"'.($type==='password'?' placeholder="Để trống để giữ khóa đã lưu"':'').'>';
    if ($hint) echo '<small>'.Payments::esc($hint).'</small>';
    echo '</label>';
}
ob_start();
?>
<link rel="stylesheet" href="../assets/css/cloudytek-payments.css?v=1">
<div class="ctk-payments">
<div class="ctk-pay-header"><div><small>CLOUDYTEK BILLING</small><h2>Cấu hình thanh toán</h2><p>SePay QR chuyển khoản và thẻ Visa / Mastercard qua Stripe Checkout.</p></div><a class="btn btn-default" href="configgateways.php">Các cổng thanh toán khác</a></div>
<?php if($error): ?><div class="alert alert-danger" role="alert"><?=Payments::esc($error)?></div><?php endif; ?>
<?php if($notice): ?><div class="alert alert-success" role="status"><?=Payments::esc($notice)?></div><?php endif; ?>
<?php if(strpos(Payments::base(),'https://')!==0): ?><div class="alert alert-info">Bạn đang chạy trên địa chỉ nội bộ. Có thể lưu cấu hình và thử Stripe Test. SePay nhận tiền thật và Stripe Live cần System URL HTTPS công khai để nhận webhook.</div><?php endif; ?>
<form method="post">
<input type="hidden" name="token" value="<?=Payments::esc(generate_token('plain'))?>">
<div class="ctk-pay-grid">
<section class="ctk-pay-card"><div class="ctk-pay-title"><h3>SePay QR</h3><span class="ctk-pay-status <?=$c['sepay_enabled']?'enabled':''?>"><?=$c['sepay_enabled']?'Đang bật':'Chưa bật'?></span></div>
<p>Khách quét QR bằng ứng dụng ngân hàng. Hệ thống đối soát webhook trước khi ghi nhận thanh toán.</p>
<label class="ctk-pay-check"><input type="checkbox" name="sepay_enabled" value="1" <?=$c['sepay_enabled']?'checked':''?>> Bật SePay QR tại checkout</label>
<?php
ctk_pay_field('bank','Mã ngân hàng',$c['bank'],'text','Dùng đúng tên gateway trong webhook SePay, ví dụ Vietcombank hoặc MBBank.');
ctk_pay_field('account','Số tài khoản nhận tiền',$c['account']);
ctk_pay_field('holder','Tên chủ tài khoản',$c['holder']);
if(\Cloudytek\Currency::enabled()) {
    echo '<label>Tỷ giá USD/VND tự động<input class="form-control" readonly value="'.Payments::esc($c['usd_vnd']).'"></label><input type="hidden" name="usd_vnd" value="'.Payments::esc($c['usd_vnd']).'"><p>Đồng bộ từ nguồn tỷ giá chung. Hóa đơn VND thanh toán đúng số tiền gốc; số tiền mỗi QR được khóa riêng.</p>';
} else ctk_pay_field('usd_vnd','Tỷ giá thanh toán: VND cho 1 USD',$c['usd_vnd'],'text','Bắt buộc khi bật. Hóa đơn VND giữ nguyên; hóa đơn USD quy đổi, làm tròn đến 1 VND và khóa số tiền cho từng QR.');
ctk_pay_field('sepay_key','API Key xác thực webhook','','password',$c['sepay_key']?'Đã lưu khóa. Để trống để giữ nguyên.':'Tự tạo chuỗi ngẫu nhiên ít nhất 24 ký tự và nhập cùng khóa tại SePay.');
?>
<div class="ctk-pay-help"><strong>Cấu hình tại SePay</strong><ol><li>Liên kết tài khoản ngân hàng tại my.sepay.vn.</li><li>Tạo webhook sự kiện Có tiền vào, xác thực API Key, sử dụng khóa phía trên.</li><li>URL nhận webhook:</li></ol><code><?=Payments::esc(Payments::base().'/modules/gateways/callback/ctksepay.php')?></code><p>Tiền tố mã thanh toán: <strong>CTK</strong>. Chuyển sai tiền, sai tài khoản hoặc quá hạn cần đối soát thủ công, hệ thống không tự cộng tiền.</p></div>
</section>
<section class="ctk-pay-card"><div class="ctk-pay-title"><h3>Visa / Mastercard</h3><span class="ctk-pay-status <?=$c['card_enabled']?'enabled':''?>"><?=$c['card_enabled']?($c['testmode']?'Chế độ Test':'Đang bật Live'):'Chưa bật'?></span></div>
<p>Khách nhập thông tin thẻ trên trang Stripe. Website không lưu số thẻ hoặc CVV.</p>
<label class="ctk-pay-check"><input type="checkbox" name="card_enabled" value="1" <?=$c['card_enabled']?'checked':''?>> Bật thanh toán thẻ tại checkout</label>
<label class="ctk-pay-check"><input type="checkbox" name="testmode" value="1" <?=$c['testmode']?'checked':''?>> Stripe Test — không thu tiền thật</label>
<?php
ctk_pay_field('stripe_key','Stripe Secret Key','','password',$c['stripe_key']?'Đã lưu khóa. Đổi khóa khi chuyển Test/Live.':'sk_test_… cho thử nghiệm; sk_live_… cho thanh toán thật.');
ctk_pay_field('stripe_webhook','Webhook Signing Secret','','password',$c['stripe_webhook']?'Đã lưu khóa webhook.':'whsec_… lấy tại trang cấu hình webhook của Stripe.');
?>
<div class="ctk-pay-help"><strong>Cấu hình tại Stripe</strong><p>Cần tài khoản doanh nghiệp được Stripe chấp thuận. Đăng ký endpoint nhận sự kiện <code>checkout.session.completed</code>:</p><code><?=Payments::esc(Payments::base().'/modules/gateways/callback/ctkcard.php')?></code><p>Test chỉ xác minh thanh toán thử, không đánh dấu hóa đơn thật là đã trả và không kích hoạt dịch vụ. Khi chạy Live, khóa API và signing secret phải cùng môi trường.</p></div>
<p><a target="_blank" rel="noopener" href="https://docs.stripe.com/testing">Hướng dẫn thẻ thử nghiệm của Stripe</a> · <a target="_blank" rel="noopener" href="https://docs.sepay.vn/tich-hop-webhooks.html">Tài liệu webhook SePay</a></p>
</section>
</div>
<div class="ctk-pay-actions"><button class="btn btn-primary" type="submit">Lưu cấu hình thanh toán</button><span>Để trống ô khóa bí mật để giữ nguyên khóa đã lưu.</span></div>
</form>
<section class="ctk-pay-card ctk-pay-history"><h3>Đối soát thanh toán gần đây</h3>
<?php $rows=Payments::installed()?Capsule::table('ctk_payment_receipts')->orderBy('created_at','desc')->limit(30)->get():array(); ?>
<div class="ctk-pay-table"><table class="table"><thead><tr><th>Thời gian UTC</th><th>Hóa đơn</th><th>Mã giao dịch</th><th>Trạng thái</th></tr></thead><tbody>
<?php $count=0; foreach($rows as $row): $count++; ?><tr><td><?=Payments::esc($row->created_at)?></td><td><a href="invoices.php?action=edit&id=<?=(int)$row->invoice_id?>">#<?=(int)$row->invoice_id?></a></td><td><?=Payments::esc($row->transaction_id)?></td><td><?=Payments::esc($row->state==='succeeded'?'Đã ghi nhận':'Cần kiểm tra thủ công')?></td></tr><?php endforeach; ?>
<?php if(!$count): ?><tr><td colspan="4">Chưa có giao dịch được ghi nhận.</td></tr><?php endif; ?>
</tbody></table></div><p>Các webhook bị từ chối và thanh toán Stripe Test được ghi trong <a href="systemactivitylog.php">Activity Log</a>. Với giao dịch cần kiểm tra, đối chiếu tại nhà cung cấp và sổ giao dịch WHMCS trước khi xử lý thủ công.</p></section>
</div>
<?php $aInt->content=ob_get_clean(); $aInt->display(); ?>

<?php
define('ADMINAREA',true);
require dirname(__DIR__).'/init.php';
$aInt=new WHMCS\Admin('View Credit Log',false);
$aInt->title='Số dư';$aInt->sidebar='clients';$aInt->icon='clients';
$aInt->requireAuthConfirmation();
require_once ROOTDIR.'/includes/cloudytek/wallet.php';
use Cloudytek\Wallet;
use WHMCS\Database\Capsule;
header('Cache-Control: no-store');
$id=isset($_GET['userid'])?(int)$_GET['userid']:0;$error='';$notice='';$s=null;
if($_SERVER['REQUEST_METHOD']==='POST') {
    checkPermission('Manage Credits');check_token('WHMCS.admin.default');
    try {
        if(!isset($_POST['token']) || !is_string($_POST['token']) || !hash_equals(generate_token('plain'),$_POST['token']))throw new RuntimeException('Invalid CSRF Protection Token');
        $added=Wallet::add($id,isset($_POST['bucket'])?$_POST['bucket']:'',isset($_POST['amount'])?$_POST['amount']:'',isset($_POST['description'])?$_POST['description']:'',isset($_POST['request_id'])?$_POST['request_id']:'',(int)WHMCS\Session::get('adminid'));
        logActivity('Wallet credit request '.($added?'recorded':'already recorded').' by admin #'.(int)WHMCS\Session::get('adminid').' for client #'.$id,$id);
        $notice=$added?'Đã cộng tiền vào tài khoản khách hàng.':'Yêu cầu này đã được ghi nhận trước đó; không cộng thêm lần nữa.';
    }catch(Throwable $e){$error=$e instanceof PDOException?'Không lưu được giao dịch. Vui lòng kiểm tra nhật ký.':$e->getMessage();}
}
if($id)try{$s=Wallet::snapshot($id);$v=Wallet::view($id);}catch(Throwable $e){$error=$e->getMessage();}
ob_start();
?>
<link rel="stylesheet" href="../assets/css/cloudytek-wallet.css?v=1">
<div class="ctk-wallet-page">
<?php if($error): ?><div class="alert alert-danger"><?=Wallet::esc($error)?></div><?php endif; ?>
<?php if($notice): ?><div class="alert alert-success"><?=Wallet::esc($notice)?></div><?php endif; ?>
<?php if($s): ?>
<div class="ctk-wallet-summary"><h2>#<?=$id?> — <?=Wallet::esc($s['client']->firstname.' '.$s['client']->lastname)?></h2><a class="btn btn-default" href="clientssummary.php?userid=<?=$id?>">Thông tin khách hàng</a></div>
<div class="ctk-wallet-cards"><section><span>Tài khoản chính</span><strong><?=Wallet::esc($v['main_formatted'])?></strong></section><section class="ctk-wallet-promo"><span>Tài khoản khuyến mãi</span><strong><?=Wallet::esc($v['promo_formatted'])?></strong></section></div>
<p class="alert alert-info">Đơn vị ghi sổ: <strong><?=Wallet::esc($v['code'])?></strong>. Khi thanh toán, khuyến mãi được trừ trước rồi mới đến tài khoản chính. Số dư cũ và tiền khách nạp thành công được tính vào tài khoản chính.</p>
<?php if(checkPermission('Manage Credits',true)): ?>
<section class="ctk-wallet-history"><h3>Cộng tiền cho khách hàng</h3><form method="post" class="ctk-wallet-admin-form">
<input type="hidden" name="token" value="<?=Wallet::esc(generate_token('plain'))?>"><input type="hidden" name="request_id" value="<?=bin2hex(random_bytes(16))?>">
<label>Loại tài khoản<select name="bucket" class="form-control"><option value="main">Tài khoản chính</option><option value="promo">Tài khoản khuyến mãi</option></select></label>
<label>Số tiền (<?=Wallet::esc($v['code'])?>)<input type="number" min="0.01" max="99999999.99" step="0.01" name="amount" class="form-control" required></label>
<label>Lý do cộng tiền<textarea name="description" class="form-control" maxlength="200" required></textarea></label><button class="btn btn-primary" type="submit">Cộng tiền</button>
</form></section>
<?php endif; ?>
<section class="ctk-wallet-history" style="margin-top:24px"><h3>Lịch sử ví</h3><div class="table-responsive"><table class="table"><thead><tr><th>UTC</th><th>Tài khoản chính</th><th>Khuyến mãi</th><th>Nội dung</th><th>Admin</th></tr></thead><tbody>
<?php $rows=Wallet::installed()?Capsule::table('ctk_wallet_entries')->where('client_id',$id)->orderBy('id','desc')->limit(50)->get():array();$count=0;foreach($rows as $row):$count++; ?>
<tr><td><?=Wallet::esc($row->created_at)?></td><td><?=Wallet::esc(Wallet::money($row->main_minor).' '.$v['code'])?></td><td><?=Wallet::esc(Wallet::money($row->promo_minor).' '.$v['code'])?></td><td><?=Wallet::esc($row->description)?></td><td><?=$row->admin_id?(int)$row->admin_id:'—'?></td></tr>
<?php endforeach;if(!$count): ?><tr><td colspan="5">Chưa có giao dịch ví mới. Số dư trước khi bổ sung tính năng này nằm trong tài khoản chính.</td></tr><?php endif; ?>
</tbody></table></div><a href="clientscredits.php?userid=<?=$id?>">Xem sổ tín dụng WHMCS đầy đủ</a></section>
<?php else: ?>
<h2>Quản lý số dư khách hàng</h2><form method="get" class="ctk-wallet-admin-form"><label>ID khách hàng<input class="form-control" type="number" name="userid" min="1" required></label><button class="btn btn-primary">Xem số dư</button></form>
<h3>Khách hàng gần đây</h3><div class="table-responsive"><table class="table"><thead><tr><th>ID</th><th>Khách hàng</th><th>Email</th><th>Tài khoản chính</th><th>Khuyến mãi</th><th></th></tr></thead><tbody>
<?php foreach(Capsule::table('tblclients')->orderBy('id','desc')->limit(50)->get(array('id','firstname','lastname','email'))as$client): ?>
<tr><td>#<?=(int)$client->id?></td><td><?=Wallet::esc($client->firstname.' '.$client->lastname)?></td><td><?=Wallet::esc($client->email)?></td>
<?php try{$balance=Wallet::view($client->id); ?><td><?=Wallet::esc($balance['main_formatted'])?></td><td><?=Wallet::esc($balance['promo_formatted'])?></td><?php }catch(Throwable$e){ ?><td colspan="2">Cần đối soát</td><?php } ?>
<td><a href="cloudytek-wallet.php?userid=<?=(int)$client->id?>">Xem số dư / Cộng tiền</a></td></tr><?php endforeach; ?>
</tbody></table></div>
<?php endif; ?>
</div>
<?php $aInt->content=ob_get_clean();$aInt->display(); ?>

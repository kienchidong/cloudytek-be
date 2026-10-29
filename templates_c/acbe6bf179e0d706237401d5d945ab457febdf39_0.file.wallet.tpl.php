<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 00:33:03
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\wallet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad25fcf8825c8_43007653',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acbe6bf179e0d706237401d5d945ab457febdf39' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\wallet.tpl',
      1 => 1792171972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad25fcf8825c8_43007653 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ctk-wallet-page">
<?php if ($_smarty_tpl->tpl_vars['walletError']->value) {?><div class="alert alert-warning"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['walletError']->value, ENT_QUOTES, 'UTF-8', true);?>
</div><?php } else { ?>
<div class="ctk-wallet-cards">
<section><span><i class="fas fa-wallet" aria-hidden="true"></i> Tài khoản chính</span><strong><?php echo $_smarty_tpl->tpl_vars['walletBalances']->value['main_formatted'];?>
</strong><p>Số dư nạp tiền và các khoản được cộng vào tài khoản chính.</p><a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=addfunds">Nạp tiền vào tài khoản chính</a></section>
<section class="ctk-wallet-promo"><span><i class="fas fa-gift" aria-hidden="true"></i> Tài khoản khuyến mãi</span><strong><?php echo $_smarty_tpl->tpl_vars['walletBalances']->value['promo_formatted'];?>
</strong><p>Được ưu tiên sử dụng trước khi trừ tài khoản chính. Tiền khuyến mãi do admin cộng.</p></section>
</div>
<p class="alert alert-info">Số dư được ghi sổ bằng <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['walletBalances']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
</strong>. Khi thanh toán dịch vụ, hệ thống trừ khuyến mãi trước, sau đó mới đến tài khoản chính. Nạp tiền chỉ được ghi nhận khi hóa đơn nạp tiền đã thanh toán thành công.</p>
<section class="ctk-wallet-history"><h3>Lịch sử số dư gần đây</h3><div class="table-responsive"><table class="table"><thead><tr><th>Ngày</th><th>Nội dung</th><th>Số tiền</th></tr></thead><tbody><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['walletHistory']->value, 'entry');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['entry']->value) {
?><tr><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['entry']->value['date'], ENT_QUOTES, 'UTF-8', true);?>
</td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['entry']->value['description'], ENT_QUOTES, 'UTF-8', true);?>
</td><td><?php echo $_smarty_tpl->tpl_vars['entry']->value['amount'];?>
</td></tr><?php
}
} else {
?><tr><td colspan="3">Chưa có giao dịch.</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></tbody></table></div></section>
<?php }?>
</div>
<?php }
}

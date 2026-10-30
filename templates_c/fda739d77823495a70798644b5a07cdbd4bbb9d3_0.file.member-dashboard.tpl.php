<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:31:42
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\includes\member-dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae447de7912e3_64221195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fda739d77823495a70798644b5a07cdbd4bbb9d3' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\includes\\member-dashboard.tpl',
      1 => 1792174271,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae447de7912e3_64221195 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="member-welcome-row">
    <div class="member-welcome"><div class="member-welcome-copy"><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalWorkspace'];?>
</span><h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalWelcome'];?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'], ENT_QUOTES, 'UTF-8', true);?>
</h1><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalWelcomeCopy'];?>
</p><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalExplore'];?>
 <i class="fas fa-arrow-right" aria-hidden="true"></i></a></div><div class="member-cloud-art" aria-hidden="true"><i class="fas fa-cloud"></i><i class="fas fa-server"></i><span>CLOUD</span></div></div>
    <div class="member-balance">
        <div class="member-balance-heading"><span class="member-balance-icon"><i class="fas fa-wallet" aria-hidden="true"></i></span><span><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Số dư<?php } else { ?>Balance<?php }?></span></div>
        <?php if ($_smarty_tpl->tpl_vars['ctkWallet']->value) {?>
            <div class="ctk-wallet-mini"><span><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Tài khoản chính<?php } else { ?>Main balance<?php }?></span><strong><?php echo $_smarty_tpl->tpl_vars['ctkWallet']->value['main_formatted'];?>
</strong></div>
            <div class="ctk-wallet-mini"><span><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Khuyến mãi<?php } else { ?>Promotional balance<?php }?></span><strong><?php echo $_smarty_tpl->tpl_vars['ctkWallet']->value['promo_formatted'];?>
</strong></div>
            <a class="member-balance-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wallet.php"><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Quản lý số dư<?php } else { ?>Manage balance<?php }?><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        <?php } else { ?><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalBalance'];?>
</span><strong><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['creditbalance'];?>
</strong><?php }?>
    </div>
</section>
<?php }
}

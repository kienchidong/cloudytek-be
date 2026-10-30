<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:30:25
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\includes\portal-guest-header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae447915c6090_55629131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f7c5675738f24332fecaeefd85fa053510ddbc6' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\includes\\portal-guest-header.tpl',
      1 => 1792203944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae447915c6090_55629131 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="portal-utility">
    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalConsultation'];?>
</a>
    <div class="portal-utility-right"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=view" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['viewcart'], ENT_QUOTES, 'UTF-8', true);?>
"><i class="fas fa-shopping-bag" aria-hidden="true"></i></a><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/portal-languages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div>
</div>
<header class="portal-login-header">
    <a class="portal-login-brand" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><span class="ctk-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
"></span></a>
    <div class="portal-header-actions"><a class="portal-order-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><i class="fas fa-plus" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservicesorder'];?>
</a><?php if ($_smarty_tpl->tpl_vars['templatefile']->value != 'login') {?><a class="portal-signin-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'];?>
</a><?php }?></div>
</header>
<?php }
}

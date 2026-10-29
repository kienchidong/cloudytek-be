<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 09:13:35
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\orderforms\standard_cart\common.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad2d9cff40ce7_47886972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc59cb1d1711a6f350d579d23e18bdd6a711f6dd' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\orderforms\\standard_cart\\common.tpl',
      1 => 1792203208,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad2d9cff40ce7_47886972 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/orderforms/standard_cart/css/all.min.css?v=<?php echo $_smarty_tpl->tpl_vars['versionHash']->value;?>
" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/orderforms/standard_cart/js/scripts.min.js?v=<?php echo $_smarty_tpl->tpl_vars['versionHash']->value;?>
"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {?><link href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/css/portal-cart.css?v=20261017-summary-2" rel="stylesheet"><?php }?>

<?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/js/portal-cart.js?v=20261015-4"><?php echo '</script'; ?>
><?php }
if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {?><link href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/css/portal-checkout.css?v=20261016-2" rel="stylesheet"><?php }
if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/js/portal-checkout.js?v=20261016-1"><?php echo '</script'; ?>
><?php }
}
}

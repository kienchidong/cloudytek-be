<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 10:45:51
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\member-account-tabs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad19defae3cb0_69735237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21b6fbc9ceb58eaf715d621fd6076e2e4a76e26b' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\member-account-tabs.tpl',
      1 => 1792121866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad19defae3cb0_69735237 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('accountTabs', $_smarty_tpl->tpl_vars['secondaryNavbar']->value->getChild('Account'));
if ($_smarty_tpl->tpl_vars['accountTabs']->value) {?><nav class="member-account-tabs" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['accountinfo'], ENT_QUOTES, 'UTF-8', true);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accountTabs']->value->getChildren(), 'link');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
if ($_smarty_tpl->tpl_vars['link']->value->getName() != 'Logout' && $_smarty_tpl->tpl_vars['link']->value->getUri() && $_smarty_tpl->tpl_vars['link']->value->getClass() != 'nav-divider') {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getUri(), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value->getLabel();?>
</a><?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></nav><?php }
}
}

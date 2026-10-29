<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 01:01:28
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\six\includes\pageheader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ace71f8e9c690_62247000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '018e644022846126e329695d0a8660541736dadd' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\six\\includes\\pageheader.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ace71f8e9c690_62247000 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="header-lined">
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;
if ($_smarty_tpl->tpl_vars['desc']->value) {?> <small><?php echo $_smarty_tpl->tpl_vars['desc']->value;?>
</small><?php }?></h1>
    <?php if ($_smarty_tpl->tpl_vars['showbreadcrumb']->value) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
</div>
<?php }
}

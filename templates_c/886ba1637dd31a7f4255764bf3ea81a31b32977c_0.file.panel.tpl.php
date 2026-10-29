<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 00:31:10
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad25f5eae3ee8_49637934',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '886ba1637dd31a7f4255764bf3ea81a31b32977c' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\panel.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad25f5eae3ee8_49637934 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel panel-<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
    <?php if (isset($_smarty_tpl->tpl_vars['headerTitle']->value)) {?>
        <div class="panel-heading">
            <h3 class="panel-title"><strong><?php echo $_smarty_tpl->tpl_vars['headerTitle']->value;?>
</strong></h3>
        </div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['bodyContent']->value)) {?>
        <div class="panel-body<?php if (isset($_smarty_tpl->tpl_vars['bodyTextCenter']->value)) {?> text-center<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['bodyContent']->value;?>

        </div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['footerContent']->value)) {?>
        <div class="panel-footer<?php if (isset($_smarty_tpl->tpl_vars['footerTextCenter']->value)) {?> text-center<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['footerContent']->value;?>

        </div>
    <?php }?>
</div>
<?php }
}

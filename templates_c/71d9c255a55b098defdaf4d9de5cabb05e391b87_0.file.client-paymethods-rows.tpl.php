<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 07:49:53
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\admin\templates\blend\client-paymethods-rows.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6aced1b1772486_26688197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71d9c255a55b098defdaf4d9de5cabb05e391b87' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\admin\\templates\\blend\\client-paymethods-rows.tpl',
      1 => 1791912384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6aced1b1772486_26688197 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payMethods']->value, 'payMethod', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['payMethod']->value) {
?>
    <tr class="<?php if ($_smarty_tpl->tpl_vars['i']->value%2) {?>altrow<?php }?>">
        <td class="client-paymethod<?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isUsingInactiveGateway']) {?> gateway-inactive<?php }?>">
            <a id="btnPayMethodDetails<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['id'];?>
"
               href="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['url'];?>
"
               data-modal-title="Pay Method Details"
               data-btn-submit-id="savePaymentMethod"
               data-btn-submit-label="<?php echo AdminLang::trans('global.savechanges');?>
"
               data-role="edit-paymethod"
               onclick="return false;"
               <?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isUsingInactiveGateway']) {?>
               title="<?php echo AdminLang::trans('clientsummary.payMethodGatewayInactive');?>
"
               <?php }?>
               class="paymethod-description open-modal">
                <i class="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['iconClass'];?>
"></i>
                &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['payMethod']->value['description'];?>

                <?php if ($_smarty_tpl->tpl_vars['payMethod']->value['isDefault']) {?><i class="pull-right fal fa-user-check">&nbsp;&nbsp;</i><?php }?>
            </a>
        </td>
    </tr>
    <?php
}
} else {
?>
    <tr>
        <td align="center">No Pay Methods</td>
    </tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}

<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 07:53:05
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\orderforms\standard_cart\ordersummary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6aced271229d78_98651284',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '738c64c182d100b27cc3a0d08b2b05e4f29b120c' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\orderforms\\standard_cart\\ordersummary.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6aced271229d78_98651284 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['producttotals']->value) {?>
    <span class="product-name"><?php if ($_smarty_tpl->tpl_vars['producttotals']->value['allowqty'] && $_smarty_tpl->tpl_vars['producttotals']->value['qty'] > 1) {
echo $_smarty_tpl->tpl_vars['producttotals']->value['qty'];?>
 x <?php }
echo $_smarty_tpl->tpl_vars['producttotals']->value['productinfo']['name'];?>
</span>
    <span class="product-group"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['productinfo']['groupname'];?>
</span>

    <div class="clearfix">
        <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['productinfo']['name'];?>
</span>
        <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['baseprice'];?>
</span>
    </div>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['producttotals']->value['configoptions'], 'configoption');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['configoption']->value) {
?>
        <?php if ($_smarty_tpl->tpl_vars['configoption']->value) {?>
            <div class="clearfix">
                <span class="pull-left">&nbsp;&raquo; <?php echo $_smarty_tpl->tpl_vars['configoption']->value['name'];?>
: <?php echo $_smarty_tpl->tpl_vars['configoption']->value['optionname'];?>
</span>
                <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['configoption']->value['recurring'];
if ($_smarty_tpl->tpl_vars['configoption']->value['setup']) {?> + <?php echo $_smarty_tpl->tpl_vars['configoption']->value['setup'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];
}?></span>
            </div>
        <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['producttotals']->value['addons'], 'addon');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['addon']->value) {
?>
        <div class="clearfix">
            <span class="pull-left">+ <?php echo $_smarty_tpl->tpl_vars['addon']->value['name'];?>
</span>
            <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['addon']->value['recurring'];?>
</span>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php if ($_smarty_tpl->tpl_vars['producttotals']->value['pricing']['setup'] || $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['recurring'] || $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['addons']) {?>
        <div class="summary-totals">
            <?php if ($_smarty_tpl->tpl_vars['producttotals']->value['pricing']['setup']) {?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['cartsetupfees'];?>
:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['setup'];?>
</span>
                </div>
            <?php }?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['recurringexcltax'], 'recurring', false, 'cycle');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cycle']->value => $_smarty_tpl->tpl_vars['recurring']->value) {
?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['cycle']->value;?>
:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['recurring']->value;?>
</span>
                </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php if ($_smarty_tpl->tpl_vars['producttotals']->value['pricing']['tax1']) {?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxname'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxrate'];?>
%:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['tax1'];?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['producttotals']->value['pricing']['tax2']) {?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxname2'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxrate2'];?>
%:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['tax2'];?>
</span>
                </div>
            <?php }?>
        </div>
    <?php }?>

    <div class="total-due-today">
        <span class="amt"><?php echo $_smarty_tpl->tpl_vars['producttotals']->value['pricing']['totaltoday'];?>
</span>
        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertotalduetoday'];?>
</span>
    </div>
<?php } elseif ($_smarty_tpl->tpl_vars['renewals']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['carttotals']->value['renewals']) {?>
        <span class="product-name"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainrenewals'),$_smarty_tpl ) );?>
</span>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['carttotals']->value['renewals'], 'renewal', false, 'domainId');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['domainId']->value => $_smarty_tpl->tpl_vars['renewal']->value) {
?>
            <div class="clearfix" id="cartDomainRenewal<?php echo $_smarty_tpl->tpl_vars['domainId']->value;?>
">
                <span class="pull-left">
                    <?php echo $_smarty_tpl->tpl_vars['renewal']->value['domain'];?>
 - <?php echo $_smarty_tpl->tpl_vars['renewal']->value['regperiod'];?>
 <?php if ($_smarty_tpl->tpl_vars['renewal']->value['regperiod'] == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.year'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.years'),$_smarty_tpl ) );
}?>
                </span>
                <span class="pull-right">
                    <?php echo $_smarty_tpl->tpl_vars['renewal']->value['priceBeforeTax'];?>

                    <a onclick="removeItem('r','<?php echo $_smarty_tpl->tpl_vars['domainId']->value;?>
'); return false;" href="#" id="linkCartRemoveDomainRenewal<?php echo $_smarty_tpl->tpl_vars['domainId']->value;?>
">
                        <i class="fas fa-fw fa-trash-alt"></i>
                    </a>
                </span>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['renewal']->value['dnsmanagement']) {?>
                <div class="clearfix">
                    <span class="pull-left">+ <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domaindnsmanagement'),$_smarty_tpl ) );?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['renewal']->value['emailforwarding']) {?>
                <div class="clearfix">
                    <span class="pull-left">+ <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainemailforwarding'),$_smarty_tpl ) );?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['renewal']->value['idprotection']) {?>
                <div class="clearfix">
                    <span class="pull-left">+ <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainidprotection'),$_smarty_tpl ) );?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['renewal']->value['hasGracePeriodFee']) {?>
                <div class="clearfix">
                    <span class="pull-left">+ <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainRenewal.graceFee'),$_smarty_tpl ) );?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['renewal']->value['hasRedemptionGracePeriodFee']) {?>
                <div class="clearfix">
                    <span class="pull-left">+ <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainRenewal.redemptionFee'),$_smarty_tpl ) );?>
</span>
                </div>
            <?php }?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    <div class="summary-totals">
        <div class="clearfix">
            <span class="pull-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'ordersubtotal'),$_smarty_tpl ) );?>
:</span>
            <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['subtotal'];?>
</span>
        </div>
        <?php if (($_smarty_tpl->tpl_vars['carttotals']->value['taxrate'] && $_smarty_tpl->tpl_vars['carttotals']->value['taxtotal']) || ($_smarty_tpl->tpl_vars['carttotals']->value['taxrate2'] && $_smarty_tpl->tpl_vars['carttotals']->value['taxtotal2'])) {?>
            <?php if ($_smarty_tpl->tpl_vars['carttotals']->value['taxrate']) {?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxname'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxrate'];?>
%:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxtotal'];?>
</span>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['carttotals']->value['taxrate2']) {?>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxname2'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxrate2'];?>
%:</span>
                    <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['taxtotal2'];?>
</span>
                </div>
            <?php }?>
        <?php }?>
    </div>
    <div class="total-due-today">
        <span class="amt"><?php echo $_smarty_tpl->tpl_vars['carttotals']->value['total'];?>
</span>
        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'ordertotalduetoday'),$_smarty_tpl ) );?>
</span>
    </div>
<?php }
}
}

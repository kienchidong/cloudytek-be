<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 00:49:27
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareaaddfunds.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad263a7c059d3_05465855',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce158a3d2f924e02afaed30fddde6b90ba910708' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareaaddfunds.tpl',
      1 => 1792172556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad263a7c059d3_05465855 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['ctkWallet']->value) {?><div class="alert alert-info ctk-wallet-topup-note"><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Nạp vào <strong>tài khoản chính</strong>. Số tiền bạn nhập có đơn vị <strong><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['walletInputCode']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['ctkWallet']->value['code'] : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</strong>; số dư chỉ tăng sau khi hóa đơn nạp được thanh toán thành công.<?php } else { ?>Top up your <strong>main balance</strong>. Enter an amount in <strong><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['walletInputCode']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['ctkWallet']->value['code'] : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</strong>. Your invoice is recorded in <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkWallet']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
; funds are credited only after successful payment.<?php }?></div><?php }
if (!$_smarty_tpl->tpl_vars['gateways']->value) {?><div class="alert alert-warning">Chưa có phương thức nạp tiền khả dụng. Vui lòng liên hệ hỗ trợ hoặc chờ admin cấu hình cổng thanh toán.</div><?php }
if ($_smarty_tpl->tpl_vars['addfundsdisabled']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['clientareaaddfundsdisabled'],'textcenter'=>true), 0, true);
} elseif ($_smarty_tpl->tpl_vars['notallowed']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['clientareaaddfundsnotallowed'],'textcenter'=>true), 0, true);
} elseif ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value,'textcenter'=>true), 0, true);
}?>

<?php if (!$_smarty_tpl->tpl_vars['addfundsdisabled']->value) {?>

    <div class="row">

        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td class="textright"><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfundsminimum'];?>
</strong></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['minimumamount']->value;?>
</td>
                    </tr>
                    <tr>
                        <td class="textright"><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfundsmaximum'];?>
</strong></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['maximumamount']->value;?>
</td>
                    </tr>
                    <tr>
                        <td class="textright"><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfundsmaximumbalance'];?>
</strong></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['maximumbalance']->value;?>
</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=addfunds">
                        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
                        <fieldset>
                            <div class="form-group">
                                <label for="amount" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfundsamount'];?>
:</label>
                                <input type="text" name="amount" id="amount"
                                       value="<?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="paymentmethod" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymentmethod'];?>
:</label><br/>
                                <select name="paymentmethod" id="paymentmethod" class="form-control">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gateways']->value, 'gateway');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['gateway']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['sysname'];?>
"><?php echo $_smarty_tpl->tpl_vars['gateway']->value['name'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfunds'];?>
" class="btn btn-primary btn-block" <?php if (!$_smarty_tpl->tpl_vars['gateways']->value || $_smarty_tpl->tpl_vars['notallowed']->value) {?>disabled<?php }?> />
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['addfundsnonrefundable'];?>

                </div>
            </div>
        </div>

    </div>

<?php }
}
}

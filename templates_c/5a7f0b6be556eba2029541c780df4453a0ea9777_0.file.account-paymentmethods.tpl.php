<?php
/* Smarty version 3.1.33-p1, created on 2026-10-20 15:41:16
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\account-paymentmethods.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad7292caa6e94_15531878',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a7f0b6be556eba2029541c780df4453a0ea9777' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\account-paymentmethods.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad7292caa6e94_15531878 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['createSuccess']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>"<i class='fa fa-check fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['addedSuccess'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['createFailed']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>"<i class='fa fa-times fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['addFailed'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['saveSuccess']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>"<i class='fa fa-check fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['updateSuccess'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['saveFailed']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>"<i class='fa fa-check fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['saveFailed'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['setDefaultResult']->value === true) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>"<i class='fa fa-check fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['defaultUpdateSuccess'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['setDefaultResult']->value === false) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>"<i class='fa fa-times fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['defaultUpdateFailed'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['deleteResult']->value === true) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>"<i class='fa fa-check fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['deleteSuccess'])), 0, true);
} elseif ($_smarty_tpl->tpl_vars['deleteResult']->value === false) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>"<i class='fa fa-times fa-fw'></i> ".((string)$_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['deleteFailed'])), 0, true);
}?>

<p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['intro'];?>
</p>

<p>
    <a href="<?php echo routePath('account-paymentmethods-add');?>
" class="btn btn-primary" data-role="add-new-credit-card">
        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['addNewCC'];?>

    </a>
    <?php if ($_smarty_tpl->tpl_vars['allowBankDetails']->value) {?>
    <a href="<?php echo routePathWithQuery('account-paymentmethods-add',null,'type=bankacct');?>
" class="btn btn-default">
        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['addNewBank'];?>

    </a>
    <?php }?>
</p>

<table class="table table-striped">
    <tr>
        <th></th>
        <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['name'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['description'];?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['status'];?>
</th>
        <th colspan="2"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['actions'];?>
</th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['client']->value->payMethods->validateGateways(), 'payMethod');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payMethod']->value) {
?>
        <tr>
            <td>
                <i class="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getFontAwesomeIcon();?>
"></i>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['payMethod']->value->payment->getDisplayName();?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->description) {?>
                    <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->description;?>

                <?php } else { ?>
                    -
                <?php }?>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getStatus();
if ($_smarty_tpl->tpl_vars['payMethod']->value->isDefaultPayMethod()) {?> - <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['default'];
}?></td>
            <td>
                <a href="<?php echo routePath('account-paymentmethods-setdefault',$_smarty_tpl->tpl_vars['payMethod']->value->id);?>
" class="btn btn-sm btn-default btn-set-default<?php if ($_smarty_tpl->tpl_vars['payMethod']->value->isDefaultPayMethod() || $_smarty_tpl->tpl_vars['payMethod']->value->isExpired()) {?> disabled<?php }?>">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['setAsDefault'];?>

                </a>
                <a href="<?php echo routePath('account-paymentmethods-view',$_smarty_tpl->tpl_vars['payMethod']->value->id);?>
" class="btn btn-sm btn-default<?php if ($_smarty_tpl->tpl_vars['payMethod']->value->getType() == 'RemoteBankAccount') {?> disabled<?php }?>" data-role="edit-payment-method">
                    <i class="fa fa-pencil"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['edit'];?>

                </a>
                <?php if ($_smarty_tpl->tpl_vars['allowDelete']->value) {?>
                    <a href="<?php echo routePath('account-paymentmethods-delete',$_smarty_tpl->tpl_vars['payMethod']->value->id);?>
" class="btn btn-sm btn-default btn-delete">
                        <i class="fa fa-trash"></i>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['delete'];?>

                    </a>
                <?php }?>
            </td>
        </tr>
    <?php
}
} else {
?>
        <tr>
            <td colspan="6" align="center">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['noPaymentMethodsCreated'];?>

            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>

<form method="post" action="" id="frmDeletePaymentMethod">
<div class="modal fade" id="modalPaymentMethodDeleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['areYouSure'];?>
</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['deletePaymentMethodConfirm'];?>
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['no'];?>
</button>
        <button type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['yes'];?>
</button>
      </div>
    </div>
  </div>
</div>
</form>

<form method="post" action="" id="frmSetDefaultPaymentMethod"></form>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        jQuery('.btn-set-default').click(function(e) {
            e.preventDefault();
            jQuery('#frmSetDefaultPaymentMethod')
                .attr('action', jQuery(this).attr('href'))
                .submit();
        });
        jQuery('.btn-delete').click(function(e) {
            e.preventDefault();
            jQuery('#frmDeletePaymentMethod')
                .attr('action', jQuery(this).attr('href'));
            jQuery('#modalPaymentMethodDeleteConfirmation').modal('show');
        });
    });
<?php echo '</script'; ?>
>
<?php }
}

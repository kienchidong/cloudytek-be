<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 10:52:14
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareaproducts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad19f6e33e393_13020428',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3541eeae95c5f02a62ba8c515b1e5a2e6acbbaaa' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareaproducts.tpl',
      1 => 1792122718,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad19f6e33e393_13020428 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\DuPham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"ServicesList",'filterColumn'=>"5",'noSortColumns'=>"0,7"), 0, true);
echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableServicesList').removeClass('hidden').DataTable();
        <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'product') {?>
            table.order([1, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
'], [5, 'asc']);
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'amount') {?>
            table.order(3, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'billingcycle') {?>
            table.order(4, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'nextduedate') {?>
            table.order(6, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'domainstatus') {?>
            table.order(5, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php }?>
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
<?php echo '</script'; ?>
>
<div class="table-container clearfix">
    <table id="tableServicesList" class="table table-list hidden">
        <thead>
            <tr>
                <th></th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderproduct'];?>
</th>
                <th>IP</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddonpricing'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalBillingCycle'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareastatus'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingnextduedate'];?>
</th>
                <th class="responsive-edit-button" style="display: none;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services']->value, 'service', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['service']->value) {
?>
                <tr onclick="clickableSafeRedirect(event, 'clientarea.php?action=productdetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['service']->value['id'];?>
', false)">
                    <td class="text-center<?php if ($_smarty_tpl->tpl_vars['service']->value['sslStatus']) {?> ssl-info<?php }?>" data-element-id="<?php echo $_smarty_tpl->tpl_vars['service']->value['id'];?>
" data-type="service"<?php if ($_smarty_tpl->tpl_vars['service']->value['domain']) {?> data-domain="<?php echo $_smarty_tpl->tpl_vars['service']->value['domain'];?>
"<?php }?>>
                        <?php if ($_smarty_tpl->tpl_vars['service']->value['sslStatus']) {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['service']->value['sslStatus']->getImagePath();?>
" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['service']->value['sslStatus']->getTooltipContent();?>
" class="<?php echo $_smarty_tpl->tpl_vars['service']->value['sslStatus']->getClass();?>
"/>
                        <?php } elseif (!$_smarty_tpl->tpl_vars['service']->value['isActive']) {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ssl/ssl-inactive-domain.png" data-toggle="tooltip" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'sslState.sslInactiveService'),$_smarty_tpl ) );?>
">
                        <?php }?>
                    </td>
                    <td><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['service']->value['product'], ENT_QUOTES, 'UTF-8', true);?>
</strong><?php if ($_smarty_tpl->tpl_vars['service']->value['domain']) {?><br /><a href="http://<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['service']->value['domain'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank" rel="noopener"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['service']->value['domain'], ENT_QUOTES, 'UTF-8', true);?>
</a><?php }?></td>
                    <td><?php if (isset($_smarty_tpl->tpl_vars['portalServiceIps']->value[$_smarty_tpl->tpl_vars['service']->value['id']]) && $_smarty_tpl->tpl_vars['portalServiceIps']->value[$_smarty_tpl->tpl_vars['service']->value['id']]) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['portalServiceIps']->value[$_smarty_tpl->tpl_vars['service']->value['id']], ENT_QUOTES, 'UTF-8', true);
} else { ?>—<?php }?></td>
                    <td class="text-center" data-order="<?php echo $_smarty_tpl->tpl_vars['service']->value['amountnum'];?>
"><?php echo $_smarty_tpl->tpl_vars['service']->value['amount'];?>
</td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['service']->value['billingcycle'];?>
</td>
                    <td class="text-center"><span class="label status status-<?php echo strtolower($_smarty_tpl->tpl_vars['service']->value['status']);?>
"><?php echo $_smarty_tpl->tpl_vars['service']->value['statustext'];?>
</span></td>
                    <td class="text-center"><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['service']->value['normalisedNextDueDate'];?>
</span><?php if ($_smarty_tpl->tpl_vars['service']->value['normalisedNextDueDate'] && $_smarty_tpl->tpl_vars['service']->value['normalisedNextDueDate'] != '0000-00-00') {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['service']->value['normalisedNextDueDate'],'%d/%m/%Y');
} else {
echo $_smarty_tpl->tpl_vars['service']->value['nextduedate'];
}?></td>
                    <td class="responsive-edit-button" style="display: none;">
                        <a href="clientarea.php?action=productdetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['service']->value['id'];?>
" class="btn btn-block btn-info">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['manageproduct'];?>

                        </a>
                    </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
    <div class="text-center" id="tableLoading">
        <p><i class="fas fa-spinner fa-spin"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>
</p>
    </div>
</div>
<?php }
}

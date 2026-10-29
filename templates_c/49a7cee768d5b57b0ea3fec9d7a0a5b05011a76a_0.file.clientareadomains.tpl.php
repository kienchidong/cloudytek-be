<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 07:57:16
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareadomains.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad2c7ec8740d7_30438995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49a7cee768d5b57b0ea3fec9d7a0a5b05011a76a' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareadomains.tpl',
      1 => 1792198601,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad2c7ec8740d7_30438995 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\DuPham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if ($_smarty_tpl->tpl_vars['warnings']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>$_smarty_tpl->tpl_vars['warnings']->value,'textcenter'=>true), 0, true);
}?>
<div class="tab-content">
    <div class="tab-pane fade in active" id="tabOverview">
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"DomainsList",'noSortColumns'=>"5",'startOrderCol'=>"0",'filterColumn'=>"4",'disableResponsive'=>true), 0, true);
?>
        <?php echo '<script'; ?>
 type="text/javascript">
            jQuery(document).ready( function ()
            {
                var table = jQuery('#tableDomainsList').removeClass('hidden').DataTable();
                <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'domain') {?>
                    table.order(0, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'regdate' || $_smarty_tpl->tpl_vars['orderby']->value == 'registrationdate') {?>
                    table.order(1, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'nextduedate') {?>
                    table.order(2, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'autorenew') {?>
                    table.order(3, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'status') {?>
                    table.order(4, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
                <?php }?>
                table.draw();
                jQuery('#tableLoading').addClass('hidden');
            });
        <?php echo '</script'; ?>
>

            <div class="table-container clearfix">
                <table id="tableDomainsList" class="table table-list member-domains-table hidden">
                    <thead>
                        <tr>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderdomain'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['regdate'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['nextdue'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenew'];?>
</th>
                            <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainstatus'];?>
</th>
                            <th class="member-domain-actions all"><span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['manage'];?>
</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domains']->value, 'domain', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['domain']->value) {
?>
                        <tr onclick="clickableSafeRedirect(event, 'clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
', false)">
                            <td><div class="member-domain-name"><span class="ssl-info" data-element-id="<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" data-type="domain" data-domain="<?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
">
                                <?php if ($_smarty_tpl->tpl_vars['domain']->value['sslStatus']) {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getImagePath();?>
" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getTooltipContent();?>
" class="<?php echo $_smarty_tpl->tpl_vars['domain']->value['sslStatus']->getClass();?>
"/>
                                <?php } elseif (!$_smarty_tpl->tpl_vars['domain']->value['isActive']) {?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ssl/ssl-inactive-domain.png" data-toggle="tooltip" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'sslState.sslInactiveDomain'),$_smarty_tpl ) );?>
">
                                <?php }?>
                            </span><a href="clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
</a></div></td>
                            <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['domain']->value['normalisedRegistrationDate'];?>
</span><?php if ($_smarty_tpl->tpl_vars['domain']->value['normalisedRegistrationDate'] && $_smarty_tpl->tpl_vars['domain']->value['normalisedRegistrationDate'] != '0000-00-00') {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['domain']->value['normalisedRegistrationDate'],'%d/%m/%Y');
} else {
echo $_smarty_tpl->tpl_vars['domain']->value['registrationdate'];
}?></td>
                            <td><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['domain']->value['normalisedNextDueDate'];?>
</span><?php if ($_smarty_tpl->tpl_vars['domain']->value['normalisedNextDueDate'] && $_smarty_tpl->tpl_vars['domain']->value['normalisedNextDueDate'] != '0000-00-00') {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['domain']->value['normalisedNextDueDate'],'%d/%m/%Y');
} else {
echo $_smarty_tpl->tpl_vars['domain']->value['nextduedate'];
}?></td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['domain']->value['autorenew']) {?>
                                    <i class="fas fa-fw fa-check text-success"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewenabled'];?>

                                <?php } else { ?>
                                    <i class="fas fa-fw fa-times text-danger"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewdisabled'];?>

                                <?php }?>
                            </td>
                            <td>
                                <span class="label status status-<?php echo $_smarty_tpl->tpl_vars['domain']->value['statusClass'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['statustext'];?>
</span>
                                <span class="hidden">
                                    <?php if ($_smarty_tpl->tpl_vars['domain']->value['expiringSoon']) {?><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"domainsExpiringSoon"),$_smarty_tpl ) );?>
</span><?php }?>
                                </span>
                            </td>
                            <td class="member-domain-actions all">
                                <button type="button" class="member-row-menu-trigger stopEventBubble" aria-haspopup="true" aria-expanded="false" aria-controls="domain-menu-<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['manage'], ENT_QUOTES, 'UTF-8', true);?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['domain']->value['domain'], ENT_QUOTES, 'UTF-8', true);?>
">
                                    <i class="fas fa-ellipsis-h" aria-hidden="true"></i>
                                </button>
                                <div class="member-row-menu" id="domain-menu-<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" hidden>
                                    <div class="member-row-menu-title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['domain']->value['domain'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                    <a href="clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><i class="fas fa-cog" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['managedomain'];?>
</a>
                                    <?php if ($_smarty_tpl->tpl_vars['domain']->value['status'] == 'Active') {?>
                                        <a href="clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
#tabNameservers"><i class="fas fa-globe" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainmanagens'];?>
</a>
                                        <a href="clientarea.php?action=domaincontacts&amp;domainid=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><i class="fas fa-user" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincontactinfoedit'];?>
</a>
                                        <a href="clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
#tabAutorenew"><i class="fas fa-sync-alt" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainautorenewstatus'];?>
</a>
                                        <a href="clientarea.php?action=domaindetails&amp;id=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
#tabReglock"><i class="fas fa-lock" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreglockstatus'];?>
</a>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['allowrenew']->value) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['domain']->value['canDomainBeManaged']) {?>
                                            <a href="<?php echo routePath('domain-renewal',$_smarty_tpl->tpl_vars['domain']->value['domain']);?>
"><i class="fas fa-redo" aria-hidden="true"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainsrenew'),$_smarty_tpl ) );?>
</a>
                                        <?php } else { ?>
                                            <span class="member-row-menu-disabled" aria-disabled="true"><i class="fas fa-redo" aria-hidden="true"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'domainsrenew'),$_smarty_tpl ) );?>
</span>
                                        <?php }?>
                                    <?php }?>
                                </div>
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
    </div>
</div>
<?php }
}

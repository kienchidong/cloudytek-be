<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 12:21:22
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\supportticketslist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad1b452b9e855_62751383',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8396a6e78e430871f6d84d5082e8e4ac6ee3d5a2' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\supportticketslist.tpl',
      1 => 1792128076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad1b452b9e855_62751383 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\DuPham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->_assignInScope('openTicketNode', $_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Open Ticket'));
if ($_smarty_tpl->tpl_vars['openTicketNode']->value && $_smarty_tpl->tpl_vars['openTicketNode']->value->getUri()) {?>
<div class="member-ticket-actions">
    <a class="btn btn-primary member-new-ticket" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['openTicketNode']->value->getUri(), ENT_QUOTES, 'UTF-8', true);?>
"><i class="fas fa-plus" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['openTicketNode']->value->getLabel();?>
</a>
</div>
<?php }
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"TicketsList",'filterColumn'=>"5",'startOrderCol'=>"6"), 0, true);
echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableTicketsList').removeClass('hidden').DataTable();
        <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'did' || $_smarty_tpl->tpl_vars['orderby']->value == 'dept') {?>
            table.order(4, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'subject' || $_smarty_tpl->tpl_vars['orderby']->value == 'title') {?>
            table.order(1, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'status') {?>
            table.order(5, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'lastreply') {?>
            table.order(6, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php }?>
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
<?php echo '</script'; ?>
>
<div class="table-container clearfix">
    <table id="tableTicketsList" class="table table-list hidden">
        <thead>
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketid'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketssubject'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalTicketSender'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['relatedservice'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsdepartment'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsstatus'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketlastupdated'];?>
</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tickets']->value, 'ticket');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ticket']->value) {
?>
                <tr onclick="window.location='viewticket.php?tid=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['tid'];?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['c'];?>
'">
                    <td>
                        <a href="viewticket.php?tid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value['tid'], ENT_QUOTES, 'UTF-8', true);?>
&amp;c=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value['c'], ENT_QUOTES, 'UTF-8', true);?>
">#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value['tid'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                    </td>
                    <td>
                        <a href="viewticket.php?tid=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['tid'];?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['ticket']->value['c'];?>
" class="border-left">
                            <span class="ticket-subject<?php if ($_smarty_tpl->tpl_vars['ticket']->value['unread']) {?> unread<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value['subject'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                        </a>
                    </td>
                    <td><?php if ($_smarty_tpl->tpl_vars['portalTicketMeta']->value[$_smarty_tpl->tpl_vars['ticket']->value['id']]['sender']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['portalTicketMeta']->value[$_smarty_tpl->tpl_vars['ticket']->value['id']]['sender'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'], ENT_QUOTES, 'UTF-8', true);
}?></td>
                    <td><?php if ($_smarty_tpl->tpl_vars['portalTicketMeta']->value[$_smarty_tpl->tpl_vars['ticket']->value['id']]['service']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['portalTicketMeta']->value[$_smarty_tpl->tpl_vars['ticket']->value['id']]['service'], ENT_QUOTES, 'UTF-8', true);
} else { ?>—<?php }?></td>
                    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value['department'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                    <td>
                        <span class="label status <?php if (is_null($_smarty_tpl->tpl_vars['ticket']->value['statusColor'])) {?>status-<?php echo $_smarty_tpl->tpl_vars['ticket']->value['statusClass'];?>
"<?php } else { ?>status-custom" style="border-color: <?php echo $_smarty_tpl->tpl_vars['ticket']->value['statusColor'];?>
; color: <?php echo $_smarty_tpl->tpl_vars['ticket']->value['statusColor'];?>
"<?php }?>>
                            <?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['ticket']->value['status']);?>

                        </span>
                    </td>
                    <td class="text-center">
                        <span class="hidden"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['normalisedLastReply'];?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['ticket']->value['normalisedLastReply']) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ticket']->value['normalisedLastReply'],'%d/%m/%Y %H:%M');
} else {
echo $_smarty_tpl->tpl_vars['ticket']->value['lastreply'];
}?>
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

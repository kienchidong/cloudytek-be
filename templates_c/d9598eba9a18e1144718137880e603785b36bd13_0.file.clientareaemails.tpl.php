<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 10:46:15
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareaemails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad19e07a20b50_09675445',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9598eba9a18e1144718137880e603785b36bd13' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareaemails.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad19e07a20b50_09675445 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/tablelist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('tableName'=>"EmailsList",'noSortColumns'=>"-1"), 0, true);
echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableEmailsList').removeClass('hidden').DataTable();
        <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'date') {?>
            table.order(0, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value == 'subject') {?>
            table.order(1, '<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
');
        <?php }?>
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
<?php echo '</script'; ?>
>
<div class="table-container clearfix">
    <table id="tableEmailsList" class="table table-list hidden">
        <thead>
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaemailsdate'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaemailssubject'];?>
</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['emails']->value, 'email');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['email']->value) {
?>
            <tr onclick="popupWindow('viewemail.php?id=<?php echo $_smarty_tpl->tpl_vars['email']->value['id'];?>
', 'emailWin', '650', '450')">
                <td class="text-center"><span class="hidden"><?php echo $_smarty_tpl->tpl_vars['email']->value['normalisedDate'];?>
</span><?php echo $_smarty_tpl->tpl_vars['email']->value['date'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['email']->value['subject'];?>
</td>
                <td class="text-center"><input type="button" class="btn btn-info btn-sm" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['emailviewmessage'];?>
" onclick="popupWindow('viewemail.php?id=<?php echo $_smarty_tpl->tpl_vars['email']->value['id'];?>
', 'emailWin', '650', '450', 'scrollbars=1,')" /></td>
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

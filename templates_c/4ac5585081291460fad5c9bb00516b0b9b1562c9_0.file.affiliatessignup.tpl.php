<?php
/* Smarty version 3.1.33-p1, created on 2026-10-20 15:41:24
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\affiliatessignup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad729340c3fa1_58001449',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ac5585081291460fad5c9bb00516b0b9b1562c9' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\affiliatessignup.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad729340c3fa1_58001449 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['affiliatesystemenabled']->value) {?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'title'=>$_smarty_tpl->tpl_vars['LANG']->value['affiliatesignuptitle'],'msg'=>($_smarty_tpl->tpl_vars['LANG']->value['affiliatesignupintro']).('<br /><br />'),'textcenter'=>true), 0, true);
?>

    <ul>
        <li><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatesignupinfo1'];?>
</li>
        <li><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatesignupinfo2'];?>
</li>
        <li><?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatesignupinfo3'];?>
</li>
    </ul>

    <br />

    <form method="post" action="affiliates.php">
        <input type="hidden" name="activate" value="true" />
        <p align="center"><input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['affiliatesactivate'];?>
" class="btn btn-success" /></p>
    </form>

<?php } else { ?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['affiliatesdisabled'],'textcenter'=>true), 0, true);
}
}
}

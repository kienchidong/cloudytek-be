<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 00:33:12
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\forwardpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad25fd8435035_41748267',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '837d94748b504251b4f0de94a6647780d2c0ec80' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\forwardpage.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad25fd8435035_41748267 (Smarty_Internal_Template $_smarty_tpl) {
?><br />

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['message']->value,'textcenter'=>true), 0, true);
?>

<br />

<div class="text-center">

    <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/loading.gif" alt="Loading" border="0" />

    <br /><br /><br />

    <div id="frmPayment" align="center">

        <?php echo $_smarty_tpl->tpl_vars['code']->value;?>


        <form method="post" action="<?php if ($_smarty_tpl->tpl_vars['invoiceid']->value) {?>viewinvoice.php?id=<?php echo $_smarty_tpl->tpl_vars['invoiceid']->value;
} else { ?>clientarea.php<?php }?>">
        </form>

    </div>

</div>

<br /><br /><br />

<?php echo '<script'; ?>
 language="javascript">
    setTimeout("autoSubmitFormByContainer('frmPayment')", 5000);
<?php echo '</script'; ?>
>
<?php }
}

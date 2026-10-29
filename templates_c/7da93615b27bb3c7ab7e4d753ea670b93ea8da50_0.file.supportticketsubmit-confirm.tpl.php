<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 12:24:09
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\supportticketsubmit-confirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad1b4f9b137a1_18446754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7da93615b27bb3c7ab7e4d753ea670b93ea8da50' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\supportticketsubmit-confirm.tpl',
      1 => 1791912388,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad1b4f9b137a1_18446754 (Smarty_Internal_Template $_smarty_tpl) {
?><br />

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">

        <div class="alert alert-success text-center">
            <strong>
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketcreated'];?>

                <a id="ticket-number" href="viewticket.php?tid=<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" class="alert-link">#<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
</a>
            </strong>
        </div>

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketcreateddesc'];?>
</p>
            </div>
        </div>

        <br />

        <p class="text-center">
            <a href="viewticket.php?tid=<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" class="btn btn-default">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['continue'];?>

                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </p>

        <br />
        <br />
        <br />

    </div>
</div>
<?php }
}

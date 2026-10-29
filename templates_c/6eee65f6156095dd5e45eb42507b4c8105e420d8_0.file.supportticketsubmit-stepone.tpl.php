<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 11:00:50
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\supportticketsubmit-stepone.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad2f2f24da3b1_06955682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6eee65f6156095dd5e45eb42507b4c8105e420d8' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\supportticketsubmit-stepone.tpl',
      1 => 1792127529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad2f2f24da3b1_06955682 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="ctk-ticket-departments">
    <a class="ctk-ticket-back" href="supporttickets.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavsupporttickets'];?>
</a>
    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsdepartment'];?>
</h2>
    <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsheader'];?>
</p>
    <div class="ctk-department-grid">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
?>
            <a class="ctk-department-card" href="<?php echo $_SERVER['PHP_SELF'];?>
?step=2&amp;deptid=<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
">
                <i class="fas fa-headset" aria-hidden="true"></i><div><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['department']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</strong><?php if ($_smarty_tpl->tpl_vars['department']->value['description']) {?><p><?php echo $_smarty_tpl->tpl_vars['department']->value['description'];?>
</p><?php }?></div><i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        <?php
}
} else {
?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['nosupportdepartments'],'textcenter'=>true), 0, true);
?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</section>
<?php }
}

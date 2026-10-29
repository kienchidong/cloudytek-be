<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 21:56:39
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\cloudytek-linode.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6acf98271b9db7_22679120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff72c46fad7b0a6be6ed2a741df471b4e6619bc8' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\cloudytek-linode.tpl',
      1 => 1791989413,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6acf98271b9db7_22679120 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" href="assets/css/cloudytek-linode.css?v=1">
<div class="ctk-linode">
    <div class="ctk-hero"><div><span class="ctk-eyebrow">YOUR CLOUD WORKSPACE</span><h2>Cloud service #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkServiceId']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2><p>Resource details and permitted management actions.</p></div><span class="ctk-pill"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['ctkResource']->value['state'])===null||$tmp==='' ? 'Unavailable' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span></div>
    <?php if ($_smarty_tpl->tpl_vars['ctkError']->value) {?><div class="alert alert-danger"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkError']->value, ENT_QUOTES, 'UTF-8', true);?>
</div><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['ctkResult']->value) {?><section class="ctk-card"><h3>Resource details / latest response</h3><pre><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkResult']->value, ENT_QUOTES, 'UTF-8', true);?>
</pre></section><?php }?>
    <?php if ((($tmp = @$_smarty_tpl->tpl_vars['ctkResource']->value['family'])===null||$tmp==='' ? '' : $tmp) == 'linode') {?>
    <section class="ctk-card"><h3>Server access</h3><p>Request the saved initial root password for this service. Access credentials are shown only on request.</p><form method="post" action="linode.php?serviceid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkServiceId']->value, ENT_QUOTES, 'UTF-8', true);?>
"><input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkToken']->value, ENT_QUOTES, 'UTF-8', true);?>
"><input type="hidden" name="action" value="access_password"><label>Type REVEAL PASSWORD to confirm<input class="form-control" name="confirm" autocomplete="off"></label><button class="btn btn-default">Show access password</button></form></section>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['ctkOperations']->value) {?>
    <section class="ctk-card"><h3>Manage this service</h3><form method="post" action="linode.php?serviceid=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkServiceId']->value, ENT_QUOTES, 'UTF-8', true);?>
">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ctkToken']->value, ENT_QUOTES, 'UTF-8', true);?>
">
        <label>Action<select class="form-control" name="operation"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ctkOperations']->value, 'op');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['op']->value) {
?><option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['op']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['op']->value['method'], ENT_QUOTES, 'UTF-8', true);?>
 · <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['op']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</option><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select></label>
        <p>Your primary resource ID is fixed automatically. Enter only additional identifiers needed for the selected action.</p>
        <div class="ctk-grid"><label>Additional path parameters<textarea class="form-control ctk-json" name="path" rows="3">{}</textarea></label><label>Query parameters<textarea class="form-control ctk-json" name="query" rows="3">{}</textarea></label></div>
        <label>Request body<textarea class="form-control ctk-json" name="body" rows="4"></textarea></label>
        <label>For a write action, type its operation ID to confirm<input class="form-control" name="confirm" autocomplete="off"></label>
        <label class="ctk-check"><input type="checkbox" name="reveal"> Show sensitive credentials for this service (confirmation required)</label>
        <button class="btn btn-primary">Run action</button>
    </form></section>
    <?php }?>
</div>
<?php }
}

<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 01:06:16
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\member-sidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad26798aba082_85530329',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a3ddc5697e398613000e8fb3dd0ee5de34dabc6' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\member-sidebar.tpl',
      1 => 1792173852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad26798aba082_85530329 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'memberLink' => 
  array (
    'compiled_filepath' => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates_c\\6a3ddc5697e398613000e8fb3dd0ee5de34dabc6_0.file.member-sidebar.tpl.php',
    'uid' => '6a3ddc5697e398613000e8fb3dd0ee5de34dabc6',
    'call_name' => 'smarty_template_function_memberLink_7980572346ad26798a90fc6_72555174',
  ),
));
$_smarty_tpl->_assignInScope('serviceMenu', $_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Services'));
$_smarty_tpl->_assignInScope('domainMenu', $_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Domains'));
$_smarty_tpl->_assignInScope('billingMenu', $_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Billing'));
$_smarty_tpl->_assignInScope('supportMenu', $_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Support'));
$_smarty_tpl->_assignInScope('accountMenu', $_smarty_tpl->tpl_vars['secondaryNavbar']->value->getChild('Account'));?>
<nav class="member-navigation" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['portalNavigation'], ENT_QUOTES, 'UTF-8', true);?>
">
    <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['primaryNavbar']->value->getChild('Home'),'icon'=>'home'), true);?>

    <div class="member-nav-section"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservices'];?>
</div>
    <?php if ($_smarty_tpl->tpl_vars['serviceMenu']->value) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['serviceMenu']->value->getChild('My Services'),'icon'=>'cube'), true);
}?>
    <?php if ($_smarty_tpl->tpl_vars['domainMenu']->value) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['domainMenu']->value->getChild('My Domains'),'icon'=>'globe'), true);
} elseif (in_array('domains',$_smarty_tpl->tpl_vars['contactpermissions']->value)) {?><a class="admin-sidebar-link member-nav-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=domains"><i class="fas fa-globe" aria-hidden="true"></i><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalMyDomains'];?>
</span></a><?php }?>
    <div class="member-nav-section"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalAccountSection'];?>
</div>
    <?php if ($_smarty_tpl->tpl_vars['accountMenu']->value) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['accountMenu']->value->getChild('Edit Account Details'),'icon'=>'user'), true);
}?>
    <?php if ($_smarty_tpl->tpl_vars['billingMenu']->value) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['billingMenu']->value->getChild('My Invoices'),'icon'=>'file-invoice'), true);
}?>
    <?php if ($_smarty_tpl->tpl_vars['ctkWallet']->value) {?><a class="admin-sidebar-link member-nav-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wallet.php"><i class="fas fa-wallet" aria-hidden="true"></i><span>Số dư</span></a><?php }?>
    <div class="member-nav-section"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalHelpSection'];?>
</div>
    <?php if ($_smarty_tpl->tpl_vars['supportMenu']->value) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'memberLink', array('node'=>$_smarty_tpl->tpl_vars['supportMenu']->value->getChild('Tickets'),'icon'=>'ticket-alt'), true);
}?>
</nav>
<?php }
/* smarty_template_function_memberLink_7980572346ad26798a90fc6_72555174 */
if (!function_exists('smarty_template_function_memberLink_7980572346ad26798a90fc6_72555174')) {
function smarty_template_function_memberLink_7980572346ad26798a90fc6_72555174(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('node'=>null,'icon'=>'circle'), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

<?php if ($_smarty_tpl->tpl_vars['node']->value && $_smarty_tpl->tpl_vars['node']->value->getUri()) {?><a class="admin-sidebar-link member-nav-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value->getUri(), ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->tpl_vars['node']->value->getAttribute('target')) {?> target="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value->getAttribute('target'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>><i class="fas fa-<?php echo $_smarty_tpl->tpl_vars['icon']->value;?>
" aria-hidden="true"></i><span><?php echo $_smarty_tpl->tpl_vars['node']->value->getLabel();?>
</span><?php if ($_smarty_tpl->tpl_vars['node']->value->hasBadge()) {?><span class="badge"><?php echo $_smarty_tpl->tpl_vars['node']->value->getBadge();?>
</span><?php }?></a><?php }
}}
/*/ smarty_template_function_memberLink_7980572346ad26798a90fc6_72555174 */
}

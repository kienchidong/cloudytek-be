<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:31:40
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\includes\member-header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae447dcea22c6_45254387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9555d199c95a17b06a5ffc7acfc8d4ff4be8011e' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\includes\\member-header.tpl',
      1 => 1792203944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae447dcea22c6_45254387 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('accountMenu', $_smarty_tpl->tpl_vars['secondaryNavbar']->value->getChild('Account'));?>
<aside id="adminSidebar" class="admin-sidebar member-sidebar" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['portalNavigation'], ENT_QUOTES, 'UTF-8', true);?>
"><div class="admin-sidebar-body"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/member-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></aside>
<div id="sidebarOverlay" class="admin-sidebar-overlay"></div>
<div class="admin-main-wrapper">
<header class="admin-topbar-header member-header">
    <div class="member-utility"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalConsultation'];?>
</a><div><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=view" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['viewcart'], ENT_QUOTES, 'UTF-8', true);?>
"><i class="far fa-shopping-bag" aria-hidden="true"></i></a><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/portal-languages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div></div>
    <div class="member-header-main">
        <button type="button" id="sidebarToggle" class="admin-sidebar-toggle" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['portalNavigation'], ENT_QUOTES, 'UTF-8', true);?>
" aria-expanded="false"><i class="fas fa-bars"></i></button>
        <a class="member-brand" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><span class="ctk-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
"></span></a>
        <div class="member-header-actions">
            <?php if (in_array('orders',$_smarty_tpl->tpl_vars['contactpermissions']->value)) {?><a class="member-order-button" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><i class="fas fa-plus" aria-hidden="true"></i><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservicesorder'];?>
</span></a><?php }?>
            <div class="dropdown member-notifications"><button class="member-icon-button dropdown-toggle" data-toggle="dropdown" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['notifications'], ENT_QUOTES, 'UTF-8', true);?>
" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell" aria-hidden="true"></i><?php if (count($_smarty_tpl->tpl_vars['clientAlerts']->value) > 0) {?><span class="member-notification-dot"></span><?php }?></button><ul class="dropdown-menu dropdown-menu-right client-alerts"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientAlerts']->value, 'alert');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['alert']->value) {
?><li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['alert']->value->getLink(), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['alert']->value->getMessage();?>
</a></li><?php
}
} else {
?><li class="member-no-alerts"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['notificationsnone'];?>
</li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></div>
            <div class="dropdown member-account"><button class="member-account-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="member-avatar"><i class="far fa-user" aria-hidden="true"></i></span><span class="member-account-copy"><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'], ENT_QUOTES, 'UTF-8', true);?>
</strong><small><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientsdetails']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</small></span><i class="fas fa-chevron-down" aria-hidden="true"></i></button><ul class="dropdown-menu dropdown-menu-right"><?php if ($_smarty_tpl->tpl_vars['accountMenu']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accountMenu']->value->getChildren(), 'link');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
if ($_smarty_tpl->tpl_vars['link']->value->getUri() && $_smarty_tpl->tpl_vars['link']->value->getClass() != 'nav-divider') {?><li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getUri(), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value->getLabel();?>
</a></li><?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
if ($_smarty_tpl->tpl_vars['adminMasqueradingAsClient']->value || $_smarty_tpl->tpl_vars['adminLoggedIn']->value) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/logout.php?returntoadmin=1"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['logoutandreturntoadminarea'];?>
</a></li><?php }?></ul></div>
        </div>
    </div>
</header>
<?php }
}

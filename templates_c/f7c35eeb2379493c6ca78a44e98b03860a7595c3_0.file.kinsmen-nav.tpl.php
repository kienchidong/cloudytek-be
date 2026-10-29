<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 07:48:33
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\kinsmen-nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6aced161833e23_82797680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7c35eeb2379493c6ca78a44e98b03860a7595c3' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\kinsmen-nav.tpl',
      1 => 1791938885,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6aced161833e23_82797680 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navbar']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <li class="admin-sidebar-item<?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?> has-submenu<?php }?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getClass();?>
" id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getId();?>
">
        <a href="<?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>#<?php } else {
echo $_smarty_tpl->tpl_vars['item']->value->getUri();
}?>" class="admin-sidebar-link<?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?> submenu-toggle<?php }?>"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('target');?>
"<?php }
if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?> aria-expanded="false"<?php }?>>
            <i class="<?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {
echo $_smarty_tpl->tpl_vars['item']->value->getIcon();
} else { ?>fas <?php if ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Home') {?>fa-home<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Store') {?>fa-shopping-bag<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Announcements') {?>fa-bullhorn<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Knowledgebase') {?>fa-book-open<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Network Status') {?>fa-signal<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Contact Us') {?>fa-envelope<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Services') {?>fa-server<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Billing') {?>fa-file-invoice-dollar<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Domains') {?>fa-globe<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Support' || $_smarty_tpl->tpl_vars['item']->value->getName() == 'Open Ticket') {?>fa-life-ring<?php } else { ?>fa-user-circle<?php }
}?> admin-sidebar-icon"></i>
            <span class="admin-sidebar-label"><?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?><span class="badge admin-sidebar-badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?><i class="fas fa-chevron-right admin-sidebar-arrow"></i><?php }?>
        </a>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
            <ul class="admin-sidebar-submenu">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value->getChildren(), 'childItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass() != 'nav-divider' && $_smarty_tpl->tpl_vars['childItem']->value->getClass() != 'dropdown-divider') {?>
                        <li id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
" class="admin-sidebar-subitem"><a class="admin-sidebar-sublink" href="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
"<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target');?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();
if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?><span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?></a></li>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        <?php }?>
    </li>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}

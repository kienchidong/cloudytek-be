<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 07:37:32
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\sidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6acececc57e300_02727160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9b744483b2d2d280ab01330fc97862b04785b45' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\sidebar.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6acececc57e300_02727160 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sidebar']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['item']->value->getName();?>
" class="panel panel-sidebar <?php if ($_smarty_tpl->tpl_vars['item']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['item']->value->getClass();
} else { ?>panel-sidebar<?php }
if ($_smarty_tpl->tpl_vars['item']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?> hidden-sm hidden-xs<?php }?>"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('id');?>
"<?php }?>>
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                <?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>

                <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?>
                <i class="fas fa-chevron-up panel-minimise pull-right"></i>
            </h3>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBodyHtml()) {?>
            <div class="panel-body">
                <?php echo $_smarty_tpl->tpl_vars['item']->value->getBodyHtml();?>

            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
            <div class="list-group<?php if ($_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class');
}?>">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value->getChildren(), 'childItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['childItem']->value->getUri()) {?>
                        <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->isDisabled()) {?> disabled<?php }
if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['childItem']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?><span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                        </a>
                    <?php } else { ?>
                        <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?><span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                        </div>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['item']->value->hasFooterHtml()) {?>
            <div class="panel-footer clearfix">
                <?php echo $_smarty_tpl->tpl_vars['item']->value->getFooterHtml();?>

            </div>
        <?php }?>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
                <div class="panel hidden-lg hidden-md <?php if ($_smarty_tpl->tpl_vars['item']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['item']->value->getClass();
} else { ?>panel-default<?php }?>"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('id');?>
"<?php }?>>
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>

                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?>
                </h3>
            </div>
            <div class="panel-body">
                <form role="form">
                    <select class="form-control" onchange="selectChangeNavigate(this)">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value->getChildren(), 'childItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
?>
                            <option menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
" class="list-group-item" <?php if ($_smarty_tpl->tpl_vars['childItem']->value->isCurrent()) {?>selected="selected"<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                                <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>(<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
)<?php }?>
                            </option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </form>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['item']->value->hasFooterHtml()) {?>
                <div class="panel-footer">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value->getFooterHtml();?>

                </div>
            <?php }?>
        </div>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}

<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 01:01:42
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\orderforms\standard_cart\sidebar-categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ace72066f17f5_99083933',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c318d60e2d1bf38d2814c12adc0e805c87033f98' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\orderforms\\standard_cart\\sidebar-categories.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ace72066f17f5_99083933 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['secondarySidebar']->value, 'panel');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['panel']->value) {
?>
    <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getName();?>
" class="panel <?php if ($_smarty_tpl->tpl_vars['panel']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['panel']->value->getClass();
} else { ?>panel-sidebar<?php }
if ($_smarty_tpl->tpl_vars['panel']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?> hidden-sm hidden-xs<?php }?>"<?php if ($_smarty_tpl->tpl_vars['panel']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getAttribute('id');?>
"<?php }?>>
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasIcon()) {?>
                    <i class="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getIcon();?>
"></i>&nbsp;
                <?php }?>

                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getLabel();?>


                <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasBadge()) {?>
                    &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['panel']->value->getBadge();?>
</span>
                <?php }?>

                <i class="fas fa-chevron-up panel-minimise pull-right"></i>
            </h3>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasBodyHtml()) {?>
            <div class="panel-body">
                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getBodyHtml();?>

            </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?>
            <div class="list-group<?php if ($_smarty_tpl->tpl_vars['panel']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['panel']->value->getChildrenAttribute('class');
}?>">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panel']->value->getChildren(), 'child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['child']->value->getUri()) {?>
                        <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['child']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['child']->value->getUri();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['child']->value->isDisabled()) {?> disabled<?php }
if ($_smarty_tpl->tpl_vars['child']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['child']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['child']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['child']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['child']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['child']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['child']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasIcon()) {?>
                                <i class="<?php echo $_smarty_tpl->tpl_vars['child']->value->getIcon();?>
"></i>&nbsp;
                            <?php }?>

                            <?php echo $_smarty_tpl->tpl_vars['child']->value->getLabel();?>


                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasBadge()) {?>
                                &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['child']->value->getBadge();?>
</span>
                            <?php }?>
                        </a>
                    <?php } else { ?>
                        <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['child']->value->getName();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['child']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['child']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['child']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasIcon()) {?>
                                <i class="<?php echo $_smarty_tpl->tpl_vars['child']->value->getIcon();?>
"></i>&nbsp;
                            <?php }?>

                            <?php echo $_smarty_tpl->tpl_vars['child']->value->getLabel();?>


                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasBadge()) {?>
                                &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['child']->value->getBadge();?>
</span>
                            <?php }?>
                        </div>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasFooterHtml()) {?>
            <div class="panel-footer clearfix">
                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getFooterHtml();?>

            </div>
        <?php }?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['panel']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?>
                <div class="panel hidden-lg hidden-md <?php if ($_smarty_tpl->tpl_vars['panel']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['panel']->value->getClass();
} else { ?>panel-default<?php }?>"<?php if ($_smarty_tpl->tpl_vars['panel']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getAttribute('id');?>
"<?php }?>>
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasIcon()) {?>
                        <i class="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getIcon();?>
"></i>&nbsp;
                    <?php }?>

                    <?php echo $_smarty_tpl->tpl_vars['panel']->value->getLabel();?>


                    <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasBadge()) {?>
                        &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['panel']->value->getBadge();?>
</span>
                    <?php }?>
                </h3>
            </div>

            <div class="panel-body">
                <form role="form">
                    <select class="form-control" onchange="selectChangeNavigate(this)">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panel']->value->getChildren(), 'child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
?>
                            <option menuItemName="<?php echo $_smarty_tpl->tpl_vars['child']->value->getName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['child']->value->getUri();?>
" class="list-group-item" <?php if ($_smarty_tpl->tpl_vars['child']->value->isCurrent()) {?>selected="selected"<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['child']->value->getLabel();?>


                                <?php if ($_smarty_tpl->tpl_vars['child']->value->hasBadge()) {?>
                                    (<?php echo $_smarty_tpl->tpl_vars['child']->value->getBadge();?>
)
                                <?php }?>
                            </option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </form>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasFooterHtml()) {?>
                <div class="panel-footer">
                    <?php echo $_smarty_tpl->tpl_vars['panel']->value->getFooterHtml();?>

                </div>
            <?php }?>
        </div>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}

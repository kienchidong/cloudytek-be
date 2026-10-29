<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 09:47:07
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\catalog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad2e1ab350b77_59334593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dffa10a329c0ea52ea3cf26c7ad7e21d295d9c88' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\catalog.tpl',
      1 => 1792205056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad2e1ab350b77_59334593 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="portal-catalog" data-category="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['portalCategory']->value, ENT_QUOTES, 'UTF-8', true);?>
">
    <section class="catalog-banner" aria-labelledby="catalog-title">
        <div class="catalog-banner-copy"><span class="catalog-eyebrow"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
 CLOUD PLATFORM</span><h1 id="catalog-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCatalogTitle'];?>
</h1><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCatalogIntro'];?>
</p><a href="#catalog-plans"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalExplore'];?>
<i class="fas fa-arrow-down" aria-hidden="true"></i></a></div>
        <div class="catalog-banner-art" aria-hidden="true"><div><i class="fas fa-cloud"></i><span>CLOUD</span></div><div><i class="fas fa-server"></i><span>VPS</span></div><div><i class="fas fa-database"></i><span>STORAGE</span></div></div>
    </section>
    <section class="catalog-discovery" aria-labelledby="catalog-services-title">
        <h2 id="catalog-services-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalServices'];?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <nav class="catalog-categories" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['portalCategories'], ENT_QUOTES, 'UTF-8', true);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['portalCategories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?gid=<?php echo $_smarty_tpl->tpl_vars['category']->value['gid'];?>
" data-catalog-category="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['key'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['portalCategory']->value == $_smarty_tpl->tpl_vars['category']->value['key']) {?>aria-current="page"<?php }?>><i class="fas fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['icon'], ENT_QUOTES, 'UTF-8', true);?>
" aria-hidden="true"></i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['label'], ENT_QUOTES, 'UTF-8', true);?>
</a><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domains.php" data-catalog-category="domains"><i class="fas fa-globe" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_name'];?>
</a></nav>
        <div class="catalog-groups"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['portalGroups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?><a class="catalog-group<?php if ($_smarty_tpl->tpl_vars['group']->value['selected']) {?> selected<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?gid=<?php echo $_smarty_tpl->tpl_vars['group']->value['gid'];?>
" data-service-category="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['category'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['group']->value['category'] != $_smarty_tpl->tpl_vars['portalCategory']->value) {?>hidden<?php }
if ($_smarty_tpl->tpl_vars['group']->value['selected']) {?> aria-current="page"<?php }?>><span class="catalog-group-icon"><i class="fas fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['icon'], ENT_QUOTES, 'UTF-8', true);?>
" aria-hidden="true"></i></span><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</strong><?php if ($_smarty_tpl->tpl_vars['group']->value['selected']) {?><span class="catalog-group-check"><i class="fas fa-check" aria-hidden="true"></i></span><?php }?></a><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div>
    </section>
    <section id="catalog-plans" class="catalog-plans-section" aria-labelledby="catalog-plans-title"><div class="catalog-plans-heading"><div><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['groupname']->value, ENT_QUOTES, 'UTF-8', true);?>
</span><h2 id="catalog-plans-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalPlans'];?>
</h2></div><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
</span></div>
        <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?><div class="alert alert-danger" role="alert"><?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>
</div><?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookAboveProductsOutput']->value, 'output');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
echo $_smarty_tpl->tpl_vars['output']->value;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <div class="catalog-plans"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['portalProducts']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?><article class="catalog-plan<?php if ($_smarty_tpl->tpl_vars['product']->value['isFeatured']) {?> featured<?php }?>" data-product-id="<?php echo $_smarty_tpl->tpl_vars['product']->value['pid'];?>
">
            <header><h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</h3><?php if ($_smarty_tpl->tpl_vars['product']->value['isFeatured']) {?><span class="plan-recommended"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRecommended'];?>
</span><?php }?></header>
            <div class="catalog-plan-body">
                <div class="catalog-plan-description"><?php if ($_smarty_tpl->tpl_vars['product']->value['features']) {
if ($_smarty_tpl->tpl_vars['product']->value['featuresdesc']) {?><p><?php echo $_smarty_tpl->tpl_vars['product']->value['featuresdesc'];?>
</p><?php }?><ul><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['features'], 'value', false, 'feature');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value => $_smarty_tpl->tpl_vars['value']->value) {
?><li><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value, ENT_QUOTES, 'UTF-8', true);?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</li><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php } else { ?><ul><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['portalSpecs'], 'line');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
?><li><?php if ($_smarty_tpl->tpl_vars['line']->value['label']) {?><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['line']->value['label'], ENT_QUOTES, 'UTF-8', true);?>
:</strong> <?php }
echo htmlspecialchars($_smarty_tpl->tpl_vars['line']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
</li><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php }?></div>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['hasconfigoptions']) {?><small class="catalog-price-note"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['startingfrom'];?>
</small><?php }?>
                <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php" class="catalog-plan-order"><input type="hidden" name="a" value="add">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?><input type="hidden" name="bid" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['bid'];?>
"><div class="catalog-fixed-price"><?php echo $_smarty_tpl->tpl_vars['product']->value['displayprice'];?>
</div><?php } else { ?><input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['pid'];?>
">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['portalCycles']) {?><label class="sr-only" for="catalog-cycle-<?php echo $_smarty_tpl->tpl_vars['product']->value['pid'];?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderbillingcycle'];?>
 — <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</label><select id="catalog-cycle-<?php echo $_smarty_tpl->tpl_vars['product']->value['pid'];?>
" name="billingcycle" <?php if ($_smarty_tpl->tpl_vars['product']->value['portalSoldOut']) {?>disabled<?php }?>><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['portalCycles'], 'cycle');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cycle']->value) {
?><option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cycle']->value['key'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cycle']->value['label'], ENT_QUOTES, 'UTF-8', true);?>
</option><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></select><?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == 'free') {?><div class="catalog-fixed-price"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderfree'];?>
</div><input type="hidden" name="billingcycle" value="free"><?php }
}?>
                    <button type="submit" <?php if ($_smarty_tpl->tpl_vars['product']->value['portalSoldOut']) {?>disabled<?php }?>><?php if ($_smarty_tpl->tpl_vars['product']->value['portalSoldOut']) {
echo $_smarty_tpl->tpl_vars['LANG']->value['outofstock'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['portalOrder'];
}?></button>
                </form>
            </div>
        </article><?php
}
} else {
?><div class="catalog-empty"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalNoPlans'];?>
</div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookBelowProductsOutput']->value, 'output');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
echo $_smarty_tpl->tpl_vars['output']->value;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </section>
    <div class="catalog-help"><i class="far fa-life-ring" aria-hidden="true"></i><div><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalNeedHelp'];?>
</strong><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalChooseHelp'];?>
</span></div><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
<i class="fas fa-arrow-right" aria-hidden="true"></i></a></div>
</div>
<?php }
}

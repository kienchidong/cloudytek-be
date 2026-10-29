<?php
/* Smarty version 3.1.33-p1, created on 2026-10-15 22:17:05
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\orderforms\standard_cart\products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad0ee71a4e402_54423573',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ce564f924bc5c192e7f778944d1c11f9067fd43' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\orderforms\\standard_cart\\products.tpl',
      1 => 1792077141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/common.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories-collapsed.tpl' => 1,
  ),
),false)) {
function content_6ad0ee71a4e402_54423573 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['portalCatalog']->value) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/catalog.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} else {
$_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div id="order-standard_cart">

    <div class="row">

        <div class="pull-md-right col-md-9">

            <div class="header-lined">
                <h1>
                    <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['headline']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['headline'];?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['name'];?>

                    <?php }?>
                </h1>
                <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['tagline']) {?>
                    <p><?php echo $_smarty_tpl->tpl_vars['productGroup']->value['tagline'];?>
</p>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                <div class="alert alert-danger">
                    <?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>

                </div>
            <?php }?>
        </div>

        <div class="col-md-3 pull-md-left sidebar hidden-xs hidden-sm">
            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>

        <div class="col-md-9 pull-md-right">

            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookAboveProductsOutput']->value, 'output');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
?>
                <div>
                    <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

                </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <div class="products" id="products">
                <div class="row row-eq-height">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, 'key');
$_smarty_tpl->tpl_vars['product']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->iteration++;
$__foreach_product_1_saved = $_smarty_tpl->tpl_vars['product'];
?>
                        <div class="col-md-6">
                            <div class="product clearfix" id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
">
                                <header>
                                    <span id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
-name"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</span>
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['qty']) {?>
                                        <span class="qty">
                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['qty'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderavailable'];?>

                                        </span>
                                    <?php }?>
                                </header>
                                <div class="product-desc">
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['featuresdesc']) {?>
                                        <p id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
-description">
                                            <?php echo $_smarty_tpl->tpl_vars['product']->value['featuresdesc'];?>

                                        </p>
                                    <?php }?>
                                    <ul>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['features'], 'value', false, 'feature');
$_smarty_tpl->tpl_vars['value']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->iteration++;
$__foreach_value_2_saved = $_smarty_tpl->tpl_vars['value'];
?>
                                            <li id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
-feature<?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
">
                                                <span class="feature-value"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</span>
                                                <?php echo $_smarty_tpl->tpl_vars['feature']->value;?>

                                            </li>
                                        <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_2_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </ul>
                                </div>
                                <footer>
                                    <div class="product-pricing" id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
-price">
                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?>
                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['bundledeal'];?>
<br />
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['displayprice']) {?>
                                                <span class="price"><?php echo $_smarty_tpl->tpl_vars['product']->value['displayprice'];?>
</span>
                                            <?php }?>
                                        <?php } else { ?>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['hasconfigoptions']) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['startingfrom'];?>

                                                <br />
                                            <?php }?>
                                            <span class="price"><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['price'];?>
</span>
                                            <br />
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "monthly") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermmonthly'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "quarterly") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermquarterly'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "semiannually") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermsemiannually'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "annually") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermannually'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "biennially") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermbiennially'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "triennially") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermtriennially'];?>

                                            <?php }?>
                                            <br>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']) {?>
                                                <small><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']->toPrefixed();?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>
</small>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    <a href="cart.php?a=add&<?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?>bid=<?php echo $_smarty_tpl->tpl_vars['product']->value['bid'];
} else { ?>pid=<?php echo $_smarty_tpl->tpl_vars['product']->value['pid'];
}?>" class="btn btn-success btn-sm" id="product<?php echo $_smarty_tpl->tpl_vars['product']->iteration;?>
-order-button">
                                        <i class="fas fa-shopping-cart"></i>
                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordernowbutton'];?>

                                    </a>
                                </footer>
                            </div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['product']->iteration%2 == 0) {?>
                            </div>
                            <div class="row row-eq-height">
                        <?php }?>
                    <?php
$_smarty_tpl->tpl_vars['product'] = $__foreach_product_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookBelowProductsOutput']->value, 'output');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
?>
                <div>
                    <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

                </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        </div>
    </div>
</div>

<?php }
}
}

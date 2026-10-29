<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 00:26:05
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\orderforms\standard_cart\checkout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad25e2d086f50_35526822',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1e207b4846c0ad5ae587b883ea20992475986e8' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\orderforms\\standard_cart\\checkout.tpl',
      1 => 1792171528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/common.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories.tpl' => 1,
    'file:orderforms/standard_cart/sidebar-categories-collapsed.tpl' => 1,
    'file:orderforms/standard_cart/linkedaccounts.tpl' => 2,
  ),
),false)) {
function content_6ad25e2d086f50_35526822 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    // Define state tab index value
    var statesTab = 10;
    // Do not enforce state input client side
    var stateNotRequired = true;
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/StatesDropdown.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/PasswordStrength.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    window.langPasswordStrength = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrength'];?>
";
    window.langPasswordWeak = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthweak'];?>
";
    window.langPasswordModerate = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthmoderate'];?>
";
    window.langPasswordStrong = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthstrong'];?>
";
<?php echo '</script'; ?>
>

<div id="order-standard_cart"<?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {?> class="portal-cart-checkout"<?php }?>>
    <?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/cart-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('step'=>3), 0, true);
}?>

    <div class="row">

        <div class="pull-md-right col-md-9">

            <div class="header-lined">
                <h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['checkout'];?>
</h1>
            </div>

        </div>

        <div class="col-md-3 pull-md-left sidebar hidden-xs hidden-sm">

            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </div>

        <div class="col-md-9 pull-md-right">

            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="already-registered clearfix">
                <?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {?><h2 class="checkout-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['checkout'];?>
</h2><?php }?>
                <div class="pull-right">
                    <button type="button" class="btn btn-info<?php if ($_smarty_tpl->tpl_vars['loggedin']->value || !$_smarty_tpl->tpl_vars['loggedin']->value && $_smarty_tpl->tpl_vars['custtype']->value == "existing") {?> hidden<?php }?>" id="btnAlreadyRegistered">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['alreadyRegistered'];?>

                    </button>
                    <button type="button" class="btn btn-warning<?php if ($_smarty_tpl->tpl_vars['loggedin']->value || $_smarty_tpl->tpl_vars['custtype']->value != "existing") {?> hidden<?php }?>" id="btnNewUserSignup">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['createAccount'];?>

                    </button>
                </div>
                <p><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen' && $_smarty_tpl->tpl_vars['loggedin']->value) {
echo $_smarty_tpl->tpl_vars['LANG']->value['portalCheckoutReview'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['enterPersonalDetails'];
}?></p>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                <div class="alert alert-danger checkout-error-feedback" role="alert">
                    <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['correctErrors'];?>
:</p>
                    <ul>
                        <?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>

                    </ul>
                </div>
                <div class="clearfix"></div>
            <?php }?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?a=checkout" name="orderfrm" id="frmCheckout">
                <input type="hidden" name="submit" value="true" />
                <input type="hidden" name="custtype" id="inputCustType" value="<?php echo $_smarty_tpl->tpl_vars['custtype']->value;?>
" />

                <div id="containerExistingUserSignin"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value || $_smarty_tpl->tpl_vars['custtype']->value != "existing") {?> class="hidden"<?php }?>>

                    <div class="sub-heading">
                        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['existingCustomerLogin'];?>
</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputLoginEmail" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];
} else { ?>
                                    <i class="fas fa-envelope"></i>
                                <?php }?></label>
                                <input type="text" name="loginemail" id="inputLoginEmail" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputLoginPassword" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];
} else { ?>
                                    <i class="fas fa-lock"></i>
                                <?php }?></label>
                                <input type="password" name="loginpassword" id="inputLoginPassword" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
">
                            </div>
                        </div>
                    </div>

                    <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"checkout-existing"), 0, false);
?>
                </div>

                <div id="containerNewUserSignup"<?php if ($_smarty_tpl->tpl_vars['custtype']->value == "existing" && !$_smarty_tpl->tpl_vars['loggedin']->value) {?> class="hidden"<?php }?>>

                    <div<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> class="hidden"<?php }?>>
                        <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"checkout-new"), 0, true);
?>
                    </div>

                    <div class="sub-heading checkout-first-heading">
                        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['personalInformation'];?>
</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputFirstName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];
} else { ?>
                                    <i class="fas fa-user"></i>
                                <?php }?></label>
                                <input type="text" name="firstname" id="inputFirstName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?> autofocus>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputLastName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];
} else { ?>
                                    <i class="fas fa-user"></i>
                                <?php }?></label>
                                <input type="text" name="lastname" id="inputLastName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputEmail" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];
} else { ?>
                                    <i class="fas fa-envelope"></i>
                                <?php }?></label>
                                <input type="email" name="email" id="inputEmail" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['email'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputPhone" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];
} else { ?>
                                    <i class="fas fa-phone"></i>
                                <?php }?></label>
                                <input type="tel" name="phonenumber" id="inputPhone" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['phonenumber'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                    </div>

                    <div class="sub-heading">
                        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['billingAddress'];?>
</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputCompanyName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];
} else { ?>
                                    <i class="fas fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="companyname" id="inputCompanyName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['companyname'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputAddress1" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];
} else { ?>
                                    <i class="far fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="address1" id="inputAddress1" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['address1'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputAddress2" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];
} else { ?>
                                    <i class="fas fa-map-marker-alt"></i>
                                <?php }?></label>
                                <input type="text" name="address2" id="inputAddress2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['address2'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group prepend-icon">
                                <label for="inputCity" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];
} else { ?>
                                    <i class="far fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="city" id="inputCity" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['city'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group prepend-icon">
                                <?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {?>
                                <label for="inputState" class="field-icon" id="checkoutStateLabel"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
</label>
                                <?php } else { ?>
                                <label for="state" class="field-icon" id="inputStateIcon">
                                    <i class="fas fa-map-signs"></i>
                                </label>
                                <label for="stateinput" class="field-icon" id="inputStateIcon">
                                    <i class="fas fa-map-signs"></i>
                                </label>
                                <?php }?>
                                <input type="text" name="state" id="inputState" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['state'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group prepend-icon">
                                <label for="inputPostcode" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];
} else { ?>
                                    <i class="fas fa-certificate"></i>
                                <?php }?></label>
                                <input type="text" name="postcode" id="inputPostcode" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['postcode'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputCountry" class="field-icon" id="inputCountryIcon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['country'];
} else { ?>
                                    <i class="fas fa-globe"></i>
                                <?php }?></label>
                                <select name="country" id="inputCountry" class="field"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled="disabled"<?php }?>>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'countrylabel', false, 'countrycode');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['countrycode']->value => $_smarty_tpl->tpl_vars['countrylabel']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['countrycode']->value;?>
"<?php if ((!$_smarty_tpl->tpl_vars['country']->value && $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['defaultcountry']->value) || $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['country']->value) {?> selected<?php }?>>
                                            <?php echo $_smarty_tpl->tpl_vars['countrylabel']->value;?>

                                        </option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['showTaxIdField']->value) {?>
                            <div class="col-sm-12">
                                <div class="form-group prepend-icon">
                                    <label for="inputTaxId" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel()),$_smarty_tpl ) );
} else { ?>
                                        <i class="fas fa-building"></i>
                                    <?php }?></label>
                                    <input type="text" name="tax_id" id="inputTaxId" class="field" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel()),$_smarty_tpl ) );?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['tax_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> readonly="readonly"<?php }?>>
                                </div>
                            </div>
                        <?php }?>
                    </div>

                    <?php if ($_smarty_tpl->tpl_vars['customfields']->value) {?>
                        <div class="sub-heading">
                            <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderadditionalrequiredinfo'];?>
</span>
                        </div>
                        <div class="field-container">
                            <div class="row">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customfields']->value, 'customfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['customfield']->value) {
?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="customfield<?php echo $_smarty_tpl->tpl_vars['customfield']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['name'];?>
</label>
                                            <?php echo $_smarty_tpl->tpl_vars['customfield']->value['input'];?>

                                            <?php if ($_smarty_tpl->tpl_vars['customfield']->value['description']) {?>
                                                <span class="field-help-text">
                                                    <?php echo $_smarty_tpl->tpl_vars['customfield']->value['description'];?>

                                                </span>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        </div>
                    <?php }?>

                </div>

                <?php if ($_smarty_tpl->tpl_vars['domainsinorder']->value) {?>

                    <div class="sub-heading">
                        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainregistrantinfo'];?>
</span>
                    </div>

                    <p class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['domainAlternativeContact'];?>
</p>

                    <div class="row margin-bottom">
                        <div class="col-sm-6 col-sm-offset-3">
                            <select name="contact" id="inputDomainContact" class="field">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['LANG']->value['usedefaultcontact'];?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domaincontacts']->value, 'domcontact');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['domcontact']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['domcontact']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['contact']->value == $_smarty_tpl->tpl_vars['domcontact']->value['id']) {?> selected<?php }?>>
                                        <?php echo $_smarty_tpl->tpl_vars['domcontact']->value['name'];?>

                                    </option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <option value="addingnew"<?php if ($_smarty_tpl->tpl_vars['contact']->value == "addingnew") {?> selected<?php }?>>
                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavaddcontact'];?>
...
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row<?php if ($_smarty_tpl->tpl_vars['contact']->value != "addingnew") {?> hidden<?php }?>" id="domainRegistrantInputFields">
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputDCFirstName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];
} else { ?>
                                    <i class="fas fa-user"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactfirstname" id="inputDCFirstName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['firstname'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputDCLastName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];
} else { ?>
                                    <i class="fas fa-user"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactlastname" id="inputDCLastName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['lastname'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputDCEmail" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];
} else { ?>
                                    <i class="fas fa-envelope"></i>
                                <?php }?></label>
                                <input type="email" name="domaincontactemail" id="inputDCEmail" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['email'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group prepend-icon">
                                <label for="inputDCPhone" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];
} else { ?>
                                    <i class="fas fa-phone"></i>
                                <?php }?></label>
                                <input type="tel" name="domaincontactphonenumber" id="inputDCPhone" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['phonenumber'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputDCCompanyName" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];
} else { ?>
                                    <i class="fas fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactcompanyname" id="inputDCCompanyName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['companyname'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputDCAddress1" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];
} else { ?>
                                    <i class="far fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactaddress1" id="inputDCAddress1" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['address1'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputDCAddress2" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];
} else { ?>
                                    <i class="fas fa-map-marker-alt"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactaddress2" id="inputDCAddress2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['address2'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group prepend-icon">
                                <label for="inputDCCity" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];
} else { ?>
                                    <i class="far fa-building"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactcity" id="inputDCCity" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['city'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group prepend-icon">
                                <label for="inputDCState" class="field-icon">
                                    <i class="fas fa-map-signs"></i>
                                </label>
                                <input type="text" name="domaincontactstate" id="inputDCState" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['state'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group prepend-icon">
                                <label for="inputDCPostcode" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];
} else { ?>
                                    <i class="fas fa-certificate"></i>
                                <?php }?></label>
                                <input type="text" name="domaincontactpostcode" id="inputDCPostcode" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['postcode'];?>
">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputDCCountry" class="field-icon" id="inputCountryIcon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['country'];
} else { ?>
                                    <i class="fas fa-globe"></i>
                                <?php }?></label>
                                <select name="domaincontactcountry" id="inputDCCountry" class="field">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'countrylabel', false, 'countrycode');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['countrycode']->value => $_smarty_tpl->tpl_vars['countrylabel']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['countrycode']->value;?>
"<?php if ((!$_smarty_tpl->tpl_vars['domaincontact']->value['country'] && $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['defaultcountry']->value) || $_smarty_tpl->tpl_vars['countrycode']->value == $_smarty_tpl->tpl_vars['domaincontact']->value['country']) {?> selected<?php }?>>
                                            <?php echo $_smarty_tpl->tpl_vars['countrylabel']->value;?>

                                        </option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group prepend-icon">
                                <label for="inputDCTaxId" class="field-icon">
                                    <i class="fas fa-building"></i>
                                </label>
                                <input type="text" name="domaincontacttax_id" id="inputDCTaxId" class="field" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel()),$_smarty_tpl ) );?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['domaincontact']->value['tax_id'];?>
">
                            </div>
                        </div>
                    </div>

                <?php }?>

                <?php if (!$_smarty_tpl->tpl_vars['loggedin']->value) {?>

                    <div id="containerNewUserSecurity"<?php if ((!$_smarty_tpl->tpl_vars['loggedin']->value && $_smarty_tpl->tpl_vars['custtype']->value == "existing") || ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && !$_smarty_tpl->tpl_vars['securityquestions']->value)) {?> class="hidden"<?php }?>>

                        <div class="sub-heading">
                            <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['accountSecurity'];?>
</span>
                        </div>

                        <div id="containerPassword" class="row<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && $_smarty_tpl->tpl_vars['securityquestions']->value) {?> hidden<?php }?>">
                            <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
                            <div class="col-sm-6">
                                <div class="form-group prepend-icon">
                                    <label for="inputNewPassword1" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];
} else { ?>
                                        <i class="fas fa-lock"></i>
                                    <?php }?></label>
                                    <input type="password" name="password" id="inputNewPassword1" data-error-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthErrorThreshold']->value;?>
" data-warning-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthWarningThreshold']->value;?>
" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
"<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"<?php }?>>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group prepend-icon">
                                    <label for="inputNewPassword2" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];
} else { ?>
                                        <i class="fas fa-lock"></i>
                                    <?php }?></label>
                                    <input type="password" name="password2" id="inputNewPassword2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];?>
"<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"<?php }?>>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-default btn-sm generate-password" data-targetfields="inputNewPassword1,inputNewPassword2">
                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['btnLabel'];?>

                                </button>
                            </div>
                            <div class="col-sm-6">
                                <div class="password-strength-meter">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                                        </div>
                                    </div>
                                    <p class="text-center small text-muted" id="passwordStrengthTextLabel"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrength'];?>
: <?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthenter'];?>
</p>
                                </div>
                            </div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['securityquestions']->value) {?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select name="securityqid" id="inputSecurityQId" class="field">
                                        <option value=""><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityquestion'];?>
</option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['securityquestions']->value, 'question');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['question']->value) {
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['question']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['question']->value['id'] == $_smarty_tpl->tpl_vars['securityqid']->value) {?> selected<?php }?>>
                                                <?php echo $_smarty_tpl->tpl_vars['question']->value['question'];?>

                                            </option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group prepend-icon">
                                        <label for="inputSecurityQAns" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];
} else { ?>
                                            <i class="fas fa-lock"></i>
                                        <?php }?></label>
                                        <input type="password" name="securityqans" id="inputSecurityQAns" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];?>
">
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                    </div>

                <?php }?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookOutput']->value, 'output');
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

                <div class="sub-heading">
                    <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['paymentDetails'];?>
</span>
                </div>

                <div class="alert alert-success text-center large-text" role="alert">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertotalduetoday'];?>
: &nbsp; <strong><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</strong>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['canUseCreditOnCheckout']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['ctkWallet']->value) {?><p class="ctk-wallet-hint">Số dư thanh toán gồm tài khoản chính và khuyến mãi. Hệ thống ưu tiên trừ khuyến mãi trước. <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wallet.php">Xem số dư</a></p><?php }?>
                    <div id="applyCreditContainer" class="apply-credit-container" data-apply-credit="<?php echo $_smarty_tpl->tpl_vars['applyCredit']->value;?>
">
                        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cart.availableCreditBalance','amount'=>$_smarty_tpl->tpl_vars['creditBalance']->value),$_smarty_tpl ) );?>
</p>

                        <?php if ($_smarty_tpl->tpl_vars['creditBalance']->value->toNumeric() >= $_smarty_tpl->tpl_vars['total']->value->toNumeric()) {?>
                            <label class="radio">
                                <input id="useFullCreditOnCheckout" type="radio" name="applycredit" value="1"<?php if ($_smarty_tpl->tpl_vars['applyCredit']->value) {?> checked<?php }?>>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cart.applyCreditAmountNoFurtherPayment','amount'=>$_smarty_tpl->tpl_vars['total']->value),$_smarty_tpl ) );?>

                            </label>
                        <?php } else { ?>
                            <label class="radio">
                                <input id="useCreditOnCheckout" type="radio" name="applycredit" value="1"<?php if ($_smarty_tpl->tpl_vars['applyCredit']->value) {?> checked<?php }?>>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cart.applyCreditAmount','amount'=>$_smarty_tpl->tpl_vars['creditBalance']->value),$_smarty_tpl ) );?>

                            </label>
                        <?php }?>

                        <label class="radio">
                            <input id="skipCreditOnCheckout" type="radio" name="applycredit" value="0"<?php if (!$_smarty_tpl->tpl_vars['applyCredit']->value) {?> checked<?php }?>>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'cart.applyCreditSkip','amount'=>$_smarty_tpl->tpl_vars['creditBalance']->value),$_smarty_tpl ) );?>

                        </label>
                    </div>
                <?php }?>
                <div id="paymentGatewaysContainer" class="form-group">
                    <?php if ($_smarty_tpl->tpl_vars['template']->value != 'kinsmen' || $_smarty_tpl->tpl_vars['gateways']->value) {?><p class="small text-muted"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['preferredPaymentMethod'];?>
</p><?php }?>

                    <div class="text-center">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gateways']->value, 'gateway');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['gateway']->value) {
?>
                            <label class="radio-inline">
                                <input type="radio"
                                       name="paymentmethod"
                                       value="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['sysname'];?>
"
                                       data-payment-type="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['payment_type'];?>
"
                                       data-show-local="<?php echo $_smarty_tpl->tpl_vars['gateway']->value['show_local_cards'];?>
"
                                       class="payment-methods<?php if ($_smarty_tpl->tpl_vars['gateway']->value['type'] == "CC") {?> is-credit-card<?php }?>"
                                       <?php if ($_smarty_tpl->tpl_vars['selectedgateway']->value == $_smarty_tpl->tpl_vars['gateway']->value['sysname']) {?> checked<?php }?>
                                />
                                <?php echo $_smarty_tpl->tpl_vars['gateway']->value['name'];?>

                            </label>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen' && !$_smarty_tpl->tpl_vars['gateways']->value && (!$_smarty_tpl->tpl_vars['canUseCreditOnCheckout']->value || !$_smarty_tpl->tpl_vars['applyCredit']->value || $_smarty_tpl->tpl_vars['creditBalance']->value->toNumeric() < $_smarty_tpl->tpl_vars['total']->value->toNumeric())) {?><p class="checkout-payment-empty"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCheckoutNoGateway'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
</a></p><?php }?>
                </div>

                <div class="alert alert-danger text-center gateway-errors hidden"></div>

                <div class="clearfix"></div>

                <div class="cc-input-container<?php if ($_smarty_tpl->tpl_vars['selectedgatewaytype']->value != "CC") {?> hidden<?php }?>" id="creditCardInputFields">
                    <?php if ($_smarty_tpl->tpl_vars['client']->value) {?>
                        <div id="existingCardsContainer" class="existing-cc-grid">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['client']->value->payMethods->validateGateways()->sortByExpiryDate(), 'payMethod');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payMethod']->value) {
?>
                                <?php $_smarty_tpl->_assignInScope('payMethodExpired', 0);?>
                                <?php $_smarty_tpl->_assignInScope('expiryDate', '');?>
                                <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->isCreditCard()) {?>
                                    <?php if (($_smarty_tpl->tpl_vars['payMethod']->value->payment->isExpired())) {?>
                                        <?php $_smarty_tpl->_assignInScope('payMethodExpired', 1);?>
                                    <?php }?>

                                    <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->payment->getExpiryDate()) {?>
                                        <?php $_smarty_tpl->_assignInScope('expiryDate', $_smarty_tpl->tpl_vars['payMethod']->value->payment->getExpiryDate()->format('m/Y'));?>
                                    <?php }?>
                                <?php }?>

                                <div class="paymethod-info radio-inline" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                    <input
                                        type="radio"
                                        name="ccinfo"
                                        class="existing-card"
                                        <?php if ($_smarty_tpl->tpl_vars['payMethodExpired']->value) {?>disabled<?php }?>
                                        data-payment-type="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getType();?>
"
                                        data-payment-gateway="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->gateway_name;?>
"
                                        data-order-preference="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->order_preference;?>
"
                                        value="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                </div>

                                <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                    <i class="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getFontAwesomeIcon();?>
"></i>
                                </div>
                                <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                    <?php if ($_smarty_tpl->tpl_vars['payMethod']->value->isCreditCard() || $_smarty_tpl->tpl_vars['payMethod']->value->isRemoteBankAccount()) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->payment->getDisplayName();?>

                                    <?php } else { ?>
                                        <span class="type">
                                            <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->payment->getAccountType();?>

                                        </span>
                                        <?php echo substr($_smarty_tpl->tpl_vars['payMethod']->value->payment->getAccountNumber(),-4);?>

                                    <?php }?>
                                </div>
                                <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['payMethod']->value->getDescription();?>

                                </div>
                                <div class="paymethod-info" data-paymethod-id="<?php echo $_smarty_tpl->tpl_vars['payMethod']->value->id;?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['expiryDate']->value;
if ($_smarty_tpl->tpl_vars['payMethodExpired']->value) {?><br><small><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaexpired'];?>
</small><?php }?>
                                </div>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    <?php }?>
                    <div class="row cvv-input" id="existingCardInfo">
                        <div class="col-lg-3 col-sm-4">
                            <div class="form-group prepend-icon">
                                <label for="inputCardCVV2" class="field-icon">
                                    <i class="fas fa-barcode"></i>
                                </label>
                                <div class="input-group">
                                    <input type="tel" name="cccvv" id="inputCardCVV2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcvvnumbershort'];?>
" autocomplete="cc-cvc">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" data-toggle="popover" data-placement="bottom" data-content="<img src='<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ccv.gif' width='210' />">
                                            ?
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul>
                        <li>
                            <label class="radio-inline">
                                <input type="radio" name="ccinfo" value="new" id="new" <?php if (!$_smarty_tpl->tpl_vars['client']->value || $_smarty_tpl->tpl_vars['client']->value->payMethods->count() === 0) {?> checked="checked"<?php }?> />
                                &nbsp;
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'creditcardenternewcard'),$_smarty_tpl ) );?>

                            </label>
                        </li>
                    </ul>

                    <div class="row" id="newCardInfo">
                        <div id="cardNumberContainer" class="col-sm-6 new-card-container">
                            <div class="form-group prepend-icon">
                                <label for="inputCardNumber" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['cardNumber'];
} else { ?>
                                    <i class="fas fa-credit-card"></i>
                                <?php }?></label>
                                <input type="tel" name="ccnumber" id="inputCardNumber" class="field cc-number-field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['cardNumber'];?>
" autocomplete="cc-number">
                            </div>
                        </div>
                        <div class="col-sm-3 new-card-container">
                            <div class="form-group prepend-icon">
                                <label for="inputCardExpiry" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardexpires'];
} else { ?>
                                    <i class="fas fa-calendar-alt"></i>
                                <?php }?></label>
                                <input type="tel" name="ccexpirydate" id="inputCardExpiry" class="field" placeholder="MM / YY<?php if ($_smarty_tpl->tpl_vars['showccissuestart']->value) {?> (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardexpires'];?>
)<?php }?>" autocomplete="cc-exp">
                            </div>
                        </div>
                        <div class="col-sm-3" id="cvv-field-container">
                            <div class="form-group prepend-icon">
                                <label for="inputCardCVV" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcvvnumbershort'];
} else { ?>
                                    <i class="fas fa-barcode"></i>
                                <?php }?></label>
                                <div class="input-group">
                                    <input type="tel" name="cccvv" id="inputCardCVV" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcvvnumbershort'];?>
" autocomplete="cc-cvc">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" data-toggle="popover" data-placement="bottom" data-content="<img src='<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/ccv.gif' width='210' />">
                                            ?
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['showccissuestart']->value) {?>
                            <div class="col-sm-3 col-sm-offset-6 new-card-container">
                                <div class="form-group prepend-icon">
                                    <label for="inputCardStart" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardstart'];
} else { ?>
                                        <i class="far fa-calendar-check"></i>
                                    <?php }?></label>
                                    <input type="tel" name="ccstartdate" id="inputCardStart" class="field" placeholder="MM / YY (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardstart'];?>
)" autocomplete="cc-exp">
                                </div>
                            </div>
                            <div class="col-sm-3 new-card-container">
                                <div class="form-group prepend-icon">
                                    <label for="inputCardIssue" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardissuenum'];
} else { ?>
                                        <i class="fas fa-asterisk"></i>
                                    <?php }?></label>
                                    <input type="tel" name="ccissuenum" id="inputCardIssue" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditcardcardissuenum'];?>
">
                                </div>
                            </div>
                        <?php }?>
                        <div class="form-group new-card-container">
                            <div id="inputDescriptionContainer" class="col-md-6">
                                <div class="prepend-icon">
                                    <label for="inputDescription" class="field-icon"><?php if ($_smarty_tpl->tpl_vars['template']->value == 'kinsmen') {
echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['descriptionInput'];
} else { ?>
                                        <i class="fas fa-pencil"></i>
                                    <?php }?></label>
                                    <input type="text" class="field" id="inputDescription" name="ccdescription" autocomplete="off" value="" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethods']['descriptionInput'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['paymentMethodsManage']['optional'];?>
" />
                                </div>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['allowClientsToRemoveCards']->value) {?>
                                <div class="col-md-6" style="line-height: 32px;">
                                    <input type="hidden" name="nostore" value="1">
                                    <input type="checkbox" class="toggle-switch-success no-icheck" data-size="mini" checked="checked" name="nostore" id="inputNoStore" value="0" data-on-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'yes'),$_smarty_tpl ) );?>
" data-off-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'no'),$_smarty_tpl ) );?>
">
                                    <label for="inputNoStore" class="checkbox-inline no-padding">
                                        &nbsp;&nbsp;
                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['creditCardStore'];?>

                                    </label>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['shownotesfield']->value) {?>

                    <div class="sub-heading">
                        <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['additionalNotes'];?>
</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="notes" class="field" rows="4" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordernotesdescription'];?>
"><?php echo $_smarty_tpl->tpl_vars['orderNotes']->value;?>
</textarea>
                            </div>
                        </div>
                    </div>

                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['showMarketingEmailOptIn']->value) {?>
                    <div class="marketing-email-optin">
                        <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'emailMarketing.joinOurMailingList'),$_smarty_tpl ) );?>
</h4>
                        <p><?php echo $_smarty_tpl->tpl_vars['marketingEmailOptInMessage']->value;?>
</p>
                        <input type="checkbox" name="marketingoptin" value="1"<?php if ($_smarty_tpl->tpl_vars['marketingEmailOptIn']->value) {?> checked<?php }?> class="no-icheck toggle-switch-success" data-size="small" data-on-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'yes'),$_smarty_tpl ) );?>
" data-off-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'no'),$_smarty_tpl ) );?>
">
                    </div>
                <?php }?>

                <div class="text-center">
                    <?php if ($_smarty_tpl->tpl_vars['accepttos']->value) {?>
                        <p>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="accepttos" id="accepttos" />
                                &nbsp;
                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertosagreement'];?>

                                <a href="<?php echo $_smarty_tpl->tpl_vars['tosurl']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</a>
                            </label>
                        </p>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['captcha']->value) {?>
                        <div class="text-center margin-bottom">
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        </div>
                    <?php }?>

                    <button type="submit"
                            id="btnCompleteOrder"
                            class="btn btn-primary btn-lg disable-on-click spinner-on-click<?php if ($_smarty_tpl->tpl_vars['captcha']->value) {
echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);
}?>"
                            <?php if ($_smarty_tpl->tpl_vars['cartitems']->value == 0) {?>disabled="disabled"<?php }?>
                            onclick="this.value='<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pleasewait'];?>
'">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['completeorder'];?>

                        &nbsp;<i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </form>

            <?php if ($_smarty_tpl->tpl_vars['servedOverSsl']->value) {?>
                <div class="alert alert-warning checkout-security-msg">
                    <i class="fas fa-lock"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersecure'];?>
 (<strong><?php echo $_smarty_tpl->tpl_vars['ipaddress']->value;?>
</strong>) <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersecure2'];?>

                    <div class="clearfix"></div>
                </div>
            <?php }?>

        </div>
    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/jquery.payment.js"><?php echo '</script'; ?>
>
<?php }
}

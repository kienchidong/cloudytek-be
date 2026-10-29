<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 09:26:14
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientregister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad2dcc6a31c32_73883834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b44691308964c3b2e16364a53bf98c30d7b37b4c' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientregister.tpl',
      1 => 1792203944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad2dcc6a31c32_73883834 (Smarty_Internal_Template $_smarty_tpl) {
if (in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>
    <?php echo '<script'; ?>
>
        var statesTab = 10;
        var stateNotRequired = true;
    <?php echo '</script'; ?>
>
<?php }?>

<?php echo '<script'; ?>
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
    jQuery(document).ready(function()
    {
        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
    });
<?php echo '</script'; ?>
>
<div class="portal-registration">
<section class="registration-form-card" aria-labelledby="registration-title">
<header class="registration-heading"><span class="registration-eyebrow"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
</span><h1 id="registration-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterTitle'];?>
</h1><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterIntro'];?>
</p><span class="registration-signin"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalHaveAccount'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'];?>
 <i class="fas fa-arrow-right" aria-hidden="true"></i></a></span></header>
<?php if ($_smarty_tpl->tpl_vars['registrationDisabled']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>((($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccount']).(' <strong><a href="cart.php" class="alert-link">')).($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccountOrder'])).('</a></strong>')), 0, true);
}?>

<?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
}?>

<?php if (!$_smarty_tpl->tpl_vars['registrationDisabled']->value) {?>
<div id="registration">
    <form method="post" class="using-password-strength" action="<?php echo $_SERVER['PHP_SELF'];?>
" role="form" name="orderfrm" id="frmCheckout">
        <input type="hidden" name="register" value="true"/>
        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">

        <div id="containerNewUserSignup">

            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"registration"), 0, true);
?>

            <div class="sub-heading">
                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['personalInformation'];?>
</span>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputFirstName" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
</label>
                        <input type="text" name="firstname" id="inputFirstName" autocomplete="given-name" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientfirstname']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if (!in_array('firstname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?> autofocus>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputLastName" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
</label>
                        <input type="text" name="lastname" id="inputLastName" autocomplete="family-name" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientlastname']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if (!in_array('lastname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputEmail" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
</label>
                        <input type="email" name="email" id="inputEmail" autocomplete="email" required class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientemail']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputPhone" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
</label>
                        <input type="tel" name="phonenumber" id="inputPhone" autocomplete="tel" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientphonenumber']->value, ENT_QUOTES, 'UTF-8', true);?>
">
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
                        <label for="inputCompanyName" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
</label>
                        <input type="text" name="companyname" id="inputCompanyName" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientcompanyname']->value, ENT_QUOTES, 'UTF-8', true);?>
">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputAddress1" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
</label>
                        <input type="text" name="address1" id="inputAddress1" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress1']->value;?>
"  <?php if (!in_array('address1',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputAddress2" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
</label>
                        <input type="text" name="address2" id="inputAddress2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress2']->value;?>
">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group prepend-icon">
                        <label for="inputCity" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
</label>
                        <input type="text" name="city" id="inputCity" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientcity']->value, ENT_QUOTES, 'UTF-8', true);?>
"  <?php if (!in_array('city',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group prepend-icon">
                        <label for="stateinput" class="field-icon" id="registrationStateLabel"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
</label>
                        <input type="text" name="state" id="state" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientstate']->value, ENT_QUOTES, 'UTF-8', true);?>
"  <?php if (!in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group prepend-icon">
                        <label for="inputPostcode" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
</label>
                        <input type="text" name="postcode" id="inputPostcode" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['clientpostcode']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if (!in_array('postcode',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputCountry" class="field-icon" id="inputCountryIcon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['country'];?>
</label>
                        <select name="country" id="inputCountry" class="field form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientcountries']->value, 'countryName', false, 'countryCode');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryName']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
"<?php if ((!$_smarty_tpl->tpl_vars['clientcountry']->value && $_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['defaultCountry']->value) || ($_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['clientcountry']->value)) {?> selected="selected"<?php }?>>
                                    <?php echo $_smarty_tpl->tpl_vars['countryName']->value;?>

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
                            <label for="inputTaxId" class="field-icon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel()),$_smarty_tpl ) );?>
</label>
                            <input type="text" name="tax_id" id="inputTaxId" class="field" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel()),$_smarty_tpl ) );?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['tax_id'];?>
">
                        </div>
                    </div>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['customfields']->value || $_smarty_tpl->tpl_vars['currencies']->value) {?>
            <div class="sub-heading">
                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderadditionalrequiredinfo'];?>
</span>
            </div>
            <div class="row">
                <?php if ($_smarty_tpl->tpl_vars['customfields']->value) {?>
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
                            <div class="control">
                                <?php echo $_smarty_tpl->tpl_vars['customfield']->value['input'];?>

                            <?php if ($_smarty_tpl->tpl_vars['customfield']->value['description']) {?>
                                <span class="field-help-text"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['description'];?>
</span>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customfields']->value && count($_smarty_tpl->tpl_vars['customfields']->value)%2 > 0) {?>
                    <div class="clearfix"></div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['currencies']->value) {?>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputCurrency" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['choosecurrency'];?>
</label>
                        <select id="inputCurrency" name="currency" class="field form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'curr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['curr']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['curr']->value['id'];?>
"<?php if (!$_POST['currency'] && $_smarty_tpl->tpl_vars['curr']->value['default'] || $_POST['currency'] == $_smarty_tpl->tpl_vars['curr']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['curr']->value['code'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php }?>
        </div>
        <div id="containerNewUserSecurity" <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && !$_smarty_tpl->tpl_vars['securityquestions']->value) {?> class="hidden"<?php }?>>

            <div class="sub-heading">
                <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['accountSecurity'];?>
</span>
            </div>
            <div id="containerPassword" class="row<?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && $_smarty_tpl->tpl_vars['securityquestions']->value) {?> hidden<?php }?>">
                <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputNewPassword1" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
</label>
                        <input type="password" name="password" id="inputNewPassword1" data-error-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthErrorThreshold']->value;?>
" data-warning-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthWarningThreshold']->value;?>
" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="new-password"<?php if (!$_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> required<?php }
if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"<?php }?>>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputNewPassword2" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];?>
</label>
                        <input type="password" name="password2" id="inputNewPassword2" class="field" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];?>
" autocomplete="new-password"<?php if (!$_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> required<?php }
if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?> value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
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
                <div class="form-group col-sm-12">
                    <select name="securityqid" id="inputSecurityQId" class="field form-control">
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
                        <label for="inputSecurityQAns" class="field-icon"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];?>
</label>
                        <input type="password" name="securityqans" id="inputSecurityQAns" class="field form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];?>
" autocomplete="off">
                    </div>
                </div>
            </div>
            <?php }?>
        </div>

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

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

        <br/>
        <?php if ($_smarty_tpl->tpl_vars['accepttos']->value) {?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger tospanel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fas fa-exclamation-triangle tosicon"></span> &nbsp; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <label class="checkbox">
                                    <input type="checkbox" name="accepttos" class="accepttos">
                                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertosagreement'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['tosurl']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <p align="center">
            <input class="btn btn-large btn-primary<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientregistertitle'];?>
"/>
        </p>
    </form>
</div>
<?php }?>

</section>
<aside class="registration-welcome"><div class="registration-welcome-brand"><span class="ctk-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
"></span></div><h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterWelcome'];?>
</h2><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterWelcomeCopy'];?>
</p><ul><li><i class="fas fa-server" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterServices'];?>
</li><li><i class="far fa-credit-card" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterBilling'];?>
</li><li><i class="far fa-life-ring" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalRegisterSupport'];?>
</li></ul><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
 <i class="fas fa-arrow-right" aria-hidden="true"></i></a></aside>
</div>
<?php }
}

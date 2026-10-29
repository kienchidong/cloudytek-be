{if in_array('state', $optionalFields)}
    <script>
        var statesTab = 10;
        var stateNotRequired = true;
    </script>
{/if}

<script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>
<script type="text/javascript" src="{$BASE_PATH_JS}/PasswordStrength.js"></script>
<script>
    window.langPasswordStrength = "{$LANG.pwstrength}";
    window.langPasswordWeak = "{$LANG.pwstrengthweak}";
    window.langPasswordModerate = "{$LANG.pwstrengthmoderate}";
    window.langPasswordStrong = "{$LANG.pwstrengthstrong}";
    jQuery(document).ready(function()
    {
        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
    });
</script>
<div class="portal-registration">
<section class="registration-form-card" aria-labelledby="registration-title">
<header class="registration-heading"><span class="registration-eyebrow">{$companyname|escape}</span><h1 id="registration-title">{$LANG.portalRegisterTitle}</h1><p>{$LANG.portalRegisterIntro}</p><span class="registration-signin">{$LANG.portalHaveAccount} <a href="{$WEB_ROOT}/clientarea.php">{$LANG.login} <i class="fas fa-arrow-right" aria-hidden="true"></i></a></span></header>
{if $registrationDisabled}
    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.registerCreateAccount|cat:' <strong><a href="cart.php" class="alert-link">'|cat:$LANG.registerCreateAccountOrder|cat:'</a></strong>'}
{/if}

{if $errormessage}
    {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
{/if}

{if !$registrationDisabled}
<div id="registration">
    <form method="post" class="using-password-strength" action="{$smarty.server.PHP_SELF}" role="form" name="orderfrm" id="frmCheckout">
        <input type="hidden" name="register" value="true"/>
        <input type="hidden" name="token" value="{$token}">

        <div id="containerNewUserSignup">

            {include file="$template/includes/linkedaccounts.tpl" linkContext="registration"}

            <div class="sub-heading">
                <span>{$LANG.orderForm.personalInformation}</span>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputFirstName" class="field-icon">{$LANG.orderForm.firstName}</label>
                        <input type="text" name="firstname" id="inputFirstName" autocomplete="given-name" class="field form-control" placeholder="{$LANG.orderForm.firstName}" value="{$clientfirstname|escape}" {if !in_array('firstname', $optionalFields)}required{/if} autofocus>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputLastName" class="field-icon">{$LANG.orderForm.lastName}</label>
                        <input type="text" name="lastname" id="inputLastName" autocomplete="family-name" class="field form-control" placeholder="{$LANG.orderForm.lastName}" value="{$clientlastname|escape}" {if !in_array('lastname', $optionalFields)}required{/if}>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputEmail" class="field-icon">{$LANG.orderForm.emailAddress}</label>
                        <input type="email" name="email" id="inputEmail" autocomplete="email" required class="field form-control" placeholder="{$LANG.orderForm.emailAddress}" value="{$clientemail|escape}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputPhone" class="field-icon">{$LANG.orderForm.phoneNumber}</label>
                        <input type="tel" name="phonenumber" id="inputPhone" autocomplete="tel" class="field" placeholder="{$LANG.orderForm.phoneNumber}" value="{$clientphonenumber|escape}">
                    </div>
                </div>
            </div>

            <div class="sub-heading">
                <span>{$LANG.orderForm.billingAddress}</span>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputCompanyName" class="field-icon">{$LANG.orderForm.companyName}</label>
                        <input type="text" name="companyname" id="inputCompanyName" class="field" placeholder="{$LANG.orderForm.companyName} ({$LANG.orderForm.optional})" value="{$clientcompanyname|escape}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputAddress1" class="field-icon">{$LANG.orderForm.streetAddress}</label>
                        <input type="text" name="address1" id="inputAddress1" class="field form-control" placeholder="{$LANG.orderForm.streetAddress}" value="{$clientaddress1}"  {if !in_array('address1', $optionalFields)}required{/if}>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputAddress2" class="field-icon">{$LANG.orderForm.streetAddress2}</label>
                        <input type="text" name="address2" id="inputAddress2" class="field" placeholder="{$LANG.orderForm.streetAddress2}" value="{$clientaddress2}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group prepend-icon">
                        <label for="inputCity" class="field-icon">{$LANG.orderForm.city}</label>
                        <input type="text" name="city" id="inputCity" class="field form-control" placeholder="{$LANG.orderForm.city}" value="{$clientcity|escape}"  {if !in_array('city', $optionalFields)}required{/if}>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group prepend-icon">
                        <label for="stateinput" class="field-icon" id="registrationStateLabel">{$LANG.orderForm.state}</label>
                        <input type="text" name="state" id="state" class="field form-control" placeholder="{$LANG.orderForm.state}" value="{$clientstate|escape}"  {if !in_array('state', $optionalFields)}required{/if}>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group prepend-icon">
                        <label for="inputPostcode" class="field-icon">{$LANG.orderForm.postcode}</label>
                        <input type="text" name="postcode" id="inputPostcode" class="field form-control" placeholder="{$LANG.orderForm.postcode}" value="{$clientpostcode|escape}" {if !in_array('postcode', $optionalFields)}required{/if}>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group prepend-icon">
                        <label for="inputCountry" class="field-icon" id="inputCountryIcon">{$LANG.orderForm.country}</label>
                        <select name="country" id="inputCountry" class="field form-control">
                            {foreach $clientcountries as $countryCode => $countryName}
                                <option value="{$countryCode}"{if (!$clientcountry && $countryCode eq $defaultCountry) || ($countryCode eq $clientcountry)} selected="selected"{/if}>
                                    {$countryName}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                {if $showTaxIdField}
                    <div class="col-sm-12">
                        <div class="form-group prepend-icon">
                            <label for="inputTaxId" class="field-icon">{lang key=\WHMCS\Billing\Tax\Vat::getLabel()}</label>
                            <input type="text" name="tax_id" id="inputTaxId" class="field" placeholder="{lang key=\WHMCS\Billing\Tax\Vat::getLabel()} ({$LANG.orderForm.optional})" value="{$clientsdetails.tax_id}">
                        </div>
                    </div>
                {/if}
            </div>
            {if $customfields || $currencies}
            <div class="sub-heading">
                <span>{$LANG.orderadditionalrequiredinfo}</span>
            </div>
            <div class="row">
                {if $customfields}
                {foreach $customfields as $customfield}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="customfield{$customfield.id}">{$customfield.name}</label>
                            <div class="control">
                                {$customfield.input}
                            {if $customfield.description}
                                <span class="field-help-text">{$customfield.description}</span>
                            {/if}
                            </div>
                        </div>
                    </div>
                {/foreach}
                {/if}
                {if $customfields && count($customfields)%2 > 0 }
                    <div class="clearfix"></div>
                {/if}
                {if $currencies}
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputCurrency" class="field-icon">{$LANG.choosecurrency}</label>
                        <select id="inputCurrency" name="currency" class="field form-control">
                            {foreach from=$currencies item=curr}
                                <option value="{$curr.id}"{if !$smarty.post.currency && $curr.default || $smarty.post.currency eq $curr.id } selected{/if}>{$curr.code}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                {/if}
            </div>
            {/if}
        </div>
        <div id="containerNewUserSecurity" {if $remote_auth_prelinked && !$securityquestions } class="hidden"{/if}>

            <div class="sub-heading">
                <span>{$LANG.orderForm.accountSecurity}</span>
            </div>
            <div id="containerPassword" class="row{if $remote_auth_prelinked && $securityquestions} hidden{/if}">
                <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputNewPassword1" class="field-icon">{$LANG.clientareapassword}</label>
                        <input type="password" name="password" id="inputNewPassword1" data-error-threshold="{$pwStrengthErrorThreshold}" data-warning-threshold="{$pwStrengthWarningThreshold}" class="field" placeholder="{$LANG.clientareapassword}" autocomplete="new-password"{if !$remote_auth_prelinked} required{/if}{if $remote_auth_prelinked} value="{$password}"{/if}>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputNewPassword2" class="field-icon">{$LANG.clientareaconfirmpassword}</label>
                        <input type="password" name="password2" id="inputNewPassword2" class="field" placeholder="{$LANG.clientareaconfirmpassword}" autocomplete="new-password"{if !$remote_auth_prelinked} required{/if}{if $remote_auth_prelinked} value="{$password}"{/if}>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-default btn-sm generate-password" data-targetfields="inputNewPassword1,inputNewPassword2">
                        {$LANG.generatePassword.btnLabel}
                    </button>
                </div>
                <div class="col-sm-6">
                    <div class="password-strength-meter">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                            </div>
                        </div>
                        <p class="text-center small text-muted" id="passwordStrengthTextLabel">{$LANG.pwstrength}: {$LANG.pwstrengthenter}</p>
                    </div>
                </div>
            </div>
            {if $securityquestions}
            <div class="row">
                <div class="form-group col-sm-12">
                    <select name="securityqid" id="inputSecurityQId" class="field form-control">
                        <option value="">{$LANG.clientareasecurityquestion}</option>
                        {foreach $securityquestions as $question}
                            <option value="{$question.id}"{if $question.id eq $securityqid} selected{/if}>
                                {$question.question}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="form-group prepend-icon">
                        <label for="inputSecurityQAns" class="field-icon">{$LANG.clientareasecurityanswer}</label>
                        <input type="password" name="securityqans" id="inputSecurityQAns" class="field form-control" placeholder="{$LANG.clientareasecurityanswer}" autocomplete="off">
                    </div>
                </div>
            </div>
            {/if}
        </div>

        {if $showMarketingEmailOptIn}
            <div class="marketing-email-optin">
                <h4>{lang key='emailMarketing.joinOurMailingList'}</h4>
                <p>{$marketingEmailOptInMessage}</p>
                <input type="checkbox" name="marketingoptin" value="1"{if $marketingEmailOptIn} checked{/if} class="no-icheck toggle-switch-success" data-size="small" data-on-text="{lang key='yes'}" data-off-text="{lang key='no'}">
            </div>
        {/if}

        {include file="$template/includes/captcha.tpl"}

        <br/>
        {if $accepttos}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger tospanel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="fas fa-exclamation-triangle tosicon"></span> &nbsp; {$LANG.ordertos}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <label class="checkbox">
                                    <input type="checkbox" name="accepttos" class="accepttos">
                                    {$LANG.ordertosagreement} <a href="{$tosurl}" target="_blank">{$LANG.ordertos}</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
        <p align="center">
            <input class="btn btn-large btn-primary{$captcha->getButtonClass($captchaForm)}" type="submit" value="{$LANG.clientregistertitle}"/>
        </p>
    </form>
</div>
{/if}

</section>
<aside class="registration-welcome"><div class="registration-welcome-brand"><span class="ctk-logo"><img src="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="{$companyname|escape}"></span></div><h2>{$LANG.portalRegisterWelcome}</h2><p>{$LANG.portalRegisterWelcomeCopy}</p><ul><li><i class="fas fa-server" aria-hidden="true"></i>{$LANG.portalRegisterServices}</li><li><i class="far fa-credit-card" aria-hidden="true"></i>{$LANG.portalRegisterBilling}</li><li><i class="far fa-life-ring" aria-hidden="true"></i>{$LANG.portalRegisterSupport}</li></ul><a href="{$WEB_ROOT}/contact.php">{$LANG.getsupport} <i class="fas fa-arrow-right" aria-hidden="true"></i></a></aside>
</div>

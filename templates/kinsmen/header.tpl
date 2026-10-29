<!DOCTYPE html>
<html lang="{if $portalLanguage == 'vietnamese'}vi{else}en{/if}">
<head>
    <meta charset="{$charset}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{if $kbarticle.title}{$kbarticle.title} - {/if}{$pagetitle} - {$companyname}</title>

    {include file="$template/includes/head.tpl"}

    {$headoutput}

</head>
<body class="admin-layout{if $loggedin} portal-member{/if}{if !$loggedin} guest-layout{if ($templatefile == 'login' || $templatefile == 'password-reset-container')} portal-login-page{/if} portal-public-page{if $templatefile == 'clientregister'} portal-register-page{/if}{/if}{if $inShoppingCart && $templatefile != 'products'} portal-cart-page{/if}" data-phone-cc-input="{$phoneNumberInputStyle}" data-client-page="{$templatefile|escape}">

{$headeroutput}

{if $loggedin}
{include file="$template/includes/member-header.tpl"}
{else}
<div class="admin-main-wrapper">
{include file="$template/includes/portal-guest-header.tpl"}
{/if}

{if $templatefile == 'homepage'}
    <section id="home-banner">
        <div class="container-fluid text-center">
            {if $registerdomainenabled || $transferdomainenabled}
                <h2>{$LANG.homebegin}</h2>
                <form method="post" action="domainchecker.php" id="frmDomainHomepage">
                    <input type="hidden" name="transfer" />
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="domain" placeholder="{$LANG.exampledomain}" autocapitalize="none" data-toggle="tooltip" data-placement="left" data-trigger="manual" title="{lang key='orderForm.required'}" />
                                <span class="input-group-btn">
                                    {if $registerdomainenabled}
                                        <input type="submit" class="btn search{$captcha->getButtonClass($captchaForm)}" value="{$LANG.search}" />
                                    {/if}
                                    {if $transferdomainenabled}
                                        <input type="submit" id="btnTransfer" class="btn transfer{$captcha->getButtonClass($captchaForm)}" value="{$LANG.domainstransfer}" />
                                    {/if}
                                </span>
                            </div>
                        </div>
                    </div>

                    {include file="$template/includes/captcha.tpl"}
                </form>
            {else}
                <h2>{$LANG.doToday}</h2>
            {/if}
        </div>
    </section>
    <div class="home-shortcuts">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs text-center">
                    <p class="lead">
                        {$LANG.howcanwehelp}
                    </p>
                </div>
                <div class="col-sm-12 col-md-8">
                    <ul>
                        {if $registerdomainenabled || $transferdomainenabled}
                            <li>
                                <a id="btnBuyADomain" href="domainchecker.php">
                                    <i class="fas fa-globe"></i>
                                    <p>
                                        {$LANG.buyadomain} <span>&raquo;</span>
                                    </p>
                                </a>
                            </li>
                        {/if}
                        <li>
                            <a id="btnOrderHosting" href="cart.php">
                                <i class="far fa-hdd"></i>
                                <p>
                                    {$LANG.orderhosting} <span>&raquo;</span>
                                </p>
                            </a>
                        </li>
                        <li>
                            <a id="btnMakePayment" href="clientarea.php">
                                <i class="fas fa-credit-card"></i>
                                <p>
                                    {$LANG.makepayment} <span>&raquo;</span>
                                </p>
                            </a>
                        </li>
                        <li>
                            <a id="btnGetSupport" href="submitticket.php">
                                <i class="far fa-envelope"></i>
                                <p>
                                    {$LANG.getsupport} <span>&raquo;</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
{/if}

{include file="$template/includes/verifyemail.tpl"}

<section id="main-body">
    <div class="container-fluid admin-content-padding{if $skipMainBodyContainer}-fluid without-padding{/if}">
        <div class="row">

        <div class="col-xs-12 main-content">
            {include file="$template/includes/currency-note.tpl"}
            {if $loggedin && !$inShoppingCart}
                {include file="$template/includes/pageheader.tpl" title=$displayTitle desc=$tagline showbreadcrumb=false}
                {if in_array($templatefile,array('clientareadetails','clientareacontacts','clientareachangepw','clientareasecurity','clientareaemails','clientareaaddcontact'))}
                    {include file="$template/includes/member-account-tabs.tpl"}
                {/if}
                {if $primarySidebar->hasChildren() || $secondarySidebar->hasChildren()}
                    <details class="member-page-tools"><summary><i class="fas fa-sliders-h" aria-hidden="true"></i> {$LANG.portalPageTools}</summary><div class="member-page-tools-content">
                        {if $primarySidebar->hasChildren()}{include file="$template/includes/sidebar.tpl" sidebar=$primarySidebar}{/if}
                        {if $secondarySidebar->hasChildren()}{include file="$template/includes/sidebar.tpl" sidebar=$secondarySidebar}{/if}
                    </div></details>
                {/if}
            {elseif !$primarySidebar->hasChildren() && !$showingLoginPage && !$inShoppingCart && $templatefile != 'homepage' && !$skipMainBodyContainer && $templatefile != 'contact' && $templatefile != 'clientregister'}
                {include file="$template/includes/pageheader.tpl" title=$displayTitle desc=$tagline showbreadcrumb=true}
            {/if}

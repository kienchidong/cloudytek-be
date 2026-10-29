<div class="portal-utility">
    <a href="{$WEB_ROOT}/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> {$LANG.portalConsultation}</a>
    <div class="portal-utility-right"><a href="{$WEB_ROOT}/cart.php?a=view" aria-label="{$LANG.viewcart|escape}"><i class="fas fa-shopping-bag" aria-hidden="true"></i></a>{include file="$template/includes/portal-languages.tpl"}</div>
</div>
<header class="portal-login-header">
    <a class="portal-login-brand" href="{$WEB_ROOT}/clientarea.php"><span class="ctk-logo"><img src="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="{$companyname|escape}"></span></a>
    <div class="portal-header-actions"><a class="portal-order-link" href="{$WEB_ROOT}/cart.php"><i class="fas fa-plus" aria-hidden="true"></i> {$LANG.navservicesorder}</a>{if $templatefile != 'login'}<a class="portal-signin-link" href="{$WEB_ROOT}/clientarea.php"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> {$LANG.login}</a>{/if}</div>
</header>

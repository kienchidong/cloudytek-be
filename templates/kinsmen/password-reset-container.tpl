{if $loggedin}
<div class="logincontainer">
    {include file="$template/includes/pageheader.tpl" title=$LANG.pwreset}
    {include file="$template/includes/portal-reset-content.tpl"}
</div>
{else}
<div class="portal-auth-card portal-reset-card logincontainer">
    <section class="portal-signin portal-reset" aria-labelledby="portal-reset-title">
        <div class="portal-reset-icon"><i class="fas fa-key" aria-hidden="true"></i></div>
        <h1 id="portal-reset-title">{$LANG.pwreset}</h1>
        {include file="$template/includes/portal-reset-content.tpl"}
        <a class="portal-forgot portal-back-login" href="{$WEB_ROOT}/clientarea.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> {$LANG.login}</a>
    </section>
    <section class="portal-welcome" aria-labelledby="portal-reset-welcome">
        <div class="portal-welcome-copy">
            <div class="portal-welcome-brand"><span class="ctk-logo"><img src="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="{$companyname|escape}"></span></div>
            <h2 id="portal-reset-welcome">{if $language == 'vietnamese'}TRUY CẬP AN TOÀN{else}SECURE ACCOUNT ACCESS{/if}</h2>
            <p>{if $language == 'vietnamese'}Khôi phục mật khẩu để tiếp tục quản lý dịch vụ, hóa đơn và yêu cầu hỗ trợ tại {$companyname|escape}.{else}Recover access to your account and get back to managing your services, invoices and support with {$companyname|escape}.{/if}</p>
            <a class="portal-register" href="{$WEB_ROOT}/clientarea.php">{$LANG.login}</a>
        </div>
        <a class="portal-help-link" href="{$WEB_ROOT}/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> {$LANG.getsupport}</a>
    </section>
</div>
{/if}

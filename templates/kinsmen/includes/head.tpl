<!-- Styling -->
<link href="{$WEB_ROOT}/assets/css/cloudytek-wallet.css?v=1" rel="stylesheet">

<link href="{$WEB_ROOT}/templates/{$template}/css/all.min.css?v={$versionHash}" rel="stylesheet">
<link href="{$WEB_ROOT}/assets/css/fontawesome-all.min.css" rel="stylesheet">
<link href="{$WEB_ROOT}/templates/{$template}/css/custom.css?v=kinsmen1" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    var csrfToken = '{$token}',
        markdownGuide = '{lang key="markdown.title"}',
        locale = '{if !empty($mdeLocale)}{$mdeLocale}{else}en{/if}',
        saved = '{lang key="markdown.saved"}',
        saving = '{lang key="markdown.saving"}',
        whmcsBaseUrl = "{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}",
        requiredText = '{lang key="orderForm.required"}',
        recaptchaSiteKey = "{if $captcha}{$captcha->recaptcha->getSiteKey()}{/if}";
</script>
<script src="{$WEB_ROOT}/templates/{$template}/js/scripts.min.js?v={$versionHash}"></script>

{if $templatefile == "viewticket" && !$loggedin}
  <meta name="robots" content="noindex" />
{/if}

<link href="{$WEB_ROOT}/templates/{$template}/css/six-compat.css?v=20261015-2" rel="stylesheet">
<script src="{$WEB_ROOT}/templates/{$template}/js/darkmode.js?v=1" defer></script>
<script src="{$WEB_ROOT}/templates/{$template}/js/six-compat.js?v=20261015-2" defer></script>

{if ($templatefile == 'login' || $templatefile == 'password-reset-container')}
<link href="{$WEB_ROOT}/templates/{$template}/css/portal-login.css?v=20261015-3" rel="stylesheet">
<script src="{$WEB_ROOT}/templates/{$template}/js/portal-login.js?v=20261015-1" defer></script>
{/if}

<link href="{$WEB_ROOT}/templates/{$template}/css/portal-public.css?v=20261015-2" rel="stylesheet">
<link href="{$WEB_ROOT}/templates/{$template}/css/control-states.css?v=20261015-1" rel="stylesheet">
<link href="{$WEB_ROOT}/templates/{$template}/css/portal-experience.css?v=20261029-icon-loader-2" rel="stylesheet">
<script src="{$WEB_ROOT}/templates/{$template}/js/portal-experience.js?v=20261029-content-scroll-1" defer></script>
<link href="{$WEB_ROOT}/templates/{$template}/css/control-borders.css?v=20261015-1" rel="stylesheet">
{if $templatefile == 'clientregister'}<link href="{$WEB_ROOT}/templates/{$template}/css/portal-register.css?v=20261015-1" rel="stylesheet"><script src="{$WEB_ROOT}/templates/{$template}/js/portal-register.js?v=20261015-1" defer></script>{/if}
<link href="{$WEB_ROOT}/assets/css/cloudytek-controls.css?v=20261015-2" rel="stylesheet">
<script src="{$WEB_ROOT}/assets/js/cloudytek-controls.js?v=20261015-2" defer></script>
<link href="{$WEB_ROOT}/assets/css/cloudytek-validation.css?v=20261016-2" rel="stylesheet">
<script src="{$WEB_ROOT}/assets/js/cloudytek-validation.js?v=20261016-2" defer></script>
{if in_array($templatefile,array('viewticket','supportticketslist','supportticketsubmit-stepone','supportticketsubmit-steptwo','supportticketsubmit-confirm'))}<link href="{$WEB_ROOT}/assets/css/cloudytek-support.css?v=20261016-2" rel="stylesheet">{/if}

{if $loggedin}<link href="{$WEB_ROOT}/templates/{$template}/css/member-workspace.css?v=20261017-domain-actions-1" rel="stylesheet"><script defer src="{$WEB_ROOT}/templates/{$template}/js/member-workspace.js?v=20261017-domain-actions-1"></script>{/if}

<link rel="icon" type="image/png" href="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent">
<link rel="stylesheet" href="{$WEB_ROOT}/assets/css/cloudytek-brand.css?v=20261017-transparent">
<link rel="stylesheet" href="{$WEB_ROOT}/templates/{$template}/css/portal-modals.css?v=20261017-3">
<script defer src="{$WEB_ROOT}/templates/{$template}/js/portal-modals.js?v=20261017-3"></script>
{if $templatefile == 'domain-search'}<link rel="stylesheet" href="{$WEB_ROOT}/templates/{$template}/css/portal-domains.css?v=20261017-3"><script defer src="{$WEB_ROOT}/templates/{$template}/js/portal-domains.js?v=20261029-icon-loader-2"></script>{/if}

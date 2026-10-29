<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="{$charset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="assets/workspace/entry.js?v=20261017-wallet-1" data-method="{$smarty.server.REQUEST_METHOD}"></script>
    <script>try { if (window.parent !== window && window.parent.document.getElementById('cloudytek-workspace-root')) document.documentElement.classList.add('cloudytek-workspace-frame'); else document.documentElement.classList.add('cloudytek-standalone'); } catch (e) {}</script>

    <title>WHMCS - {$pagetitle}</title>

    
    <link href="templates/blend/css/all.min.css?v={$versionHash}" rel="stylesheet" />
    <link href="{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}/assets/css/fontawesome-all.min.css" rel="stylesheet" />
    <script type="text/javascript" src="templates/{$template}/js/scripts.min.js?v={$versionHash}"></script>
    <script>
        var datepickerformat = "{$datepickerformat}",
            csrfToken="{$csrfToken}",
            adminBaseRoutePath = "{\WHMCS\Admin\AdminServiceProvider::getAdminRouteBase()}",
            whmcsBaseUrl = "{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}";

        {if $jquerycode}
            $(document).ready(function(){ldelim}
                {$jquerycode}
            {rdelim});
        {/if}
        {if $jscode}
            {$jscode}
        {/if}
    </script>

    <link href="templates/{$template}/css/compat.css?v=1" rel="stylesheet" />
    <link href="templates/{$template}/css/modern.css?v=20261014-2" rel="stylesheet" />
    <script defer src="templates/{$template}/js/modern.js?v=20261014-4"></script>
    <link href="templates/{$template}/css/workspace-frame.css?v=20261014-3" rel="stylesheet" />

    <link href="templates/{$template}/css/standalone.css?v=20261014-4" rel="stylesheet" />

    <script defer src="assets/workspace/navigation.js?v=20261016-clean-urls-1"></script>
    <link href="templates/{$template}/css/plane.css?v=20261015-8" rel="stylesheet" />
    <link href="../assets/css/cloudytek-controls.css?v=20261015-2" rel="stylesheet" />
    <script defer src="../assets/js/cloudytek-controls.js?v=20261015-2"></script>

    <script defer src="assets/workspace/focus.js?v=20261015-1"></script>

    <script defer src="assets/workspace/table-footer.js?v=20261015-1"></script>

    {$headoutput}

<link rel="icon" type="image/png" href="../assets/img/cloudytek-brand.png?v=20261017-transparent">
<link rel="stylesheet" href="../assets/css/cloudytek-brand.css?v=20261017-transparent">
</head>
<body class="cloudytek-admin" data-phone-cc-input="{$phoneNumberInputStyle}">

    {$headeroutput}

    <div class="topbar">
        <div class="pull-left">
            <a href="index.php">{$_ADMINLANG.home.title}</a> |
            <a href="../">{$_ADMINLANG.global.clientarea}</a> |
            <a href="#" data-toggle="modal" data-target="#myNotes">{$_ADMINLANG.global.mynotes}</a> |
            <a href="myaccount.php">{$_ADMINLANG.global.myaccount}</a> |
            <a id="logout" href="logout.php">{$_ADMINLANG.global.logout}</a>
            {$topBarNotification}
        </div>
        <div class="pull-right date hidden-xs">
            {$carbon->translateTimestampToFormat($smarty.now, "l, j F Y, H:i")}
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="header">
        <div class="logo">
            <button class="cloudytek-sidebar-toggle" type="button" aria-label="Toggle sidebar" aria-controls="sidebar" aria-expanded="false"><i class="fas fa-bars" aria-hidden="true"></i></button>
            <a class="cloudlinkd-brand" href="index.php"><span class="ctk-logo"><img src="../assets/img/cloudytek-brand.png?v=20261017-transparent" alt="Cloudytek"></span><small>ADMIN</small></a>
        </div>
        <div class="stats">
            <a href="orders.php?status=Pending">
                <span class="stat">{$sidebarstats.orders.pending}</span>
                {$_ADMINLANG.stats.pendingorders}
            </a> |
            <a href="invoices.php?status=Overdue">
                <span class="stat">{$sidebarstats.invoices.overdue}</span>
                {$_ADMINLANG.stats.overdueinvoices}
            </a> |
            <a href="supporttickets.php">
                <span class="stat">{$sidebarstats.tickets.awaitingreply}</span>
                {$_ADMINLANG.stats.ticketsawaitingreply}
            </a>
        </div>
    </div>

    {include file="$template/menu.tpl"}

    <div class="alert alert-warning global-admin-warning{if !$globalAdminWarningMsg} hidden{/if}">
        {$globalAdminWarningMsg}
    </div>

    <div id="sidebaropen"{if !$minsidebar} style="display:none;"{/if}>
        <a href="#" onclick="sidebarOpen();return false">
            <img src="templates/{$template}/images/opensidebar.png" border="0" />
        </a>
    </div>
    <div id="sidebar"{if $minsidebar} style="display:none;"{/if}>
        {include file="$template/sidebar.tpl"}
    </div>

    <div class="contentarea" id="contentarea"{if !$minsidebar} style="margin-left:209px;"{/if}>

        <div style="float:left;width:100%;">

            {if $helplink}
                <div class="contexthelp">
                    <a href="http://docs.whmcs.com/{$helplink}" target="_blank">
                        <img src="images/icons/help.png" border="0" align="absmiddle" />
                        {$_ADMINLANG.help.contextlink}
                    </a>
                </div>
            {/if}

            <h1{if $pagetitle == $_ADMINLANG.global.hometitle} class="pull-left"{/if}>{$pagetitle}</h1>

{assign var=accountMenu value=$secondaryNavbar->getChild('Account')}
<aside id="adminSidebar" class="admin-sidebar member-sidebar" aria-label="{$LANG.portalNavigation|escape}"><div class="admin-sidebar-body">{include file="$template/includes/member-sidebar.tpl"}</div></aside>
<div id="sidebarOverlay" class="admin-sidebar-overlay"></div>
<div class="admin-main-wrapper">
<header class="admin-topbar-header member-header">
    <div class="member-utility"><a href="{$WEB_ROOT}/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> {$LANG.portalConsultation}</a><div><a href="{$WEB_ROOT}/cart.php?a=view" aria-label="{$LANG.viewcart|escape}"><i class="far fa-shopping-bag" aria-hidden="true"></i></a>{include file="$template/includes/portal-languages.tpl"}</div></div>
    <div class="member-header-main">
        <button type="button" id="sidebarToggle" class="admin-sidebar-toggle" aria-label="{$LANG.portalNavigation|escape}" aria-expanded="false"><i class="fas fa-bars"></i></button>
        <a class="member-brand" href="{$WEB_ROOT}/clientarea.php"><span class="ctk-logo"><img src="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="{$companyname|escape}"></span></a>
        <div class="member-header-actions">
            {if in_array('orders',$contactpermissions)}<a class="member-order-button" href="{$WEB_ROOT}/cart.php"><i class="fas fa-plus" aria-hidden="true"></i><span>{$LANG.navservicesorder}</span></a>{/if}
            <div class="dropdown member-notifications"><button class="member-icon-button dropdown-toggle" data-toggle="dropdown" aria-label="{$LANG.notifications|escape}" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell" aria-hidden="true"></i>{if count($clientAlerts)>0}<span class="member-notification-dot"></span>{/if}</button><ul class="dropdown-menu dropdown-menu-right client-alerts">{foreach $clientAlerts as $alert}<li><a href="{$alert->getLink()|escape}">{$alert->getMessage()}</a></li>{foreachelse}<li class="member-no-alerts">{$LANG.notificationsnone}</li>{/foreach}</ul></div>
            <div class="dropdown member-account"><button class="member-account-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="member-avatar"><i class="far fa-user" aria-hidden="true"></i></span><span class="member-account-copy"><strong>{$clientsdetails.firstname|escape} {$clientsdetails.lastname|escape}</strong><small>{$clientsdetails.email|escape}</small></span><i class="fas fa-chevron-down" aria-hidden="true"></i></button><ul class="dropdown-menu dropdown-menu-right">{if $accountMenu}{foreach $accountMenu->getChildren() as $link}{if $link->getUri() && $link->getClass() != 'nav-divider'}<li><a href="{$link->getUri()|escape}">{$link->getLabel()}</a></li>{/if}{/foreach}{/if}{if $adminMasqueradingAsClient || $adminLoggedIn}<li><a href="{$WEB_ROOT}/logout.php?returntoadmin=1">{$LANG.logoutandreturntoadminarea}</a></li>{/if}</ul></div>
        </div>
    </div>
</header>

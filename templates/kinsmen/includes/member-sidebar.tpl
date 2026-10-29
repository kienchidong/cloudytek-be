{function name=memberLink node=null icon='circle'}
{if $node && $node->getUri()}<a class="admin-sidebar-link member-nav-link" href="{$node->getUri()|escape}"{if $node->getAttribute('target')} target="{$node->getAttribute('target')|escape}"{/if}><i class="fas fa-{$icon}" aria-hidden="true"></i><span>{$node->getLabel()}</span>{if $node->hasBadge()}<span class="badge">{$node->getBadge()}</span>{/if}</a>{/if}
{/function}
{assign var=serviceMenu value=$primaryNavbar->getChild('Services')}
{assign var=domainMenu value=$primaryNavbar->getChild('Domains')}
{assign var=billingMenu value=$primaryNavbar->getChild('Billing')}
{assign var=supportMenu value=$primaryNavbar->getChild('Support')}
{assign var=accountMenu value=$secondaryNavbar->getChild('Account')}
<nav class="member-navigation" aria-label="{$LANG.portalNavigation|escape}">
    {memberLink node=$primaryNavbar->getChild('Home') icon='home'}
    <div class="member-nav-section">{$LANG.navservices}</div>
    {if $serviceMenu}{memberLink node=$serviceMenu->getChild('My Services') icon='cube'}{/if}
    {if $domainMenu}{memberLink node=$domainMenu->getChild('My Domains') icon='globe'}{elseif in_array('domains',$contactpermissions)}<a class="admin-sidebar-link member-nav-link" href="{$WEB_ROOT}/clientarea.php?action=domains"><i class="fas fa-globe" aria-hidden="true"></i><span>{$LANG.portalMyDomains}</span></a>{/if}
    <div class="member-nav-section">{$LANG.portalAccountSection}</div>
    {if $accountMenu}{memberLink node=$accountMenu->getChild('Edit Account Details') icon='user'}{/if}
    {if $billingMenu}{memberLink node=$billingMenu->getChild('My Invoices') icon='file-invoice'}{/if}
    {if $ctkWallet}<a class="admin-sidebar-link member-nav-link" href="{$WEB_ROOT}/wallet.php"><i class="fas fa-wallet" aria-hidden="true"></i><span>Số dư</span></a>{/if}
    <div class="member-nav-section">{$LANG.portalHelpSection}</div>
    {if $supportMenu}{memberLink node=$supportMenu->getChild('Tickets') icon='ticket-alt'}{/if}
</nav>

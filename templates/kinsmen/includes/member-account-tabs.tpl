{assign var=accountTabs value=$secondaryNavbar->getChild('Account')}
{if $accountTabs}<nav class="member-account-tabs" aria-label="{$LANG.accountinfo|escape}">{foreach $accountTabs->getChildren() as $link}{if $link->getName() != 'Logout' && $link->getUri() && $link->getClass() != 'nav-divider'}<a href="{$link->getUri()|escape}">{$link->getLabel()}</a>{/if}{/foreach}</nav>{/if}

<div class="portal-catalog ctk-domain-store" data-category="domains" data-mode="{$domainSearchMode|escape}" data-contact="{$WEB_ROOT}/contact.php" data-cart="{$WEB_ROOT}/cart.php">
    <section class="catalog-banner" aria-labelledby="domain-title">
        <div class="catalog-banner-copy"><span class="catalog-eyebrow">{$companyname|escape} CLOUD PLATFORM</span><h1 id="domain-title">{$LANG.ctkDomain_title}</h1><p>{$LANG.ctkDomain_intro}</p><a href="#domain-search">{$LANG.ctkDomain_explore} <i class="fas fa-arrow-down" aria-hidden="true"></i></a></div>
        <div class="ctk-domain-banner-icon" aria-hidden="true"><i class="fas fa-globe"></i><span>www.</span></div>
    </section>
    <section class="catalog-discovery" aria-labelledby="domain-services-title">
        <h2 id="domain-services-title">{$LANG.portalServices} {$companyname|escape}</h2>
        <nav class="catalog-categories" aria-label="{$LANG.portalCategories|escape}">{foreach $domainCategories as $category}<a href="{$WEB_ROOT}/cart.php?gid={$category.gid}"><i class="fas fa-{$category.icon|escape}" aria-hidden="true"></i>{$category.label|escape}</a>{/foreach}<a href="{$WEB_ROOT}/domains.php" aria-current="page"><i class="fas fa-globe" aria-hidden="true"></i>{$LANG.ctkDomain_name}</a></nav>
    </section>
    <section id="domain-search" aria-label="{$LANG.ctkDomain_title|escape}">
        <nav class="ctk-domain-tabs" aria-label="{$LANG.ctkDomain_mode|escape}"><a href="{$WEB_ROOT}/domains.php" {if $domainSearchMode == 'register'}aria-current="page"{/if}>{$LANG.ctkDomain_new}</a><a href="{$WEB_ROOT}/domains.php?mode=transfer" {if $domainSearchMode == 'transfer'}aria-current="page"{/if}>{$LANG.ctkDomain_transfer} {$companyname|escape}</a></nav>
        <form id="ctkDomainSearch" method="post" action="{$WEB_ROOT}/domains.php" novalidate>
            <input type="hidden" name="token" value="{$domainSearchToken|escape}">
            <label for="ctkDomainInput" class="sr-only">{$LANG.ctkDomain_inputLabel}</label>
            <div class="ctk-domain-search-row"><div class="ctk-domain-input-wrap"><i class="fas fa-search" aria-hidden="true"></i><input type="text" id="ctkDomainInput" name="domain" placeholder="{$LANG.ctkDomain_placeholder|escape}" autocomplete="off" autocapitalize="none" spellcheck="false" maxlength="253" aria-describedby="ctkDomainError"></div><button type="submit"><i class="fas fa-search" aria-hidden="true"></i><span>{$LANG.ctkDomain_check}</span></button></div>
            <p id="ctkDomainError" class="ctk-domain-error" role="alert" hidden></p>
        </form>
        <div id="ctkDomainProgress" class="ctk-domain-progress" role="status" aria-label="{$LANG.ctkDomain_checking|escape}" hidden><i class="fas fa-circle-notch fa-spin" aria-hidden="true"></i></div>
        <div id="ctkDomainResults" aria-live="polite" aria-atomic="false" hidden>
            <div id="ctkDomainPrimary" class="ctk-domain-primary"></div>
            <section aria-labelledby="ctkDomainSuggestionsTitle"><h2 id="ctkDomainSuggestionsTitle">{$LANG.ctkDomain_suggestions}</h2><div id="ctkDomainSuggestions" class="ctk-domain-grid"></div><div class="ctk-domain-more"><button type="button" id="ctkDomainMore" aria-controls="ctkDomainSuggestions" hidden><span>{$LANG.ctkDomain_more}</span><i class="fas fa-chevron-down" aria-hidden="true"></i></button></div></section>
            <p class="ctk-domain-note">{$LANG.ctkDomain_note}</p>
        </div>
    </section>
    <section class="ctk-domain-related" aria-labelledby="domain-related-title"><h2 id="domain-related-title">{$LANG.ctkDomain_related}</h2><div>{foreach $domainCategories as $category}{if in_array($category.key,array('hosting','vps','ssl','cloud'))}<a href="{$WEB_ROOT}/cart.php?gid={$category.gid}"><i class="fas fa-{$category.icon|escape}" aria-hidden="true"></i><strong>{$category.label|escape}</strong><span>{$LANG.ctkDomain_details} <i class="fas fa-arrow-right" aria-hidden="true"></i></span></a>{/if}{/foreach}</div></section>
    <script type="application/json" id="ctkDomainCopy">{$domainSearchCopy}</script>
</div>

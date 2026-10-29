<div class="portal-catalog" data-category="{$portalCategory|escape}">
    <section class="catalog-banner" aria-labelledby="catalog-title">
        <div class="catalog-banner-copy"><span class="catalog-eyebrow">{$companyname|escape} CLOUD PLATFORM</span><h1 id="catalog-title">{$LANG.portalCatalogTitle}</h1><p>{$LANG.portalCatalogIntro}</p><a href="#catalog-plans">{$LANG.portalExplore}<i class="fas fa-arrow-down" aria-hidden="true"></i></a></div>
        <div class="catalog-banner-art" aria-hidden="true"><div><i class="fas fa-cloud"></i><span>CLOUD</span></div><div><i class="fas fa-server"></i><span>VPS</span></div><div><i class="fas fa-database"></i><span>STORAGE</span></div></div>
    </section>
    <section class="catalog-discovery" aria-labelledby="catalog-services-title">
        <h2 id="catalog-services-title">{$LANG.portalServices} {$companyname|escape}</h2>
        <nav class="catalog-categories" aria-label="{$LANG.portalCategories|escape}">{foreach $portalCategories as $category}<a href="{$WEB_ROOT}/cart.php?gid={$category.gid}" data-catalog-category="{$category.key|escape}" {if $portalCategory == $category.key}aria-current="page"{/if}><i class="fas fa-{$category.icon|escape}" aria-hidden="true"></i>{$category.label|escape}</a>{/foreach}<a href="{$WEB_ROOT}/domains.php" data-catalog-category="domains"><i class="fas fa-globe" aria-hidden="true"></i>{$LANG.ctkDomain_name}</a></nav>
        <div class="catalog-groups">{foreach $portalGroups as $group}<a class="catalog-group{if $group.selected} selected{/if}" href="{$WEB_ROOT}/cart.php?gid={$group.gid}" data-service-category="{$group.category|escape}" {if $group.category != $portalCategory}hidden{/if}{if $group.selected} aria-current="page"{/if}><span class="catalog-group-icon"><i class="fas fa-{$group.icon|escape}" aria-hidden="true"></i></span><strong>{$group.name|escape}</strong>{if $group.selected}<span class="catalog-group-check"><i class="fas fa-check" aria-hidden="true"></i></span>{/if}</a>{/foreach}</div>
    </section>
    <section id="catalog-plans" class="catalog-plans-section" aria-labelledby="catalog-plans-title"><div class="catalog-plans-heading"><div><span>{$groupname|escape}</span><h2 id="catalog-plans-title">{$LANG.portalPlans}</h2></div><span>{$currency.code|escape}</span></div>
        {if $errormessage}<div class="alert alert-danger" role="alert">{$errormessage}</div>{/if}
        {foreach $hookAboveProductsOutput as $output}{$output}{/foreach}
        <div class="catalog-plans">{foreach $portalProducts as $product}<article class="catalog-plan{if $product.isFeatured} featured{/if}" data-product-id="{$product.pid}">
            <header><h3>{$product.name|escape}</h3>{if $product.isFeatured}<span class="plan-recommended">{$LANG.portalRecommended}</span>{/if}</header>
            <div class="catalog-plan-body">
                <div class="catalog-plan-description">{if $product.features}{if $product.featuresdesc}<p>{$product.featuresdesc}</p>{/if}<ul>{foreach $product.features as $feature => $value}<li><strong>{$feature|escape}:</strong> {$value}</li>{/foreach}</ul>{else}<ul>{foreach $product.portalSpecs as $line}<li>{if $line.label}<strong>{$line.label|escape}:</strong> {/if}{$line.value|escape}</li>{/foreach}</ul>{/if}</div>
                {if $product.pricing.hasconfigoptions}<small class="catalog-price-note">{$LANG.startingfrom}</small>{/if}
                <form method="get" action="{$WEB_ROOT}/cart.php" class="catalog-plan-order"><input type="hidden" name="a" value="add">
                    {if $product.bid}<input type="hidden" name="bid" value="{$product.bid}"><div class="catalog-fixed-price">{$product.displayprice}</div>{else}<input type="hidden" name="pid" value="{$product.pid}">
                    {if $product.portalCycles}<label class="sr-only" for="catalog-cycle-{$product.pid}">{$LANG.orderbillingcycle} — {$product.name|escape}</label><select id="catalog-cycle-{$product.pid}" name="billingcycle" {if $product.portalSoldOut}disabled{/if}>{foreach $product.portalCycles as $cycle}<option value="{$cycle.key|escape}">{$cycle.label|escape}</option>{/foreach}</select>{elseif $product.paytype == 'free'}<div class="catalog-fixed-price">{$LANG.orderfree}</div><input type="hidden" name="billingcycle" value="free">{/if}{/if}
                    <button type="submit" {if $product.portalSoldOut}disabled{/if}>{if $product.portalSoldOut}{$LANG.outofstock}{else}{$LANG.portalOrder}{/if}</button>
                </form>
            </div>
        </article>{foreachelse}<div class="catalog-empty">{$LANG.portalNoPlans}</div>{/foreach}</div>
        {foreach $hookBelowProductsOutput as $output}{$output}{/foreach}
    </section>
    <div class="catalog-help"><i class="far fa-life-ring" aria-hidden="true"></i><div><strong>{$LANG.portalNeedHelp}</strong><span>{$LANG.portalChooseHelp}</span></div><a href="{$WEB_ROOT}/contact.php">{$LANG.getsupport}<i class="fas fa-arrow-right" aria-hidden="true"></i></a></div>
</div>

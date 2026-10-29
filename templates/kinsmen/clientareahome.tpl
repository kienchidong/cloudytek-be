{include file="$template/includes/member-dashboard.tpl"}

<div class="tiles clearfix">
    <div class="row">
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=services'">
            <a href="clientarea.php?action=services">
                <div class="icon"><i class="fas fa-cube"></i></div>
                <div class="stat">{$clientsstats.productsnumactive}</div>
                <div class="title">{$LANG.navservices}</div>
                <div class="highlight bg-color-blue"></div>
            </a>
        </div>
        {if in_array('domains',$contactpermissions)}
            <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=domains'">
                <a href="clientarea.php?action=domains"><div class="icon"><i class="fas fa-globe"></i></div><div class="stat">{$clientsstats.numactivedomains}</div><div class="title">{$LANG.navdomains}</div><div class="highlight bg-color-green"></div></a>
            </div>
        {else}
            <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=quotes'"><a href="clientarea.php?action=quotes"><div class="icon"><i class="far fa-file-alt"></i></div><div class="stat">{$clientsstats.numquotes}</div><div class="title">{$LANG.quotes}</div></a></div>
        {/if}
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='supporttickets.php'">
            <a href="supporttickets.php">
                <div class="icon"><i class="fas fa-comments"></i></div>
                <div class="stat">{$clientsstats.numactivetickets}</div>
                <div class="title">{$LANG.navtickets}</div>
                <div class="highlight bg-color-red"></div>
            </a>
        </div>
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=invoices'">
            <a href="clientarea.php?action=invoices">
                <div class="icon"><i class="fas fa-credit-card"></i></div>
                <div class="stat">{$clientsstats.numunpaidinvoices}</div>
                <div class="title">{$LANG.navinvoices}</div>
                <div class="highlight bg-color-gold"></div>
            </a>
        </div>
    </div>
</div>

<form class="member-help-search" role="search" method="post" action="clientarea.php?action=kbsearch">
    <input type="hidden" name="token" value="{$token}">
    <div class="member-help-search-copy">
        <span class="member-help-search-icon"><i class="fas fa-book-open" aria-hidden="true"></i></span>
        <div><h2>{if $portalLanguage=='vietnamese'}Bạn cần tìm hướng dẫn?{else}Looking for a guide?{/if}</h2><p>{if $portalLanguage=='vietnamese'}Tìm nhanh câu trả lời cho dịch vụ của bạn.{else}Find answers for your services.{/if}</p></div>
    </div>
    <div class="home-kb-search">
        <label class="sr-only" for="member-kb-query">{$LANG.clientHomeSearchKb}</label>
        <i class="fas fa-search" aria-hidden="true"></i>
        <input id="member-kb-query" type="search" name="search" class="form-control" placeholder="{$LANG.clientHomeSearchKb}" />
        <button type="submit" class="btn btn-primary">{if $portalLanguage=='vietnamese'}Tìm kiếm{else}Search{/if}</button>
    </div>
</form>

{foreach from=$addons_html item=addon_html}
    <div>
        {$addon_html}
    </div>
{/foreach}

<div class="client-home-panels">
            {function name=outputHomePanels}
                <div menuItemName="{$item->getName()}" class="panel panel-default member-home-panel panel-accent-{$item->getExtra('color')}{if !$item->hasChildren()} member-home-panel-empty{/if}{if $item->getClass()} {$item->getClass()}{/if}"{if $item->getAttribute('id')} id="{$item->getAttribute('id')}"{/if}>
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {if $item->getExtra('btn-link') && $item->getExtra('btn-text')}
                                <div class="pull-right">
                                    <a href="{$item->getExtra('btn-link')}" class="btn btn-default bg-color-{$item->getExtra('color')} btn-xs">
                                        {if $item->getName()=='Active Products/Services' || $item->getName()=='Recent News'}
                                            {$item->getExtra('btn-text')}<i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        {else}
                                            {if $item->getExtra('btn-icon')}<i class="{$item->getExtra('btn-icon')}" aria-hidden="true"></i>{/if}
                                            {if $item->getName()=='Recent Support Tickets'}{if $portalLanguage=='vietnamese'}Gửi yêu cầu{else}New ticket{/if}{else}{$item->getExtra('btn-text')}{/if}
                                        {/if}
                                    </a>
                                </div>
                            {/if}
                            <span class="member-panel-heading-copy">
                                {if $item->hasIcon()}<span class="member-panel-icon"><i class="{$item->getIcon()}" aria-hidden="true"></i></span>{/if}
                                <span class="member-panel-label">{$item->getLabel()}</span>
                                {if $item->hasBadge()}<span class="badge">{$item->getBadge()}</span>{/if}
                            </span>
                        </h3>
                    </div>
                    {if !$item->hasChildren() && $item->getName()=='Active Products/Services'}
                        <div class="panel-body member-dashboard-empty">
                            <span class="member-dashboard-empty-icon"><i class="fas fa-cube" aria-hidden="true"></i></span>
                            <h4>{if $portalLanguage=='vietnamese'}Chưa có dịch vụ đang hoạt động{else}No active services yet{/if}</h4>
                            <p>{if $portalLanguage=='vietnamese'}Chọn dịch vụ phù hợp để bắt đầu sử dụng.{else}Choose a service to get started.{/if}</p>
                            <a class="member-empty-action" href="{$WEB_ROOT}/cart.php">{if $portalLanguage=='vietnamese'}Đăng ký dịch vụ{else}Explore services{/if}<i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    {elseif !$item->hasChildren() && $item->getName()=='Recent Support Tickets'}
                        <div class="panel-body member-dashboard-empty">
                            <span class="member-dashboard-empty-icon"><i class="far fa-comments" aria-hidden="true"></i></span>
                            <h4>{if $portalLanguage=='vietnamese'}Chưa có yêu cầu hỗ trợ{else}No recent support tickets{/if}</h4>
                            <p>{if $portalLanguage=='vietnamese'}Khi cần trợ giúp, hãy gửi yêu cầu cho chúng tôi.{else}Send us a ticket whenever you need a hand.{/if}</p>
                        </div>
                    {elseif $item->hasBodyHtml()}
                        <div class="panel-body">
                            {$item->getBodyHtml()}
                        </div>
                    {/if}
                    {if $item->hasChildren()}
                        <div class="list-group{if $item->getChildrenAttribute('class')} {$item->getChildrenAttribute('class')}{/if}">
                            {foreach $item->getChildren() as $childItem}
                                {if $childItem->getUri()}
                                    <a menuItemName="{$childItem->getName()}" href="{$childItem->getUri()}" class="list-group-item{if $childItem->getClass()} {$childItem->getClass()}{/if}{if $childItem->isCurrent()} active{/if}"{if $childItem->getAttribute('dataToggleTab')} data-toggle="tab"{/if}{if $childItem->getAttribute('target')} target="{$childItem->getAttribute('target')}"{/if} id="{$childItem->getId()}">
                                        {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                                        {$childItem->getLabel()}
                                        {if $childItem->hasBadge()}&nbsp;<span class="badge">{$childItem->getBadge()}</span>{/if}
                                    </a>
                                {else}
                                    <div menuItemName="{$childItem->getName()}" class="list-group-item{if $childItem->getClass()} {$childItem->getClass()}{/if}" id="{$childItem->getId()}">
                                        {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                                        {$childItem->getLabel()}
                                        {if $childItem->hasBadge()}&nbsp;<span class="badge">{$childItem->getBadge()}</span>{/if}
                                    </div>
                                {/if}
                            {/foreach}
                        </div>
                    {/if}
                    {if $item->hasFooterHtml()}
                        <div class="panel-footer">
                            {$item->getFooterHtml()}
                        </div>
                    {/if}
                </div>
            {/function}

            {foreach $panels as $item}
                {outputHomePanels}
            {/foreach}
</div>

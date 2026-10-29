{foreach $navbar as $item}
    <li class="admin-sidebar-item{if $item->hasChildren()} has-submenu{/if} {$item->getClass()}" id="{$item->getId()}">
        <a href="{if $item->hasChildren()}#{else}{$item->getUri()}{/if}" class="admin-sidebar-link{if $item->hasChildren()} submenu-toggle{/if}"{if $item->getAttribute('target')} target="{$item->getAttribute('target')}"{/if}{if $item->hasChildren()} aria-expanded="false"{/if}>
            <i class="{if $item->hasIcon()}{$item->getIcon()}{else}fas {if $item->getName() == 'Home'}fa-home{elseif $item->getName() == 'Store'}fa-shopping-bag{elseif $item->getName() == 'Announcements'}fa-bullhorn{elseif $item->getName() == 'Knowledgebase'}fa-book-open{elseif $item->getName() == 'Network Status'}fa-signal{elseif $item->getName() == 'Contact Us'}fa-envelope{elseif $item->getName() == 'Services'}fa-server{elseif $item->getName() == 'Billing'}fa-file-invoice-dollar{elseif $item->getName() == 'Domains'}fa-globe{elseif $item->getName() == 'Support' || $item->getName() == 'Open Ticket'}fa-life-ring{else}fa-user-circle{/if}{/if} admin-sidebar-icon"></i>
            <span class="admin-sidebar-label">{$item->getLabel()}</span>
            {if $item->hasBadge()}<span class="badge admin-sidebar-badge">{$item->getBadge()}</span>{/if}
            {if $item->hasChildren()}<i class="fas fa-chevron-right admin-sidebar-arrow"></i>{/if}
        </a>
        {if $item->hasChildren()}
            <ul class="admin-sidebar-submenu">
                {foreach $item->getChildren() as $childItem}
                    {if $childItem->getClass() != 'nav-divider' && $childItem->getClass() != 'dropdown-divider'}
                        <li id="{$childItem->getId()}" class="admin-sidebar-subitem"><a class="admin-sidebar-sublink" href="{$childItem->getUri()}"{if $childItem->getAttribute('target')} target="{$childItem->getAttribute('target')}"{/if}>{$childItem->getLabel()}{if $childItem->hasBadge()}<span class="badge">{$childItem->getBadge()}</span>{/if}</a></li>
                    {/if}
                {/foreach}
            </ul>
        {/if}
    </li>
{/foreach}

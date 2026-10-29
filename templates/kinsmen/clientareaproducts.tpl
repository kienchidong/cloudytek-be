{include file="$template/includes/tablelist.tpl" tableName="ServicesList" filterColumn="5" noSortColumns="0,7"}
<script type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableServicesList').removeClass('hidden').DataTable();
        {if $orderby == 'product'}
            table.order([1, '{$sort}'], [5, 'asc']);
        {elseif $orderby == 'amount'}
            table.order(3, '{$sort}');
        {elseif $orderby == 'billingcycle'}
            table.order(4, '{$sort}');
        {elseif $orderby == 'nextduedate'}
            table.order(6, '{$sort}');
        {elseif $orderby == 'domainstatus'}
            table.order(5, '{$sort}');
        {/if}
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
</script>
<div class="table-container clearfix">
    <table id="tableServicesList" class="table table-list hidden">
        <thead>
            <tr>
                <th></th>
                <th>{$LANG.orderproduct}</th>
                <th>IP</th>
                <th>{$LANG.clientareaaddonpricing}</th>
                <th>{$LANG.portalBillingCycle}</th>
                <th>{$LANG.clientareastatus}</th>
                <th>{$LANG.clientareahostingnextduedate}</th>
                <th class="responsive-edit-button" style="display: none;"></th>
            </tr>
        </thead>
        <tbody>
            {foreach key=num item=service from=$services}
                <tr onclick="clickableSafeRedirect(event, 'clientarea.php?action=productdetails&amp;id={$service.id}', false)">
                    <td class="text-center{if $service.sslStatus} ssl-info{/if}" data-element-id="{$service.id}" data-type="service"{if $service.domain} data-domain="{$service.domain}"{/if}>
                        {if $service.sslStatus}
                            <img src="{$service.sslStatus->getImagePath()}" data-toggle="tooltip" title="{$service.sslStatus->getTooltipContent()}" class="{$service.sslStatus->getClass()}"/>
                        {elseif !$service.isActive}
                            <img src="{$BASE_PATH_IMG}/ssl/ssl-inactive-domain.png" data-toggle="tooltip" title="{lang key='sslState.sslInactiveService'}">
                        {/if}
                    </td>
                    <td><strong>{$service.product|escape}</strong>{if $service.domain}<br /><a href="http://{$service.domain|escape}" target="_blank" rel="noopener">{$service.domain|escape}</a>{/if}</td>
                    <td>{if isset($portalServiceIps[$service.id]) && $portalServiceIps[$service.id]}{$portalServiceIps[$service.id]|escape}{else}—{/if}</td>
                    <td class="text-center" data-order="{$service.amountnum}">{$service.amount}</td>
                    <td class="text-center">{$service.billingcycle}</td>
                    <td class="text-center"><span class="label status status-{$service.status|strtolower}">{$service.statustext}</span></td>
                    <td class="text-center"><span class="hidden">{$service.normalisedNextDueDate}</span>{if $service.normalisedNextDueDate && $service.normalisedNextDueDate != '0000-00-00'}{$service.normalisedNextDueDate|date_format:'%d/%m/%Y'}{else}{$service.nextduedate}{/if}</td>
                    <td class="responsive-edit-button" style="display: none;">
                        <a href="clientarea.php?action=productdetails&amp;id={$service.id}" class="btn btn-block btn-info">
                            {$LANG.manageproduct}
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <div class="text-center" id="tableLoading">
        <p><i class="fas fa-spinner fa-spin"></i> {$LANG.loading}</p>
    </div>
</div>

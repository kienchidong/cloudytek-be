{if $warnings}
    {include file="$template/includes/alert.tpl" type="warning" msg=$warnings textcenter=true}
{/if}
<div class="tab-content">
    <div class="tab-pane fade in active" id="tabOverview">
        {include file="$template/includes/tablelist.tpl" tableName="DomainsList" noSortColumns="5" startOrderCol="0" filterColumn="4" disableResponsive=true}
        <script type="text/javascript">
            jQuery(document).ready( function ()
            {
                var table = jQuery('#tableDomainsList').removeClass('hidden').DataTable();
                {if $orderby == 'domain'}
                    table.order(0, '{$sort}');
                {elseif $orderby == 'regdate' || $orderby == 'registrationdate'}
                    table.order(1, '{$sort}');
                {elseif $orderby == 'nextduedate'}
                    table.order(2, '{$sort}');
                {elseif $orderby == 'autorenew'}
                    table.order(3, '{$sort}');
                {elseif $orderby == 'status'}
                    table.order(4, '{$sort}');
                {/if}
                table.draw();
                jQuery('#tableLoading').addClass('hidden');
            });
        </script>

            <div class="table-container clearfix">
                <table id="tableDomainsList" class="table table-list member-domains-table hidden">
                    <thead>
                        <tr>
                            <th>{$LANG.orderdomain}</th>
                            <th>{$LANG.regdate}</th>
                            <th>{$LANG.nextdue}</th>
                            <th>{$LANG.domainsautorenew}</th>
                            <th>{$LANG.domainstatus}</th>
                            <th class="member-domain-actions all"><span class="sr-only">{$LANG.manage}</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    {foreach key=num item=domain from=$domains}
                        <tr onclick="clickableSafeRedirect(event, 'clientarea.php?action=domaindetails&amp;id={$domain.id}', false)">
                            <td><div class="member-domain-name"><span class="ssl-info" data-element-id="{$domain.id}" data-type="domain" data-domain="{$domain.domain}">
                                {if $domain.sslStatus}
                                    <img src="{$domain.sslStatus->getImagePath()}" data-toggle="tooltip" title="{$domain.sslStatus->getTooltipContent()}" class="{$domain.sslStatus->getClass()}"/>
                                {elseif !$domain.isActive}
                                    <img src="{$BASE_PATH_IMG}/ssl/ssl-inactive-domain.png" data-toggle="tooltip" title="{lang key='sslState.sslInactiveDomain'}">
                                {/if}
                            </span><a href="clientarea.php?action=domaindetails&amp;id={$domain.id}">{$domain.domain}</a></div></td>
                            <td><span class="hidden">{$domain.normalisedRegistrationDate}</span>{if $domain.normalisedRegistrationDate && $domain.normalisedRegistrationDate != '0000-00-00'}{$domain.normalisedRegistrationDate|date_format:'%d/%m/%Y'}{else}{$domain.registrationdate}{/if}</td>
                            <td><span class="hidden">{$domain.normalisedNextDueDate}</span>{if $domain.normalisedNextDueDate && $domain.normalisedNextDueDate != '0000-00-00'}{$domain.normalisedNextDueDate|date_format:'%d/%m/%Y'}{else}{$domain.nextduedate}{/if}</td>
                            <td>
                                {if $domain.autorenew}
                                    <i class="fas fa-fw fa-check text-success"></i> {$LANG.domainsautorenewenabled}
                                {else}
                                    <i class="fas fa-fw fa-times text-danger"></i> {$LANG.domainsautorenewdisabled}
                                {/if}
                            </td>
                            <td>
                                <span class="label status status-{$domain.statusClass}">{$domain.statustext}</span>
                                <span class="hidden">
                                    {if $domain.expiringSoon}<span>{lang key="domainsExpiringSoon"}</span>{/if}
                                </span>
                            </td>
                            <td class="member-domain-actions all">
                                <button type="button" class="member-row-menu-trigger stopEventBubble" aria-haspopup="true" aria-expanded="false" aria-controls="domain-menu-{$domain.id}" aria-label="{$LANG.manage|escape}: {$domain.domain|escape}">
                                    <i class="fas fa-ellipsis-h" aria-hidden="true"></i>
                                </button>
                                <div class="member-row-menu" id="domain-menu-{$domain.id}" hidden>
                                    <div class="member-row-menu-title">{$domain.domain|escape}</div>
                                    <a href="clientarea.php?action=domaindetails&amp;id={$domain.id}"><i class="fas fa-cog" aria-hidden="true"></i> {$LANG.managedomain}</a>
                                    {if $domain.status eq 'Active'}
                                        <a href="clientarea.php?action=domaindetails&amp;id={$domain.id}#tabNameservers"><i class="fas fa-globe" aria-hidden="true"></i> {$LANG.domainmanagens}</a>
                                        <a href="clientarea.php?action=domaincontacts&amp;domainid={$domain.id}"><i class="fas fa-user" aria-hidden="true"></i> {$LANG.domaincontactinfoedit}</a>
                                        <a href="clientarea.php?action=domaindetails&amp;id={$domain.id}#tabAutorenew"><i class="fas fa-sync-alt" aria-hidden="true"></i> {$LANG.domainautorenewstatus}</a>
                                        <a href="clientarea.php?action=domaindetails&amp;id={$domain.id}#tabReglock"><i class="fas fa-lock" aria-hidden="true"></i> {$LANG.domainreglockstatus}</a>
                                    {/if}
                                    {if $allowrenew}
                                        {if $domain.canDomainBeManaged}
                                            <a href="{routePath('domain-renewal', $domain.domain)}"><i class="fas fa-redo" aria-hidden="true"></i> {lang key='domainsrenew'}</a>
                                        {else}
                                            <span class="member-row-menu-disabled" aria-disabled="true"><i class="fas fa-redo" aria-hidden="true"></i> {lang key='domainsrenew'}</span>
                                        {/if}
                                    {/if}
                                </div>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
                <div class="text-center" id="tableLoading">
                    <p><i class="fas fa-spinner fa-spin"></i> {$LANG.loading}</p>
                </div>
            </div>
    </div>
</div>

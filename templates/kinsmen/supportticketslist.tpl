{assign var=openTicketNode value=$primaryNavbar->getChild('Open Ticket')}
{if $openTicketNode && $openTicketNode->getUri()}
<div class="member-ticket-actions">
    <a class="btn btn-primary member-new-ticket" href="{$openTicketNode->getUri()|escape}"><i class="fas fa-plus" aria-hidden="true"></i> {$openTicketNode->getLabel()}</a>
</div>
{/if}
{include file="$template/includes/tablelist.tpl" tableName="TicketsList" filterColumn="5" startOrderCol="6"}
<script type="text/javascript">
    jQuery(document).ready( function ()
    {
        var table = jQuery('#tableTicketsList').removeClass('hidden').DataTable();
        {if $orderby == 'did' || $orderby == 'dept'}
            table.order(4, '{$sort}');
        {elseif $orderby == 'subject' || $orderby == 'title'}
            table.order(1, '{$sort}');
        {elseif $orderby == 'status'}
            table.order(5, '{$sort}');
        {elseif $orderby == 'lastreply'}
            table.order(6, '{$sort}');
        {/if}
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
</script>
<div class="table-container clearfix">
    <table id="tableTicketsList" class="table table-list hidden">
        <thead>
            <tr>
                <th>{$LANG.supportticketsticketid}</th>
                <th>{$LANG.supportticketssubject}</th>
                <th>{$LANG.portalTicketSender}</th>
                <th>{$LANG.relatedservice}</th>
                <th>{$LANG.supportticketsdepartment}</th>
                <th>{$LANG.supportticketsstatus}</th>
                <th>{$LANG.supportticketsticketlastupdated}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$tickets item=ticket}
                <tr onclick="window.location='viewticket.php?tid={$ticket.tid}&amp;c={$ticket.c}'">
                    <td>
                        <a href="viewticket.php?tid={$ticket.tid|escape}&amp;c={$ticket.c|escape}">#{$ticket.tid|escape}</a>
                    </td>
                    <td>
                        <a href="viewticket.php?tid={$ticket.tid}&amp;c={$ticket.c}" class="border-left">
                            <span class="ticket-subject{if $ticket.unread} unread{/if}">{$ticket.subject|escape}</span>
                        </a>
                    </td>
                    <td>{if $portalTicketMeta[$ticket.id].sender}{$portalTicketMeta[$ticket.id].sender|escape}{else}{$clientsdetails.firstname|escape} {$clientsdetails.lastname|escape}{/if}</td>
                    <td>{if $portalTicketMeta[$ticket.id].service}{$portalTicketMeta[$ticket.id].service|escape}{else}—{/if}</td>
                    <td>{$ticket.department|escape}</td>
                    <td>
                        <span class="label status {if is_null($ticket.statusColor)}status-{$ticket.statusClass}"{else}status-custom" style="border-color: {$ticket.statusColor}; color: {$ticket.statusColor}"{/if}>
                            {$ticket.status|strip_tags}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="hidden">{$ticket.normalisedLastReply}</span>
                        {if $ticket.normalisedLastReply}{$ticket.normalisedLastReply|date_format:'%d/%m/%Y %H:%M'}{else}{$ticket.lastreply}{/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <div class="text-center" id="tableLoading">
        <p><i class="fas fa-spinner fa-spin"></i> {$LANG.loading}</p>
    </div>
</div>

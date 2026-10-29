<section class="ctk-ticket-departments">
    <a class="ctk-ticket-back" href="supporttickets.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> {$LANG.clientareanavsupporttickets}</a>
    <h2>{$LANG.supportticketsdepartment}</h2>
    <p>{$LANG.supportticketsheader}</p>
    <div class="ctk-department-grid">
        {foreach from=$departments item=department}
            <a class="ctk-department-card" href="{$smarty.server.PHP_SELF}?step=2&amp;deptid={$department.id}">
                <i class="fas fa-headset" aria-hidden="true"></i><div><strong>{$department.name|escape}</strong>{if $department.description}<p>{$department.description}</p>{/if}</div><i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        {foreachelse}
            {include file="$template/includes/alert.tpl" type="info" msg=$LANG.nosupportdepartments textcenter=true}
        {/foreach}
    </div>
</section>

<link rel="stylesheet" href="assets/css/cloudytek-linode.css?v=20261015-2">
<div class="ctk-linode">
    <div class="ctk-hero"><div><span class="ctk-eyebrow">YOUR CLOUD WORKSPACE</span><h2>Cloud service #{$ctkServiceId|escape}</h2><p>Resource details and permitted management actions.</p></div><span class="ctk-pill">{$ctkResource.state|default:'Unavailable'|escape}</span></div>
    {if $ctkError}<div class="alert alert-danger">{$ctkError|escape}</div>{/if}
    {if $ctkResult}<section class="ctk-card"><h3>Resource details / latest response</h3><pre>{$ctkResult|escape}</pre></section>{/if}
    {if $ctkResource.family|default:'' == 'linode'}
    <section class="ctk-card"><h3>Server access</h3><p>Request the saved initial root password for this service. Access credentials are shown only on request.</p><form method="post" action="linode.php?serviceid={$ctkServiceId|escape}"><input type="hidden" name="token" value="{$ctkToken|escape}"><input type="hidden" name="action" value="access_password"><label>Type REVEAL PASSWORD to confirm<input class="form-control" name="confirm" autocomplete="off"></label><button class="btn btn-default">Show access password</button></form></section>
    {/if}
    {if $ctkOperations}
    <section class="ctk-card"><h3>Manage this service</h3><form method="post" action="linode.php?serviceid={$ctkServiceId|escape}">
        <input type="hidden" name="token" value="{$ctkToken|escape}">
        <label>Action<select class="form-control" name="operation">{foreach $ctkOperations as $op}<option value="{$op.id|escape}">{$op.method|escape} · {$op.title|escape}</option>{/foreach}</select></label>
        <p>Your primary resource ID is fixed automatically. Enter only additional identifiers needed for the selected action.</p>
        <div class="ctk-grid"><label>Additional path parameters<textarea class="form-control ctk-json" name="path" rows="3">{ldelim}{rdelim}</textarea></label><label>Query parameters<textarea class="form-control ctk-json" name="query" rows="3">{ldelim}{rdelim}</textarea></label></div>
        <label>Request body<textarea class="form-control ctk-json" name="body" rows="4"></textarea></label>
        <label>For a write action, type its operation ID to confirm<input class="form-control" name="confirm" autocomplete="off"></label>
        <label class="ctk-check"><input type="checkbox" name="reveal"> Show sensitive credentials for this service (confirmation required)</label>
        <button class="btn btn-primary">Run action</button>
    </form></section>
    {/if}
</div>

<nav class="portal-cart-breadcrumb" aria-label="{$LANG.breadcrumbnav}">
    <a href="{$WEB_ROOT}/cart.php">{$LANG.portalCartHome}</a><span aria-hidden="true">›</span><span>{$LANG.portalCartTitle}</span>
</nav>
<nav class="portal-cart-steps" aria-label="{$LANG.portalCartSteps}">
    <ol>
        <li class="{if $step > 1}is-complete{else}is-current{/if}" {if $step == 1}aria-current="step"{/if}><span class="step-number">{if $step > 1}<i class="fas fa-check" aria-hidden="true"></i>{else}1{/if}</span><span>{$LANG.portalCartConfigure}</span></li>
        <li class="{if $step > 2}is-complete{elseif $step == 2}is-current{/if}" {if $step == 2}aria-current="step"{/if}><span class="step-number">{if $step > 2}<i class="fas fa-check" aria-hidden="true"></i>{else}2{/if}</span><span>{$LANG.portalCartTitle}</span></li>
        <li class="{if $step == 3}is-current{/if}" {if $step == 3}aria-current="step"{/if}><span class="step-number">3</span><span>{$LANG.orderForm.checkout}</span></li>
    </ol>
</nav>

<section class="member-welcome-row">
    <div class="member-welcome"><div class="member-welcome-copy"><span>{$LANG.portalWorkspace}</span><h1>{$LANG.portalWelcome}, {$clientsdetails.firstname|escape}</h1><p>{$LANG.portalWelcomeCopy}</p><a href="{$WEB_ROOT}/cart.php">{$LANG.portalExplore} <i class="fas fa-arrow-right" aria-hidden="true"></i></a></div><div class="member-cloud-art" aria-hidden="true"><i class="fas fa-cloud"></i><i class="fas fa-server"></i><span>CLOUD</span></div></div>
    <div class="member-balance">
        <div class="member-balance-heading"><span class="member-balance-icon"><i class="fas fa-wallet" aria-hidden="true"></i></span><span>{if $portalLanguage=='vietnamese'}Số dư{else}Balance{/if}</span></div>
        {if $ctkWallet}
            <div class="ctk-wallet-mini"><span>{if $portalLanguage=='vietnamese'}Tài khoản chính{else}Main balance{/if}</span><strong>{$ctkWallet.main_formatted}</strong></div>
            <div class="ctk-wallet-mini"><span>{if $portalLanguage=='vietnamese'}Khuyến mãi{else}Promotional balance{/if}</span><strong>{$ctkWallet.promo_formatted}</strong></div>
            <a class="member-balance-link" href="{$WEB_ROOT}/wallet.php">{if $portalLanguage=='vietnamese'}Quản lý số dư{else}Manage balance{/if}<i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        {else}<span>{$LANG.portalBalance}</span><strong>{$clientsstats.creditbalance}</strong>{/if}
    </div>
</section>

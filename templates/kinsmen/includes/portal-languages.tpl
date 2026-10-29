<nav class="portal-languages" aria-label="Language">
    <i class="fas fa-globe" aria-hidden="true"></i>
    <a href="{$portalLanguageLinks.vietnamese|escape}" lang="vi" hreflang="vi" {if $portalLanguage == 'vietnamese'}class="active" aria-current="true"{/if}>VI<span class="sr-only"> — Tiếng Việt</span></a>
    <span aria-hidden="true">|</span>
    <a href="{$portalLanguageLinks.english|escape}" lang="en" hreflang="en" {if $portalLanguage == 'english'}class="active" aria-current="true"{/if}>EN<span class="sr-only"> — English</span></a>
</nav>

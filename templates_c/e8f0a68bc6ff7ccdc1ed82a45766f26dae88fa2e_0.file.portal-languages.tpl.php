<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:30:25
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\includes\portal-languages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae4479179ad79_32666061',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8f0a68bc6ff7ccdc1ed82a45766f26dae88fa2e' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\includes\\portal-languages.tpl',
      1 => 1792077024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae4479179ad79_32666061 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="portal-languages" aria-label="Language">
    <i class="fas fa-globe" aria-hidden="true"></i>
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['portalLanguageLinks']->value['vietnamese'], ENT_QUOTES, 'UTF-8', true);?>
" lang="vi" hreflang="vi" <?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>class="active" aria-current="true"<?php }?>>VI<span class="sr-only"> — Tiếng Việt</span></a>
    <span aria-hidden="true">|</span>
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['portalLanguageLinks']->value['english'], ENT_QUOTES, 'UTF-8', true);?>
" lang="en" hreflang="en" <?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'english') {?>class="active" aria-current="true"<?php }?>>EN<span class="sr-only"> — English</span></a>
</nav>
<?php }
}

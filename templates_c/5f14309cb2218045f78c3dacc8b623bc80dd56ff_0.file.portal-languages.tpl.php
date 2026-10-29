<?php
/* Smarty version 3.1.33-p1, created on 2026-10-15 22:16:38
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\portal-languages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad0ee56f31576_98676025',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f14309cb2218045f78c3dacc8b623bc80dd56ff' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\portal-languages.tpl',
      1 => 1792077024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad0ee56f31576_98676025 (Smarty_Internal_Template $_smarty_tpl) {
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

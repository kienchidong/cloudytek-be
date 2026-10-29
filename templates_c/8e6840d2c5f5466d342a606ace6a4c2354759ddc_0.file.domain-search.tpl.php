<?php
/* Smarty version 3.1.33-p1, created on 2026-10-29 13:46:09
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\domain-search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae2ebb1352009_73964468',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e6840d2c5f5466d342a606ace6a4c2354759ddc' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\domain-search.tpl',
      1 => 1793255745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae2ebb1352009_73964468 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="portal-catalog ctk-domain-store" data-category="domains" data-mode="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['domainSearchMode']->value, ENT_QUOTES, 'UTF-8', true);?>
" data-contact="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php" data-cart="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php">
    <section class="catalog-banner" aria-labelledby="domain-title">
        <div class="catalog-banner-copy"><span class="catalog-eyebrow"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
 CLOUD PLATFORM</span><h1 id="domain-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_title'];?>
</h1><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_intro'];?>
</p><a href="#domain-search"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_explore'];?>
 <i class="fas fa-arrow-down" aria-hidden="true"></i></a></div>
        <div class="ctk-domain-banner-icon" aria-hidden="true"><i class="fas fa-globe"></i><span>www.</span></div>
    </section>
    <section class="catalog-discovery" aria-labelledby="domain-services-title">
        <h2 id="domain-services-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalServices'];?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <nav class="catalog-categories" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['portalCategories'], ENT_QUOTES, 'UTF-8', true);?>
"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domainCategories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?gid=<?php echo $_smarty_tpl->tpl_vars['category']->value['gid'];?>
"><i class="fas fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['icon'], ENT_QUOTES, 'UTF-8', true);?>
" aria-hidden="true"></i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['label'], ENT_QUOTES, 'UTF-8', true);?>
</a><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domains.php" aria-current="page"><i class="fas fa-globe" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_name'];?>
</a></nav>
    </section>
    <section id="domain-search" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_title'], ENT_QUOTES, 'UTF-8', true);?>
">
        <nav class="ctk-domain-tabs" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_mode'], ENT_QUOTES, 'UTF-8', true);?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domains.php" <?php if ($_smarty_tpl->tpl_vars['domainSearchMode']->value == 'register') {?>aria-current="page"<?php }?>><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_new'];?>
</a><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domains.php?mode=transfer" <?php if ($_smarty_tpl->tpl_vars['domainSearchMode']->value == 'transfer') {?>aria-current="page"<?php }?>><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_transfer'];?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
</a></nav>
        <form id="ctkDomainSearch" method="post" action="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domains.php" novalidate>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['domainSearchToken']->value, ENT_QUOTES, 'UTF-8', true);?>
">
            <label for="ctkDomainInput" class="sr-only"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_inputLabel'];?>
</label>
            <div class="ctk-domain-search-row"><div class="ctk-domain-input-wrap"><i class="fas fa-search" aria-hidden="true"></i><input type="text" id="ctkDomainInput" name="domain" placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_placeholder'], ENT_QUOTES, 'UTF-8', true);?>
" autocomplete="off" autocapitalize="none" spellcheck="false" maxlength="253" aria-describedby="ctkDomainError"></div><button type="submit"><i class="fas fa-search" aria-hidden="true"></i><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_check'];?>
</span></button></div>
            <p id="ctkDomainError" class="ctk-domain-error" role="alert" hidden></p>
        </form>
        <div id="ctkDomainProgress" class="ctk-domain-progress" role="status" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_checking'], ENT_QUOTES, 'UTF-8', true);?>
" hidden><i class="fas fa-circle-notch fa-spin" aria-hidden="true"></i></div>
        <div id="ctkDomainResults" aria-live="polite" aria-atomic="false" hidden>
            <div id="ctkDomainPrimary" class="ctk-domain-primary"></div>
            <section aria-labelledby="ctkDomainSuggestionsTitle"><h2 id="ctkDomainSuggestionsTitle"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_suggestions'];?>
</h2><div id="ctkDomainSuggestions" class="ctk-domain-grid"></div><div class="ctk-domain-more"><button type="button" id="ctkDomainMore" aria-controls="ctkDomainSuggestions" hidden><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_more'];?>
</span><i class="fas fa-chevron-down" aria-hidden="true"></i></button></div></section>
            <p class="ctk-domain-note"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_note'];?>
</p>
        </div>
    </section>
    <section class="ctk-domain-related" aria-labelledby="domain-related-title"><h2 id="domain-related-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_related'];?>
</h2><div><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domainCategories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
if (in_array($_smarty_tpl->tpl_vars['category']->value['key'],array('hosting','vps','ssl','cloud'))) {?><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?gid=<?php echo $_smarty_tpl->tpl_vars['category']->value['gid'];?>
"><i class="fas fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['icon'], ENT_QUOTES, 'UTF-8', true);?>
" aria-hidden="true"></i><strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['label'], ENT_QUOTES, 'UTF-8', true);?>
</strong><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ctkDomain_details'];?>
 <i class="fas fa-arrow-right" aria-hidden="true"></i></span></a><?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div></section>
    <?php echo '<script'; ?>
 type="application/json" id="ctkDomainCopy"><?php echo $_smarty_tpl->tpl_vars['domainSearchCopy']->value;
echo '</script'; ?>
>
</div>
<?php }
}

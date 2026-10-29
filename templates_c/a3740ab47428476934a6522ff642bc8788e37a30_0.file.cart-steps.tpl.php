<?php
/* Smarty version 3.1.33-p1, created on 2026-10-15 23:55:46
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\cart-steps.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad10592ea9162_14417109',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3740ab47428476934a6522ff642bc8788e37a30' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\cart-steps.tpl',
      1 => 1792083334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad10592ea9162_14417109 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="portal-cart-breadcrumb" aria-label="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['breadcrumbnav'];?>
">
    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCartHome'];?>
</a><span aria-hidden="true">›</span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCartTitle'];?>
</span>
</nav>
<nav class="portal-cart-steps" aria-label="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCartSteps'];?>
">
    <ol>
        <li class="<?php if ($_smarty_tpl->tpl_vars['step']->value > 1) {?>is-complete<?php } else { ?>is-current<?php }?>" <?php if ($_smarty_tpl->tpl_vars['step']->value == 1) {?>aria-current="step"<?php }?>><span class="step-number"><?php if ($_smarty_tpl->tpl_vars['step']->value > 1) {?><i class="fas fa-check" aria-hidden="true"></i><?php } else { ?>1<?php }?></span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCartConfigure'];?>
</span></li>
        <li class="<?php if ($_smarty_tpl->tpl_vars['step']->value > 2) {?>is-complete<?php } elseif ($_smarty_tpl->tpl_vars['step']->value == 2) {?>is-current<?php }?>" <?php if ($_smarty_tpl->tpl_vars['step']->value == 2) {?>aria-current="step"<?php }?>><span class="step-number"><?php if ($_smarty_tpl->tpl_vars['step']->value > 2) {?><i class="fas fa-check" aria-hidden="true"></i><?php } else { ?>2<?php }?></span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalCartTitle'];?>
</span></li>
        <li class="<?php if ($_smarty_tpl->tpl_vars['step']->value == 3) {?>is-current<?php }?>" <?php if ($_smarty_tpl->tpl_vars['step']->value == 3) {?>aria-current="step"<?php }?>><span class="step-number">3</span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['checkout'];?>
</span></li>
    </ol>
</nav>
<?php }
}

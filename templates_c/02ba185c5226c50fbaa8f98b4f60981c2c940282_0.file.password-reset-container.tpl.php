<?php
/* Smarty version 3.1.33-p1, created on 2026-10-20 15:40:38
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\password-reset-container.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad7290666b1a2_36714906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02ba185c5226c50fbaa8f98b4f60981c2c940282' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\password-reset-container.tpl',
      1 => 1792203944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad7290666b1a2_36714906 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
<div class="logincontainer">
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/pageheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->tpl_vars['LANG']->value['pwreset']), 0, true);
?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/portal-reset-content.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>
<?php } else { ?>
<div class="portal-auth-card portal-reset-card logincontainer">
    <section class="portal-signin portal-reset" aria-labelledby="portal-reset-title">
        <div class="portal-reset-icon"><i class="fas fa-key" aria-hidden="true"></i></div>
        <h1 id="portal-reset-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwreset'];?>
</h1>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/portal-reset-content.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <a class="portal-forgot portal-back-login" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'];?>
</a>
    </section>
    <section class="portal-welcome" aria-labelledby="portal-reset-welcome">
        <div class="portal-welcome-copy">
            <div class="portal-welcome-brand"><span class="ctk-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
"></span></div>
            <h2 id="portal-reset-welcome"><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>TRUY CẬP AN TOÀN<?php } else { ?>SECURE ACCOUNT ACCESS<?php }?></h2>
            <p><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Khôi phục mật khẩu để tiếp tục quản lý dịch vụ, hóa đơn và yêu cầu hỗ trợ tại <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
.<?php } else { ?>Recover access to your account and get back to managing your services, invoices and support with <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
.<?php }?></p>
            <a class="portal-register" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['login'];?>
</a>
        </div>
        <a class="portal-help-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
</a>
    </section>
</div>
<?php }
}
}

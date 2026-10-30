<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:30:25
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\includes\portal-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae44791e4d064_78607620',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4eaefbf50912a246eeab653925756f4bbf10be55' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\includes\\portal-login.tpl',
      1 => 1792203944,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae44791e4d064_78607620 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="portal-auth-card logincontainer<?php if ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?> with-social<?php }?>">
    <section class="portal-signin" aria-labelledby="portal-login-title">
        <h1 id="portal-login-title"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['LANG']->value['login'], 'UTF-8');?>
</h1>
        <?php if ($_smarty_tpl->tpl_vars['verificationId']->value && empty($_smarty_tpl->tpl_vars['transientDataName']->value)) {?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['verificationKeyExpired'],'textcenter'=>true), 0, true);
?>
        <?php } elseif ($_smarty_tpl->tpl_vars['ssoredirect']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['sso']['redirectafterlogin'],'textcenter'=>true), 0, true);
?>
        <?php } elseif ($_smarty_tpl->tpl_vars['invalid']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['googleRecaptchaIncorrect'],'textcenter'=>true), 0, true);
?>
        <?php }?>
        <div class="providerLinkingFeedback"></div>
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['systemurl']->value;?>
dologin.php" class="login-form" role="form">
            <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
            <div class="portal-input-field">
                <label class="sr-only" for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaemail'];?>
</label>
                <i class="far fa-envelope" aria-hidden="true"></i>
                <input type="email" name="username" class="form-control" id="inputEmail" placeholder="Email" autocomplete="username" required autofocus>
            </div>
            <div class="portal-input-field">
                <label class="sr-only" for="inputPassword"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
</label>
                <i class="fas fa-lock" aria-hidden="true"></i>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="current-password" required>
                <button type="button" class="portal-password-toggle" aria-label="<?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Hiện mật khẩu<?php } else { ?>Show password<?php }?>" data-show-label="<?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Hiện mật khẩu<?php } else { ?>Show password<?php }?>" data-hide-label="<?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Ẩn mật khẩu<?php } else { ?>Hide password<?php }?>" aria-pressed="false" aria-controls="inputPassword"><i class="far fa-eye-slash" aria-hidden="true"></i></button>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['incorrect']->value) {?><div class="alert alert-danger" data-validation-field="password" role="alert"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginincorrect'];?>
</div><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['captcha']->value->isEnabled()) {?>
                <div class="text-center margin-bottom"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div>
            <?php }?>
            <label class="portal-remember"><input type="checkbox" name="rememberme"> <span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>
</span></label>
            <input id="login" type="submit" class="btn btn-primary portal-login-submit<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
">
            <a class="portal-forgot" href="<?php echo routePath('password-reset-begin');?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['forgotpw'];?>
</a>
        </form>
        <?php if ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?>
            <div class="portal-social"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"login",'customFeedback'=>true), 0, true);
?></div>
        <?php }?>
    </section>
    <section class="portal-welcome" aria-labelledby="portal-welcome-title">
        <div class="portal-welcome-copy">
            <div class="portal-welcome-brand"><span class="ctk-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
"></span></div>
            <?php if ($_smarty_tpl->tpl_vars['condlinks']->value['allowClientRegistration']) {?>
                <h2 id="portal-welcome-title"><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>CHƯA CÓ TÀI KHOẢN?<?php } else { ?>NEW TO <?php echo mb_strtoupper(htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true), 'UTF-8');?>
?<?php }?></h2>
                <p><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Đăng ký tài khoản để sử dụng dịch vụ và quản lý hạ tầng của bạn tại <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
.<?php } else { ?>Create an account to explore our services and manage your infrastructure with <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['companyname']->value, ENT_QUOTES, 'UTF-8', true);?>
.<?php }?></p>
                <a class="portal-register" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/register.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['register'];?>
</a>
            <?php } else { ?>
                <h2 id="portal-welcome-title"><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>CHÀO MỪNG TRỞ LẠI<?php } else { ?>WELCOME BACK<?php }?></h2>
                <p><?php if ($_smarty_tpl->tpl_vars['language']->value == 'vietnamese') {?>Đăng nhập để quản lý dịch vụ, hóa đơn và yêu cầu hỗ trợ của bạn.<?php } else { ?>Sign in to manage your services, invoices and support requests in one place.<?php }?></p>
            <?php }?>
        </div>
        <a class="portal-help-link" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
</a>
    </section>
</div>
<?php }
}

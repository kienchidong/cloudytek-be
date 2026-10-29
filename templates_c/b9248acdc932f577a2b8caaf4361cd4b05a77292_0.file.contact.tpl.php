<?php
/* Smarty version 3.1.33-p1, created on 2026-10-15 22:18:35
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad0eecb775e49_53534325',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9248acdc932f577a2b8caaf4361cd4b05a77292' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\contact.tpl',
      1 => 1792077359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad0eecb775e49_53534325 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="portal-support">
    <aside class="support-intro"><span class="support-icon"><i class="far fa-life-ring" aria-hidden="true"></i></span><span class="support-kicker"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['getsupport'];?>
</span><h1><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportIntro'];?>
</h1><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportCopy'];?>
</p><div class="support-account"><i class="far fa-user" aria-hidden="true"></i><h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportAccount'];?>
</h2><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportAccountCopy'];?>
</p><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>submitticket.php<?php } else { ?>clientarea.php<?php }?>"><?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {
echo $_smarty_tpl->tpl_vars['LANG']->value['navopenticket'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['login'];
}?><i class="fas fa-arrow-right" aria-hidden="true"></i></a></div><a class="support-browse" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><i class="fas fa-arrow-left" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalBackServices'];?>
</a></aside>
    <section class="support-form-card" aria-labelledby="support-form-title"><h2 id="support-form-title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportForm'];?>
</h2><p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportDetails'];?>
</p>
        <?php if ($_smarty_tpl->tpl_vars['sent']->value) {?><div class="alert alert-success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactsent'];?>
</div><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?><div class="alert alert-danger" role="alert"><?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>
</div><?php }?>
        <?php if (!$_smarty_tpl->tpl_vars['sent']->value) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php" class="support-form"><input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"><input type="hidden" name="action" value="send">
            <div class="support-form-row"><div class="form-group"><label for="inputName"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientname'];?>
</label><input type="text" name="name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" id="inputName" autocomplete="name" required></div><div class="form-group"><label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientemail'];?>
</label><input type="email" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" id="inputEmail" autocomplete="email" required></div></div>
            <div class="form-group"><label for="inputSubject"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubject'];?>
</label><input type="text" name="subject" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subject']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" id="inputSubject" required></div>
            <div class="form-group"><label for="inputMessage"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactmessage'];?>
</label><textarea name="message" rows="7" class="form-control" id="inputMessage" required><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['message']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea></div>
            <?php if ($_smarty_tpl->tpl_vars['captcha']->value) {?><div class="support-captcha"><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></div><?php }?>
            <div class="support-submit-row"><span><i class="fas fa-lock" aria-hidden="true"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalSupportPrivacy'];?>
</span><button type="submit" class="btn btn-primary<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactsend'];?>
<i class="far fa-paper-plane" aria-hidden="true"></i></button></div>
        </form><?php }?>
    </section>
</div>
<?php }
}

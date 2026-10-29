<div class="portal-support">
    <aside class="support-intro"><span class="support-icon"><i class="far fa-life-ring" aria-hidden="true"></i></span><span class="support-kicker">{$LANG.getsupport}</span><h1>{$LANG.portalSupportIntro}</h1><p>{$LANG.portalSupportCopy}</p><div class="support-account"><i class="far fa-user" aria-hidden="true"></i><h2>{$LANG.portalSupportAccount}</h2><p>{$LANG.portalSupportAccountCopy}</p><a href="{$WEB_ROOT}/{if $loggedin}submitticket.php{else}clientarea.php{/if}">{if $loggedin}{$LANG.navopenticket}{else}{$LANG.login}{/if}<i class="fas fa-arrow-right" aria-hidden="true"></i></a></div><a class="support-browse" href="{$WEB_ROOT}/cart.php"><i class="fas fa-arrow-left" aria-hidden="true"></i>{$LANG.portalBackServices}</a></aside>
    <section class="support-form-card" aria-labelledby="support-form-title"><h2 id="support-form-title">{$LANG.portalSupportForm}</h2><p>{$LANG.portalSupportDetails}</p>
        {if $sent}<div class="alert alert-success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> {$LANG.contactsent}</div>{/if}
        {if $errormessage}<div class="alert alert-danger" role="alert">{$errormessage}</div>{/if}
        {if !$sent}<form method="post" action="{$WEB_ROOT}/contact.php" class="support-form"><input type="hidden" name="token" value="{$token}"><input type="hidden" name="action" value="send">
            <div class="support-form-row"><div class="form-group"><label for="inputName">{$LANG.supportticketsclientname}</label><input type="text" name="name" value="{$name|escape}" class="form-control" id="inputName" autocomplete="name" required></div><div class="form-group"><label for="inputEmail">{$LANG.supportticketsclientemail}</label><input type="email" name="email" value="{$email|escape}" class="form-control" id="inputEmail" autocomplete="email" required></div></div>
            <div class="form-group"><label for="inputSubject">{$LANG.supportticketsticketsubject}</label><input type="text" name="subject" value="{$subject|escape}" class="form-control" id="inputSubject" required></div>
            <div class="form-group"><label for="inputMessage">{$LANG.contactmessage}</label><textarea name="message" rows="7" class="form-control" id="inputMessage" required>{$message|escape}</textarea></div>
            {if $captcha}<div class="support-captcha">{include file="$template/includes/captcha.tpl"}</div>{/if}
            <div class="support-submit-row"><span><i class="fas fa-lock" aria-hidden="true"></i>{$LANG.portalSupportPrivacy}</span><button type="submit" class="btn btn-primary{$captcha->getButtonClass($captchaForm)}">{$LANG.contactsend}<i class="far fa-paper-plane" aria-hidden="true"></i></button></div>
        </form>{/if}
    </section>
</div>

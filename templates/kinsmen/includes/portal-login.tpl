<div class="portal-auth-card logincontainer{if $linkableProviders} with-social{/if}">
    <section class="portal-signin" aria-labelledby="portal-login-title">
        <h1 id="portal-login-title">{$LANG.login|upper}</h1>
        {if $verificationId && empty($transientDataName)}
            {include file="$template/includes/alert.tpl" type="error" msg=$LANG.verificationKeyExpired textcenter=true}
        {elseif $ssoredirect}
            {include file="$template/includes/alert.tpl" type="info" msg=$LANG.sso.redirectafterlogin textcenter=true}
        {elseif $invalid}
            {include file="$template/includes/alert.tpl" type="error" msg=$LANG.googleRecaptchaIncorrect textcenter=true}
        {/if}
        <div class="providerLinkingFeedback"></div>
        <form method="post" action="{$systemurl}dologin.php" class="login-form" role="form">
            <input type="hidden" name="token" value="{$token}">
            <div class="portal-input-field">
                <label class="sr-only" for="inputEmail">{$LANG.clientareaemail}</label>
                <i class="far fa-envelope" aria-hidden="true"></i>
                <input type="email" name="username" class="form-control" id="inputEmail" placeholder="Email" autocomplete="username" required autofocus>
            </div>
            <div class="portal-input-field">
                <label class="sr-only" for="inputPassword">{$LANG.clientareapassword}</label>
                <i class="fas fa-lock" aria-hidden="true"></i>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="{$LANG.clientareapassword}" autocomplete="current-password" required>
                <button type="button" class="portal-password-toggle" aria-label="{if $language == 'vietnamese'}Hiện mật khẩu{else}Show password{/if}" data-show-label="{if $language == 'vietnamese'}Hiện mật khẩu{else}Show password{/if}" data-hide-label="{if $language == 'vietnamese'}Ẩn mật khẩu{else}Hide password{/if}" aria-pressed="false" aria-controls="inputPassword"><i class="far fa-eye-slash" aria-hidden="true"></i></button>
            </div>
            {if $incorrect}<div class="alert alert-danger" data-validation-field="password" role="alert">{$LANG.loginincorrect}</div>{/if}
            {if $captcha->isEnabled()}
                <div class="text-center margin-bottom">{include file="$template/includes/captcha.tpl"}</div>
            {/if}
            <label class="portal-remember"><input type="checkbox" name="rememberme"> <span>{$LANG.loginrememberme}</span></label>
            <input id="login" type="submit" class="btn btn-primary portal-login-submit{$captcha->getButtonClass($captchaForm)}" value="{$LANG.loginbutton}">
            <a class="portal-forgot" href="{routePath('password-reset-begin')}">{$LANG.forgotpw}</a>
        </form>
        {if $linkableProviders}
            <div class="portal-social">{include file="$template/includes/linkedaccounts.tpl" linkContext="login" customFeedback=true}</div>
        {/if}
    </section>
    <section class="portal-welcome" aria-labelledby="portal-welcome-title">
        <div class="portal-welcome-copy">
            <div class="portal-welcome-brand"><span class="ctk-logo"><img src="{$WEB_ROOT}/assets/img/cloudytek-brand.png?v=20261017-transparent" alt="{$companyname|escape}"></span></div>
            {if $condlinks.allowClientRegistration}
                <h2 id="portal-welcome-title">{if $language == 'vietnamese'}CHƯA CÓ TÀI KHOẢN?{else}NEW TO {$companyname|escape|upper}?{/if}</h2>
                <p>{if $language == 'vietnamese'}Đăng ký tài khoản để sử dụng dịch vụ và quản lý hạ tầng của bạn tại {$companyname|escape}.{else}Create an account to explore our services and manage your infrastructure with {$companyname|escape}.{/if}</p>
                <a class="portal-register" href="{$WEB_ROOT}/register.php">{$LANG.register}</a>
            {else}
                <h2 id="portal-welcome-title">{if $language == 'vietnamese'}CHÀO MỪNG TRỞ LẠI{else}WELCOME BACK{/if}</h2>
                <p>{if $language == 'vietnamese'}Đăng nhập để quản lý dịch vụ, hóa đơn và yêu cầu hỗ trợ của bạn.{else}Sign in to manage your services, invoices and support requests in one place.{/if}</p>
            {/if}
        </div>
        <a class="portal-help-link" href="{$WEB_ROOT}/contact.php"><i class="far fa-life-ring" aria-hidden="true"></i> {$LANG.getsupport}</a>
    </section>
</div>

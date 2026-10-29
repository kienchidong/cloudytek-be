document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.portal-password-toggle');
    var password = document.getElementById('inputPassword');
    if (!button || !password) return;
    button.addEventListener('click', function () {
        var show = password.type === 'password';
        password.type = show ? 'text' : 'password';
        button.setAttribute('aria-pressed', String(show));
        button.setAttribute('aria-label', show ? button.dataset.hideLabel : button.dataset.showLabel);
        button.querySelector('i').className = show ? 'far fa-eye' : 'far fa-eye-slash';
    });
});

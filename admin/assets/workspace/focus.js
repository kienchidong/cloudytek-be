(function () {
    var root = document.documentElement;
    root.dataset.focusMode = 'pointer';
    document.addEventListener('pointerdown', function () { root.dataset.focusMode = 'pointer'; }, true);
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Tab' || event.key.indexOf('Arrow') === 0) root.dataset.focusMode = 'keyboard';
    }, true);
}());

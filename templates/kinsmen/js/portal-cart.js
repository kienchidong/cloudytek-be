(function () {
    'use strict';
    function init() {
        var description = document.querySelector('.portal-cart-configure .portal-product-description');
        if (description && description.querySelector('br') && !description.querySelector('div,ul,ol,table,p')) {
            var features = document.createElement('div');
            features.className = 'portal-product-features';
            var line = document.createElement('div');
            Array.prototype.forEach.call(description.childNodes, function (node) {
                if (node.nodeName === 'BR') {
                    if (line.textContent.trim()) features.appendChild(line);
                    line = document.createElement('div');
                } else line.appendChild(node.cloneNode(true));
            });
            if (line.textContent.trim()) features.appendChild(line);
            if (features.childElementCount > 1) description.replaceChildren(features);
        }
        var select = document.getElementById('inputBillingcycle');
        var cards = document.querySelector('.portal-cycle-cards');
        if (!select || !cards || cards.dataset.ready) return;
        cards.dataset.ready = 'true';
        var months = {monthly: 1, quarterly: 3, semiannually: 6, annually: 12, biennially: 24, triennially: 36};
        Array.prototype.forEach.call(select.options, function (option) {
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'portal-cycle-card';
            button.dataset.cycle = option.value;
            var label = document.createElement('span');
            label.textContent = months[option.value] ? months[option.value] + ' ' + cards.dataset.monthLabel : option.textContent.trim();
            var price = document.createElement('strong');
            // Keep the native formatted price and period together: no price parsing or calculation.
            price.textContent = option.textContent.trim();
            button.appendChild(label);
            button.appendChild(price);
            button.addEventListener('click', function () {
                if (select.disabled || select.value === option.value) return;
                select.value = option.value;
                select.dispatchEvent(new Event('change', {bubbles: true}));
            });
            cards.appendChild(button);
        });
        function sync() {
            cards.querySelectorAll('button').forEach(function (button) {
                button.setAttribute('aria-pressed', button.dataset.cycle === select.value ? 'true' : 'false');
                button.disabled = select.disabled;
            });
        }
        select.addEventListener('change', sync);
        select.hidden = true;
        // The cards have their own accessible group name; avoid a visible label targeting a hidden select.
        var nativeLabel = document.querySelector('label[for="inputBillingcycle"]');
        if (nativeLabel) nativeLabel.removeAttribute('for');
        sync();
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
}());

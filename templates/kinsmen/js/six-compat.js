document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var toggle = document.getElementById('sidebarToggle');
    function sync() {
        if (toggle) toggle.setAttribute('aria-expanded', sidebar.classList.contains('open') ? 'true' : 'false');
        document.querySelectorAll('.submenu-toggle').forEach(function (link) {
            link.setAttribute('aria-expanded', link.parentElement.classList.contains('open') ? 'true' : 'false');
        });
    }
    document.addEventListener('click', sync);
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            sync();
            if (toggle) toggle.focus();
        }
    });
    var current = new URL(window.location.href);
    document.querySelectorAll('.admin-sidebar-link:not(.submenu-toggle),.admin-sidebar-sublink').forEach(function (link) {
        var uri = new URL(link.href, window.location.href);
        if (uri.pathname === current.pathname && uri.search === current.search) {
            link.setAttribute('aria-current', 'page');
            var item = link.closest('.admin-sidebar-item');
            if (item) {item.classList.add('active'); if (item.classList.contains('has-submenu')) item.classList.add('open');}
        }
    });
    sync();
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.main-content > p > a[href="https://www.whmcs.com/"]').forEach(function (link) {
        var paragraph = link.parentElement;
        if (/^Powered by\s+WHMCompleteSolution\s*$/.test(paragraph.textContent.trim())) paragraph.remove();
    });
});

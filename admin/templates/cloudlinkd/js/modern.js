/* Presentation only; existing WHMCS actions and permission checks stay server-side. */
document.addEventListener('DOMContentLoaded', function () {
    var avatar = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60"><rect width="60" height="60" rx="30" fill="#eef1ff"/><circle cx="30" cy="23" r="9" fill="#8797d1"/><path d="M14 48c0-11 7-17 16-17s16 6 16 17" fill="#8797d1"/></svg>');
    function fallbackAvatar(img) {
        if (img.dataset.cloudytekAvatarFallback) return;
        img.dataset.cloudytekAvatarFallback = 'true';
        img.src = avatar;
    }
    document.addEventListener('error', function (event) {
        var img = event.target;
        if (img.tagName === 'IMG' && img.closest('.widget-staff')) fallbackAvatar(img);
    }, true);
    document.querySelectorAll('.widget-staff img').forEach(function (img) {
        if (img.complete && img.naturalWidth === 0) fallbackAvatar(img);
    });
    if (document.documentElement.classList.contains('cloudytek-standalone')) {
        document.querySelectorAll('#menu > li').forEach(function(item) {
            var submenu=item.querySelector('ul');
            if (!submenu) return;
            var button=document.createElement('button');
            button.className='standalone-expand';button.type='button';button.textContent='+';
            button.setAttribute('aria-label','Expand '+item.querySelector('a').textContent.trim());
            button.setAttribute('aria-expanded','false');
            button.addEventListener('click',function(){var open=item.classList.toggle('standalone-open');button.textContent=open?'-':'+';button.setAttribute('aria-expanded',String(open));});
            item.insertBefore(button,submenu);
        });
        var contextSidebar=document.getElementById('sidebar');
        if(contextSidebar){var contextTools=document.createElement('details');contextTools.className='standalone-tools';var summary=document.createElement('summary');summary.textContent='Page tools and shortcuts';contextTools.appendChild(summary);contextSidebar.parentNode.insertBefore(contextTools,contextSidebar);contextTools.appendChild(contextSidebar);}
        var navToggle=document.querySelector('.cloudytek-sidebar-toggle');
        navToggle.setAttribute('aria-controls','menu');
        navToggle.addEventListener('click',function(){var open=document.body.classList.toggle('standalone-nav-open');navToggle.setAttribute('aria-expanded',String(open));});
        document.addEventListener('keydown',function(event){if(event.key==='Escape'){document.body.classList.remove('standalone-nav-open');navToggle.setAttribute('aria-expanded','false');}});
        return;
    }
    var sidebar = document.getElementById('sidebar');
    var toggle = document.querySelector('.cloudytek-sidebar-toggle');
    if (!sidebar || !toggle) return;
    function syncSidebar() {
        document.body.classList.toggle('sidebar-collapsed', sidebar.style.display === 'none');
    }
    syncSidebar();
    new MutationObserver(syncSidebar).observe(sidebar, {attributes: true, attributeFilter: ['style']});
    var backdrop = document.createElement('button');
    backdrop.type = 'button';
    backdrop.className = 'cloudytek-sidebar-backdrop';
    backdrop.setAttribute('aria-label', 'Close sidebar');
    document.body.appendChild(backdrop);
    function closeSidebar() {
        document.body.classList.remove('sidebar-mobile-open');
        toggle.setAttribute('aria-expanded', 'false');
    }
    toggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('sidebar-mobile-open');
        toggle.setAttribute('aria-expanded', String(open));
    });
    backdrop.addEventListener('click', function () { closeSidebar(); toggle.focus(); });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && document.body.classList.contains('sidebar-mobile-open')) {
            closeSidebar(); toggle.focus();
        }
    });
    window.addEventListener('resize', function () { if (window.innerWidth > 767) closeSidebar(); });
});

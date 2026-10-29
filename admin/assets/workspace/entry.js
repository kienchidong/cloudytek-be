/* Route ordinary read-only admin entry points into the single workspace shell. */
(function () {
    if (window.parent !== window || document.currentScript.dataset.method !== 'GET') return;
    var url = new URL(location.href), file = url.pathname.split('/').pop();
    if (/^[a-zA-Z0-9_-]+$/.test(file)) file += '.php';
    if (url.searchParams.get('classic') === '1') return;
    var readPage = /^(clients|clientsadd|clientssummary|clientsservices|orders|ordersadd|invoices|transactions|gatewaylog|supportcenter|supporttickets|supportannouncements|supportkb|supportdownloads|reports|modulequeue|automationstatus|system[a-z]+|utilities[a-z]+|calendar|todolist|whois|billableitems|quotes|addonmodules|whmcsconnect|networkissues|affiliates|cancelrequests|massmail|cloudytek-linode|cloudytek-payments|cloudytek-wallet|myaccount|config[a-z]+)\.php$/.test(file);
    var routedPage = file === 'index.php' && /^\/admin\/(services|domains|addons|apps|setup|help|utilities)(\/[a-z-]+)*\/?$/.test(url.searchParams.get('rp') || '');
    if (!readPage && !routedPage) return;
    if (routedPage && /\/(delete|remove|terminate|suspend|unsuspend|reboot|cancel|approve|run|reset)(\/|$)/.test(url.searchParams.get('rp'))) return;
    var allowed = ['legacy','workspace_frame','userid','id','tab','status','page','sort','orderby','module','view','rp','type','report','validity','q','group','limit'];
    if ([...url.searchParams.keys()].some(function (key) { return allowed.indexOf(key) === -1; })) return;
    url.searchParams.delete('legacy'); url.searchParams.delete('workspace_frame');
    var route = file + (url.search ? '?' + url.searchParams.toString() : '');
    location.replace(new URL('workspace', url).href + '#/' + encodeURIComponent(route.replace(/\.php(?=[?#]|$)/g, '')));
}());

<?php
if (!defined('WHMCS')) { exit; }
require_once ROOTDIR.'/includes/cloudytek/currency.php';

// Request-scoped only: never share account data or stale exchange rates across requests.
function cloudytekLocaleCurrency() {
    static $rows = array();
    $code = Lang::getName() === 'vietnamese' ? 'VND' : 'USD';
    if (!array_key_exists($code, $rows)) {
        $row = WHMCS\Database\Capsule::table('tblcurrencies')->where('code', $code)->first();
        $rows[$code] = $row ? (array) $row : null;
    }
    return $rows[$code];
}

function cloudytekDisplayAmount($amount, array $source, array $target) {
    // Same calculation and rounding as convertCurrency(), using the already loaded rows.
    if (!array_key_exists('rate', $source)) { $source = getCurrency('', $source['id']); }
    if (!array_key_exists('rate', $target)) { $target = getCurrency('', $target['id']); }
    $from = !empty($source['rate']) ? (float) $source['rate'] : 1;
    $to = !empty($target['rate']) ? (float) $target['rate'] : 1;
    return format_as_currency($amount / $from * $to);
}

// Run during client bootstrap, before native cart pricing and registration execute.
// Existing account ledgers retain their billing currency.
if (defined('CLIENTAREA') && !defined('ADMINAREA') && !WHMCS\Session::get('uid')) {
    $localeCurrency = \Cloudytek\Currency::enabled() ? (array)WHMCS\Database\Capsule::table('tblcurrencies')->where('code','VND')->first() : cloudytekLocaleCurrency();
    if ($localeCurrency) { WHMCS\Session::set('currency', (int) $localeCurrency['id']); }
}

// The client portal opens at login (or the account dashboard for an active session).
// Keep native authentication, return destinations and public recovery/checkout routes.
add_hook('ClientAreaPage', 5, function ($vars) {
    if (isset($vars['templatefile']) && $vars['templatefile'] === 'homepage'
        && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
        header('Location: ' . rtrim(WHMCS\Utility\Environment\WebHelper::getBaseUrl(), '/') . '/clientarea.php', true, 302);
        exit;
    }
});

// Convert presentation values after the native billing calculations have finished.
// Account currencies, service amounts, invoice records and gateway payloads are never rewritten.
function cloudytekLocaleMoneyView($value, array $source, array $target, $path = '') {
    if ($value instanceof WHMCS\View\Formatter\Price) {
        $currency = $value->getCurrency();
        $currency = is_array($currency) && isset($currency['id']) ? $currency : $source;
        if ((int) $currency['id'] === (int) $target['id']) { return $value; }
        return new WHMCS\View\Formatter\Price(cloudytekDisplayAmount((float) $value->toNumeric(), $currency, $target), $target);
    }
    if (is_array($value)) {
        foreach ($value as $key => $item) { $value[$key] = cloudytekLocaleMoneyView($item, $source, $target, $path . '/' . $key); }
        return $value;
    }
    $key = substr($path, strrpos($path, '/') + 1);
    $moneyKeys = array('monthly','quarterly','semiannually','annually','biennially','triennially','onetime','amount','total','subtotal','price','cost','displayprice','displayPriceSimple','setupfee','recurringamount');
    if (!is_string($value) || (!in_array($key, $moneyKeys, true) && strpos($path, '/portalCycles/') === false)) { return $value; }
    $prefix = $source['prefix']; $suffix = $source['suffix'];
    if ($prefix === '' && $suffix === '') { return $value; }
    $pattern = $prefix !== '' ? '~' . preg_quote($prefix, '~') . '(-?[0-9][0-9.,]*)(?:' . preg_quote($suffix, '~') . ')?~u'
        : '~(-?[0-9][0-9.,]*)' . preg_quote($suffix, '~') . '~u';
    return preg_replace_callback($pattern, function ($match) use ($source, $target) {
        $number = $match[1];
        if ($source['code']==='VND') { $number = str_replace(array('.', ','), '', $number); }
        elseif ((int) $source['format'] === 3) { $number = str_replace(array('.', ','), array('', '.'), $number); }
        else { $number = str_replace(',', '', $number); }
        return (string) new WHMCS\View\Formatter\Price(cloudytekDisplayAmount((float) $number, $source, $target), $target);
    }, $value);
}
add_hook('ClientAreaPage', 1000, function ($vars) {
    $row = cloudytekLocaleCurrency();
    if (!$row) { return array(); }
    $target = (array) $row;
    $source = isset($vars['currency']) && is_array($vars['currency']) ? $vars['currency'] : getCurrency(WHMCS\Session::get('uid'), WHMCS\Session::get('currency'));
    $result = array('currency' => $target);
    if ((int) $source['id'] !== (int) $target['id']) {
        foreach ($vars as $key => $value) {
            if (in_array($key, array('LANG','currency','clientsdetails','client','token','paymentbutton','credit_card_input','gatewaysoutput','ctkWallet','walletBalances','walletHistory'), true)) { continue; }
            if (is_array($value) || $value instanceof WHMCS\View\Formatter\Price || in_array($key, array('total','subtotal','amount','creditbalance','totalrecurringmonthly','totalrecurringannually'), true)) {
                $result[$key] = cloudytekLocaleMoneyView($value, $source, $target, '/' . $key);
            }
        }
        $result['portalBillingCurrency'] = $source['code'];
        $result['portalDisplayCurrency'] = $target['code'];
    }
    return $result;
});

// Keep links on the current page when switching the two supported client languages.
function cloudytekTrimClientMenu($menu) {
    foreach ($menu->getChildren() as $child) {
        if (in_array($child->getName(), array('Support', 'Contact Us'), true)) {
            $child->setLabel(Lang::trans('portalConsultation'));
        }
        if ($child->getName() === 'Choose Currency' || strpos((string) $child->getUri(), 'serverstatus.php') !== false) {
            $menu->removeChild($child->getName());
        } else {
            cloudytekTrimClientMenu($child);
        }
    }
}
add_hook('ClientAreaPrimaryNavbar', 20, function ($menu) { cloudytekTrimClientMenu($menu); });
add_hook('ClientAreaSecondaryNavbar', 20, function ($menu) { cloudytekTrimClientMenu($menu); });
add_hook('ClientAreaPrimarySidebar', 20, function ($menu) { cloudytekTrimClientMenu($menu); });
add_hook('ClientAreaSecondarySidebar', 20, function ($menu) { cloudytekTrimClientMenu($menu); });

add_hook('ClientAreaPage', 20, function ($vars) {
    $path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/clientarea.php', PHP_URL_PATH);
    $query = $_GET;
    unset($query['language'], $query['token'], $query['currency']);
    // Never repeat a cart/account action when changing language.
    if (isset($query['a']) && !in_array($query['a'], array('view', 'checkout'), true)) {
        unset($query['a'], $query['pid'], $query['bid'], $query['i']);
    }
    $links = array();
    foreach (array('english', 'vietnamese') as $language) {
        $query['language'] = $language;
        $links[$language] = $path . '?' . http_build_query($query);
    }
    $result = array('portalLanguageLinks' => $links, 'portalLanguage' => Lang::getName(), 'currencies' => array());
    if (isset($vars['templatefile']) && $vars['templatefile'] === 'contact') {
        $result['displayTitle'] = $result['pagetitle'] = Lang::trans('getsupport');
    }
    return $result;
});

// Compact catalogue captions only; native prices and submitted cycle keys stay unchanged.
function cloudytekCatalogPriceLabel($value, $cycle) {
    $label = trim(html_entity_decode(strip_tags((string) $value), ENT_QUOTES, 'UTF-8'));
    $label = preg_replace('/(?<=\d)\s*(?:đ|₫)/u', ' VND', $label);
    $vi = Lang::getName() === 'vietnamese';
    $periods = $vi
        ? array('monthly'=>'/tháng','quarterly'=>'/3 tháng','semiannually'=>'/6 tháng','annually'=>'/năm','biennially'=>'/2 năm','triennially'=>'/3 năm')
        : array('monthly'=>'/month','quarterly'=>'/3 months','semiannually'=>'/6 months','annually'=>'/year','biennially'=>'/2 years','triennially'=>'/3 years');
    if (isset($periods[$cycle])) {
        $nativePeriod = Lang::trans('orderpaymentterm' . $cycle);
        $label = preg_replace('/\s*' . preg_quote($nativePeriod, '/') . '/u', $periods[$cycle], $label);
    }
    return $label;
}

// Present WHMCS's native public product list and pricing in the client theme.
add_hook('ClientAreaPageCart', 20, function ($vars) {
    if (!isset($vars['templatefile']) || $vars['templatefile'] !== 'products'
        || !isset($vars['template']) || $vars['template'] !== 'kinsmen') { return array(); }
    $definitions = array(
        'hosting' => array('label' => Lang::trans('portalHosting'), 'icon' => 'globe'),
        'vps' => array('label' => 'VPS', 'icon' => 'server'),
        'cloud' => array('label' => 'Cloud', 'icon' => 'cloud'),
        'storage' => array('label' => Lang::trans('portalStorage'), 'icon' => 'database'),
        'servers' => array('label' => Lang::trans('portalServers'), 'icon' => 'building'),
        'ssl' => array('label' => 'SSL Certificates', 'icon' => 'shield-alt'),
        'other' => array('label' => Lang::trans('portalOther'), 'icon' => 'layer-group'),
    );
    $groups = array(); $categories = array(); $selectedCategory = '';
    foreach (isset($vars['productgroups']) ? $vars['productgroups'] : array() as $group) {
        $name = $group['name'];
        $category = preg_match('/vps/i', $name) ? 'vps'
            : (preg_match('/storage|backup|s3/i', $name) ? 'storage'
            : (preg_match('/cloud|gpu/i', $name) ? 'cloud'
            : (preg_match('/col+ocation|dedicated|physical|bare.?metal/i', $name) ? 'servers'
            : (preg_match('/ssl|certificate/i', $name) ? 'ssl'
            : (preg_match('/hosting|wordpress/i', $name) ? 'hosting' : 'other')))));
        $group['category'] = $category;
        $group['icon'] = $definitions[$category]['icon'];
        $group['selected'] = (int) $group['gid'] === (int) $vars['gid'];
        $groups[] = $group;
        if (!isset($categories[$category])) {
            $categories[$category] = $definitions[$category];
            $categories[$category]['gid'] = $group['gid'];
        }
        if ($group['selected']) { $selectedCategory = $category; }
    }
    foreach ($categories as $key => &$category) { $category['key'] = $key; }
    unset($category);
    $cycles = array('monthly', 'quarterly', 'semiannually', 'annually', 'biennially', 'triennially', 'onetime');
    $products = array();
    foreach (isset($vars['products']) ? $vars['products'] : array() as $product) {
        $product['portalCycles'] = array();
        foreach ($cycles as $cycle) {
            if (isset($product['pricing'][$cycle])) {
                $product['portalCycles'][] = array('key' => $cycle, 'label' => cloudytekCatalogPriceLabel($product['pricing'][$cycle], $cycle));
            }
        }
        $product['portalSoldOut'] = isset($product['qty']) && $product['qty'] !== '' && (int) $product['qty'] <= 0;
        $product['portalSpecs'] = array();
        if (empty($product['features'])) {
            foreach (preg_split('~<br\s*/?\s*>|</(?:p|li|div)>~i', $product['description']) as $line) {
                $line = trim(html_entity_decode(strip_tags($line), ENT_QUOTES, 'UTF-8'));
                foreach (preg_split('/\s*\|\s*/u', $line) as $detail) {
                    $detail = trim($detail);
                    if ($detail === '') { continue; }
                    $spec = array('label' => '', 'value' => $detail);
                    if (preg_match('/^([^:]{1,50}):\s+(.+)$/u', $detail, $parts)) {
                        $spec = array('label' => trim($parts[1]), 'value' => trim($parts[2]));
                    } elseif (preg_match('/^(.+?)\s+(RAM|vCPU|CPU|SSD DISK|SSD NVMe|NVMe|Storage|Transfer|Bandwidth|IPv4|IPv6)$/iu', $detail, $parts)) {
                        $spec = array('label' => $parts[2] === 'vCPU' ? 'CPU' : $parts[2], 'value' => trim($parts[1]) . ($parts[2] === 'vCPU' ? ' vCPU' : ''));
                    }
                    $product['portalSpecs'][] = $spec;
                }
            }
        }
        $products[] = $product;
    }
    return array('portalCatalog' => true, 'portalCategories' => array_values($categories),
        'portalGroups' => $groups, 'portalCategory' => $selectedCategory, 'portalProducts' => $products);
});

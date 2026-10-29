<?php
if (!defined('WHMCS')) { exit; }

add_hook('ClientAreaHeadOutput', 2000, function($vars) {
    if (empty($vars['template']) || $vars['template'] !== 'kinsmen') { return ''; }
    if (\WHMCS\Session::get('uid') && !headers_sent()) { header('Cache-Control: no-store, private'); }
    $page = isset($vars['templatefile']) ? $vars['templatefile'] : '';
    $public = in_array($page,array('products','announcements','viewannouncement','knowledgebase','knowledgebasecat','knowledgebasearticle','contact','domain-search'),true);
    $robots = $public && empty($vars['loggedin']) ? 'index,follow' : 'noindex,follow';
    $title = isset($vars['pagetitle']) ? strip_tags($vars['pagetitle']) : 'Cloudytek';
    $description = $title.' — Cloudytek. Dịch vụ Cloud, VPS, tên miền và hỗ trợ khách hàng.';
    $out = '<meta name="robots" content="'.$robots.'"><meta name="description" content="'.htmlspecialchars($description,ENT_QUOTES,'UTF-8').'">';
    if ($public) {
        // Retain meaningful product/article parameters, discard tracking and session input.
        $query = array();
        foreach (array('rp','id','gid','pid','catid','a','domain') as $key) { if (isset($_GET[$key]) && is_scalar($_GET[$key])) { $query[$key] = (string)$_GET[$key]; } }
        $request = isset($_SERVER['CLOUDYTEK_PUBLIC_REQUEST_URI']) ? $_SERVER['CLOUDYTEK_PUBLIC_REQUEST_URI'] : $_SERVER['REQUEST_URI'];
        $path = parse_url($request,PHP_URL_PATH);
        $systemUrl = \WHMCS\Config\Setting::getValue('SystemURL');
        $origin = parse_url($systemUrl);
        $base = isset($origin['scheme'],$origin['host']) ? $origin['scheme'].'://'.$origin['host'].(isset($origin['port'])?':'.$origin['port']:'') : '';
        $url = $base.$path.($query ? '?'.http_build_query($query) : '');
        $out .= '<link rel="canonical" href="'.htmlspecialchars($url,ENT_QUOTES,'UTF-8').'">';
    }
    if (!\WHMCS\Session::get('cid') && is_file(ROOTDIR.'/assets/cloudytek-client/portal.js')) {
        $out .= '<link rel="stylesheet" href="/assets/cloudytek-client/portal.css?v='.filemtime(ROOTDIR.'/assets/cloudytek-client/portal.css').'">';
    }
    return $out;
});

add_hook('ClientAreaFooterOutput', 2000, function($vars) {
    if (empty($vars['template']) || $vars['template'] !== 'kinsmen' || \WHMCS\Session::get('cid') || !is_file(ROOTDIR.'/assets/cloudytek-client/portal.js')) { return ''; }
    $uid = (int)\WHMCS\Session::get('uid');
    $page = isset($vars['templatefile']) ? $vars['templatefile'] : '';
    $config = array('authenticated'=>(bool)$uid,'language'=>\Lang::getName()==='vietnamese'?'vi':'en','page'=>$page,'dashboard'=>$uid && $page==='clientareahome','data'=>null);
    if ($uid) {
        try { require_once ROOTDIR.'/includes/cloudytek/react-portal.php'; $config['data'] = \Cloudytek\ReactPortal\data(); }
        catch (Throwable $e) { error_log('Cloudytek React portal: '.$e->getMessage()); return ''; }
    }
    $colors = is_file(ROOTDIR.'/assets/cloudytek-client/native-colors.css') ? '<link rel="stylesheet" href="/assets/cloudytek-client/native-colors.css?v='.filemtime(ROOTDIR.'/assets/cloudytek-client/native-colors.css').'">' : '';
    return $colors.'<script>window.cloudytekPortal='.json_encode($config,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_INVALID_UTF8_SUBSTITUTE).';</script><script type="module" src="/assets/cloudytek-client/portal.js?v='.filemtime(ROOTDIR.'/assets/cloudytek-client/portal.js').'"></script>';
});

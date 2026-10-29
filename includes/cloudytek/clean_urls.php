<?php
/** Extensionless browser URLs; PHP entry points remain unchanged internally. */
namespace Cloudytek\CleanUrls;

function entryFile($path)
{
    if (!preg_match('~^/(?:admin/)?[a-zA-Z0-9_-]+\.php$~D', $path)) { return null; }
    if (in_array($path, array('/init.php', '/configuration.php', '/admin/init.php'), true)) { return null; }
    $root = dirname(__DIR__, 2);
    return is_file($root . $path) ? $root . $path : null;
}

function url($value, $depth = 0)
{
    if (!is_string($value) || strpos($value, '.php') === false || preg_match('~[\x00-\x20]~', $value)) { return $value; }
    $parts = parse_url($value);
    if ($parts === false || empty($parts['path'])) { return $value; }
    if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), array('http', 'https'), true)) { return $value; }
    if (isset($parts['host'])) {
        $authority = strtolower($parts['host']) . (isset($parts['port']) ? ':' . $parts['port'] : '');
        if ($authority !== strtolower(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '')) { return $value; }
    }
    $path = $parts['path'];
    if ($path[0] !== '/') {
        $script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/index.php';
        $path = rtrim(str_replace('\\', '/', dirname($script)), '/') . '/' . $path;
    }
    $segments = array();
    foreach (explode('/', $path) as $segment) {
        if ($segment === '' || $segment === '.') { continue; }
        if ($segment === '..') { array_pop($segments); } else { $segments[] = $segment; }
    }
    $path = '/' . implode('/', $segments);
    if (!entryFile($path)) { return $value; }
    $clean = substr($path, 0, -4);
    if ($clean === '/index') { $clean = '/'; }
    if ($clean === '/admin/index') { $clean = '/admin/'; }
    // Keep query strings and fragments byte-for-byte (including HTML entities).
    if (isset($parts['query'])) {
        $query = $parts['query'];
        if ($depth < 4) {
            $query = preg_replace_callback('~(^|&(?:amp;)?)(redirect=)([^&#]*)~', function ($m) use ($depth) {
                $old = rawurldecode($m[3]);
                $new = url($old, $depth + 1);
                return $m[1] . $m[2] . ($new === $old ? $m[3] : rawurlencode($new));
            }, $query);
        }
        $clean .= '?' . $query;
    }
    if (isset($parts['fragment'])) { $clean .= '#' . $parts['fragment']; }
    return $clean;
}

function rewriteHtml($body)
{
    // Only URL attributes: do not alter inline JS logic, bootstrap JSON, signed
    // payloads, hidden inputs, text, remote links, API callbacks or binary data.
    return preg_replace_callback('~\b(href|action|src|formaction|data-url|data-href)(\s*=\s*)(["\'])(.*?)\3~is', function ($m) {
        return $m[1] . $m[2] . $m[3] . url($m[4]) . $m[3];
    }, $body);
}

function boot()
{
    if (PHP_SAPI === 'cli' || defined('CLOUDYTEK_CLEAN_URLS_STARTED')) { return; }
    define('CLOUDYTEK_CLEAN_URLS_STARTED', true);
    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    $request = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    $canonical = url($request);
    if (in_array($method, array('GET', 'HEAD'), true) && $canonical !== $request) {
        header('Location: ' . $canonical, true, 308);
        exit;
    }
    // WHMCS 7.8's dispatchers match legacy entry-point URIs, not just SCRIPT_NAME.
    // Expose the public alias to the browser while preserving native dispatch.
    $script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    $publicPath = parse_url($request, PHP_URL_PATH);
    if (entryFile($script) && ($publicPath === substr($script, 0, -4) || $publicPath === url($script))) {
        $_SERVER['CLOUDYTEK_PUBLIC_REQUEST_URI'] = $request;
        $_SERVER['REQUEST_URI'] = $script . (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '');
    }
    header_register_callback(function () {
        foreach (headers_list() as $header) {
            if (stripos($header, 'Location:') === 0) {
                $old = trim(substr($header, 9));
                $new = url($old);
                if ($new !== $old) { header('Location: ' . $new, true, http_response_code()); }
            }
        }
    });
    ob_start(function ($body) {
        $type = '';
        foreach (headers_list() as $header) {
            if (stripos($header, 'Content-Disposition:') === 0) { return $body; }
            if (stripos($header, 'Content-Type:') === 0) { $type = strtolower($header); }
        }
        if (($type !== '' && strpos($type, 'text/html') === false) ||
            ($type === '' && stripos($body, '<html') === false && stripos($body, '<form') === false)) { return $body; }
        $rewritten = rewriteHtml($body);
        if ($rewritten !== $body) { header_remove('Content-Length'); }
        return $rewritten;
    });
}

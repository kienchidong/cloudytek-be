<?php
if (!defined('WHMCS') && !defined('CLOUDYTEK_LINODE_TEST')) { http_response_code(403); exit; }
spl_autoload_register(function ($class) {
    $prefix = 'Cloudytek\\Linode\\';
    if (strpos($class, $prefix) === 0) {
        $name = substr($class, strlen($prefix));
        if (preg_match('/^[A-Za-z]+$/D', $name) && is_file(__DIR__ . '/lib/' . $name . '.php')) {
            require_once __DIR__ . '/lib/' . $name . '.php';
        }
    }
});

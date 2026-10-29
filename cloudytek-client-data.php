<?php
define('CLIENTAREA', true);
require __DIR__.'/init.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, private');
header('X-Robots-Tag: noindex');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') { http_response_code(405); header('Allow: GET'); echo '{"error":"Method not allowed"}'; exit; }
if (!WHMCS\Session::get('uid')) { http_response_code(401); echo '{"error":"Authentication required"}'; exit; }
if (WHMCS\Session::get('cid')) { http_response_code(403); echo '{"error":"Use native contact workspace"}'; exit; }
require_once ROOTDIR.'/includes/cloudytek/react-portal.php';
try {
    $data = \Cloudytek\ReactPortal\data();
    $resources = array('me'=>'me','dashboard/summary'=>'summary','services'=>'services','support-tickets'=>'tickets','news'=>'news');
    $resource = isset($_GET['resource']) ? $_GET['resource'] : '';
    if (!isset($resources[$resource])) { http_response_code(404); echo '{"error":"Resource not found"}'; exit; }
    echo json_encode($data[$resources[$resource]], JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_INVALID_UTF8_SUBSTITUTE);
} catch (Throwable $e) { http_response_code(503); error_log('Cloudytek React data: '.$e->getMessage()); echo '{"error":"Account data temporarily unavailable"}'; }

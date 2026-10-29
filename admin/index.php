<?php
/*
 * @ PHP 5.6
 * @ Decoder version : 1.0.0.1
 * @ Release on : 24.03.2018
 * @ Website    : http://EasyToYou.eu
 */

define("ADMINAREA", true);
require_once dirname(__DIR__) . "/init.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET)
    && stripos(isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '', 'text/html') !== false
    && strtolower(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : '') !== 'xmlhttprequest') {
    header('Location: workspace.php');
    exit;
}
$request = WHMCS\Http\Message\ServerRequest::fromGlobals();
$response = DI::make("Frontend\\Dispatcher")->dispatch($request);
$statusCode = $response->getStatusCode();
$statusFamily = substr($statusCode, 0, 1);
if (!in_array($statusFamily, array(2, 3)) && !($response instanceof WHMCS\Http\Message\JsonResponse || $response instanceof Zend\Diactoros\Response\JsonResponse || $response instanceof WHMCS\Admin\ApplicationSupport\View\Html\Smarty\ErrorPage)) {
    $viewFactory = new WHMCS\Admin\ApplicationSupport\Http\Message\ResponseFactory();
    $response = $viewFactory->genericError($request, $statusCode);
}
(new Zend\Diactoros\Response\SapiEmitter())->emit($response);
exit;

?>

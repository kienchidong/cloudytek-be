<?php
define('ADMINAREA',true);
require dirname(__DIR__).'/init.php';
$admin=new WHMCS\Admin('loginonly');
$admin->title='Cloudytek Workspace';
$admin->populateStandardAdminSmartyVariables();
$markup=$admin->getTemplate('menu',false);
$dom=new DOMDocument();
$previous=libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="UTF-8">'.$markup);
libxml_clear_errors();libxml_use_internal_errors($previous);
$xpath=new DOMXPath($dom);$groups=array();
$base=rtrim(WHMCS\Utility\Environment\WebHelper::getAdminBaseUrl(),'/');
function ctk_workspace_link($href,$base) {
    $href=html_entity_decode($href,ENT_QUOTES,'UTF-8');
    if($href===''||$href==='#'||preg_match('~^(?:javascript:|mailto:|https?://|//)~i',$href))return null;
    $path=parse_url($href,PHP_URL_PATH);
    if(!$path||strpos($path,'..')!==false)return null;
    if(strpos($path,'/')===0) {
        if(strpos($path,$base.'/')!==0)return null;
        $path=substr($path,strlen($base)+1);
    }
    if(!preg_match('~^[a-zA-Z0-9_-]+\.php$~D',$path)||in_array($path,array('workspace.php','logout.php','login.php'),true))return null;
    $query=parse_url($href,PHP_URL_QUERY);
    return $path.($query!==null&&$query!==''?'?'.$query:'');
}
foreach($xpath->query('//ul[@id="menu"]/li') as $node) {
    $anchor=$xpath->query('./a',$node)->item(0);if(!$anchor)continue;
    $span=$xpath->query('.//span[contains(@class,"hidden-xs")]',$anchor)->item(0);
    $label=trim($span?$span->textContent:$anchor->textContent);
    $items=array();
    foreach($xpath->query('./ul//a',$node) as $link) {
        $href=ctk_workspace_link($link->getAttribute('href'),$base);
        if($href)$items[]=array('id'=>$link->getAttribute('id'),'label'=>trim($link->textContent),'href'=>$href);
    }
    $href=ctk_workspace_link($anchor->getAttribute('href'),$base);
    if($href||$items)$groups[]=array('id'=>$anchor->getAttribute('id'),'label'=>$label,'href'=>$href,'items'=>$items);
}
$user=WHMCS\Database\Capsule::table('tbladmins')->where('id',WHMCS\Admin::getID())->first();
$config=array('base'=>$base,'groups'=>$groups,'user'=>array('name'=>trim($user->firstname.' '.$user->lastname),'username'=>$user->username));
$assetVersion=substr(hash('sha256',hash_file('sha256',__DIR__.'/assets/workspace/workspace.js').hash_file('sha256',__DIR__.'/assets/workspace/workspace.css')),0,12);
header('Cache-Control: no-store');
header('X-Frame-Options: SAMEORIGIN');
header('Content-Security-Policy: frame-src \'self\'; frame-ancestors \'self\'; object-src \'none\'; base-uri \'self\'');
?><!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Cloudytek · Admin Workspace</title><link rel="icon" type="image/png" href="../assets/img/cloudytek-brand.png?v=20261017-transparent"><link rel="stylesheet" href="../assets/css/cloudytek-brand.css?v=20261017-transparent"><link rel="stylesheet" href="assets/workspace/workspace.css?v=<?php echo $assetVersion; ?>"></head>
<body><div id="cloudytek-workspace-root"></div><script id="workspace-bootstrap" type="application/json"><?php echo json_encode($config,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT|JSON_HEX_APOS); ?></script><script src="assets/workspace/focus.js?v=20261015-1" defer></script><script src="assets/workspace/workspace.js?v=<?php echo $assetVersion; ?>" defer></script><noscript><p>Enable JavaScript to use the admin workspace, or <a href="index.php?legacy=1">open the classic admin</a>.</p></noscript></body></html>

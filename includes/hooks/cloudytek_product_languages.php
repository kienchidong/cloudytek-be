<?php
if (!defined('WHMCS')) { exit; }
require_once ROOTDIR.'/includes/cloudytek/product-localization.php';

// This legacy configure page uses raw OrderForm::setPid() fields; localize its view too.
add_hook('ClientAreaPageCart',30,function($vars){
    if(!isset($vars['productinfo'])||!is_array($vars['productinfo'])||empty($vars['productinfo']['pid']))return array();
    $info=$vars['productinfo'];$id=(int)$info['pid'];
    $info['name']=WHMCS\Product\Product::getProductName($id,isset($info['name'])?$info['name']:'');
    $info['description']=nl2br(WHMCS\Product\Product::getProductDescription($id));
    return array('productinfo'=>$info);
});

add_hook('AdminAreaHeadOutput',20,function(){
    if(basename(isset($_SERVER['SCRIPT_NAME'])?$_SERVER['SCRIPT_NAME']:'')!=='configproducts.php')return '';
    $id=isset($_GET['id']) && is_scalar($_GET['id'])?(int)$_GET['id']:0;
    if($id<1)return '';
    global $aInt;
    if(!$aInt || !$aInt->hasPermission('View Products/Services'))return '';
    $data=cloudytekProductVietnamese(WHMCS\Database\Capsule::connection()->getPdo(),$id);
    $data['canEdit']=(bool)$aInt->hasPermission('Edit Products/Services');
    $json=json_encode($data,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT|JSON_HEX_APOS);
    return '<script id="product-language-data" type="application/json">'.$json.'</script>'
        .'<link rel="stylesheet" href="assets/workspace/product-languages.css?v=20261016-1">'
        .'<script defer src="assets/workspace/product-languages.js?v=20261016-2"></script>';
});

add_hook('AdminProductConfigFieldsSave',20,function($vars){
    if(!defined('ADMINAREA') || $_SERVER['REQUEST_METHOD']!=='POST' || !isset($_POST['ctk_product_i18n']) || $_POST['ctk_product_i18n']!=='1')return;
    check_token('WHMCS.admin.default');checkPermission('Edit Products/Services');
    foreach(array('ctk_product_vi_name','ctk_product_vi_description') as $field)if(!isset($_POST[$field])||!is_string($_POST[$field]))throw new InvalidArgumentException('Invalid product language fields');
    $db=WHMCS\Database\Capsule::connection()->getPdo();
    $q=$db->prepare('SELECT name,description FROM tblproducts WHERE id=?');$q->execute(array((int)$vars['pid']));$english=$q->fetch(PDO::FETCH_ASSOC);
    if(!$english)throw new RuntimeException('Product not found');
    cloudytekSaveProductLanguages($db,(int)$vars['pid'],$english,array('name'=>WHMCS\Input\Sanitize::decode($_POST['ctk_product_vi_name']),'description'=>WHMCS\Input\Sanitize::decode($_POST['ctk_product_vi_description'])));
});

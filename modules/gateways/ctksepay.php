<?php
if (!defined('WHMCS')) die('Access denied');
require_once ROOTDIR.'/includes/cloudytek/payments.php';
function ctksepay_config() { return array('FriendlyName'=>array('Type'=>'System','Value'=>'SePay QR'), 'UsageNotes'=>array('Type'=>'System','Value'=>'Configure in Cloudytek payment settings: admin/cloudytek-payments.')); }
function ctksepay_MetaData() { return array('DisplayName'=>'SePay QR','APIVersion'=>'1.1','noCurrencyConversion'=>true); }
function ctksepay_link($params) { return \Cloudytek\Payments::link($params,'ctksepay'); }

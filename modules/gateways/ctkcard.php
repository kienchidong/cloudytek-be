<?php
if (!defined('WHMCS')) die('Access denied');
require_once ROOTDIR.'/includes/cloudytek/payments.php';
function ctkcard_config() { return array('FriendlyName'=>array('Type'=>'System','Value'=>'Visa / Mastercard (Stripe Checkout)'), 'UsageNotes'=>array('Type'=>'System','Value'=>'Configure in Cloudytek payment settings: admin/cloudytek-payments. Hosted checkout; no local card storage.')); }
function ctkcard_MetaData() { return array('DisplayName'=>'Visa / Mastercard','APIVersion'=>'1.1','noCurrencyConversion'=>true); }
function ctkcard_link($params) { return \Cloudytek\Payments::link($params,'ctkcard'); }

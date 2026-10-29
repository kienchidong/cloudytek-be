<?php
if (!defined('WHMCS')) { exit; }
require_once ROOTDIR.'/includes/cloudytek/linode/bootstrap.php';
add_hook('InvoicePaid', 50, function ($vars) {
    try {
        $store=\Cloudytek\Linode\Web::store();
        if($store->installed())(new \Cloudytek\Linode\Worker($store,new \Cloudytek\Linode\Catalog()))->queueInvoice((int)$vars['invoiceid']);
    } catch(\Throwable $e) { logActivity('Cloudytek Linode: invoice automation needs review.'); }
});
add_hook('AfterCronJob', 50, function () {
    try {
        $store=\Cloudytek\Linode\Web::store();
        if($store->installed())(new \Cloudytek\Linode\Worker($store,new \Cloudytek\Linode\Catalog()))->tick(3);
    } catch(\Throwable $e) { logActivity('Cloudytek Linode: worker needs review.'); }
});
add_hook('ClientAreaProductDetailsOutput', 50, function ($vars) {
    try {
        $store=\Cloudytek\Linode\Web::store();
        $serviceId=isset($vars['service'])?(int)$vars['service']->id:(isset($vars['serviceid'])?(int)$vars['serviceid']:0);
        if($store->installed() && $store->resource($serviceId)) {
            return '<a class="btn btn-primary" href="linode.php?serviceid='.$serviceId.'">Manage cloud service</a>';
        }
    } catch(\Throwable $e) {}
    return '';
});

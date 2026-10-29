<?php
if (PHP_SAPI !== 'cli') { http_response_code(403); exit; }
require dirname(__DIR__,3).'/init.php';
require __DIR__.'/bootstrap.php';
$store=\Cloudytek\Linode\Web::store();
if(!$store->installed()) { fwrite(STDERR,"Open the Linode admin page and install its tables first.\n"); exit(1); }
(new \Cloudytek\Linode\Worker($store,new \Cloudytek\Linode\Catalog()))->tick(5);
echo "Linode queue processed\n";

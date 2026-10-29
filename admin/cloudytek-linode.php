<?php
define('ADMINAREA',true);
require dirname(__DIR__).'/init.php';
$aInt=new WHMCS\Admin('View Products/Services',false);
$aInt->title='Cloudytek Linode'; $aInt->sidebar='utilities'; $aInt->icon='servers';
require ROOTDIR.'/includes/cloudytek/linode/bootstrap.php';
use Cloudytek\Linode\Web;
use Cloudytek\Linode\Catalog;
use Cloudytek\Linode\Families;
use Cloudytek\Linode\Worker;
use Cloudytek\Linode\Api;
use Cloudytek\Linode\Policy;
$error=''; $notice=''; $response=null;
try { $actor=Web::admin(); } catch(Throwable $e) { http_response_code(403); $aInt->gracefulExit(Web::esc($e->getMessage())); exit; }
$store=Web::store(); $catalog=new Catalog();
if($_SERVER['REQUEST_METHOD']==='POST') {
    try {
        Web::csrf(); $action=isset($_POST['action'])?$_POST['action']:'';
        if($action==='install') { $store->install(); $notice='Linode integration tables are ready.'; }
        elseif(!$store->installed())throw new RuntimeException('Install the integration tables first');
        elseif($action==='save_account') {
            $store->saveAccount((int)$_POST['account_id'],trim($_POST['name']),trim($_POST['api_token']),isset($_POST['writes']),$_POST['api_version'],array('api_url'=>$_POST['api_url'],'username'=>$_POST['username'],'prefix'=>$_POST['prefix'],'backup_price'=>$_POST['backup_price']));
            $store->audit('admin:'.$actor,'save-account','settings','Account settings updated'); $notice='Account saved. Token is encrypted and is never shown again.';
        } elseif($action==='save_product') {
            $family=$_POST['family']; $payload=Web::json($_POST['payload']);
            $catalog->find('POST',Families::get($family)['collection']);
            $store->saveProduct((int)$_POST['product_id'],(int)$_POST['account_id'],$family,$payload,isset($_POST['enabled']),isset($_POST['client_actions'])?$_POST['client_actions']:array());
            $store->audit('admin:'.$actor,'save-product','product:'.(int)$_POST['product_id'],'Mapping saved'); $notice='Product mapping saved.';
        } elseif($action==='execute') {
            $id=$_POST['operation']; $op=$catalog->operation($id);
            if(($op['method']!=='GET'||isset($_POST['reveal'])) && (!isset($_POST['confirm'])||!hash_equals($id,$_POST['confirm'])))throw new RuntimeException('Type the operation ID to confirm this action');
            $body=trim($_POST['body'])!==''?json_decode($_POST['body']):null;
            if(trim($_POST['body'])!==''&&json_last_error()!==JSON_ERROR_NONE)throw new RuntimeException('Invalid request JSON');
            $encoding=isset($_POST['encoding'])?$_POST['encoding']:'application/json';
            if($encoding!=='application/json') {
                $upload=isset($_FILES['upload'])?$_FILES['upload']:null;
                if(!$upload||$upload['error']!==UPLOAD_ERR_OK||!is_uploaded_file($upload['tmp_name'])||$upload['size']>8388608)throw new RuntimeException('A valid upload under 8 MB is required');
                if($encoding==='image/png')$body=file_get_contents($upload['tmp_name']);
                elseif($encoding==='multipart/form-data') {
                    $body=(array)$body;
                    $field=isset($_POST['upload_field'])?$_POST['upload_field']:'file';
                    if(!preg_match('/^[a-zA-Z0-9_\[\]-]{1,50}$/D',$field))throw new RuntimeException('Invalid upload field name');
                    $body[$field]=new CURLFile($upload['tmp_name'],(new finfo(FILEINFO_MIME_TYPE))->file($upload['tmp_name']),basename($upload['name']));
                } else throw new RuntimeException('Unsupported encoding');
            }
            $result=$store->api((int)$_POST['account_id'],$catalog)->call($id,Web::json($_POST['path']),Web::json($_POST['query']),$body,Web::json($_POST['headers']),$encoding);
            $response=array('status'=>$result['status'],'data'=>Api::present($result['data'],isset($_POST['reveal'])));
            $store->audit('admin:'.$actor,$id,'account:'.(int)$_POST['account_id'],'HTTP '.$result['status']);
        } elseif($action==='bind') {
            $service=$store->service((int)$_POST['service_id']); $mapping=$store->product($service['packageid']);
            if(!$mapping)throw new RuntimeException('Configure this service product first');
            $def=Families::get($mapping['family']);
            $result=$store->api($mapping['account_id'],$catalog)->call($catalog->find('GET',$def['root']),Web::json($_POST['path']))['data'];
            $store->bind($service['id'],$mapping['account_id'],$mapping['family'],Families::binding($mapping['family'],$result),'provisioning');
            $store->run('UPDATE ctk_linode_jobs SET status="succeeded",error="Manually linked",updated_at=? WHERE service_id=?',array(gmdate('Y-m-d H:i:s'),$service['id']));
            $store->audit('admin:'.$actor,'bind','service:'.$service['id'],'Existing resource linked'); $notice='Resource linked; the worker will check readiness.';
        } elseif($action==='queue_invoice') {
            $count=(new Worker($store,$catalog))->queueInvoice((int)$_POST['invoice_id']); $notice=$count.' eligible service(s) queued.';
            $store->audit('admin:'.$actor,'queue-invoice','invoice:'.(int)$_POST['invoice_id'],$notice);
        } elseif($action==='tick') {
            (new Worker($store,$catalog))->tick(1); $notice='One queued job processed; resource readiness refreshed.';
        } elseif($action==='retry') {
            if($_POST['confirm']!=='RETRY '.(int)$_POST['job_id'])throw new RuntimeException('Retry confirmation does not match');
            // Uncertain/running/succeeded jobs cannot be blindly retried.
            $store->run('UPDATE ctk_linode_jobs SET status="pending",error="",updated_at=? WHERE id=? AND status="failed"',array(gmdate('Y-m-d H:i:s'),(int)$_POST['job_id']));
            $notice='Failed job reset if eligible. Uncertain jobs require reconciliation / linking.';
        } else throw new RuntimeException('Unknown action');
    } catch(Throwable $e) {
        $error=$e instanceof PDOException?'Database operation failed; review integration state.':$e->getMessage();
        if($store->installed())$store->audit('admin:'.$actor,'request','integration', $e instanceof PDOException?'Database error':'Request rejected / failed');
    }
}
header('Cache-Control: no-store');
ob_start();
function ctk_input($label,$name,$value='',$type='text') {
    echo '<label>'.Web::esc($label).'<input class="form-control" type="'.Web::esc($type).'" name="'.Web::esc($name).'" value="'.Web::esc($value).'" autocomplete="off"></label>';
}
function ctk_json($label,$name,$value='{}') { echo '<label>'.Web::esc($label).'<textarea class="form-control ctk-json" name="'.Web::esc($name).'" rows="4">'.Web::esc($value).'</textarea></label>'; }
function ctk_token() { echo '<input type="hidden" name="token" value="'.Web::esc(generate_token('plain')).'">'; }
function ctk_accounts($accounts) {
    echo '<label>Account<select class="form-control" name="account_id">';
    foreach($accounts as $row)echo '<option value="'.(int)$row['id'].'">'.Web::esc($row['name']).($row['writes_enabled']?' • writes enabled':' • read only').'</option>';
    echo '</select></label>';
}
?>
<link rel="stylesheet" href="../assets/css/cloudytek-linode.css?v=20261015-2">
<div class="ctk-linode">
<div class="ctk-hero"><div><span class="ctk-eyebrow">CLOUD SERVICE CONTROL</span><h2>Linode / Akamai Cloud</h2><p>Accounts, paid-service provisioning and the complete installed API catalogue.</p></div><span class="ctk-pill"><?php echo count($catalog->all()); ?> API operations · <?php echo Web::esc($catalog->version()); ?></span></div>
<?php if($error): ?><div class="alert alert-danger"><?php echo Web::esc($error); ?></div><?php endif; ?>
<?php if($notice): ?><div class="alert alert-success"><?php echo Web::esc($notice); ?></div><?php endif; ?>
<?php if($response!==null): ?><section class="ctk-card"><h3>API response</h3><pre><?php echo Web::esc(json_encode($response,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES)); ?></pre></section><?php endif; ?>
<?php if(!$store->installed()): ?>
<section class="ctk-card"><h3>Set up integration storage</h3><p>Create five dedicated tables for accounts, product mappings, resources, jobs and audit logs.</p><form method="post"><?php ctk_token(); ?><button class="btn btn-primary" name="action" value="install">Initialize integration</button></form></section>
<?php else:
 $tab=isset($_GET['tab']) && is_string($_GET['tab']) ? $_GET['tab'] : 'accounts';
 $tabs=array('accounts'=>'Accounts','products'=>'Product mappings','resources'=>'Services','jobs'=>'Automation','api'=>'API Explorer','audit'=>'Audit');
 if (!isset($tabs[$tab])) { $tab='accounts'; }
 $accounts=in_array($tab,array('accounts','products','api'),true)?$store->all('accounts'):array();
 $products=$tab==='products'?$store->all('products'):array();
 $resources=$tab==='resources'?$store->all('resources'):array();
 $jobs=$tab==='jobs'?$store->all('jobs'):array();
?>
<nav class="ctk-tabs"><?php foreach($tabs as $key=>$label): ?><a class="<?php echo $tab===$key?'active':''; ?>" href="cloudytek-linode.php?tab=<?php echo Web::esc($key); ?>"><?php echo Web::esc($label); ?></a><?php endforeach; ?></nav>
<?php if($tab==='accounts'): ?>
<?php
$edit=array('id'=>0,'name'=>'','username'=>'','prefix'=>'ctk','backup_price'=>'0.0000','writes_enabled'=>0,'api_version'=>'v4');
if(!empty($_GET['account_id']))foreach($accounts as $row)if((int)$row['id']===(int)$_GET['account_id'])$edit=$row;
?>
<div class="ctk-grid"><section class="ctk-card"><h3><?php echo $edit['id']?'Edit account':'Connect an account'; ?></h3><p>Use a Linode API key / bearer token. Writes are off by default.</p><form method="post" id="ctk-account-form"><?php ctk_token(); ?><input type="hidden" name="action" value="save_account"><?php ctk_input('Account ID (0 = new)','account_id',$edit['id'],'number');ctk_input('Display name','name',$edit['name']); ?>
<label>API URL<input class="form-control" name="api_url" value="https://api.linode.com/<?php echo Web::esc($edit['api_version']); ?>" readonly></label>
<?php ctk_input('API Key (leave blank to keep the existing key)','api_token','','password');ctk_input('Username (optional account reference)','username',$edit['username']);ctk_input('Prefix','prefix',$edit['prefix']);ctk_input('Backup Price (reference / month)','backup_price',$edit['backup_price']); ?>
<p class="text-muted">Username is an account reference; authentication uses API Key. Prefix names newly created resources. Backup Price stores a reference amount only; configure WHMCS paid backup options to charge customers.</p>
<label>API version<select class="form-control" name="api_version"><option<?php echo $edit['api_version']==='v4'?' selected':''; ?>>v4</option><option<?php echo $edit['api_version']==='v4beta'?' selected':''; ?>>v4beta</option></select></label><label class="ctk-check"><input type="checkbox" name="writes"<?php echo $edit['writes_enabled']?' checked':''; ?>> Enable API writes and provisioning for this account</label><button class="btn btn-primary">Save account</button></form></section>
<section class="ctk-card"><h3>Connected accounts</h3><?php if(!$accounts): ?><p>No account configured yet.</p><?php endif; ?><?php foreach($accounts as $row): ?><div class="ctk-row"><div><strong>#<?php echo (int)$row['id'].' '.Web::esc($row['name']); ?></strong><p><?php echo Web::esc($row['username']).' · Prefix: '.Web::esc($row['prefix']).' · Backup reference: '.Web::esc($row['backup_price']); ?></p><a href="cloudytek-linode.php?tab=accounts&amp;account_id=<?php echo (int)$row['id']; ?>">Edit account</a></div><span class="ctk-pill"><?php echo $row['writes_enabled']?'Writes enabled':'Read only'; ?></span></div><?php endforeach; ?><p class="text-muted">API keys stay encrypted and are never shown in this list. Additional short-lived bearer credentials may be needed for specialized monitoring operations.</p></section></div>
<script src="../assets/js/cloudytek-linode.js?v=2"></script>
<?php elseif($tab==='products'): ?>
<section class="ctk-card"><h3>Map a WHMCS product</h3><p>Configure the provider payload, then enable paid-order automation. Supported placeholders: {{service_id}}, {{client_id}}, {{domain}}, {{password}}. Non-domain labels are generated uniquely for reconciliation.</p><form method="post"><?php ctk_token(); ?><input type="hidden" name="action" value="save_product"><?php ctk_input('Existing WHMCS product ID','product_id','','number');ctk_accounts($accounts); ?><label>Resource family<select class="form-control" name="family"><?php foreach(Families::all() as $key=>$def): ?><option><?php echo Web::esc($key); ?></option><?php endforeach; ?></select></label><?php ctk_json('Creation payload (provider required fields)','payload','{"region":"ap-south","type":"g6-standard-1","image":"linode/ubuntu24.04","root_pass":"{{password}}","backups_enabled":false}'); ?><label class="ctk-check"><input type="checkbox" name="enabled"> Automatically provision eligible new services after payment</label><h4>Optional customer actions</h4><?php foreach(Policy::possibleWrites() as $id=>$fields): ?><label class="ctk-check"><input type="checkbox" name="client_actions[]" value="<?php echo Web::esc($id); ?>"> <?php echo Web::esc($id); ?></label><?php endforeach; ?><p class="text-muted">Enable paid options only when included in the sold package. Resource deletion, resizing and account operations stay admin-only.</p><button class="btn btn-primary">Save mapping</button></form></section>
<section class="ctk-card"><h3>Mapped products</h3><table class="table"><thead><tr><th>Product</th><th>Account</th><th>Family</th><th>Automation</th></tr></thead><tbody><?php foreach($products as $row): ?><tr><td><?php echo (int)$row['product_id']; ?></td><td><?php echo (int)$row['account_id']; ?></td><td><?php echo Web::esc($row['family']); ?></td><td><?php echo $row['enabled']?'Enabled':'Disabled'; ?></td></tr><?php endforeach; ?></tbody></table></section>
<?php elseif($tab==='resources'): ?>
<section class="ctk-card"><h3>Linked services</h3><table class="table"><thead><tr><th>Service</th><th>Client</th><th>Family</th><th>Resource</th><th>State</th></tr></thead><tbody><?php foreach($resources as $row): ?><tr><td><a href="clientsservices.php?id=<?php echo (int)$row['service_id']; ?>"><?php echo (int)$row['service_id']; ?></a></td><td><?php echo (int)$row['client_id']; ?></td><td><?php echo Web::esc($row['family']); ?></td><td><?php echo Web::esc($row['path_json']); ?></td><td><?php echo Web::esc($row['state']); ?></td></tr><?php endforeach; ?></tbody></table></section>
<section class="ctk-card"><h3>Link an existing provider resource</h3><p>Configure the product mapping first. The integration verifies the resource through its mapped provider account before binding it to the service owner.</p><form method="post"><?php ctk_token(); ?><input type="hidden" name="action" value="bind"><?php ctk_input('WHMCS service ID','service_id','','number');ctk_json('Resource path parameters','path','{"linodeId":"123"}'); ?><button class="btn btn-primary">Verify and link</button></form></section>
<?php elseif($tab==='jobs'): ?>
<section class="ctk-card"><h3>Paid-service automation</h3><p>InvoicePaid queues eligible Pending services. Cron processes jobs and checks readiness. Ambiguous writes are held for reconciliation and never automatically created again.</p><form method="post" class="ctk-inline"><?php ctk_token();ctk_input('Paid invoice ID','invoice_id','','number'); ?><button class="btn btn-primary" name="action" value="queue_invoice">Queue eligible services</button></form><form method="post"><?php ctk_token(); ?><button class="btn btn-default" name="action" value="tick">Process one job / refresh readiness</button></form><table class="table"><thead><tr><th>Job</th><th>Service</th><th>Family</th><th>State</th><th>Details</th></tr></thead><tbody><?php foreach($jobs as $row): ?><tr><td><?php echo (int)$row['id']; ?></td><td><?php echo (int)$row['service_id']; ?></td><td><?php echo Web::esc($row['family']); ?></td><td><?php echo Web::esc($row['status']); ?></td><td><?php echo Web::esc($row['error']); ?></td></tr><?php endforeach; ?></tbody></table></section><section class="ctk-card"><h3>Retry a failed preflight job</h3><form method="post"><?php ctk_token(); ?><input type="hidden" name="action" value="retry"><?php ctk_input('Job ID','job_id','','number');ctk_input('Confirmation: RETRY followed by job ID','confirm'); ?><button class="btn btn-default">Retry eligible failed job</button></form><p>For reconcile jobs, locate the generated correlation label in Linode / API Explorer and link the existing resource on the Services tab. If no resource exists, review the provider result before resolving it.</p></section>
<?php elseif($tab==='api'): ?>
<section class="ctk-card"><h3>Full API Explorer</h3><p>Select an operation to see its parameters and JSON schema. All installed catalogue operations are accessible to authorized administrators; actual availability depends on your account, region and API scopes.</p><input class="form-control" id="ctk-operation-filter" placeholder="Search by service, operation or endpoint"><form method="post" id="ctk-api-form" enctype="multipart/form-data"><?php ctk_token(); ?><input type="hidden" name="action" value="execute"><?php ctk_accounts($accounts); ?><label>API operation<select class="form-control" name="operation" id="ctk-operation"><?php foreach($catalog->all() as $op): ?><option value="<?php echo Web::esc($op['id']); ?>"><?php echo Web::esc($op['method'].' '.$op['path'].' — '.$op['title']); ?></option><?php endforeach; ?></select></label><div class="ctk-operation-help"></div><div class="ctk-grid"><?php ctk_json('Path parameters','path');ctk_json('Query parameters','query');ctk_json('Declared headers (e.g. X-Filter)','headers');ctk_json('Request body (leave blank for no body)','body',''); ?></div><label>Body encoding<select class="form-control" name="encoding"><option>application/json</option><option>multipart/form-data</option><option>image/png</option></select></label><label>File upload (for PNG / multipart operations)<input class="form-control" type="file" name="upload"></label><?php ctk_input('Multipart upload field name','upload_field','file');ctk_input('For writes / sensitive output, type the selected operation ID','confirm'); ?><label class="ctk-check"><input type="checkbox" name="reveal"> Show sensitive API response (confirmation required)</label><button class="btn btn-primary">Execute selected operation</button></form><details><summary>Request schema</summary><pre id="ctk-schema"></pre></details></section>
<script>window.ctkLinodeCatalog=<?php echo json_encode($catalog->all(),JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT|JSON_HEX_APOS); ?>;</script><script src="../assets/js/cloudytek-linode.js?v=1"></script>
<?php elseif($tab==='audit'): ?>
<section class="ctk-card"><h3>Integration audit</h3><table class="table"><thead><tr><th>Time UTC</th><th>Actor</th><th>Operation</th><th>Subject</th><th>Outcome</th></tr></thead><tbody><?php foreach($store->all('audit') as $row): ?><tr><?php foreach(array('created_at','actor','operation','subject','outcome') as $field): ?><td><?php echo Web::esc($row[$field]); ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody></table></section>
<?php endif; endif; ?>
</div>
<?php $aInt->content=ob_get_clean();$aInt->display(); ?>

<?php
define('ADMINAREA',true);
require dirname(__DIR__).'/init.php';
$admin=new WHMCS\Admin('loginonly');
header('Content-Type: application/json; charset=utf-8');header('Cache-Control: no-store');
function ctk_overview_permission($admin,$name){try{return $admin->hasPermission($name);}catch(Throwable $e){return false;}}
try {
    if(!ctk_overview_permission($admin,'Main Homepage')){http_response_code(403);echo json_encode(array('error'=>'Overview permission is required'));exit;}
    $db=WHMCS\Database\Capsule::connection()->getPdo();
    $count=function($sql)use($db){return (int)$db->query($sql)->fetchColumn();};
    $metrics=array();$orders=array();$activity=array();$cloud=null;
    if(ctk_overview_permission($admin,'List Clients'))$metrics[]=array('key'=>'clients','label'=>'Active clients','value'=>$count("SELECT COUNT(*) FROM tblclients WHERE status='Active'"),'total'=>$count('SELECT COUNT(*) FROM tblclients'),'href'=>'clients.php?status=Active');
    if(ctk_overview_permission($admin,'List Services'))$metrics[]=array('key'=>'services','label'=>'Active services','value'=>$count("SELECT COUNT(*) FROM tblhosting WHERE domainstatus='Active'"),'total'=>$count('SELECT COUNT(*) FROM tblhosting'),'href'=>'index.php?rp=/admin/services');
    $canOrders=ctk_overview_permission($admin,'View Orders');
    if($canOrders){
        $metrics[]=array('key'=>'orders','label'=>'Pending orders','value'=>$count("SELECT COUNT(*) FROM tblorders WHERE status='Pending'"),'total'=>$count('SELECT COUNT(*) FROM tblorders'),'href'=>'orders.php?status=Pending');
        $showClients=ctk_overview_permission($admin,'List Clients');
        $query=$db->query('SELECT o.id,o.ordernum,o.date,o.status'.($showClients?',c.firstname,c.lastname,c.companyname':'').' FROM tblorders o'.($showClients?' LEFT JOIN tblclients c ON c.id=o.userid':'').' ORDER BY o.id DESC LIMIT 6');
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row)$orders[]=array('id'=>(int)$row['id'],'number'=>$row['ordernum'],'date'=>$row['date'],'status'=>$row['status'],'customer'=>$showClients?(trim($row['firstname'].' '.$row['lastname'])?:'Client'):'Customer','company'=>$showClients?$row['companyname']:'');
        $from=gmdate('Y-m-d',strtotime('-6 days'));$statement=$db->prepare('SELECT DATE(date) AS day,COUNT(*) AS total FROM tblorders WHERE date>=? GROUP BY DATE(date)');$statement->execute(array($from));$daily=array();foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $row)$daily[$row['day']]=(int)$row['total'];
        for($i=6;$i>=0;$i--){$day=gmdate('Y-m-d',strtotime('-'.$i.' days'));$activity[]=array('day'=>$day,'label'=>gmdate('D',strtotime($day)),'value'=>isset($daily[$day])?$daily[$day]:0);}
    }
    if(ctk_overview_permission($admin,'List Invoices'))$metrics[]=array('key'=>'invoices','label'=>'Overdue invoices','value'=>$count("SELECT COUNT(*) FROM tblinvoices WHERE status='Unpaid' AND duedate<CURRENT_DATE"),'total'=>$count('SELECT COUNT(*) FROM tblinvoices'),'href'=>'invoices.php?status=Overdue');
    if(ctk_overview_permission($admin,'View Products/Services')) {
        require ROOTDIR.'/includes/cloudytek/linode/bootstrap.php';
        try{Cloudytek\Linode\Web::admin();$store=Cloudytek\Linode\Web::store();
            if($store->installed())$cloud=array('accounts'=>$count('SELECT COUNT(*) FROM ctk_linode_accounts'),'resources'=>$count('SELECT COUNT(*) FROM ctk_linode_resources'),'pending'=>$count("SELECT COUNT(*) FROM ctk_linode_jobs WHERE status IN ('pending','running')"),'review'=>$count("SELECT COUNT(*) FROM ctk_linode_jobs WHERE status IN ('failed','reconcile')"));
        }catch(Throwable $e){}
    }
    echo json_encode(array('metrics'=>$metrics,'orders'=>$orders,'activity'=>$activity,'cloud'=>$cloud,'canOrders'=>$canOrders,'generatedAt'=>gmdate('c')),JSON_UNESCAPED_UNICODE);
}catch(Throwable $e){http_response_code(500);echo json_encode(array('error'=>'Overview is temporarily unavailable'));}

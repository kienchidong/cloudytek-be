<?php
namespace Cloudytek\ReactPortal;
use WHMCS\Database\Capsule;

/** Session-owned, read-only projection. Never accept a client ID from the request. */
function data() {
    $uid = (int)\WHMCS\Session::get('uid');
    if (!$uid || \WHMCS\Session::get('cid')) { throw new \RuntimeException('Authentication required'); }
    $client = Capsule::table('tblclients')->where('id', $uid)->first();
    if (!$client) { throw new \RuntimeException('Authentication required'); }
    require_once ROOTDIR.'/includes/cloudytek/wallet.php';
    $wallet = \Cloudytek\Wallet::view($uid);
    $services = array();
    foreach (Capsule::table('tblhosting')->join('tblproducts','tblproducts.id','=','tblhosting.packageid')
        ->where('tblhosting.userid',$uid)->where('tblhosting.domainstatus','Active')
        ->orderBy('tblhosting.id','desc')->limit(5)->get(array('tblhosting.id','tblhosting.domain','tblproducts.name','tblproducts.type')) as $row) {
        $services[] = array('id'=>(string)$row->id,'name'=>$row->domain ?: $row->name,'category'=>$row->name,'status'=>'active');
    }
    $tickets = array();
    foreach (Capsule::table('tbltickets')->where('userid',$uid)->orderBy('lastreply','desc')->limit(5)->get(array('id','tid','c','title','status','lastreply','date')) as $row) {
        $tickets[] = array('id'=>(string)$row->id,'subject'=>$row->title,'status'=>$row->status==='Closed'?'closed':($row->status==='Open'?'open':'pending'),
            'updatedAt'=>date('c',strtotime($row->lastreply ?: $row->date)), 'url'=>'/viewticket?tid='.rawurlencode($row->tid).'&c='.rawurlencode($row->c));
    }
    $news = array();
    foreach (Capsule::table('tblannouncements')->where('published',1)->where('date','<=',date('Y-m-d H:i:s'))->orderBy('date','desc')->limit(5)->get(array('id','title','date')) as $row) {
        $news[] = array('id'=>(string)$row->id,'title'=>html_entity_decode(strip_tags($row->title),ENT_QUOTES,'UTF-8'),'publishedAt'=>date('c',strtotime($row->date)));
    }
    return array(
        'me'=>array('id'=>(string)$uid,'name'=>trim($client->firstname.' '.$client->lastname),'email'=>$client->email,
            'primaryBalance'=>$wallet['main']/100,'promotionalBalance'=>$wallet['promo']/100,'secondaryBalance'=>$wallet['promo']/100,
            'currency'=>$wallet['code']),
        'summary'=>array('serviceCount'=>Capsule::table('tblhosting')->where('userid',$uid)->where('domainstatus','Active')->count(),
            'domainCount'=>Capsule::table('tbldomains')->where('userid',$uid)->where('status','Active')->count(),
            'supportTicketCount'=>Capsule::table('tbltickets')->where('userid',$uid)->where('status','!=','Closed')->count(),
            'invoiceCount'=>Capsule::table('tblinvoices')->where('userid',$uid)->where('status','Unpaid')->count(),
            'billingCount'=>Capsule::table('tblinvoices')->where('userid',$uid)->where('status','Unpaid')->count()),
        'services'=>$services, 'tickets'=>$tickets, 'news'=>$news
    );
}

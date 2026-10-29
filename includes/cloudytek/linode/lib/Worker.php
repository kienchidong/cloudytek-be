<?php
namespace Cloudytek\Linode;
class Worker
{
    private $store;
    private $catalog;
    private $factory;
    public function __construct(Store $store, Catalog $catalog, callable $factory=null) { $this->store=$store; $this->catalog=$catalog; $this->factory=$factory; }
    private function api($account) { return $this->factory?call_user_func($this->factory,$account):$this->store->api($account,$this->catalog); }
    public static function substitute($value,array $values)
    {
        if(is_array($value)) { foreach($value as $k=>$v)$value[$k]=self::substitute($v,$values); return $value; }
        return is_string($value)?strtr($value,$values):$value;
    }
    public function queueInvoice($invoiceId)
    {
        $invoice=$this->store->run('SELECT * FROM tblinvoices WHERE id=? AND status="Paid"',array($invoiceId))->fetch(\PDO::FETCH_ASSOC);
        if(!$invoice)return 0;
        $items=$this->store->run('SELECT DISTINCT relid FROM tblinvoiceitems WHERE invoiceid=? AND type="Hosting"',array($invoiceId))->fetchAll(\PDO::FETCH_COLUMN); $count=0;
        foreach($items as $id) {
            $service=$this->store->service($id); $product=$this->store->product($service['packageid']);
            if(!$product || !$product['enabled'] || $service['domainstatus']!=='Pending' || (int)$service['userid']!==(int)$invoice['userid'] || $this->store->resource($id))continue;
            $order=$this->store->run('SELECT status FROM tblorders WHERE id=?',array($service['orderid']))->fetchColumn();
            if(in_array($order,array('Fraud','Cancelled'),true))continue;
            $account=$this->store->account($product['account_id']);
            $prefix=isset($account['prefix'])?$account['prefix']:'ctk';
            $correlation=$prefix.'-s'.$id.'-'.bin2hex(random_bytes(4));
            $payload=json_decode(Vault::open($product['payload_cipher']),true);
            if(strpos(json_encode($payload),'{{password}}')!==false && decrypt($service['password'])==='') {
                $password='Aa9!'.bin2hex(random_bytes(16));
                $this->store->run('UPDATE tblhosting SET password=? WHERE id=? AND password=?',array(encrypt($password),$id,$service['password']));
                $service=$this->store->service($id);
            }
            $payload=self::substitute($payload,array('{{service_id}}'=>(string)$id,'{{client_id}}'=>(string)$service['userid'],'{{domain}}'=>$service['domain'],'{{password}}'=>decrypt($service['password'])));
            if($product['family']!=='domain')$payload['label']=$correlation;
            if($product['family']==='domain' && empty($payload['domain']))throw new \RuntimeException('Domain name is required');
            if($product['family']==='linode' && empty($payload['authorized_keys']) && empty($payload['root_pass']))throw new \RuntimeException('Configure SSH keys or a service root password');
            $q=$this->store->run('INSERT IGNORE INTO ctk_linode_jobs(service_id,invoice_id,client_id,account_id,family,correlation,payload_cipher,status,updated_at) VALUES(?,?,?,?,?,?,?,"pending",?)',array($id,$invoiceId,$service['userid'],$product['account_id'],$product['family'],$correlation,Vault::seal(json_encode($payload)),gmdate('Y-m-d H:i:s')));
            $count+=$q->rowCount();
        }
        return $count;
    }
    public function tick($limit=5)
    {
        $this->store->run('UPDATE ctk_linode_jobs SET status="reconcile",error="Worker interrupted; reconcile before retry" WHERE status="running" AND updated_at < ?',array(gmdate('Y-m-d H:i:s',time()-180)));
        $jobs=$this->store->run('SELECT * FROM ctk_linode_jobs WHERE status="pending" ORDER BY id LIMIT '.max(1,min(10,(int)$limit)))->fetchAll(\PDO::FETCH_ASSOC);
        foreach($jobs as $job) {
            $claimed=$this->store->run('UPDATE ctk_linode_jobs SET status="running",updated_at=? WHERE id=? AND status="pending"',array(gmdate('Y-m-d H:i:s'),$job['id']));
            if(!$claimed->rowCount())continue;
            $issued=false;
            try {
                $service=$this->store->service($job['service_id']);
                if((int)$service['userid']!==(int)$job['client_id'] || $service['domainstatus']!=='Pending')throw new \RuntimeException('Service is no longer eligible');
                if(!$this->store->run('SELECT id FROM tblinvoices WHERE id=? AND userid=? AND status="Paid"',array($job['invoice_id'],$job['client_id']))->fetchColumn())throw new \RuntimeException('Invoice is no longer paid');
                $account=$this->store->account($job['account_id']);
                if(!$account['writes_enabled']||Vault::open($account['token_cipher'])==='')throw new \RuntimeException('Account writes / token are not configured');
                $order=$this->store->run('SELECT status FROM tblorders WHERE id=?',array($service['orderid']))->fetchColumn();
                if(in_array($order,array('Fraud','Cancelled'),true))throw new \RuntimeException('Order is blocked');
                if($this->store->resource($job['service_id'])) { $this->finish($job,'succeeded','Already bound'); continue; }
                $def=Families::get($job['family']); $operation=$this->catalog->find('POST',$def['collection']);
                $api=$this->api($job['account_id']); $payload=json_decode(Vault::open($job['payload_cipher']),true);
                $issued=true;
                $result=$api->call($operation,array(),array(),(object)$payload)['data'];
                $path=Families::binding($job['family'],$result);
                $this->store->bind($job['service_id'],$job['account_id'],$job['family'],$path);
                $this->finish($job,'succeeded','');
                $this->store->audit('worker',$operation,'service:'.$job['service_id'],'Resource created; readiness pending');
            } catch(\Throwable $e) {
                // An issued mutation is never automatically repeated, including 5xx/timeouts.
                $this->finish($job,$issued?'reconcile':'failed',substr($e->getMessage(),0,255));
            }
        }
        $this->poll();
    }
    private function finish(array $job,$status,$error)
    {
        $this->store->run('UPDATE ctk_linode_jobs SET status=?,error=?,updated_at=? WHERE id=?',array($status,$error,gmdate('Y-m-d H:i:s'),$job['id']));
    }
    public function poll()
    {
        $rows=$this->store->run('SELECT * FROM ctk_linode_resources WHERE state="provisioning" ORDER BY last_checked_at ASC LIMIT 3')->fetchAll(\PDO::FETCH_ASSOC);
        foreach($rows as $row) {
            $this->store->run('UPDATE ctk_linode_resources SET last_checked_at=? WHERE service_id=?',array(gmdate('Y-m-d H:i:s'),$row['service_id']));
            try {
                $def=Families::get($row['family']); $result=$this->api($row['account_id'])->call($this->catalog->find('GET',$def['root']),json_decode($row['path_json'],true))['data'];
                $status=isset($result['status'])?$result['status']:'ready';
                if($row['family']==='lke') {
                    $pools=$this->api($row['account_id'])->call($this->catalog->find('GET',$def['root'].'/pools'),json_decode($row['path_json'],true))['data'];
                    $nodes=array();foreach(isset($pools['data'])?$pools['data']:array() as $pool)foreach(isset($pool['nodes'])?$pool['nodes']:array() as $node)$nodes[]=$node;
                    if(!$nodes)$status='provisioning';
                    foreach($nodes as $node)if(!isset($node['status'])||$node['status']!=='ready')$status='provisioning';
                }
                if(in_array($status,array('running','active','ready','offline'),true)) {
                    $this->store->run('UPDATE ctk_linode_resources SET state="active" WHERE service_id=?',array($row['service_id']));
                    $this->store->run('UPDATE tblhosting SET domainstatus="Active" WHERE id=? AND userid=? AND domainstatus="Pending"',array($row['service_id'],$row['client_id']));
                    if($row['family']==='linode' && !empty($result['ipv4'][0]))$this->store->run('UPDATE tblhosting SET dedicatedip=? WHERE id=?',array($result['ipv4'][0],$row['service_id']));
                    $this->store->audit('worker','ready','service:'.$row['service_id'],'Service ready');
                }
            } catch(\Throwable $e) { $this->store->audit('worker','poll','service:'.$row['service_id'],'Provider state unavailable'); }
        }
    }
}

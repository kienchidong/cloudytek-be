<?php
namespace Cloudytek\Linode;
class Store
{
    private $db;
    private $installed;
    public function __construct(\PDO $db) { $this->db=$db; }
    public function installed()
    {
        if ($this->installed !== null) { return $this->installed; }
        try { $this->db->query('SELECT id FROM ctk_linode_accounts LIMIT 1'); return $this->installed = true; }
        catch (\PDOException $e) { return $this->installed = false; }
    }
    public function install()
    {
        $sql = array(
            'CREATE TABLE IF NOT EXISTS ctk_linode_accounts (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, token_cipher TEXT NOT NULL, writes_enabled TINYINT NOT NULL DEFAULT 0, api_version VARCHAR(10) NOT NULL DEFAULT "v4")',
            'CREATE TABLE IF NOT EXISTS ctk_linode_products (product_id INT UNSIGNED PRIMARY KEY, account_id INT UNSIGNED NOT NULL, family VARCHAR(30) NOT NULL, payload_cipher MEDIUMTEXT NOT NULL, enabled TINYINT NOT NULL DEFAULT 0, actions_json TEXT NOT NULL)',
            'CREATE TABLE IF NOT EXISTS ctk_linode_resources (service_id INT UNSIGNED PRIMARY KEY, client_id INT UNSIGNED NOT NULL, account_id INT UNSIGNED NOT NULL, family VARCHAR(30) NOT NULL, resource_key VARCHAR(200) NOT NULL, path_json TEXT NOT NULL, state VARCHAR(40) NOT NULL, last_checked_at DATETIME NULL, UNIQUE KEY provider_resource (account_id,family,resource_key))',
            'CREATE TABLE IF NOT EXISTS ctk_linode_jobs (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, service_id INT UNSIGNED NOT NULL UNIQUE, invoice_id INT UNSIGNED NOT NULL, client_id INT UNSIGNED NOT NULL, account_id INT UNSIGNED NOT NULL, family VARCHAR(30) NOT NULL, correlation VARCHAR(64) NOT NULL, payload_cipher MEDIUMTEXT NOT NULL, status VARCHAR(30) NOT NULL, error VARCHAR(255) NOT NULL DEFAULT "", updated_at DATETIME NOT NULL, INDEX job_state(status,updated_at))',
            'CREATE TABLE IF NOT EXISTS ctk_linode_audit (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, actor VARCHAR(60) NOT NULL, operation VARCHAR(120) NOT NULL, subject VARCHAR(120) NOT NULL, outcome VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL)'
        );
        foreach($sql as $query) { $this->db->exec($query . ' ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'); }
        $accountColumns=array('username'=>"VARCHAR(100) NOT NULL DEFAULT ''",'prefix'=>"VARCHAR(10) NOT NULL DEFAULT 'ctk'",'backup_price'=>"DECIMAL(16,4) NOT NULL DEFAULT 0");
        foreach($accountColumns as $column=>$definition) {
            if(!$this->db->query("SHOW COLUMNS FROM ctk_linode_accounts LIKE '".$column."'")->fetch())$this->db->exec('ALTER TABLE ctk_linode_accounts ADD `'.$column.'` '.$definition);
        }
        if(!$this->db->query("SHOW COLUMNS FROM ctk_linode_resources LIKE 'last_checked_at'")->fetch())$this->db->exec('ALTER TABLE ctk_linode_resources ADD last_checked_at DATETIME NULL');
        $this->installed = true;
    }
    public function run($sql, array $values=array()) { $q=$this->db->prepare($sql); $q->execute($values); return $q; }
    public function all($table)
    {
        if (!in_array($table,array('accounts','products','resources','jobs','audit'),true)) { throw new \InvalidArgumentException('Invalid table'); }
        $order=$table==='products'?'product_id':($table==='resources'?'service_id':'id');
        return $this->run('SELECT * FROM ctk_linode_'.$table.' ORDER BY '.$order.' DESC LIMIT 500')->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function account($id) { $r=$this->run('SELECT * FROM ctk_linode_accounts WHERE id=?',array($id))->fetch(\PDO::FETCH_ASSOC); if(!$r)throw new \RuntimeException('Account not found'); return $r; }
    public function api($id, Catalog $catalog)
    {
        $row=$this->account($id);
        return new Api($catalog, Vault::open($row['token_cipher']), (bool)$row['writes_enabled'], null, $row['api_version']);
    }
    public function saveAccount($id,$name,$token,$writes,$version,array $options=array())
    {
        if (strlen($name)<1 || strlen($name)>100 || !in_array($version,array('v4','v4beta'),true))throw new \InvalidArgumentException('Invalid account settings');
        if(isset($options['api_url'])&&rtrim($options['api_url'],'/')!=='https://api.linode.com/'.$version)throw new \InvalidArgumentException('API URL must match the official Linode API and selected version');
        $old=$id?$this->account($id):array('username'=>'','prefix'=>'ctk','backup_price'=>'0');
        $username=isset($options['username'])?trim($options['username']):$old['username'];
        $prefix=isset($options['prefix'])?rtrim(trim($options['prefix']),'-'):$old['prefix'];
        $price=isset($options['backup_price'])?trim((string)$options['backup_price']):$old['backup_price'];
        if(strlen($username)>100||preg_match('/[\x00-\x1f\x7f]/',$username))throw new \InvalidArgumentException('Invalid username');
        if(!preg_match('/^[a-z][a-z0-9-]{0,9}$/D',$prefix))throw new \InvalidArgumentException('Prefix must be 1–10 lowercase letters, numbers or hyphens, starting with a letter');
        if(!preg_match('/^[0-9]{1,10}(?:\.[0-9]{1,4})?$/D',$price))throw new \InvalidArgumentException('Backup Price must be a non-negative amount with up to four decimal places');
        if($id) {
            $cipher=$token!==''?Vault::seal($token):$old['token_cipher'];
            $this->run('UPDATE ctk_linode_accounts SET name=?,token_cipher=?,writes_enabled=?,api_version=?,username=?,prefix=?,backup_price=? WHERE id=?',array($name,$cipher,(int)$writes,$version,$username,$prefix,$price,$id));
        } else {
            if($token==='')throw new \InvalidArgumentException('A token is required');
            $this->run('INSERT INTO ctk_linode_accounts(name,token_cipher,writes_enabled,api_version,username,prefix,backup_price) VALUES(?,?,?,?,?,?,?)',array($name,Vault::seal($token),(int)$writes,$version,$username,$prefix,$price));
        }
    }
    public function product($id) { return $this->run('SELECT * FROM ctk_linode_products WHERE product_id=?',array($id))->fetch(\PDO::FETCH_ASSOC); }
    public function saveProduct($id,$account,$family,array $payload,$enabled,array $actions)
    {
        $this->account($account); Families::get($family);
        $native=$this->run('SELECT servertype,autosetup FROM tblproducts WHERE id=?',array($id))->fetch(\PDO::FETCH_ASSOC);
        if(!$native)throw new \RuntimeException('WHMCS product not found');
        if($enabled && ($native['servertype']!==''||!in_array($native['autosetup'],array('','off'),true)))throw new \RuntimeException('Set the native product module to None and disable native automatic setup before enabling direct provisioning');
        foreach($actions as $action)if(!isset(Policy::possibleWrites()[$action]))throw new \RuntimeException('Unknown client action');
        $this->run('INSERT INTO ctk_linode_products VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE account_id=VALUES(account_id),family=VALUES(family),payload_cipher=VALUES(payload_cipher),enabled=VALUES(enabled),actions_json=VALUES(actions_json)',array($id,$account,$family,Vault::seal(json_encode($payload)),(int)$enabled,json_encode($actions)));
    }
    public function resource($service) { return $this->run('SELECT * FROM ctk_linode_resources WHERE service_id=?',array($service))->fetch(\PDO::FETCH_ASSOC); }
    public function service($id) { $r=$this->run('SELECT * FROM tblhosting WHERE id=?',array($id))->fetch(\PDO::FETCH_ASSOC); if(!$r)throw new \RuntimeException('Service not found'); return $r; }
    public function bind($service,$account,$family,array $path,$state='provisioning')
    {
        $hosting=$this->service($service);
        preg_match_all('/\{([^}]+)\}/',Families::get($family)['root'],$matches);
        if(array_diff($matches[1],array_keys($path))||array_diff(array_keys($path),$matches[1]))throw new \InvalidArgumentException('Invalid resource binding fields');
        $path=array_map('strval',$path);ksort($path);$key=json_encode($path);
        $old=$this->resource($service);
        if($old) {
            if((int)$old['account_id']!==(int)$account || $old['family']!==$family || $old['resource_key']!==$key)throw new \RuntimeException('Service is already bound to another resource');
            return;
        }
        $this->run('INSERT INTO ctk_linode_resources(service_id,client_id,account_id,family,resource_key,path_json,state) VALUES(?,?,?,?,?,?,?)',array($service,$hosting['userid'],$account,$family,$key,$key,$state));
    }
    public function audit($actor,$operation,$subject,$outcome)
    {
        $this->run('INSERT INTO ctk_linode_audit(actor,operation,subject,outcome,created_at) VALUES(?,?,?,?,?)',array(substr($actor,0,60),substr($operation,0,120),substr($subject,0,120),substr($outcome,0,255),gmdate('Y-m-d H:i:s')));
    }
}

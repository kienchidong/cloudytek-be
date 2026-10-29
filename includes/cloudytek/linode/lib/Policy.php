<?php
namespace Cloudytek\Linode;
class Policy
{
    public static function possibleWrites()
    {
        return array(
            'post-boot-linode-instance'=>array('config_id'), 'post-shutdown-linode-instance'=>array(),
            'post-reboot-linode-instance'=>array('config_id'),
            'post-rebuild-linode-instance'=>array('image','root_pass','authorized_keys'),
            'post-reset-disk-password'=>array('password'), 'post-reset-linode-password'=>array('root_pass'),
            'post-snapshot'=>array('label'),
            'post-restore-backup'=>array('linode_id','overwrite'),
            'post-add-linode-ip'=>array('type','public'), 'put-ip'=>array('rdns'),
            'post-enable-backups'=>array(), 'post-cancel-backups'=>array(),
            'post-domain-record'=>array('type','name','target','priority','weight','port','ttl_sec','protocol','service','tag'),
            'put-domain-record'=>array('name','target','priority','weight','port','ttl_sec','protocol','service','tag'),
            'delete-domain-record'=>array()
        );
    }
    public static function authorize(Catalog $catalog, array $resource, array $service, $clientId, $id, array $path, $body, array $allowed)
    {
        if ((int)$service['userid'] !== (int)$clientId || (int)$resource['client_id'] !== (int)$clientId || (int)$resource['service_id'] !== (int)$service['id']) {
            throw new \RuntimeException('Access denied');
        }
        $op = $catalog->operation($id); $root = '/{apiVersion}' . Families::get($resource['family'])['root'];
        $rdns=$id==='put-ip'&&$resource['family']==='linode';
        if (!$rdns && $op['path'] !== $root && strpos($op['path'], $root . '/') !== 0) { throw new \RuntimeException('Operation is outside this service'); }
        $bound = json_decode($resource['path_json'], true);
        foreach ($bound as $name=>$value) {
            if (isset($path[$name]) && (string)$path[$name] !== (string)$value) { throw new \RuntimeException('Resource identifiers cannot be changed'); }
            $path[$name] = $value;
        }
        if ($op['method'] !== 'GET') {
            $writes = self::possibleWrites();
            if ($service['domainstatus'] !== 'Active' || !isset($writes[$id]) || !in_array($id, $allowed, true)) {
                throw new \RuntimeException('This action is not enabled for this service');
            }
            $fields = (array)$body;
            foreach ($fields as $name=>$value) {
                if (!in_array($name, $writes[$id], true)) { throw new \RuntimeException('Field is not permitted: ' . $name); }
            }
            // config_id references an existing owned profile, not an arbitrary provider resource.
            if (isset($fields['config_id']) && !preg_match('/^[1-9][0-9]*$/D',(string)$fields['config_id'])) { throw new \RuntimeException('Invalid profile identifier'); }
            if($id==='post-restore-backup'&&(!isset($fields['linode_id'])||(string)$fields['linode_id']!==(string)$bound['linodeId']))throw new \RuntimeException('A backup can only be restored onto this service');
        }
        $catalog->path($id,$path);
        return $path;
    }
}

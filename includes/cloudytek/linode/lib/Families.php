<?php
namespace Cloudytek\Linode;
class Families
{
    public static function all()
    {
        return array(
            'linode' => array('collection'=>'/linode/instances','root'=>'/linode/instances/{linodeId}','key'=>'linodeId'),
            'volume' => array('collection'=>'/volumes','root'=>'/volumes/{volumeId}','key'=>'volumeId'),
            'domain' => array('collection'=>'/domains','root'=>'/domains/{domainId}','key'=>'domainId'),
            'firewall' => array('collection'=>'/networking/firewalls','root'=>'/networking/firewalls/{firewallId}','key'=>'firewallId'),
            'vpc' => array('collection'=>'/vpcs','root'=>'/vpcs/{vpcId}','key'=>'vpcId'),
            'nodebalancer' => array('collection'=>'/nodebalancers','root'=>'/nodebalancers/{nodeBalancerId}','key'=>'nodeBalancerId'),
            'lke' => array('collection'=>'/lke/clusters','root'=>'/lke/clusters/{clusterId}','key'=>'clusterId'),
            'mysql' => array('collection'=>'/databases/mysql/instances','root'=>'/databases/mysql/instances/{mysqlInstanceId}','key'=>'mysqlInstanceId'),
            'postgresql' => array('collection'=>'/databases/postgresql/instances','root'=>'/databases/postgresql/instances/{postgresqlInstanceId}','key'=>'postgresqlInstanceId'),
            'valkey' => array('collection'=>'/databases/valkey/instances','root'=>'/databases/valkey/instances/{valkeyInstanceId}','key'=>'valkeyInstanceId'),
            'bucket' => array('collection'=>'/object-storage/buckets','root'=>'/object-storage/buckets/{regionId}/{bucket}','key'=>'bucket'),
            'longview' => array('collection'=>'/longview/clients','root'=>'/longview/clients/{clientId}','key'=>'clientId'),
            'stackscript' => array('collection'=>'/linode/stackscripts','root'=>'/linode/stackscripts/{stackscriptId}','key'=>'stackscriptId'),
            'image' => array('collection'=>'/images','root'=>'/images/{imageId}','key'=>'imageId')
        );
    }
    public static function get($family)
    {
        $all = self::all();
        if (!isset($all[$family])) { throw new \InvalidArgumentException('Unknown resource family'); }
        return $all[$family];
    }
    public static function binding($family, array $resource)
    {
        $def = self::get($family);
        if ($family === 'bucket') {
            $region = isset($resource['region']) ? $resource['region'] : (isset($resource['cluster']) ? $resource['cluster'] : null);
            if (!$region || empty($resource['label'])) { throw new \RuntimeException('Bucket response has no region/label'); }
            return array('regionId'=>$region,'bucket'=>$resource['label']);
        }
        if (!isset($resource['id'])) { throw new \RuntimeException('Provider response has no resource ID'); }
        return array($def['key'] => (string) $resource['id']);
    }
}

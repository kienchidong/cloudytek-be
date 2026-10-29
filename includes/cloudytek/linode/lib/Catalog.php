<?php
namespace Cloudytek\Linode;

class Catalog
{
    private $data;
    public function __construct($file = null)
    {
        $this->data = json_decode(file_get_contents($file ?: dirname(__DIR__) . '/resources/catalog.json'), true);
        if (!isset($this->data['operations'])) { throw new \RuntimeException('Invalid Linode API catalogue'); }
    }
    public function version() { return $this->data['version']; }
    public function all() { return $this->data['operations']; }
    public function operation($id)
    {
        if (!isset($this->data['operations'][$id])) { throw new \InvalidArgumentException('Unknown API operation'); }
        return $this->data['operations'][$id];
    }
    public function resolve($value)
    {
        if (!isset($value['$ref'])) { return $value; }
        $ref = $value['$ref'];
        if (strpos($ref, '#/components/') !== 0) { throw new \InvalidArgumentException('External schema references are prohibited'); }
        $node = $this->data;
        foreach (explode('/', substr($ref, 2)) as $part) {
            if (!isset($node[$part])) { throw new \InvalidArgumentException('Unresolved schema reference'); }
            $node = $node[$part];
        }
        return $node;
    }
    public function parameters($id)
    {
        return array_map(array($this, 'resolve'), $this->operation($id)['parameters']);
    }
    public function path($id, array $values, $version = 'v4')
    {
        if (!in_array($version, array('v4', 'v4beta'), true)) { throw new \InvalidArgumentException('Invalid API version'); }
        $values['apiVersion'] = $version;
        return preg_replace_callback('/\{([^}]+)\}/', function ($match) use ($values) {
            $key = $match[1];
            if (!isset($values[$key]) || !is_scalar($values[$key])) { throw new \InvalidArgumentException('Missing path parameter: ' . $key); }
            $value = (string) $values[$key];
            if ($value === '' || strlen($value) > 255 || strpos($value, '..') !== false || preg_match('/[\x00-\x20\x7f\\\\?#%]/', $value)) {
                throw new \InvalidArgumentException('Invalid path parameter: ' . $key);
            }
            return rawurlencode($value);
        }, $this->operation($id)['path']);
    }
    public function find($method, $path)
    {
        foreach ($this->all() as $op) {
            if ($op['method'] === strtoupper($method) && $op['path'] === '/{apiVersion}' . $path) { return $op['id']; }
        }
        throw new \InvalidArgumentException('Endpoint is not in the installed catalogue');
    }
}

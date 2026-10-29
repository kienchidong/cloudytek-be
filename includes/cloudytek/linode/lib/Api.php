<?php
namespace Cloudytek\Linode;

class Api
{
    private $catalog;
    private $token;
    private $writes;
    private $transport;
    private $version;
    public function __construct(Catalog $catalog, $token, $writes = false, callable $transport = null, $version = 'v4')
    {
        if (!is_string($token) || preg_match('/[\r\n]/', $token)) { throw new \InvalidArgumentException('Invalid API credential'); }
        $this->catalog = $catalog; $this->token = $token; $this->writes = $writes;
        $this->transport = $transport; $this->version = $version;
    }
    public function call($id, array $path = array(), array $query = array(), $body = null, array $headers = array(), $encoding = 'application/json')
    {
        $op = $this->catalog->operation($id);
        if ($this->token === '') { throw new \RuntimeException('Configure a Linode token before connecting'); }
        if ($op['method'] !== 'GET' && !$this->writes) { throw new \RuntimeException('Writes are disabled for this account'); }
        $declared = array('query' => array(), 'header' => array());
        foreach ($this->catalog->parameters($id) as $param) {
            if (isset($declared[$param['in']])) { $declared[$param['in']][strtolower($param['name'])] = $param; }
        }
        foreach ($query as $name => $value) {
            if (!isset($declared['query'][strtolower($name)]) || (!is_scalar($value) && !is_array($value))) {
                throw new \InvalidArgumentException('Undeclared query parameter: ' . $name);
            }
        }
        $safeHeaders = array();
        foreach ($headers as $name => $value) {
            if (strtolower($name) === 'authorization' || !isset($declared['header'][strtolower($name)]) || !is_scalar($value) || preg_match('/[\r\n]/', (string) $value)) {
                throw new \InvalidArgumentException('Invalid header: ' . $name);
            }
            $safeHeaders[] = $name . ': ' . $value;
        }
        foreach (array('query', 'header') as $location) {
            $provided = $location === 'query' ? $query : $headers;
            $lower = array_change_key_case($provided, CASE_LOWER);
            foreach ($declared[$location] as $name => $param) {
                if (!empty($param['required']) && !array_key_exists($name, $lower)) { throw new \InvalidArgumentException('Missing ' . $location . ' parameter: ' . $param['name']); }
            }
        }
        $contentType = $encoding;
        if ($body !== null) {
            $rb = $this->catalog->resolve($op['body']);
            if (empty($rb['content'])) { throw new \InvalidArgumentException('This operation does not accept a request body'); }
            if (!isset($rb['content'][$encoding])) { throw new \RuntimeException('Encoding is not declared for this operation'); }
            if ($encoding === 'application/json') {
                $payload = json_encode($body, JSON_UNESCAPED_SLASHES);
                if ($payload === false || strlen($payload) > 1048576) { throw new \InvalidArgumentException('Invalid or oversized request body'); }
            } elseif ($encoding === 'image/png') {
                if (!is_string($body) || strlen($body)>8388608 || substr($body,0,8)!=="\x89PNG\r\n\x1a\n")throw new \InvalidArgumentException('A valid PNG upload is required');
                $payload=$body;
            } elseif ($encoding === 'multipart/form-data') {
                if(!is_array($body))throw new \InvalidArgumentException('Multipart fields are required');
                foreach($body as $field) {
                    if($field instanceof \CURLFile) {
                        if(!is_file($field->getFilename())||filesize($field->getFilename())>8388608)throw new \InvalidArgumentException('Invalid upload');
                    } elseif(!is_scalar($field))throw new \InvalidArgumentException('Invalid multipart field');
                }
                $payload=$body;
            } else { throw new \RuntimeException('Unsupported body encoding'); }
        } else {
            if (!empty($op['body']['required'])) { throw new \InvalidArgumentException('Request body is required'); }
            $payload = null;
        }
        $url = 'https://api.linode.com' . $this->catalog->path($id, $path, $this->version);
        if ($query) {
            $pairs=array();
            foreach($query as $name=>$value) {
                $param=$declared['query'][strtolower($name)];
                if(!is_array($value))$pairs[]=rawurlencode($name).'='.rawurlencode((string)$value);
                elseif(isset($param['style'])&&$param['style']==='deepObject')$pairs[]=http_build_query(array($name=>$value),'','&',PHP_QUERY_RFC3986);
                elseif(!isset($param['explode'])||$param['explode']) {
                    foreach($value as $k=>$item) {
                        if(!is_scalar($item))throw new \InvalidArgumentException('Nested query arrays are not supported');
                        $pairs[]=rawurlencode(is_int($k)?$name:$k).'='.rawurlencode((string)$item);
                    }
                } else {
                    $items=array();foreach($value as $k=>$item) {
                        if(!is_scalar($item))throw new \InvalidArgumentException('Invalid query array');
                        if(!is_int($k))$items[]=rawurlencode($k);
                        $items[]=rawurlencode((string)$item);
                    }
                    $separator=isset($param['style'])&&$param['style']==='spaceDelimited'?'%20':(isset($param['style'])&&$param['style']==='pipeDelimited'?'%7C':',');
                    $pairs[]=rawurlencode($name).'='.implode($separator,$items);
                }
            }
            $url .= '?' . implode('&',$pairs);
        }
        $requestHeaders = array_merge(array('Authorization: Bearer ' . $this->token, 'Accept: application/json'), $safeHeaders);
        if($contentType!=='multipart/form-data')$requestHeaders[]='Content-Type: '.$contentType;
        $attempts = $op['method'] === 'GET' ? 3 : 1;
        for ($attempt = 0; $attempt < $attempts; $attempt++) {
            $response = $this->transport ? call_user_func($this->transport, $op['method'], $url, $requestHeaders, $payload) : $this->curl($op['method'], $url, $requestHeaders, $payload);
            $status = (int) $response['status'];
            if ($op['method'] === 'GET' && ($status === 429 || $status >= 500) && $attempt + 1 < $attempts) {
                if (!$this->transport) { usleep(200000 * ($attempt + 1)); }
                continue;
            }
            $data = json_decode($response['body'], true);
            if ($status < 200 || $status >= 300) {
                // Provider errors can echo submitted secrets. Keep logs and exception messages minimal.
                throw new \RuntimeException('Linode API HTTP ' . $status . ' (' . $id . ')', $status);
            }
            return array('status' => $status, 'data' => json_last_error() === JSON_ERROR_NONE ? $data : $response['body']);
        }
        throw new \RuntimeException('API request failed');
    }
    private function curl($method, $url, $headers, $body)
    {
        $handle = curl_init($url); $buffer = ''; $tooLarge = false;
        curl_setopt_array($handle, array(CURLOPT_CUSTOMREQUEST => $method, CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CONNECTTIMEOUT => 8, CURLOPT_TIMEOUT => 35, CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS, CURLOPT_USERAGENT => 'Cloudytek-WHMCS-Linode/1.0',
            CURLOPT_WRITEFUNCTION => function ($ch, $chunk) use (&$buffer, &$tooLarge) {
                if (strlen($buffer) + strlen($chunk) > 8388608) { $tooLarge = true; return 0; }
                $buffer .= $chunk; return strlen($chunk);
            }));
        if ($body !== null) { curl_setopt($handle, CURLOPT_POSTFIELDS, $body); }
        $ok = curl_exec($handle); $status = curl_getinfo($handle, CURLINFO_HTTP_CODE); curl_close($handle);
        if ($ok === false) { throw new \RuntimeException($tooLarge ? 'API response exceeds size limit' : 'Network failure; write result may be uncertain', 599); }
        return array('status' => $status, 'body' => $buffer);
    }
    public static function redact($data)
    {
        if (!is_array($data)) { return '[Response omitted]'; }
        foreach ($data as $key => $value) {
            if (is_string($key) && preg_match('/password|root_pass|secret|token|(?:^|_)key(?:$|_)|kubeconfig|certificate|credentials/i', $key)) { $data[$key] = '[REDACTED]'; }
            elseif (is_array($value)) { $data[$key] = self::redact($value); }
        }
        return $data;
    }
    public static function present($data,$reveal=false)
    {
        if(!$reveal)return self::redact($data);
        if(is_string($data)&&!preg_match('//u',$data))return array('encoding'=>'base64','bytes'=>strlen($data),'data'=>base64_encode($data));
        return $data;
    }
}

<?php
namespace Cloudytek\Linode;
class Web
{
    public static function store() { return new Store(\WHMCS\Database\Capsule::connection()->getPdo()); }
    public static function csrf()
    {
        if($_SERVER['REQUEST_METHOD']!=='POST' || !isset($_POST['token']) || !is_string($_POST['token']) || !hash_equals(generate_token('plain'),$_POST['token']))throw new \RuntimeException('Invalid CSRF token');
    }
    public static function admin()
    {
        $id=(int)\WHMCS\Session::get('adminid');
        $row=\WHMCS\Database\Capsule::table('tbladmins')->where('id',$id)->first();
        $roles=array(1);
        $custom=dirname(__DIR__).'/admin-roles.php';
        if(is_file($custom))$roles=require $custom;
        if(!$row || $row->disabled || !in_array((int)$row->roleid,$roles,true))throw new \RuntimeException('This admin role is not allowed to manage Linode');
        return $id;
    }
    public static function json($text)
    {
        if(!is_string($text)||strlen($text)>1048576)throw new \InvalidArgumentException('Invalid JSON input');
        $value=json_decode($text,true);
        if(json_last_error()!==JSON_ERROR_NONE || !is_array($value))throw new \InvalidArgumentException('Expected a JSON object or array');
        return $value;
    }
    public static function esc($value) { return htmlspecialchars((string)$value,ENT_QUOTES,'UTF-8'); }
}

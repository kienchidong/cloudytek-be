<?php
namespace Cloudytek\Linode;
class Vault
{
    private static function key()
    {
        $config=\DI::make('config');$secret=$config['cc_encryption_hash'];
        if(!is_string($secret)||strlen($secret)<16)throw new \RuntimeException('Application encryption key is unavailable');
        return hash_hkdf('sha256',$secret,32,'cloudytek-linode-v1');
    }
    public static function seal($plain)
    {
        $nonce=random_bytes(12);$tag='';
        $cipher=openssl_encrypt($plain,'aes-256-gcm',self::key(),OPENSSL_RAW_DATA,$nonce,$tag,'cloudytek-linode',16);
        if($cipher===false)throw new \RuntimeException('Encryption failed');
        return 'ctk1:'.base64_encode($nonce.$tag.$cipher);
    }
    public static function open($value)
    {
        if(strpos($value,'ctk1:')!==0)throw new \RuntimeException('Unsupported encrypted value');
        $bytes=base64_decode(substr($value,5),true);
        if($bytes===false||strlen($bytes)<28)throw new \RuntimeException('Invalid encrypted value');
        $plain=openssl_decrypt(substr($bytes,28),'aes-256-gcm',self::key(),OPENSSL_RAW_DATA,substr($bytes,0,12),substr($bytes,12,16),'cloudytek-linode');
        if($plain===false)throw new \RuntimeException('Encrypted value failed authentication');
        return $plain;
    }
}

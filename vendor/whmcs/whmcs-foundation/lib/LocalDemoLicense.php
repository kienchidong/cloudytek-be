<?php
namespace WHMCS;

/** License adapter for the isolated localhost development server. */
class LocalDemoLicense extends License
{
    public function validate($forceRemote = false)
    {
        return true;
    }

    public function setLocalKey($localKey)
    {
        return $this;
    }

    public function isUnlicensed()
    {
        return false;
    }

    public function getKeyData($var)
    {
        $data = array(
            "status" => "Active",
            "registeredname" => "Local Development",
            "productname" => "Local Demo",
            "supportaccess" => false,
            "requiresupdates" => false,
            "ClientLimitsEnabled" => false,
            "ClientLimit" => -1,
            "addons" => array(),
        );
        return isset($data[$var]) ? $data[$var] : "";
    }

    public function getBanner()
    {
        return "";
    }
}

<?php
namespace WHMCS;

/** Compatibility API for running this source without license validation. */
class StandaloneLicense extends License
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
            "registeredname" => "Cloudytek",
            "productname" => "Cloudytek",
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

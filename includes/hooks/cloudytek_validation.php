<?php
// Presentation metadata only. Native WHMCS rules, CSRF and authentication remain authoritative.
add_hook('ClientAreaHeadOutput', 50, function () {
    $fields = array(
        'firstname' => array('clientareaerrorfirstname', 'clientareaerrorfirstname2'),
        'lastname' => array('clientareaerrorlastname', 'clientareaerrorlastname2'),
        'email' => array('clientareaerroremail', 'clientareaerroremailinvalid', 'clientareaerrorbannedemail', 'ordererroruserexists', 'pwresetemailrequired', 'pwresetemailnotfound'),
        'address1' => array('clientareaerroraddress1', 'clientareaerroraddress12'),
        'city' => array('clientareaerrorcity', 'clientareaerrorcity2'),
        'state' => array('clientareaerrorstate'),
        'postcode' => array('clientareaerrorpostcode', 'clientareaerrorpostcode2'),
        'country' => array('clientareaerrorcountry'),
        'phonenumber' => array('clientareaerrorphonenumber', 'clientareaerrorphonenumber2'),
        'password' => array('ordererrorpassword', 'pwstrengthfail'),
        'password2' => array('clientareaerrorpasswordconfirm', 'clientareaerrorpasswordnotmatch', 'pwdoesnotmatch'),
        'answer' => array('pwresetsecurityquestionincorrect'),
        'securityqans' => array('securityanswerrequired'),
        'name' => array('contacterrorname'),
        'subject' => array('contacterrorsubject', 'supportticketserrorsubject'),
        'message' => array('contacterrormessage', 'supportticketserrormessage'),
        'code' => array('captchaverifyincorrect'),
        'accepttos' => array('ordererroraccepttos', 'ordererrortermsofservice'),
        'ccnumber' => array('creditcardnumberinvalid'),
        'ccexpirydate' => array('creditcardexpirydateinvalid'),
        'cccvv' => array('creditcardccvinvalid')
    );
    $map = array();
    foreach ($fields as $field => $keys) {
        foreach ($keys as $key) {
            $message = Lang::trans($key);
            if (is_string($message) && $message !== $key && $message !== '') {
                $map[] = array('field' => $field, 'message' => html_entity_decode(strip_tags($message), ENT_QUOTES, 'UTF-8'));
            }
        }
    }
    return '<script type="application/json" id="cloudytek-validation-config">' . json_encode(array('language' => Lang::getName(), 'errors' => $map), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . '</script>';
});

<?php

namespace dmstr\cookieconsent\components;

use yii\base\Component;

class CookieConsentHelper extends Component
{
    public $cookieName = 'cookie_consent_status';
    /**
     * If the cookie named "cookie_consent_status" exists then its value will be
     * parsed into an array of strings each indicating which consent the user
     * had allowed. Default to an Empty Array.
     * @return array
     */
    public function getConsent()
    {
        $consent = isset($_COOKIE[$this->cookieName]) ? json_decode($_COOKIE[$this->cookieName]) : [];
        return $consent;
    }

    /**
     * Returns true if the consent is present in the consent array.
     * @param $name
     * @return bool
     */
    public function hasConsent($name)
    {
        $consent = $this->getConsent();
        return in_array($name, $consent);
    }
}

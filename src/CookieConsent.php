<?php

namespace dmstr\cookieconsent;

use yii\base\Widget;
use dmstr\cookieconsent\assets\CookieConsentAsset;

class CookieConsent extends Widget
{
    public $cookieName = 'cookie_consent_status';
    public $cookiePath = '/';
    public $cookieDomain = '';
    public $cookieExpiryDays = 365;
    public $onCheck = 'function () {}';

    public function run()
    {
        $view = $this->getView();
        CookieConsentAsset::register($view);
        $view->registerJs(
            "window.addEventListener('load', function () {
              window.cookieConsent = new CookieConsent({
                cookieName: '{$this->cookieName}',
                cookiePath: '{$this->cookiePath}',
                cookieDomain: '{$this->cookieDomain}',
                cookieExpiryDays: {$this->cookieExpiryDays},
                onCheck: {$this->onCheck}
              });
            });",
            \yii\web\View::POS_READY,
            'cookieConsent'
        );
    }
}
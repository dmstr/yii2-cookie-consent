<?php

namespace dmstr\cookieconsent;

use yii\base\Widget;
use dmstr\cookieconsent\assets\CookieConsentAsset;

class CookieConsent extends Widget
{
    public $message = 'This website uses cookies. By continuing to use the website, you agree to the use of cookies';
    public $link = '';
    public $linkLabel = '';
    public $dismiss = '';
    public $allow = '';
    public $deny = '';
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
        return $this->render('popup', [
            'message' => $this->message,
            'link' => $this->link,
            'linkLabel' => $this->linkLabel,
            'dismiss' => $this->dismiss,
            'allow' => $this->allow,
            'deny' => $this->deny,
        ]);
    }
}
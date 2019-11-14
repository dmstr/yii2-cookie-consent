<?php

namespace dmstr\cookieconsent\widgets;

use yii\base\Widget;
use dmstr\cookieconsent\assets\CookieConsentAsset;

class CookieConsent extends Widget
{
    public $name = 'cookie_consent_status';
    public $path = '/';
    public $domain = '';
    public $expiryDays = 365;
    public $message = 'This website uses cookies to ensure you get the best experience on our website.';
    public $save = 'Save';
    public $learnMore = 'More info';
    public $link = '#';
    public $consent = [];

    protected $_consentData = [];

    protected function registerAssets()
    {
        $econdedConsentData = json_encode($this->_consentData);

        $this->view->registerJs(<<<JS
window.addEventListener('load', function () {
    window.cookieConsent = new CookieConsent({
      name: '{$this->name}',
      path: '{$this->path}',
      domain: '{$this->domain}',
      expiryDays: {$this->expiryDays},
    });
    window.cookieConsent.afterSave = function (cc) {
      cc.clean({$econdedConsentData})
      window.location.reload()
    }
});
JS
        );
    }

    public function init()
    {
        parent::init();

        // ensure that $consent has defaults values for each consent.
        foreach ($this->consent as $key => $item) {

            if (!is_array($item)) {
                $key = $item;
            }

            if (isset($item["label"])) {
                $label = $item["label"];
            } else {
                $label = $key;
            }

            if (isset($item["cookies"])) {
                $cookies = $item["cookies"];
            } else {
                $cookies = [];
            }

            $this->_consentData[$key]['label'] = $label;
            $this->_consentData[$key]['cookies'] = $cookies;

        }
    }

    public function run()
    {
        CookieConsentAsset::register($this->view);
        $this->registerAssets();
        return $this->render('cookie-consent-popup', [
            "message" => $this->message,
            "save" => $this->save,
            "learnMore" => $this->learnMore,
            "link" => $this->link,
            "consent" => $this->_consentData
        ]);
    }
}

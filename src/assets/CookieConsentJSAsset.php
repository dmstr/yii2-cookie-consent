<?php

namespace dmstr\cookieconsent\assets;

use yii\web\AssetBundle;

class CookieConsentJSAsset extends AssetBundle
{
    public $sourcePath = '@vendor/npm/dmstr--cookie-consent/dist';
    public $js = [
        'cookie-consent.js',
    ];
}

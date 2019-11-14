<?php

namespace dmstr\cookieconsent\assets;

use yii\web\AssetBundle;

class CookieConsentAsset extends AssetBundle
{

    public $sourcePath = __DIR__;

    public $js = [
        'scripts/cookie-consent.js',
    ];

    public $css = [
        'styles/' . (YII_ENV_PROD ? 'cookie-consent.min.css' : 'cookie-consent.css'),
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

}

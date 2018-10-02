<?php

namespace dmstr\cookieconsent\assets;

use yii\web\AssetBundle;

class CookieConsentAsset extends AssetBundle
{

    public $sourcePath = __DIR__;

    public $js = [
        'scripts/cookie-consent.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

}
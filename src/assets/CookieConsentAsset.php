<?php
/**
 * @link http://www.diemeisterei.de
 * @copyright Copyright (c) 2019 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\cookieconsent\assets;

use yii\web\AssetBundle;

class CookieConsentAsset extends AssetBundle
{

    public $sourcePath = __DIR__;

    public $css = [
        'styles/' . (YII_ENV_PROD ? 'cookie-consent.min.css' : 'cookie-consent.css'),
    ];

    public $depends = [
        "dmstr\cookieconsent\assets\CookieConsentJSAsset"
    ];

}

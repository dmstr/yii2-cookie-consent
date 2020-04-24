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

class CookieConsentJSAsset extends AssetBundle
{
    public $sourcePath = '@npm/dmstr--cookie-consent/dist';
    public $js = [
        'cookie-consent.js',
    ];
}

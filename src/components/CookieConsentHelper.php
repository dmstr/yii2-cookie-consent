<?php
/**
 * @link http://www.diemeisterei.de
 * @copyright Copyright (c) 2019 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\cookieconsent\components;

use yii\base\Component;

/**
 * --- PUBLIC PROPERTIES ---
 *
 * @property string $cookieName
 */
class CookieConsentHelper extends Component
{
    /**
     * @var $cookieName
     * Name of cookie consent settings cookie
     */
    public $cookieName = 'cookie_consent_status';

    /**
     * If the cookie named "cookie_consent_status" exists then its value will be
     * parsed into an array of strings each indicating which consent the user
     * had allowed. Default to an empty Array.
     *
     * @return array
     */
    public function getConsent()
    {
        if (isset($_COOKIE[$this->cookieName])) {
            $cookieData = json_decode($_COOKIE[$this->cookieName]);
            if ($cookieData) {
                return $cookieData;
            }
        }
        return [];
    }

    /**
     * Returns true if the consent is present in the consent array.
     *
     * @param $name
     *
     * @return bool
     */
    public function hasConsent($name)
    {
        return in_array($name, $this->getConsent(), true);
    }
}

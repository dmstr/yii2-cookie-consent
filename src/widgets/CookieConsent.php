<?php
/**
 * @link http://www.diemeisterei.de
 * @copyright Copyright (c) 2019 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\cookieconsent\widgets;

use dmstr\cookieconsent\assets\CookieConsentAsset;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * --- PUBLIC PROPERTIES ---
 *
 * @property string $name
 * @property string $cookieConsentHelperComponent
 * @property string $path
 * @property string $domain
 * @property string $expiryDays
 * @property string $message
 * @property string $save
 * @property string $learnMore
 * @property string $link
 * @property array $consent
 *
 * --- PROTECTED PROPERTIES ---
 *
 * @property array $_consentData
 *
 * --- WORTH KNOWING ---
 *
 * Widgets throws an yii\base\InvalidConfigException if you define an invalid cookie consent helper component
 */
class CookieConsent extends Widget
{
    /**
     * @var $name
     * Name of cookie consent settings cookie
     */
    public $name;

    /**
     * @var $path
     * Cookie path
     */
    public $path = '/';

    /**
     * @var $domain
     * Cookie domain
     */
    public $domain = '';
    /**
     * @var $expiryDays
     * Expiry days of settings cookie in days
     */
    public $expiryDays = 365;

    /**
     * @var $message
     * Cookie consent text
     */
    public $message = 'This website uses cookies to ensure you get the best experience on our website.';

    /**
     * @var $save
     * Label for save button
     */
    public $save = 'Save';

    /**
     * @var $learnMore
     * Label for learn more button
     */
    public $learnMore = 'More info';

    /**
     * @var $learnMore
     * Link to more info (e.g. privacy policy)
     */
    public $link = '#';

    /**
     * @var $consent
     * Cookie groups
     *
     * [
     *     'statistics' => [
     *         'label' => 'Statistics',
     *         'cookies' => [
     *             '_ga',
     *             '_gat',
     *             '_gid'
     *         ]
     *     ],
     *     'marketing',
     *     'external-media'
     * ]
     */
    public $consent = [];

    /**
     * @var $_consentData
     *
     * consent data for cookie conset js
     */
    protected $_consentData = [];

    protected function registerAssets()
    {
        $encondedConsentData = json_encode($this->_consentData);

        $this->view->registerJs(<<<JS
window.addEventListener('load', function () {
    window.cookieConsent = new CookieConsent({
      name: '{$this->name}',
      path: '{$this->path}',
      domain: '{$this->domain}',
      expiryDays: {$this->expiryDays},
    });
    window.cookieConsent.afterSave = function (cc) {
      cc.clean({$encondedConsentData})
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

            if (isset($item['label'])) {
                $label = $item['label'];
            } else {
                $label = $key;
            }

            if (isset($item['cookies'])) {
                $cookies = $item['cookies'];
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
            'message' => $this->message,
            'save' => $this->save,
            'learnMore' => $this->learnMore,
            'link' => $this->link,
            'consent' => $this->_consentData
        ]);
    }
}

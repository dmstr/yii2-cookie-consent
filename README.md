# yii2-cookie-consent
solution to the EU Cookie Law

## Getting started

### Installation

```
composer require dmstr/yii2-cookie-consent
```

## CookieConsentHelper Component

yii config
```php
'components' => [
    'cookieConsentHelper' => [
        'class' => dmstr\cookieconsent\components\CookieConsentHelper::class
    ]
]
```

### Usage with PHP

```php
use dmstr\cookieconsent\widgets\CookieConsent;
<?= CookieConsent::widget([
    'name' => 'cookie_consent_status',
    'path' => '/',
    'domain' => '',
    'expiryDays' => 365,
    'message' => Yii::t('cookie-consent', 'We use cookies to ensure the proper functioning of our website. For an improved visit experience we use analysis products. These are used when you agree with "Statistics".'),
    'save' => Yii::t('cookie-consent', 'Save'),
    'acceptAll' => Yii::t('cookie-consent', 'Accept all'),
    'controlsOpen' => Yii::t('cookie-consent', 'Change'),
    'detailsOpen' => Yii::t('cookie-consent', 'Cookie Details'),
    'learnMore' => Yii::t('cookie-consent', 'Privacy statement'),
    'visibleControls' => true,
    'visibleDetails' => false,
    'link' => '#',
    'consent' => [
        'necessary' => [
            'label' => Yii::t('cookie-consent', 'Necessary'),
            'checked' => true,
            'disabled' => true
        ],
        'statistics' => [
            'label' => Yii::t('cookie-consent', 'Statistics'),
            'cookies' => [
                ['name' => '_ga'],
                ['name' => '_gat', 'domain' => '', 'path' => '/'],
                ['name' => '_gid', 'domain' => '', 'path' => '/']
            ],
            'details' => [
                'Goal' => Yii::t('cookie-consent', 'Create statistics data'),
                'Cookie Names' => '_ga, _gat, _gid, _gali'
            ]
        ]
    ]
]) ?>
```

```php
<?php if (\Yii::$app->cookieConsentHelper->hasConsent('statistics')): ?>
    <!-- Google Analytics Script-->
<?php endif; ?>
```

### Usage with TWIG

```php
{{ use('dmstr/cookieconsent/widgets/CookieConsent') }}
{{ CookieConsent_widget({
    "name": "cookie_consent_status",
    "path": "/",
    "domain": "",
    "expiryDays": 365,
    "message": t("cookie-consent", "We use cookies to ensure the proper functioning of our website. For an improved visit experience we use analysis products. These are used when you agree with "Statistics"."),
    "save": t("cookie-consent", "Save"),
    "acceptAll": t("cookie-consent", "Accept all"),
    "controlsOpen": t("cookie-consent", "Change"),
    "detailsOpen": t("cookie-consent", "Cookie Details"),
    "learnMore": t("cookie-consent", "Privacy statement"),
    "visibleControls": false,
    "visibleDetails": false,
    "link": "#",
    "consent": {
        "necessary": {
            "label": t("cookie-consent", "Necessary"),
            "checked": true,
            "disabled": true
        },
        "statistics": {
            "label": t("cookie-consent", "Statistics"),
            "cookies": [
                {"name": "_ga", "domain": "", "path": "/"},
                {"name": "_gat", "domain": "", "path": "/"},
                {"name": "_gid", "domain": "", "path": "/"},
                {"name": "_gali", "domain": "", "path": "/"},
            ],
            "details": {
                "Ziel": t("cookie-consent", "Create statistics data"),
                "Cookies": "_ga, _gat, _gid, _gali"
            }
        }
    }
}) }}
```

```php
{% if app.cookieConsentHelper.hasConsent('statistics') %}
    {# Google Analytics Code #}
{% endif %}
```

## Options

<table>
    <thead>
        <tr>
            <th>option</th>
            <th>description</th>
            <th>default</th>
            <th>type</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>name</td>
            <td>Defines the cookie name that Cookie Consent will use to store the status of the consent. Default is cookie conset helper's cookie name</td>
            <td> "" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>path</td>
            <td>Defines the cookie path</td>
            <td> "/" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>domain</td>
            <td>Defines the cookie domain</td>
            <td> "" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>expiryDays</td>
            <td>Defines the cookie exipration days</td>
            <td> 365 </td>
            <td> INT </td>
        </tr>
        <tr>
            <td>message</td>
            <td>The message in the popup</td>
            <td> "This website uses cookies to ensure you get the best experience on our website." </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>save</td>
            <td>The save button text</td>
            <td> "Save" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>acceptAll</td>
            <td>The accept all button text</td>
            <td> "Accept all" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>controlsOpen</td>
            <td>The open controls button text</td>
            <td> "Change" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>detailsOpen</td>
            <td>The open details button text</td>
            <td> "Details" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>learnMore</td>
            <td>The link text</td>
            <td> "More info" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>visibleControls</td>
            <td>If the controls panel should start open</td>
            <td> false </td>
            <td> BOOLEAN </td>
        </tr>
        <tr>
            <td>visibleDetails</td>
            <td>If the details panel should start open</td>
            <td> false </td>
            <td> BOOLEAN </td>
        </tr>
        <tr>
            <td>link</td>
            <td>The link pointing to your privacy policy page</td>
            <td> "#" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>consent</td>
            <td>A configuration array that will tell the cookie consent what it should do. Keys are the consent values that will be stored in the consent cookie. Labels are the checkbos labes. If no label is set the key will be used instead. The cookies array are a list of cookies names that can be deleted (when possible) when the corresponding consent value is revoked. See the above example "Usage with PHP". Also is possible to start the checkbox checked or disabled</td>
            <td> [] </td>
            <td> ARRAY </td>
        </tr>
    </tbody>
</table>

## Toggle popup, controls and details

```html
<button class="cookie-consent-open">open</button>
<button class="cookie-consent-close">close</button>
<button class="cookie-consent-toggle">toggle</button>
<button class="cookie-consent-controls-open">Open controls</button>
<button class="cookie-consent-controls-close">Close controls</button>
<button class="cookie-consent-controls-toggle">Toggle controls</button>
<button class="cookie-consent-details-open">Open Details</button>
<button class="cookie-consent-details-close">Close Details</button>
<button class="cookie-consent-details-toggle">Toggle details</button>
```

### CSS Example

```css
.cookie-consent-popup {
    animation-name: show;
    animation-duration: 1s;
    animation-timing-function: ease;
    display: none;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 999999;
}

.cookie-consent-popup.open {
    display: block;
    opacity: 1;
    animation-name: show;
    animation-duration: 1s;
    animation-timing-function: ease;
}

.cookie-consent-controls {
    max-height: 0;
    overflow: hidden;
    -webkit-transition: max-height 0.5s ease-out;
    -moz-transition: max-height 0.5s ease-out;
    transition: max-height 0.5s ease-out;
}

.cookie-consent-controls.open {
    margin: 0 0 30px 0;
    max-height: 600px;
}

.cookie-consent-details {
    max-height: 0;
    overflow: hidden;
    -webkit-transition: max-height 0.5s ease-out;
    -moz-transition: max-height 0.5s ease-out;
    transition: max-height 0.5s ease-out;
}

.cookie-consent-details.open {
    max-height: 600px;
}

@keyframes show {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes hide {
    from {opacity: 1;}
    to {opacity: 0;}
}

```

## Settings config example [phemellc/yii2-settings](https://github.com/phemellc/yii2-settings)

* section: cookie-consent
* key: config
* type: object

```json
{
  "name": "cookie_consent_status",
  "path": "/",
  "domain": "",
  "expiryDays": 365,
  "message": "We use cookies to ensure the proper functioning of our website. For an improved visit experience we use analysis products. These are used when you agree with 'Statistics'.",
  "save": "Speichern",
  "learnMore": "Datenschutzerklärung",
  "link": "#",
  "consent": {
    "necessary": {
        "label": "Necessary",
        "checked": true,
        "disabled": true
    },
    "statistics": {
      "label": "Statistics",
      "cookies": [
        {
          "name": "_ga"
        },
        {
          "name": "_gat",
          "domain": "",
          "path": "/"
        },
        {
          "name": "_gid",
          "domain": "",
          "path": "/"
        }
      ]
    },
    "0": "marketing",
    "1": "external-media"
  }
}
```

```php
<?php
    $config = Yii::$app->settings->get('config', 'cookie-consent', []);
    $config = isset($config->scalar) ? $config->scalar : '{}';
    $config = json_decode($config, true);
?>

<?= CookieConsent::widget($config) ?>
```

## Worth knowing

Widgets throws an `yii\base\InvalidConfigException` if you define an invalid cookie consent helper component

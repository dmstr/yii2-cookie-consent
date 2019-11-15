# yii2-cookie-consent
solution to the EU Cookie Law

## Getting started

### Usage with PHP

```php
use dmstr\cookieconsent\CookieConsent;
<?= CookieConsent::widget([
    'name' => 'cookie_consent_status',
    'path' => '/',
    'domain' => '',
    'expiryDays' => 365,
    'message' => 'Durch die Zustimmung erklären Sie sich mit der Verwendung von Cookies und der Weitergabe Ihrer Nutzerdaten an Dritte einverstanden. Ihre Rechte als Benutzer finden Sie in unserer Datenschutzerklärung. Diese Einwilligung ist freiwillig und kann jederzeit widerrufen werden.',
    'save' => 'Speichern',
    'learnMore' => 'Datenschutzerklärung',
    'link' => '#',
    'consent' => [
        'statistics' => [
            'label' => 'Statistics',
            'cookies' => ['_ga', '_gat',  '_gid']
        ],
        'marketing',
        'external-media'
    ]
]) ?>
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

Example usuage
```php
<?php if (\Yii::$app->cookieConsentHelper->hasConsent('statistics')): ?>
    <!-- Google Analytics Script-->
<?php endif; ?>
```

### Usage with Twig

```php
{{ use('dmstr/cookieconsent/CookieConsent') }}
{{ CookieConsent_widget({
    'name': 'cookie_consent_status',
    'path': '/',
    'domain': '',
    'expiryDays': 365,
    'message': 'This website uses cookies to ensure you get the best experience on our website.',
    'save': 'Save',
    'learnMore': 'More info',
    'link': '#',
    'consent': [
        'statistics': [
            'label': 'Statistics',
            'cookies': ['_ga', '_gat', '_gid']
        ],
        'marketing',
        'external-media'
    ]
}) }}
```

### Usage with TWIG

```php
{{ use('dmstr/cookieconsent/CookieConsent') }}
{{ CookieConsent_widget({
    'name': 'cookie_consent_status',
    'path': '/',
    'domain': '',
    'expiryDays': 365
}) }}
```

## OPTIONS

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
            <td>Defines the cookie name that Cookie Consent will use to store the status of the consent</td>
            <td> "cookie_consent_status" </td>
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
            <td>learnMore</td>
            <td>The link text</td>
            <td> "More info" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>link</td>
            <td>The link pointing to your privacy policy page</td>
            <td> "#" </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>consent</td>
            <td>A configuration array that will tell the cookie consent what it should do. Keys are the consent values that will be stored in the consent cookie. Labels are the checkbos labes. If no label is set the key will be used instead. The cookies array are a list of cookies names that can be deleted (when possible) when the corresponding consent value is revoked. See the above example "Usage with PHP"</td>
            <td> [] </td>
            <td> ARRAY </td>
        </tr>
    </tbody>
</table>

## Open and close the popup

```html
<button class="cookie-consent-open">Open popup</button>
<button class="cookie-consent-close">Close popup</button>
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
  "message": "Durch die Zustimmung erklären Sie sich mit der Verwendung von Cookies und der Weitergabe Ihrer Nutzerdaten an Dritte einverstanden. Ihre Rechte als Benutzer finden Sie in unserer Datenschutzerkäung. Diese Einwilligung ist freiwillig und kann jederzeit widerrufen werden.",
  "save": "Speichern",
  "learnMore": "Datenschutzerklärung",
  "link": "#",
  "consent": {
    "statistics": {
      "label": "Statistics",
      "cookies": [
        "_ga",
        "_gat",
        "_gid"
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

# yii2-cookie-consent
solution to the EU Cookie Law

Usage
-----

```php
use dmstr\cookieconsent\CookieConsent;

<?= CookieConsent::widget([
    "message" => "Diese Website benutzt Cookies. Wenn Sie die Website weiter nutzen, stimmen Sie der Verwendung von Cookies zu.",
    "link" => "",
    "linkLabel" => "Mehr Info",
    "dismiss" => "Dismiss",
    "allow" => "Allow",
    "deny" => "Deny",
    "cookieName" => "cookie_consent_status",
    "cookiePath" => "/",
    "cookieDomain" => "",
    "cookieExpiryDays" => 365,
    "onCheck" => "function (status, cc) {
        console.log(cc.cookieName, '=', status);
        if (status === 'undefined') {}
        if (status === 'allowed') {}
        if (status === 'denied') {}
    }"
]) ?>
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
            <td>cookieName</td>
            <td>Defines the cookie name that Cookie Consent will use to store the status of the consent</td>
            <td> 'cookie_consent_status' </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>cookiePath</td>
            <td>Defines the cookie path</td>
            <td> '/' </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>cookieDomain</td>
            <td>Defines the cookie domain</td>
            <td> '' </td>
            <td> STRING </td>
        </tr>
        <tr>
            <td>cookieExpiryDays</td>
            <td>Defines the cookie exipration days</td>
            <td> 365 </td>
            <td> INT </td>
        </tr>
        <tr>
            <td>onCheck</td>
            <td>A function that will be triggered when an instance of CookieConsent is made or the consent status change</td>
            <td> function (type, didConsent) {} </td>
            <td> FUNCTION </td>
        </tr>
    </tbody>
</table>

## HTML
This Cookie Consent library works in a declarative approach. Thats mean that you
just need to put the right classes in your html get it working.

* `cookie-consent-popup`: to display and hide the a popup. The popup is not displayed
by default and will become a `open` class for displaying.

* `cookie-consent-dismiss`: stores a cookie with value `dismissed`, triggers
`onCheck` hook function and hides the popup.

* `cookie-consent-allow`: stores a cookie with value `allowed`, triggers
`onCheck` hook function and hides the popup.

* `cookie-consent-deny`: stores a cookie with value `denied`, triggers `onCheck`
hook function and open the popup.

* `cookie-consent-open`: open the popup.

* `cookie-consent-close`: close the popup.

```html
<div class="cookie-consent-popup">
  <div>We are using cookies</div>
  <a href="">Learn more</a>
  <button class="cookie-consent-dismiss">Dismiss</button>
  <button class="cookie-consent-deny">Deny</button>
  <button class="cookie-consent-allow">Allow</button>
</div>
```

Your are no obligated to put buttons only in the popup. You can (and should) put
this in an accesible way for your user too everywhere in your website.

## HOOK (onCheck)
Disabling and enabling cookies should be done setting the Cookie Consent `onCheck`
function in the options object by initialitiation. This function provides you
a the consent status ('dismissed', 'allowed', 'denied') an the actuall Cookie Consent
instance.

```php
<?= CookieConsent::widget([
  "onCheck" => "function (status, cc) {
      if (status === 'allowed' || status === 'dismissed') {
        // enable cookies
      } else {
        // disable cookies
      }
  }"
]) ?>
```

## HELPER METHODS
Cookie Consent have some useful methods for cookie management.

<table>
    <thead>
        <tr>
            <th>method</th>
            <th>description</th>
            <th>params</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>getCookie</td>
            <td>returns the value of a cookie if exist</td>
            <td>(STRING name)</td>
        </tr>
        <tr>
            <td>setCookie</td>
            <td>sets a cookie or overwrites it if exist</td>
            <td>(STRING name), (STRING value), (INT expiryDays), (STRING domain), (STRING path)</td>
        </tr>
        <tr>
            <td>deleteDomain</td>
            <td>removes the cookie by expiring it (set the expiryDays)</td>
            <td>(STRING name)</td>
        </tr>
    </tbody>
</table>

```javascript
cc.getCookie('cookieName');
cc.setCookie('name', 'value', expiryDays, 'domain', 'path');
cc.deleteCookie('cookieName');
```

var CookieConsent = function (options) {
  'use strict';
  var self = this;

  // ---------------------------------------------------------------- properties

  self.options = options || {};
  self.cookieValue = '';
  self.cookieName = self.options.cookieName || 'cookie_consent_status';
  self.cookiePath = self.options.cookiePath || '/';
  self.cookieDomain = self.options.cookieDomain || '';
  self.cookieExpiryDays = self.options.cookieExpiryDays || 365;
  self.popup = document.querySelector('.cookie-consent-popup');
  self.dismissButtons = Array.prototype.slice.call(document.querySelectorAll('.cookie-consent-dismiss'));
  self.denyButtons = Array.prototype.slice.call(document.querySelectorAll('.cookie-consent-deny'));
  self.allowButtons = Array.prototype.slice.call(document.querySelectorAll('.cookie-consent-allow'));
  self.openButtons = Array.prototype.slice.call(document.querySelectorAll('.cookie-consent-open'));
  self.closeButtons = Array.prototype.slice.call(document.querySelectorAll('.cookie-consent-close'));
  self.status = {
    dismissed: 'dismissed',
    allowed: 'allowed',
    denied: 'denied'
  };

  // ---------------------------------------------------------------------- init

  self.init = function () {
    if (self.popup) {
      self.addEventListener();

      if (!self.didConsent()) {
        self.open();
      }

      self.onCheck(self.getStatus(), self);
    }
  };

  // ----------------------------------------------- add buttons event listeners

  self.addEventListener = function () {
    if (self.dismissButtons.length > 0) {
      self.dismissButtons.forEach(function (btn) {
        btn.addEventListener('click', self.dismiss);
      });
    }
    if (self.denyButtons.length > 0) {
      self.denyButtons.forEach(function (btn) {
        btn.addEventListener('click', self.deny);
      });
    }
    if (self.allowButtons.length > 0) {
      self.allowButtons.forEach(function (btn) {
        btn.addEventListener('click', self.allow);
      });
    }
    if (self.openButtons.length > 0) {
      self.openButtons.forEach(function (btn) {
        btn.addEventListener('click', self.open);
      });
    }
    if (self.closeButtons.length > 0) {
      self.closeButtons.forEach(function (btn) {
        btn.addEventListener('click', self.close);
      });
    }
  };

  // ------------------------------------------------------------------- methods

  self.dismiss = function () {
    self.cookieValue = self.status.dismissed;
    self.setCookie(self.cookieName, self.cookieValue, self.cookieExpiryDays, self.cookieDomain, self.cookiePath);
    self.close();
    self.onCheck(self.getStatus(), self);
  };

  self.allow = function () {
    self.cookieValue = self.status.allowed;
    self.setCookie(self.cookieName, self.cookieValue, self.cookieExpiryDays, self.cookieDomain, self.cookiePath);
    self.close();
    self.onCheck(self.getStatus(), self);
  };

  self.deny = function () {
    self.cookieValue = self.status.denied;
    self.setCookie(self.cookieName, self.cookieValue, self.cookieExpiryDays, self.cookieDomain, self.cookiePath);
    self.open();
    self.onCheck(self.getStatus(), self);
  };

  self.open = function () {
    if (!self.hasClass(self.popup, 'open')) {
      self.addClass(self.popup, 'open');
    }
  };

  self.close = function () {
    self.removeClass(self.popup, 'open');
  };

  self.getCookie = function (name) {
    var value = '; ' + document.cookie;
    var parts = value.split('; ' + name + '=');
    return parts.length !== 2 ? undefined : parts.pop().split(';').shift();
  };

  self.setCookie = function (name, value, expiryDays, domain, path) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + (expiryDays || 365));
    var cookie = [
      name + '=' + value,
      'expires=' + exdate.toUTCString(),
      'path=' + (path || '/')
    ];
    if (domain) {
      cookie.push('domain=' + domain);
    }

    document.cookie = cookie.join(';');
  };

  self.deleteCookie = function (name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  };

  self.getStatus = function () {
    return self.getCookie(self.cookieName) || 'undefined';
  };

  self.didConsent = function () {
    var val = self.getCookie(self.cookieName);
    return val === self.status.allowed || val === self.status.dismissed;
  };

  self.escapeRegExp = function (str) {
    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&');
  };

  self.hasClass = function (element, selector) {
    var s = ' ';
    return element.nodeType === 1 &&
      (s + element.className + s).replace(/[\n\t]/g, s).indexOf(s + selector + s) >= 0;
  };

  self.addClass = function (element, className) {
    element.className += ' ' + className;
  };

  self.removeClass = function (element, className) {
    var regex = new RegExp('\\b' + self.escapeRegExp(className) + '\\b');
    element.className = element.className.replace(regex, '');
  };

  // ----------------------------------------------------------- hooks callbacks

  self.onCheck = self.options.onCheck || function (didConsent, status) {};

  // ---------------------------------------------------------------------------

  self.init();

};
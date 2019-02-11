YOURLS-reCAPTCHA-Plugin
====================
Plugin for [YOURLS](http://yourls.org) to protect shortener from bots.

Installation
------------
1. Create `/user/plugins/yourls-recaptcha-plugin` folder for plugin and copy `plugin.php`.
2. Sign up for a reCaptcha key at [Google](https://www.google.com/recaptcha/admin)
3. Insert key in `plugin.php`
4. Insert `<div class="g-recaptcha" data-sitekey="recaptcha_key"></div>` to form in `index.php` 

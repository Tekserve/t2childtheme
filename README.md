t2-vertikal-child-theme
=======================

Child theme of Vertikal for WordPress. Contains specific changes for t2computing.com.

Installation
------------
1. Install Vertikal theme (http://preview.themique.com/vertikal/demo.html)
2. Install required plugins as detailed in theme installation guide
3. Install this child theme by uploading to your 'wp-content/themes/' directory
4. Replace the plugin 'Vertikal Premium Theme Add-ons' with the version included in this child theme's directory as 'js_vertikal_addons_t2.zip'

Overriding Plugin Functions
---------------------------
'js_vertikal_addons_t2' is an alternate version of the included plugin that allows you to write your own versions of some of the shortcodes.
The functions that can be overridden are:

* tmq_HR
* tmq_Gap
* tmq_progressbar
* tmq_review
* tmq_taglist
* tmq_services
* tmq_promobox
* tmq_teammembers
* tmq_clients
* tmq_pricetable
* tmq_portfolio
* tmq_blog
* tmq_contactinfo

To override a function, just write the function definition in the included file 'vertikal_addons_overrides.php'.
A rewrite of 'tmq_teammembers' is included (with original code included and commented out where necessary... you don't have to write your functions this way, but it makes it easier to update your overrides should Themique update one of the original functions) in this file as an example.# t2childtheme

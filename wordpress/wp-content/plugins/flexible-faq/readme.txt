=== Flexible FAQ ===
Contributors: bagerathan
Donate link: http://www.wpsnippet.com
Tags: faq, q & a, q and a
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Flexible FAQ is a very simple plugin to add FAQs (Frequently asked questions) to your WordPress site using shortcodes. 

== Description ==

I have created this plugin to use on my client's websites to provide an easy FAQ section when needed. It provided much more flexibility than adding an FAQ section into the theme. 

Hope this plugin would help anyone who needed a FAQ section in their website.

**Shortcodes**

You can add the [faq] shortcode to any page to display the FAQ section. This shortcode does accept few attributes. 

1. style - possibilities : pretty, block, list
2. ids - possibilities : comma separated IDs of FAQ items.
3. category - possibilities : category slug.

for example : *[faq style="pretty”]*

You can re-order the FAQ items by drag them in FAQ admin page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `flexible-faq` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Is it possible to change the styles? =

Absolutely. Just copy the flexible-faq.css file from your plugin folder to the theme root folder and make any change you desire. Because you are copying the css file to your theme folder, it will not get overwrite when the plugin get updated.

= How many FAQ pages can I have? =

As many as you want. You can use the shortcode to specifically display the FAQ items. By category or just by IDs. 

For example if you have a FAQ category id “1” then you can use the shortcode [faq category=1] to display just the FAQ items from that category.

or

For example out of all the FAQ items you have, if you just need to display two FAQ items in a page, you can simply use [faq ids=“123,124”] to display just those two FAQ items. Here 123 and 124 are the IDs of the FAQ items intended to be displayed.  

= I still have a question = 

Please ask here on the [Support] (http://wordpress.org/support/plugin/flexible-faq “Flexible FAQ Support”). Thanks.  

== Screenshots ==

1. shortcode [faq style=“block”]

2. shortcode [faq style=“pretty”] or just [faq]

3. shortcode [faq style=“list”]

== Changelog ==

= 0.2 =
* Fix - Now it is possible to have multiple FAQ blocks in pretty style.
* Fix - Now it is possible to have same question on multiple blocks of questions.

= 0.1 =
* Initial release.

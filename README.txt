=== Plugin Name ===
Contributors: nnyvang
Donate link: http://ccnn.dk
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Small and simple plugin which makes it easy for an enduser to implement DoCAS course data on their Wordpress site.

Please note: You MUST be a "Maxi customer" with DoCAS to have any use of this plugin
For more info on DoCAS, please visit [DoCAS Systems](http://docas.dk/)

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload ans unzip `docas.zip` to the `/wp-content/plugins/` directory / or install the `docas.zip` via plugin manager
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the options menu and save your account specific DoCAS API keys
4. Add the shortcode to the page/post where the data should be displayed:

= Shortcodes supported =

These are the shortcode which is currently supported:

* [docas_list_all data="courses"]
* [docas_list_all data="courselists"]
* [docas_list_all data="coursemodels"]
* [docas_list_all data="instructors"]
* [docas_list_all data="locations"]
* [docas_list_all data="vendor"]

== Frequently Asked Questions ==

= Do I need to write code to do this =

No coding skills required, just copy paste the shortcodes where you want them

= How to list all courses =

Place the shortcode [docas_list_all data="courses"]

== Screenshots ==

1. DoCAS Options Menu
2. Shortcode on a page

== Changelog ==

= 1.0.1 =
* Minor security update
* Shortcodes refactored into one dynamic shortcode

= 1.0.0 =
* Initial stable version
* Supports shortcodes which generates Ajax based data from the DoCAS database

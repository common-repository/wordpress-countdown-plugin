=== Plugin Name ===
Contributors: pepijndevos
Tags: countdown, javascript, redirect, shortcode
Requires at least: 2.5
Tested up to: 3.0
Stable tag: trunk
Donate link: http://pepijndevos.nl/donate/

Add a countdown timer to any page hiding content until the date passes.

== Description ==

With this plugin you can set up a countdown timer - or even multiple - on a page. The timer will count down until the given date and show the alternative content.

This plugin is great for use on sales pages and product launches or discounts, it gives a sense of tension to the visitor.

This plugin does not use an admin page, everything is done with a few simple shortcodes.

*Usage:*

`[countdown date="18:00:00 08/30/2009"]
This page goes live in about: [counter]
[after]
Enter your secret content here
[/countdown]`

Note that dates are UTC and that alternative content is not send to the browser until the date passed.

== Installation ==

1. Upload `countdown.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

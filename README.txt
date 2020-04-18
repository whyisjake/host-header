=== WordPress Host Headers ===
Contributors: whyisjake
Donate link: https://jakespurlock.com
Tags: security, hosting
Requires at least: 1.5
Tested up to: 5.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a Host-Header to track down hosting partners in helping combat web spam.

== Description ==

This simple plugin that adds a "Host-Header" HTTP header where you can define your webhost. Web partners that scan for compromised websites can notify hosts more effectively to cleanup sites.

This plugin is super overkill. Adding a simple file with the following to your `mu-plugins.php` will have the same effect.

`
// custom-host-header.php
add_filter( 'wp_headers', function( $headers ) {
	$headers['Host-Header'] = 'YOUR HOST NAME HERE';
	return $headers;
} );
`

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `/host-header/` plugin to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Or, search for the plugin in the plugin repo.
1. There is no step 4.

== Changelog ==

= 1.0.1 =
* Fix the clode block

= 1.0.0 =
* Let's kick this off.

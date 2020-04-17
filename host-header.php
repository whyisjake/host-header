<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jakespurlock.com
 * @since             1.0.0
 * @package           Host_Header
 *
 * @wordpress-plugin
 * Plugin Name:       Host Header
 * Plugin URI:        https://github.com/whyisjake/host-header
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jake Spurlock
 * Author URI:        https://jakespurlock.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       host-header
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HOST_HEADER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-host-header-activator.php
 */
function activate_host_header() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-host-header-activator.php';
	Host_Header_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-host-header-deactivator.php
 */
function deactivate_host_header() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-host-header-deactivator.php';
	Host_Header_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_host_header' );
register_deactivation_hook( __FILE__, 'deactivate_host_header' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-host-header.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_host_header() {

	$plugin = new Host_Header();
	$plugin->run();

}
run_host_header();

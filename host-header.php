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
 * Description:       Add a Host-Header to track down hosting partners in helping combat web spam.
 * Version:           1.0.1
 * Author:            Jake Spurlock
 * Author URI:        https://jakespurlock.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'HOST_HEADER_VERSION', '1.0.1' );

function host_header_add_to_headers( $headers ) {
	$options = get_option( 'host_header_api_settings' );

	if ( '1' === $options['host_header_api_display_1'] && ! empty( $options['host_header_api_text_field_0'] ) || apply_filters( 'host_header_bypass', false ) ) {
		$headers['Host-Header'] = apply_filters( 'host_header', $options['host_header_api_text_field_0'] );
	}

	return $headers;
}

// Add custom header for VIP
add_filter( 'wp_headers', 'host_header_add_to_headers' );
add_action( 'admin_menu', 'host_header_add_admin_menu' );
add_action( 'admin_init', 'host_header_api_settings_init' );

function host_header_add_admin_menu() {
	add_options_page( 'Host Header Settings', 'Host Header Settings', 'manage_options', 'host-header-settings', 'host_header_settings' );
}

function host_header_api_settings_init() {
	register_setting( 'host_header', 'host_header_api_settings' );
	add_settings_section(
		'host_header_api_host_header_section',
		__( 'Options', 'Host_Header' ),
		'host_header_api_settings_section_callback',
		'host_header'
	);

	add_settings_field(
		'host_header_api_text_field_0',
		__( 'Host Value', 'Host_Header' ),
		'host_header_api_host_0_render',
		'host_header',
		'host_header_api_host_header_section'
	);

	add_settings_field(
		'host_header_api_display_1',
		__( 'Display', 'Host_Header' ),
		'host_header_api_select_field_1_render',
		'host_header',
		'host_header_api_host_header_section'
	);
}

function host_header_api_host_0_render() {
	$options = get_option( 'host_header_api_settings' );
	?>
	<input type='text' name='host_header_api_settings[host_header_api_text_field_0]' value='<?php echo $options['host_header_api_text_field_0']; ?>'>
	<?php
}

function host_header_api_select_field_1_render() {
	$options = get_option( 'host_header_api_settings' );
	?>
	<select name='host_header_api_settings[host_header_api_display_1]'>
		<option value='1' <?php selected( $options['host_header_api_display_1'], 1 ); ?>>True</option>
		<option value='0' <?php selected( $options['host_header_api_display_1'], 0 ); ?>>False</option>
	</select>

	<?php
}

function host_header_api_settings_section_callback() {
	echo __( 'Choose whether to display the header, and what value to use.', 'Host_Header' );
}

function host_header_settings() {
	?>
	<form action='options.php' method='post'>

		<h1>Host Header Settings</h1>

		<?php
		settings_fields( 'host_header' );
		do_settings_sections( 'host_header' );
		submit_button();
		?>

	</form>
	<?php
}

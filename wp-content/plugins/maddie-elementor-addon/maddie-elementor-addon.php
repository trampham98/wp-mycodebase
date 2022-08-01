<?php
/**
 * Plugin Name:       Maddie Elementor Addon
 * Plugin URI:        https://madison-technologies.com/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Author:            Maddie Team
 * Author URI:        https://madison-technologies.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       maddie-elementor-addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action('plugins_loaded', 'maddie_elementor_addon');
function maddie_elementor_addon() {
	if (!did_action('elementor/loaded')) {
		add_action('admin_notices', 'admin_notice_missing_elementor_plugin');
		return false;
	}

	$maddie_includes = array(
		'enqueue.php',
		'posttypes.php',
		'widgets.php',
		'functions.php',
	);
	foreach ($maddie_includes as $file) {
		require_once(__DIR__ . '/includes/' . $file);
	}
}

function admin_notice_missing_elementor_plugin() {
	if (isset($_GET['activate'])) 
		unset($_GET['activate']);

	$message = sprintf(
		esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'maddie-elementor-addon'),
		'<strong>' . esc_html__('Maddie Elementor Addon', 'maddie-elementor-addon') . '</strong>',
		'<strong>' . esc_html__('Elementor', 'maddie-elementor-addon') . '</strong>'
	);

	printf('<div class="notice notice-error"><p>%1$s</p></div>', $message);
}
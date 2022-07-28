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
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Array of files to include.
$maddie_includes = array(
	'posttypes.php',
	'functions.php',
);

// Include files.
foreach ($maddie_includes as $file) {
  require_once(__DIR__.'/includes/'.$file);
}

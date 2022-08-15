<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$maddie_inc_dir = 'inc/';
$maddie_includes = array(
	'enqueue.php',
	'menus.php',
	'posttypes.php',
	'taxonomies.php',
	'widgets.php',
	'elementor-widgets.php',
	'functions.php',
	'ajax.php',
	'shortcodes.php',
);

// Include files.
foreach ($maddie_includes as $file) {
	require_once get_theme_file_path( $maddie_inc_dir . $file );
}
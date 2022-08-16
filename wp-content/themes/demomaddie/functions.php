<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$demomaddie_inc_dir  = 'inc/';
$demomaddie_includes = array(
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

foreach ($demomaddie_includes as $file) {
	require_once get_theme_file_path($demomaddie_inc_dir.$file);
}
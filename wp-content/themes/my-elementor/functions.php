<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

require('inc/config.php');

add_action('init', 'masterInit');
function masterInit() {
	require('inc/posttypes.php');
	require('inc/taxonomies.php');
	require('inc/menus.php');
	require('inc/acf.php');
}

add_action('widgets_init', 'masterWidgetsInit');
function masterWidgetsInit() {
	require('inc/widgets.php');
}

// Extras functions
require('inc/extras.php');
require('inc/elementor-widgets.php');
require('inc/shortcodes.php');
require('inc/ajax.php');

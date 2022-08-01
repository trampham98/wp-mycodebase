<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action('elementor/elements/categories_registered', 'maddie_addon_register_elementor_widget_categories');
function maddie_addon_register_elementor_widget_categories($elements_manager) {
	$elements_manager->add_category(
		'maddie-category',
		[
			'title' => esc_html__('Maddie Category', 'maddie'),
			'icon' => 'fa fa-plug',
			'sort' => 'a-z',
		]
	);
}

add_action('elementor/widgets/register', 'maddie_addon_register_elementor_widget');
function maddie_addon_register_elementor_widget($widgets_manager) {  
  require_once(__DIR__ . '/widgets/maddie-posts/maddie-posts.php');
  $widgets_manager->register(new \Elementor_Maddie_Addon_Posts_Widget());
}
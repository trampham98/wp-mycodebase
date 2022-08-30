<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('elementor/elements/categories_registered', 'demomaddie_add_elementor_widget_categories');
function demomaddie_add_elementor_widget_categories($elements_manager) {
	$elements_manager->add_category(
		'demomaddie-elementor-cat',
		[
			'title' => esc_html__('DemoMaddie', 'demomaddie'),
			'icon' => 'fa fa-plug',
		]
	);
}

add_action('elementor/widgets/register', 'demomaddie_register_elementor_widgets');
function demomaddie_register_elementor_widgets($widgets_manager) {
  $stylesheet_url = get_stylesheet_directory();

	require_once($stylesheet_url.'/elementor-widgets/demomaddie-slider/demomaddie-slider.php');
	require_once($stylesheet_url.'/elementor-widgets/demomaddie-posts/demomaddie-posts.php');

	$widgets_manager->register(new \Elementor_DemoMaddie_Slider_Widget());
	$widgets_manager->register(new \Elementor_DemoMaddie_Posts_Widget());
}
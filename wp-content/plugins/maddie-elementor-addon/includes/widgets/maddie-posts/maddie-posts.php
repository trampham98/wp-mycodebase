<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Elementor_Maddie_Addon_Posts_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'maddie-addon-posts';
	}

	public function get_title() {
		return esc_html__('Maddie Posts', 'maddie-addon');
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return ['maddie-category'];
	}

	public function get_keywords() {
		return ['posts', 'maddie', 'addon'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'maddie-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => esc_html__('URL to embed', 'maddie-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => esc_html__('https://your-link.com', 'maddie-addon'),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$html = wp_oembed_get( $settings['url'] );

		echo '<div class="oembed-elementor-widget">';
		echo ( $html ) ? $html : $settings['url'];
		echo '</div>';
	}

}
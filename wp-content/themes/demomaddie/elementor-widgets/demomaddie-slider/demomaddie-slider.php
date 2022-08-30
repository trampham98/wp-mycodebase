<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class Elementor_DemoMaddie_Slider_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'elementor_demomaddie_slider_widget';
	}

	public function get_title() {
		return esc_html__('DemoMaddie Slider', 'demomaddie');
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return ['demomaddie-elementor-cat'];
	}

	public function get_keywords() {
		return ['demomaddie', 'slider'];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ctrl_section_content',
			[
				'label' => esc_html__('Slides', 'demomaddie'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'ctrl_section_layout',
			[
				'label'   => esc_html__('Layout', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'      => esc_html__('Default', 'demomaddie'),
					'slide-images' => esc_html__('Slide Images', 'demomaddie'),
				],
			]
		);
	}

	protected function render() {
		// $settings = $this->get_settings_for_display();
    echo "Hello";
	}
}
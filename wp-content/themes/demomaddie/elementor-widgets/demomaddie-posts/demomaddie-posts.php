<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

class Elementor_DemoMaddie_Posts_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'elementor_demomaddie_posts_widget';
	}

	public function get_title() {
		return esc_html__('DemoMaddie Posts', 'demomaddie');
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return ['demomaddie-elementor-cat'];
	}

	public function get_keywords() {
		return ['demomaddie', 'posts'];
	}

  public function get_post_types() {
		$post_types = get_post_types(array(
			'public' => true
		));
		
		if (!$post_types) {
			$post_types = array(
				'post'  => esc_html__('Post', 'maddie-addon'),
			);
			return $post_types;
		}

		unset($post_types['attachment']);
		unset($post_types['e-landing-page']);
		unset($post_types['elementor_library']);
		unset($post_types['edl-listing']);

		return $post_types;
	}

	public function get_post_categories() {
		$control = (array) $this;
		$post_type = isset( $control["\0Elementor\Controls_Stack\0data"]['settings']['ctrl_post_type'] ) ? $control["\0Elementor\Controls_Stack\0data"]['settings']['ctrl_post_type'] : 'post';

		$taxonomies = get_object_taxonomies($post_type, 'names'); 
		$taxonomy   = $taxonomies ? $taxonomies[0] : 'category';

		$post_cat = array('all-cat' => esc_html__('All Categories', 'maddie'));

		$args = array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		);
		$terms = get_categories($args);

		if (!$terms) 
			return $post_cat;
			
		foreach ($terms as $term) {
			$post_cat[$term->slug] = $term->name;
		}

		error_log('hello789');
		error_log(print_r($post_cat, true));

		return $post_cat;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'ctrl_section_layout',
			[
				'label' => esc_html__('Layout', 'demomaddie'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
			'ctrl_widget_title',
			[
				'label'       => esc_html__('Title', 'demomaddie'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Default title', 'demomaddie'),
				'placeholder' => esc_html__('Type your title here', 'demomaddie'),
        'label_block' => true,
			]
		);

    $this->add_control(
			'ctrl_widget_heading1',
			[
				'label'     => esc_html__('Posts Queries', 'demomaddie'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

    $this->add_control(
			'ctrl_layout',
			[
				'label'   => esc_html__('Layout', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'demomaddie'),
					'slider'  => esc_html__('Slider', 'demomaddie'),
				],
			]
		);

    $this->add_control(
			'ctrl_post_type',
			[
				'label'   => esc_html__('Post type', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => $this->get_post_types(),
			]
		);

    $this->add_control(
			'ctrl_post_categories',
			[
				'label'   => esc_html__('Post categories', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => $this->get_post_categories(),
				'condition' => [
					'ctrl_post_type!' => '',
				],
			]
		);

	}

	protected function render() {
		// $settings = $this->get_settings_for_display();
    echo "Hello";
	}
}
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

  public static function get_button_sizes() {
		return [
			'xs' => esc_html__('Extra Small', 'demomaddie'),
			'sm' => esc_html__('Small', 'demomaddie'),
			'md' => esc_html__('Medium', 'demomaddie'),
			'lg' => esc_html__('Large', 'demomaddie'),
			'xl' => esc_html__('Extra Large', 'demomaddie'),
		];
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

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs('slides_repeater');

    $repeater->start_controls_tab('content', [ 
      'label' => esc_html__('Content', 'demomaddie') 
    ]);
		$repeater->add_control(
			'ctrl_slide_heading',
			[
				'label'       => esc_html__('Title & Description', 'demomaddie'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('Slide Heading', 'demomaddie'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'ctrl_slide_description',
			[
				'label'      => esc_html__('Description', 'demomaddie'),
				'type'       => \Elementor\Controls_Manager::TEXTAREA,
				'default'    => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'demomaddie'),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'ctrl_slide_cta_btn',
			[
				'label'   => esc_html__('CTA Button Text', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Click Here', 'demomaddie'),
			]
		);
		$repeater->add_control(
			'ctrl_slide_cta_link',
			[
				'label' => esc_html__('CTA Link', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'demomaddie'),
			]
		);
		$repeater->add_control(
			'ctrl_slide_cta_link_click',
			[
				'label'   => esc_html__('Apply Link On', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'slide'  => esc_html__('Whole Slide', 'demomaddie'),
					'button' => esc_html__('CTA Button Only', 'demomaddie'),
				],
				'default'    => 'slide',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'ctrl_slide_cta_link[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab('background', [ 
      'label' => esc_html__('Background', 'demomaddie')
    ]);
		$repeater->add_control(
			'ctrl_slide_background_color',
			[
				'label'     => esc_html__('Color', 'demomaddie'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'ctrl_slide_background_image',
			[
				'label'     => _x('Image', 'Background Control', 'demomaddie'),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);
		$repeater->add_control(
			'ctrl_slide_background_size',
			[
				'label'   => _x('Size', 'Background Control', 'demomaddie'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover'   => _x('Cover', 'Background Control', 'demomaddie'),
					'contain' => _x('Contain', 'Background Control', 'demomaddie'),
					'auto'    => _x('Auto', 'Background Control', 'demomaddie'),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .swiper-slide-bg' => 'background-size: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'ctrl_slide_background_image[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);
		$repeater->add_control(
			'ctrl_slide_background_overlay',
			[
				'label'      => esc_html__('Background Overlay', 'demomaddie'),
				'type'       => \Elementor\Controls_Manager::SWITCHER,
				'default'    => '',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'ctrl_slide_background_image[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'ctrl_slides',
			[
				'label' => esc_html__('Slides', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'ctrl_slide_heading'          => esc_html__('Slide 1 Heading', 'demomaddie'),
						'ctrl_slide_description'      => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'demomaddie'),
						'ctrl_slide_cta_btn'          => esc_html__('Click Here', 'demomaddie'),
						'ctrl_slide_background_color' => '#833ca3',
					],
					[
						'ctrl_slide_heading'          => esc_html__('Slide 2 Heading', 'demomaddie'),
						'ctrl_slide_description'      => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'demomaddie'),
						'ctrl_slide_cta_btn'          => esc_html__('Click Here', 'demomaddie'),
						'ctrl_slide_background_color' => '#4054b2',
					],
					[
						'ctrl_slide_heading'          => esc_html__('Slide 3 Heading', 'demomaddie'),
						'ctrl_slide_description'      => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'demomaddie'),
						'ctrl_slide_cta_btn'          => esc_html__('Click Here', 'demomaddie'),
						'ctrl_slide_background_color' => '#1abc9c',
					],
				],
				'title_field' => '{{{ ctrl_slide_heading }}}',
			]
		);

		$this->add_responsive_control(
			'ctrl_slides_height',
			[
				'label' => esc_html__('Height', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ctrl_section_slider_options',
			[
				'label' => esc_html__('Slider Options', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SECTION,
			]
		);
		$this->add_control(
			'navigation',
			[
				'label' => esc_html__('Navigation', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => esc_html__('Arrows and Dots', 'demomaddie'),
					'arrows' => esc_html__('Arrows', 'demomaddie'),
					'dots' => esc_html__('Dots', 'demomaddie'),
					'none' => esc_html__('None', 'demomaddie'),
				],
				'frontend_available' => true,
			]
		);

    $this->add_control(
			'ctrl_nav_dots',
			[
				'label' => esc_html__('Nav Dots', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__('Autoplay', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__('Pause on Hover', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'autoplay!' => '',
				],
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label' => esc_html__('Pause on Interaction', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'autoplay!' => '',
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__('Autoplay Speed', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'transition-duration: calc({{VALUE}}ms*1.2)',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => esc_html__('Infinite Loop', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'transition',
			[
				'label' => esc_html__('Transition', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => esc_html__('Slide', 'demomaddie'),
					'fade' => esc_html__('Fade', 'demomaddie'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label' => esc_html__('Transition Speed', 'demomaddie') . ' (ms)',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'content_animation',
			[
				'label' => esc_html__('Content Animation', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'' => esc_html__('None', 'demomaddie'),
					'fadeInDown' => esc_html__('Down', 'demomaddie'),
					'fadeInUp' => esc_html__('Up', 'demomaddie'),
					'fadeInRight' => esc_html__('Right', 'demomaddie'),
					'fadeInLeft' => esc_html__('Left', 'demomaddie'),
					'zoomIn' => esc_html__('Zoom', 'demomaddie'),
				],
				'assets' => [
					'styles' => [
						[
							'name' => 'e-animations',
							'conditions' => [
								'terms' => [
									[
										'name' => 'content_animation',
										'operator' => '!==',
										'value' => '',
									],
								],
							],
						],
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => esc_html__('Slides', 'demomaddie'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => esc_html__('Content Width', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-contents' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => esc_html__('Padding', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => esc_html__('Horizontal Position', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'demomaddie'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'demomaddie'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'demomaddie'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor--h-position-',
			]
		);

		$this->add_control(
			'slides_vertical_position',
			[
				'label' => esc_html__('Vertical Position', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => esc_html__('Top', 'demomaddie'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__('Middle', 'demomaddie'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'demomaddie'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'elementor--v-position-',
			]
		);

		$this->add_control(
			'slides_text_align',
			[
				'label' => esc_html__('Text Align', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'demomaddie'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'demomaddie'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'demomaddie'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .swiper-slide-contents',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__('Title', 'demomaddie'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_spacing',
			[
				'label' => esc_html__('Spacing', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-inner .elementor-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => esc_html__('Text Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-heading' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'global' => [
					// 'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .elementor-slide-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => esc_html__('Description', 'demomaddie'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_spacing',
			[
				'label' => esc_html__('Spacing', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-slide-inner .elementor-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Text Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'global' => [
					// 'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector' => '{{WRAPPER}} .elementor-slide-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__('Button', 'demomaddie'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => esc_html__('Size', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .elementor-slide-button',
				'global' => [
					// 'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label' => esc_html__('Border Width', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('button_tabs');

		$this->start_controls_tab('normal', [ 'label' => esc_html__('Normal', 'demomaddie') ] );

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elementor-slide-button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__('Border Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('hover', [ 'label' => esc_html__('Hover', 'demomaddie') ] );

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elementor-slide-button:hover',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'demomaddie'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		// $settings = $this->get_settings_for_display();
		// $html = wp_oembed_get( $settings['url'] );

    echo "Hello";

	}

}
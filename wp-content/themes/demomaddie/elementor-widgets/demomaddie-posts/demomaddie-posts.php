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

	public function get_post_categories($tax='category') {
		$post_cat = array('all-cat' => esc_html__('All Categories', 'maddie'));
		$args = array(
			'taxonomy'   => $tax,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'parent'     => 0
		);

		$terms = get_categories($args);

		if (!$terms) 
			return $post_cat;
			
		foreach ($terms as $term) {
			$term_id = $term->term_id;
			$child_ids = get_term_children($term_id, $tax);

			$post_cat[$term->slug] = $term->name;

			if ($child_ids) {
				foreach ($child_ids as $child_id) {
					$term_child = get_term($child_id, $tax);
					$post_cat[$term_child->slug] = "__".$term_child->name;
				}
			}
		}

		return $post_cat;
	}

	protected function register_controls() {
		$this->start_controls_section( 'ctrl_section_layout', [
			'label' => esc_html__('Content Setting', 'demomaddie'),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		]);

    $this->add_control('ctrl_widget_title', [
			'label'       => esc_html__('Title', 'demomaddie'),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__('Default title', 'demomaddie'),
			'placeholder' => esc_html__('Type your title here', 'demomaddie'),
			'label_block' => true,
		]);

		// queries
    $this->add_control('ctrl_widget_heading1', [
			'label'     => esc_html__('Post queries', 'demomaddie'),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('ctrl_related_post', [
			'label'        => esc_html__('Related posts query?', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => esc_html__('Yes', 'demomaddie'),
			'label_off'    => esc_html__('No', 'demomaddie'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_control('ctrl_related_post_option', [
			'label'        => esc_html__('Customize related post queries?', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => esc_html__('Yes', 'demomaddie'),
			'label_off'    => esc_html__('No', 'demomaddie'),
			'return_value' => 'yes',
			'default'      => 'no',
			'condition' => [
				'ctrl_related_post' => 'yes',
			],
		]);

		$this->add_control('ctrl_layout', [
			'label'   => esc_html__('Layout', 'demomaddie'),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'default',
			'options' => [
				'default'   => esc_html__('Default', 'demomaddie'),
				'image-box' => esc_html__('Image box', 'demomaddie'),
			],
		]);

    $this->add_control('ctrl_post_type', [
			'label'   => esc_html__('Post type', 'demomaddie'),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'post',
			'options' => [
				'post'  => esc_html__('Post', 'demomaddie'),
				'movie' => esc_html__('Movie', 'demomaddie'),
			],
		]);

    $this->add_control('ctrl_post_categories', [
			'label'   => esc_html__('Post categories', 'demomaddie'),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'all-cat',
			'options' => $this->get_post_categories(),
			'conditions' => [
				'relation' => 'or',
				'terms' => [
					[
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'ctrl_related_post',
								'operator' => '!==',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_post_type',
								'operator' => '===',
								'value' => 'post',
							],
						],
					],
					[
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'ctrl_related_post',
								'operator' => '===',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_related_post_option',
								'operator' => '==',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_post_type',
								'operator' => '===',
								'value' => 'post',
							],
						],
					],
				],
			],
		]);

		$this->add_control('ctrl_movie_categories', [
			'label'   => esc_html__('Movie categories', 'demomaddie'),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'all-cat',
			'options' => $this->get_post_categories('tax_movie'),
			'conditions' => [
				'relation' => 'or',
				'terms' => [
					[
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'ctrl_related_post',
								'operator' => '!==',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_post_type',
								'operator' => '===',
								'value' => 'movie',
							],
						],
					],
					[
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'ctrl_related_post',
								'operator' => '===',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_related_post_option',
								'operator' => '==',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_post_type',
								'operator' => '===',
								'value' => 'movie',
							],
						],
					],
				],
			],
		]);

		$this->add_control('ctrl_posts_per_page', [
			'label'   => esc_html__('Posts/page', 'demomaddie'),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'min'     => -1,
			'max'     => 100,
			'step'    => 2,
			'default' => 8,
		]);

		$this->add_control('ctrl_nothing_found_mess', [
			'label'       => esc_html__('Nothing found message', 'demomaddie'),
			'type'        => \Elementor\Controls_Manager::TEXTAREA,
			'rows'        => 5,
			'default'     => esc_html__('It seems we can&#039;t find what you&#039;re looking for.', 'demomaddie'),
			'conditions' => [
				'relation' => 'or',
				'terms' => [
					[
						'name' => 'ctrl_related_post',
						'operator' => '!==',
						'value' => 'yes',
					],
					[
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'ctrl_related_post',
								'operator' => '===',
								'value' => 'yes',
							],
							[
								'name' => 'ctrl_related_post_option',
								'operator' => '===',
								'value' => 'yes',
							],
						],
					],
				],
			],
		]);

		// advanced
    $this->add_control('ctrl_widget_heading2', [
			'label'     => esc_html__('Advanced', 'demomaddie'),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_responsive_control('ctrl_columns', [
			'type' => \Elementor\Controls_Manager::SELECT,
			'label' => esc_html__('Columns', 'demomaddie'),
			'options' => [
				'maddie-columns-1' => esc_html__('1', 'demomaddie'),
				'maddie-columns-2' => esc_html__('2', 'demomaddie'),
				'maddie-columns-3' => esc_html__('3', 'demomaddie'),
				'maddie-columns-4' => esc_html__('4', 'demomaddie'),
				'maddie-columns-5' => esc_html__('5', 'demomaddie'),
				'maddie-columns-6' => esc_html__('6', 'demomaddie'),
			],
			'desktop_default' => 'maddie-columns-4',
			'tablet_default'  => 'maddie-columns-2',
			'mobile_default'  => 'maddie-columns-1',
			// 'selectors' => [
			// 	'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			// ],
			// 'prefix_class' => 'content-align-%s',
		]);

		$this->add_control('ctrl_show_cta', [
			'label'        => esc_html__('Show CTA button', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => esc_html__('Show', 'demomaddie'),
			'label_off'    => esc_html__('Hide', 'demomaddie'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_control('ctrl_cta_title', [
			'label'       => esc_html__('Title button', 'demomaddie'),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__('See more', 'demomaddie'),
			'placeholder' => esc_html__('Type your title here', 'demomaddie'),
			'label_block' => true,
			'condition'   => [
				'ctrl_show_cta' => 'yes',
			],
		]);

		$this->add_control('ctrl_cta_url', [
			'label'       => esc_html__('Link button', 'demomaddie'),
			'type'        => \Elementor\Controls_Manager::URL,
			'placeholder' => esc_html__('https://your-link.com', 'demomaddie'),
			'label_block' => true,
			'default'     => [
				'url'         => '',
				'is_external' => false,
				'nofollow'    => true,
			],
			'condition' => [
				'ctrl_show_cta' => 'yes',
			],
		]);

		$this->add_control('ctrl_show_categories_filter', [
			'label'        => esc_html__('Show categories filter', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => esc_html__('Show', 'demomaddie'),
			'label_off'    => esc_html__('Hide', 'demomaddie'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_control('ctrl_show_pagination', [
			'label'        => esc_html__('Show pagination', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'label_on'     => esc_html__('Show', 'demomaddie'),
			'label_off'    => esc_html__('Hide', 'demomaddie'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_responsive_control('ctrl_entrance_animation', [
			'label'        => esc_html__('Entrance Animation', 'demomaddie'),
			'type'         => \Elementor\Controls_Manager::ANIMATION,
			// 'prefix_class' => 'animated ',
			'default'      => 'none',
		]);

		$this->end_controls_section();

		/**
		 * Style controls
		 */
		$this->start_controls_section('ctrl_style', [
			'label' => esc_html__('Layout', 'demomaddie'),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('ctrl_row_align', [
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'label'   => esc_html__('Row alignment', 'demomaddie'),
			'toggle'  => false,
			'default' => 'left',
			'options' => [
				'left' => [
					'title' => esc_html__('Left', 'demomaddie'),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'demomaddie'),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__('Right', 'demomaddie'),
					'icon'  => 'eicon-text-align-right',
				],
			],
			// 'prefix_class' => 'content-align-%s',
		]);

		$this->add_control('ctrl_widget_heading3', [
			'label'     => esc_html__('Widget Title', 'demomaddie'),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('ctrl_widget_title_color', [
			'label' => esc_html__('Color', 'demomaddie'),
			'type' => \Elementor\Controls_Manager::COLOR,
			// 'selectors' => [
			// 	'{{WRAPPER}} .title' => 'color: {{VALUE}}',
			// ],
		]);

		// ctrl_widget_title_typography
		$this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
			'name' => 'ctrl_widget_title_typography',
			// 'selector' => '{{WRAPPER}} .your-class',
		]);

		$this->add_responsive_control('ctrl_widget_title_align', [
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'label'   => esc_html__('Alignment', 'demomaddie'),
			'toggle'  => false,
			'default' => 'left',
			'options' => [
				'left' => [
					'title' => esc_html__('Left', 'demomaddie'),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'demomaddie'),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__('Right', 'demomaddie'),
					'icon'  => 'eicon-text-align-right',
				],
			],
			// 'prefix_class' => 'content-align-%s',
		]);

		$this->add_control('ctrl_widget_heading4', [
			'label'     => esc_html__('Nothing found message', 'demomaddie'),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('ctrl_nothing_found_mess_color', [
			'label' => esc_html__('Color', 'demomaddie'),
			'type' => \Elementor\Controls_Manager::COLOR,
			// 'selectors' => [
			// 	'{{WRAPPER}} .title' => 'color: {{VALUE}}',
			// ],
		]);

		// ctrl_nothing_found_mess_typography
		$this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
			'name' => 'ctrl_nothing_found_mess_typography',
			// 'selector' => '{{WRAPPER}} .your-class',
		]);

		$this->add_responsive_control('ctrl_nothing_found_mess_align', [
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'label'   => esc_html__('Alignment', 'demomaddie'),
			'toggle'  => false,
			'default' => 'left',
			'options' => [
				'left' => [
					'title' => esc_html__('Left', 'demomaddie'),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'demomaddie'),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__('Right', 'demomaddie'),
					'icon'  => 'eicon-text-align-right',
				],
			],
			// 'prefix_class' => 'content-align-%s',
		]);

		$this->add_control('ctrl_widget_heading5', [
			'label'     => esc_html__('CTA button', 'demomaddie'),
			'type'      => \Elementor\Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('ctrl_cta_button_color', [
			'label' => esc_html__('Color', 'demomaddie'),
			'type' => \Elementor\Controls_Manager::COLOR,
			// 'selectors' => [
			// 	'{{WRAPPER}} .title' => 'color: {{VALUE}}',
			// ],
		]);

		// ctrl_cta_button_typography
		$this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
			'name' => 'ctrl_cta_button_typography',
			// 'selector' => '{{WRAPPER}} .your-class',
		]);

		$this->add_responsive_control('ctrl_cta_button_align', [
			'type'    => \Elementor\Controls_Manager::CHOOSE,
			'label'   => esc_html__('Alignment', 'demomaddie'),
			'toggle'  => false,
			'default' => 'left',
			'options' => [
				'left' => [
					'title' => esc_html__('Left', 'demomaddie'),
					'icon'  => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__('Center', 'demomaddie'),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__('Right', 'demomaddie'),
					'icon'  => 'eicon-text-align-right',
				],
			],
			// 'prefix_class' => 'content-align-%s',
		]);

		$this->end_controls_section();
	}

	protected function render() {
		global $the_query;

		$widget_id      = $this->get_id();
		$settings       = $this->get_settings_for_display();

		$tax            = '';
		$term           = '';
		$curr_post_id   = '';

		$widget_title    = $settings['ctrl_widget_title'];
		$widget_layout   = $settings['ctrl_layout'] ?? 'default';
		$related_query   = $settings['ctrl_related_post'];
		$related_option  = $settings['ctrl_related_post_option'];
		$post_type       = $settings['ctrl_post_type'];
		$posts_per_page  = $settings['ctrl_posts_per_page'] ?? 8;
		$no_posts_mess   = $settings['ctrl_nothing_found_mess'];
		$columns         = $settings['ctrl_columns'] ?? 'maddie-columns-4';
		$show_filter     = $settings['ctrl_show_categories_filter'];
		$show_cta        = $settings['ctrl_show_cta'];
		$show_pagination = $settings['ctrl_show_pagination'];
		$animation       = $settings['ctrl_entrance_animation'];
		
		$classes = array(
			'maddie-posts-widget', 
			'maddie-widget-'.$widget_id
		);

		switch ($post_type) {
			case 'movie':
				$tax  = 'tax_movie';
				$term = $settings['ctrl_movie_categories'];
				break;
			
			default:
				$tax  = 'category';
				$term = $settings['ctrl_post_categories'];
				break;
		}

		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
		);

		if ($term != '' && $term != 'all-cat') {
			$args['tax_query'] =  array(
				array(
					'taxonomy' => $tax,
					'field'    => 'slug',
					'terms'    => $term,
				),
			);
		}

		if ($related_query == 'yes') {
			$curr_post_id = get_queried_object_id();
			$args['post__not_in'] =  array($curr_post_id);

			if ($related_option !== 'yes') {
				$curr_term = get_the_terms($curr_post_id, $tax);
				$term = $curr_term ? wp_list_pluck($curr_term, 'slug') : '';
	
				$args['tax_query'] =  array(
					array(
						'taxonomy' => $tax,
						'field'    => 'slug',
						'terms'    => $term,
					),
				);
			}
		}

		$the_query = new WP_Query($args);

		if ($related_query == 'yes' && $related_option !== 'yes') {
			$total_results = $the_query->found_posts;
			if ($total_results == 0) {
				$args['tax_query'] = array();
				$args['orderby']   = 'rand';
				$the_query = new WP_Query($args);
			}
		}
		?>

		<div class="<?php echo implode(" ", $classes); ?>">
			<div class="maddie-widget-wrapper">
				<!-- widget-title -->
				<?php if (!empty($widget_title)): ?>
					<div class="maddie-widget-title"><h2><?php echo $widget_title; ?></h2></div>
				<?php endif; ?>

				<!-- widget-content -->
				<div class="maddie-widget-content">
					<?php if ($the_query->have_posts()): ?>
						<div class="maddie-row">
							<?php
								while ($the_query->have_posts()) {
									$the_query->the_post(); 
									get_template_part('elementor-widgets/demomaddie-posts/layout/content', $widget_layout);
								}
							?>
						</div>
					<?php elseif ($no_posts_mess): ?>
						<div class="nothing-found-mess"><?php echo $no_posts_mess; ?></div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				
				<!-- cta button -->
				<?php if ($show_cta=='yes'):
					$cta_title = $settings['ctrl_cta_title'];
					$cta_url   = $settings['ctrl_cta_url'];
					if (empty($cta_title) || empty($cta_url)) return;
					$this->add_link_attributes('cta_link', $cta_url); 
					?>
					<div class="cta-wrapper">
						<a <?php echo $this->get_render_attribute_string('cta_link'); ?>><?php echo $cta_title; ?></a>
					</div>
				<?php endif; ?>

			</div>
		</div>

		<?php
	}
}
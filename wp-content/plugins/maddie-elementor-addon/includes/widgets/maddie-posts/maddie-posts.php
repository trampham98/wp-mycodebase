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
		unset($post_types['loop-template']);
		return $post_types;
	}

	public function get_loop_templates() {
		$loop_templates = array();

		$args = array(
			'post_type' => 'loop-template',
			'posts_per_page' => -1,
		);
		$posts= get_posts($args);
		
		if ($posts) {
			foreach ($posts as $post) {
				$loop_templates[$post->ID] = $post->post_title;
			}
		}

		return $loop_templates;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'maddie-addon'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ctrl_widget_title',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__('Widget Title', 'maddie-addon'),
				'label_block' => true,
				'placeholder' => esc_html__('Enter your title', 'maddie-addon'),
			]
		);

		$this->add_control(
			'ctrl_widget_heading1',
			[
				'label'     => esc_html__('Query Posts', 'maddie-addon'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ctrl_post_type',
			[
				'label'   => esc_html__('Post type', 'maddie-addon'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => $this->get_post_types(),
			]
		);

		$this->add_control(
			'ctrl_posts_per_page',
			[
				'label'       => esc_html__('Posts per page', 'maddie-addon'),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 4,
				'description' => esc_html__('Enter -1 to show all posts', 'maddie-addon'),
			]
		);

		$this->add_control(
			'ctrl_widget_heading2',
			[
				'label'     => esc_html__('Posts Layout', 'maddie-addon'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ctrl_loop_template',
			[
				'label'   => esc_html__('Loop Templates', 'maddie-addon'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_loop_templates(),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$widget_id    = $this->get_id();

		$widget_title   = $settings['ctrl_widget_title'];
		$post_type      = $settings['ctrl_post_type'];
		$posts_per_page = $settings['ctrl_posts_per_page'];
		$loop_template  = $settings['ctrl_loop_template'];


		$args = array(
			'post_type'  => 'post',
		);
		$query = new WP_Query($args);
		?>

		<div id="maddie-addon-widget-<?php echo $widget_id; ?>" class="maddie-addon-widget" data-id="<?php echo $widget_id; ?>">
			<div class="maddie-addon-widget-wrapper">
				<?php if ($widget_title && $widget_title != ''): ?>
					<div class="maddie-addon-widget-header">
						<h2 class="maddie-addon-widget-title"><?php echo $widget_title; ?></h2>
					</div>
				<?php endif; ?>

				<div class="maddie-addon-widget-body">
					<?php 
						if ($query->have_posts()) {
							while ($query->have_posts()) {
								$query->the_post();
								
								$query1 = get_post($loop_template); 
								$content = apply_filters('the_content', $query1->post_content);
								echo $content;

								// echo $post_loop->post_content;
								// error_log('check123');
								// error_log(print_r($post_loop, true));
							}
							wp_reset_postdata();
						}
					?>
				</div>
			
			</div>
		</div>

		<?php
	}
}
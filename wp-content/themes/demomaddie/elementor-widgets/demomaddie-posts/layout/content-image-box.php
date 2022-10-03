<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_id    = get_the_ID();
$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'full') : \Elementor\Utils::get_placeholder_image_src();
?>
<div class="post-item-<?php echo $post_id; ?> maddie-column maddie-post-item">
  <a href="<?php echo get_the_permalink(); ?>">
    <div class="post-item-image" style="background-image: url(<?php echo $post_image; ?>);">
      <img src="<?php echo $post_image; ?>" alt="<?php echo get_the_title(); ?>">
    </div>
  </a>
  <div class="post-item-wrapper">
    <a class="post-item-title" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
    <span class="post-item-date"><?php echo get_the_date('F m, Y'); ?></span>
  </div>
</div>
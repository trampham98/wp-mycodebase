<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$post_id = get_the_ID();
?>
<div class="post-item-<?php echo $post_id; ?> maddie-column maddie-post-item">
  <div class="post-item-wrapper">
    <a class="post-item-title" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
    <span class="post-item-date"><?php echo get_the_date('F m, Y'); ?></span>
  </div>
</div>
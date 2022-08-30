<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('init', 'demomaddie_register_post_types');
function demomaddie_register_post_types() {
  $labels = array(
    'name'               => _x('Movies', 'Post type general name', 'maddie_addon_post_type'),
    'singular_name'      => _x('movie', 'Post type singular name', 'maddie_addon_post_type'),
    'add_new_item'       => __('Add new movie', 'maddie_addon_post_type'),
    'edit_item'          => __('Edit movie', 'maddie_addon_post_type'),
    'view_item'          => __('View movie', 'maddie_addon_post_type'),
    'all_items'          => __('All Movies', 'maddie_addon_post_type'),
    'search_items'       => __('Search Movies', 'maddie_addon_post_type'),
    'not_found'          => __('No Movies found.', 'maddie_addon_post_type'),
    'not_found_in_trash' => __('No Movies found in Trash.', 'maddie_addon_post_type'),
  );
  $args = array(
    'labels'          => $labels,
    'public'          => true,
    'menu_icon'       => 'dashicons-format-video',
    'capability_type' => 'post',
    'has_archive'     => false,
    'show_in_rest'    => true,
    'supports'        => array('title', 'editor', 'author', 'thumbnail', 'revisions'),
  );
  register_post_type('movie', $args);
}
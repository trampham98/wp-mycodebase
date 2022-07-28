<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('init', 'maddie_addon_register_post_types');
function maddie_addon_register_post_types() {
  $labels = array(
    'name'               => _x('Loop Templates', 'Post type general name', 'maddie_addon_post_type'),
    'singular_name'      => _x('Loop Template', 'Post type singular name', 'maddie_addon_post_type'),
    'add_new_item'       => __('Add new loop template', 'maddie_addon_post_type'),
    'edit_item'          => __('Edit loop template', 'maddie_addon_post_type'),
    'view_item'          => __('View loop template', 'maddie_addon_post_type'),
    'all_items'          => __('All loop templates', 'maddie_addon_post_type'),
    'search_items'       => __('Search loop templates', 'maddie_addon_post_type'),
    'not_found'          => __('No loop templates found.', 'maddie_addon_post_type'),
    'not_found_in_trash' => __('No loop templates found in Trash.', 'maddie_addon_post_type'),
  );
  $args = array(
    'labels'          => $labels,
    'public'          => true,
    'menu_icon'       => 'dashicons-list-view',
    'capability_type' => 'post',
    'has_archive'     => false,
    'show_in_rest'    => true,
    'supports'        => array('title', 'editor', 'author', 'thumbnail', 'revisions'),
  );

  register_post_type('loop-template', $args);
}
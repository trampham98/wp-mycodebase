<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('init', 'demomaddie_register_taxonomies', 0);
function demomaddie_register_taxonomies() {
  $labels = array(
    'name'              => _x('Categories', 'taxonomy general name', 'maddie'),
    'singular_name'     => _x('Category', 'taxonomy singular name', 'maddie'),
    'search_items'      => __('Search Categories', 'maddie'),
    'all_items'         => __('All Categories', 'maddie'),
    'parent_item'       => __('Parent Category', 'maddie'),
    'parent_item_colon' => __('Parent Category:', 'maddie'),
    'edit_item'         => __('Edit Category', 'maddie'),
    'update_item'       => __('Update Category', 'maddie'),
    'add_new_item'      => __('Add New Category', 'maddie'),
    'new_item_name'     => __('New Category Name', 'maddie'),
    'menu_name'         => __('Categories', 'maddie'),
  );
  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'hierarchical'      => true,
    'show_in_quick_edit'=> true,
    'show_admin_column' => true,
    'query_var'         => true,
  );
  register_taxonomy('tax_movie', array('movie'), $args );
}
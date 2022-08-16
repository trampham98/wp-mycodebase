<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', 'demomaddie_enqueue_scripts');
function demomaddie_enqueue_scripts() {

  $stylesheet_uri = get_stylesheet_directory_uri();

  wp_enqueue_style('hello-elementor', get_template_directory_uri() . '/style.css', array());

  wp_enqueue_style('demomaddie-vendors-style', $stylesheet_uri.'/assets/css/vendors.css', array());
  wp_enqueue_style('demomaddie-main-style', $stylesheet_uri.'/assets/css/theme.css', array());

  wp_enqueue_script('demomaddie-vendors-script', $stylesheet_uri.'/assets/js/vendors.js', array('jquery'), true);
  wp_enqueue_script('demomaddie-main-script', $stylesheet_uri.'/assets/js/main.js', array('jquery'), true);

  // frontend ajax requests.
  wp_enqueue_script('demomaddie-frontend-ajax', $stylesheet_uri.'/assets/js/frontend-ajax.js', array('jquery'), null, true);
  wp_localize_script('demomaddie-frontend-ajax', 'siteConfig',
    array( 
      'url'      => rtrim(get_site_url(), '/'),
      'themeUrl' => rtrim(get_stylesheet_directory_uri(), '/'),
      'ajaxUrl'  => admin_url('admin-ajax.php'),
    )
  );
}

add_action('admin_enqueue_scripts', 'demomaddie_enqueue_scripts_admin');
function demomaddie_enqueue_scripts_admin() {
  wp_register_style('demomaddie-admin-style', get_stylesheet_directory_uri().'/assets/css/editor.css', array());
  wp_enqueue_style('demomaddie-admin-style');
}
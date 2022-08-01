<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', 'maddie_addon_enqueue_scripts');
function maddie_addon_enqueue_scripts() {
  $js_ver  = date("ymd-Gis", filemtime(plugin_dir_path(__DIR__) . 'assets/js/main.js'));
  $css_ver = date("ymd-Gis", filemtime(plugin_dir_path(__DIR__) . 'assets/css/main.css'));
  
  wp_enqueue_style('maddie-elementor-addon-style', plugins_url('style.css', __DIR__), false, $css_ver);
  wp_enqueue_script('maddie-elementor-addon-script', plugins_url('js/custom.js', __DIR__), array('jquery'), $js_ver, true);
}

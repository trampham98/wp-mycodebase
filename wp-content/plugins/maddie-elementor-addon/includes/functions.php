<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('elementor/init', 'maddie_addon_add_cpt_support');
function maddie_addon_add_cpt_support() {
  add_post_type_support('loop-template', 'elementor');
}
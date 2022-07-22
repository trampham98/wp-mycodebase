<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

function get_image_alt($image, $default = "DNeX") {
  $image_id = '';

  if (is_array($image)) {
    if (isset($image['alt']) && $image['alt'] != '')
      return $image['alt'];

    return @str_replace('-', ' ', $image['title']);
  }

  if (is_numeric($image))
    $image_id = get_post_thumbnail_id($image);

  if (is_string($image))
    $image_id = attachment_url_to_postid($image);

  if ($image_id) {
    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    if ($alt != '')
      return $alt;

    return str_replace('-', ' ', get_post($image_id)->post_title);
  }

  return $default;
}

add_filter('upload_mimes', 'maddie_custom_mime_types');
function maddie_custom_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
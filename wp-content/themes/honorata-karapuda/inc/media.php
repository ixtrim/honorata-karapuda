<?php 

/***
 * Add SVG to media library.
 */
function cc_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/***
 * Add URL for logotype to media library.
 */
function add_logo_url_field_to_media( $form_fields, $post ) {
  $form_fields['logo_url'] = array(
      'label' => 'Logo URL',
      'input' => 'text',
      'value' => get_post_meta($post->ID, '_logo_url', true),
      'helps' => 'Enter the URL of the logo'
  );

  return $form_fields;
}
add_filter('attachment_fields_to_edit', 'add_logo_url_field_to_media', 10, 2);

function save_logo_url_field_to_media( $post, $attachment ) {
  if ( isset( $attachment['logo_url'] ) ) {
      update_post_meta( $post['ID'], '_logo_url', esc_url_raw( $attachment['logo_url'] ) );
  }

  return $post;
}
add_filter('attachment_fields_to_save', 'save_logo_url_field_to_media', 10, 2);

/***
 * Define the path to the theme images directory.
 */
define('THEME_IMAGE_PATH', get_stylesheet_directory_uri() . '/assets/dist/images/');

function astudio_default_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr) {
  $default_image_id = get_theme_mod('astudio_default_thumbnail');

  if (empty($html)) {
      $default_image_url = wp_get_attachment_image_url($default_image_id, $size);

      if ($default_image_url) {
          $html = '<img src="' . esc_url($default_image_url) . '" alt="' . esc_attr(get_the_title($post_id)) . '" class="wp-post-image" />';
      }
  }

  return $html;
}
add_filter('post_thumbnail_html', 'astudio_default_thumbnail', 10, 5);


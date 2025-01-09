<?php

/***
 * Theme Customisation - Logo
 */

add_theme_support(
  'custom-logo',
  array(
    'flex-width' => true,
    'flex-height' => true,
    'unlink-homepage-logo' => false,
  )
);

function hkarapuda_custom_logo_output($html, $id)
{
  $footer_logo_id = get_theme_mod('footer_logo');
  if ($footer_logo_id && $id === 'footer-logo') {
    $html = wp_get_attachment_image($footer_logo_id, 'full', false, array('class' => 'footer-logo'));
  }
  return $html;
}
add_filter('get_custom_logo', 'hkarapuda_custom_logo_output', 10, 2);

function hkarapuda_logo_output($html)
{
  $html = preg_replace('/<span.*?>/', '', $html);
  $html = str_replace('</span>', '', $html);

  return $html;
}
add_filter('get_custom_logo', 'hkarapuda_logo_output');

/***
 * Theme Customisation - Additional sections in WordPress customizer.
 */
function hkarapuda_sanitize($input)
{
  $allowed_html = array(
    'span' => array(),
    'strong' => array(),
    'em' => array(),
    'b' => array(),
  );

  return wp_kses($input, $allowed_html);
}
function hkarapuda_custom_sanitize_scripts($input)
{
  $allowed_tags = wp_kses_allowed_html('post');
  $allowed_tags['script'] = array(
    'id' => true,
    'type' => true,
    'src' => true,
  );

  return wp_kses($input, $allowed_tags);
}

function hkarapuda_customize_register($wp_customize)
{

  /* Social Media Section */
  $wp_customize->add_section('hkarapuda_sm_section', array(
    'title' => __('Social Media', 'hkarapuda'),
    'priority' => 200,
    'description' => __('Social Media', 'hkarapuda'),
  ));

  $wp_customize->add_setting('hkarapuda_sm_linkedin', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('hkarapuda_sm_linkedin', array(
    'label' => __('Linkedin URL', 'hkarapuda'),
    'section' => 'hkarapuda_sm_section',
    'type' => 'url',
  ));

  $wp_customize->add_setting('hkarapuda_sm_instagram', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('hkarapuda_sm_instagram', array(
    'label' => __('Instagram URL', 'hkarapuda'),
    'section' => 'hkarapuda_sm_section',
    'type' => 'url',
  ));

  $wp_customize->add_setting('hkarapuda_sm_email', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('hkarapuda_sm_email', array(
    'label' => __('Adress e-mail', 'hkarapuda'),
    'section' => 'hkarapuda_sm_section',
    'type' => 'email',
  ));
  
}
add_action('customize_register', 'hkarapuda_customize_register');

function hkarapuda_sanitize_textarea($input) {
  return sanitize_textarea_field($input);
}

/***
  * Gutenberg Blocks definition
  */
function get_block_cover($asset_path)
{
  return get_template_directory_uri() . '/assets/dist/images/blocks-covers/' . $asset_path;
}

/***
  * Backend Styling
  */
function hkarapuda_admin_styles()
{
  wp_enqueue_style('hkarapuda-admin-styles', get_template_directory_uri() . '/assets/dist/css/backend.css', array(), time());
}
add_action('admin_enqueue_scripts', 'hkarapuda_admin_styles');


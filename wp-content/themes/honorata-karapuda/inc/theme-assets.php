<?php

/***
 * Theme Full Site Editing
 */
if (!function_exists('fse_setup')) {
  function fse_setup()
  {
    add_theme_support('wp-block-styles');
  }
}
add_action('after_setup_theme', 'fse_setup');

/***
 * Enqueue scripts and styles.
 */
if (!function_exists('astudio_scripts')) {
  function astudio_scripts()
  {

    wp_enqueue_style('astudio_theme', get_template_directory_uri() . '/assets/dist/css/main.css', array(), time());

    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollTrigger.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('gsap-scrolltoplugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollToPlugin.min.js', array(), wp_get_theme()->get('Version'), true);

    wp_enqueue_script('masonry', 'https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', array(), time(), true);

    wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3');
    wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array(), '2.11.3', true);

    wp_enqueue_script('hkarapuda', get_template_directory_uri() . '/assets/dist/js/theme.js', array(), time(), true);

    wp_localize_script('ajax-js', 'ajax_params', array(
      'ajax_url' => admin_url('admin-ajax.php')
    ));

    add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) {
      if (isset($attr['srcset'])) {
        $attr['loading'] = 'lazy';
      }
      return $attr;
    }, 10, 3);

  }
}
add_action('wp_enqueue_scripts', 'astudio_scripts');

function enqueue_jquery() {
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');
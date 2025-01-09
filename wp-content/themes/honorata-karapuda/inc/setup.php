<?php

function hkarapuda_theme()
{

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('responsive-images');
  add_theme_support('site-icon');

  /***
  * Register Navigation
  */
  register_nav_menus(
    array(
      'main-menu'     => esc_html__('Main Menu', 'hkarapuda'),
    )
  );

  /***
  * Register custom images size
  */
  add_image_size('avatar', 100, 100, true);
  add_image_size('swiper', 352, 352, true);
  add_image_size('full-width', 767, 0, false);
  add_image_size('cs-teaser', 512, 999, false);
  add_image_size('strategies-big', 960, 540, false);
  add_image_size('strategies-small', 390, 563, false);
  add_image_size('key-benefits', 512, 855, true);
}

add_action('after_setup_theme', 'hkarapuda_theme');
<?php

$hk_sm_links = [
  'linkedin' => [
    'url' => get_theme_mod('hkarapuda_sm_linkedin', ''),
    'label' => __('Follow us on LinkedIn', 'hkarapuda'),
  ],
  'instagram' => [
    'url' => get_theme_mod('hkarapuda_sm_instagram', ''),
    'label' => __('Follow us on Instagram', 'hkarapuda'),
  ],
  'email' => [
    'url' => get_theme_mod('hkarapuda_sm_email', ''),
    'label' => __('Send me an e-mail', 'hkarapuda'),
  ],
];

?>

<header class="page-header">
  <div class="container">

    <?php if (function_exists('the_custom_logo')) { ?>
      <div class="page-header__brand">
        <?php the_custom_logo(); ?>
      </div>
    <?php } ?>

    <?php if (!empty($hk_sm_links)) : ?>
      <div class="page-header__sm">
        <ul>
          <?php foreach ($hk_sm_links as $key => $link) : ?>
            <?php if (!empty($link['url'])) : ?>
              <li class="<?php echo esc_attr($key); ?>">
                <a href="<?php echo esc_url($link['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($link['label']); ?>">
                  <span><?php echo esc_attr(ucfirst($key)); ?></span>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

  </div>
</header>
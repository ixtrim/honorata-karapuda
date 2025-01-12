<?php

get_header();

$gallery = get_field('gallery');


?>

<div class="gallery">
  <div class="grid">
    <div class="grid-sizer"></div>
    <?php foreach ($gallery as $image): ?>
      <div class="grid-item">
        <a href="<?php echo esc_url($image['url']); ?>" class="aspect-w-16 aspect-h-12 overflow-hidden bg-gray-100 rounded-2xl" data-lightbox="gallery" <?php if ($image['title']) { ?>data-title="<?php echo esc_attr($image['title']); ?>"<?php } ?> data-description="<?php echo esc_attr($image['alt']); ?>">
          <img src="<?php echo esc_url($image['sizes']['gallery-thumb']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full h-auto object-cover rounded-lg">
        </a>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<?php get_footer();

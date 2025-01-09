<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php if ( ! has_site_icon() ) : ?>
			<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/images/brand/favicon.svg' ); ?>" type="image/svg+xml">
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/images/brand/favicon-180x180.png' ); ?>">
			<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/images/brand/favicon-32x32.png' ); ?>">
			<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/images/brand/favicon-16x16.png' ); ?>">
    <?php endif; ?>
		
		<?php wp_head(); ?>
		
	</head>

	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

		<div class="page-wrapper">
			<?php get_template_part( 'template-parts/site-header' ); ?>
			<main class="page-content">
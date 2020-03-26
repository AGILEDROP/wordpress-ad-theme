<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agiledrop
 */
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
} ?>

<div id="app" class="page">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'agiledrop' ); ?></a>

	<header class="agile-header" role="header">

		<div class="header-container container">

			<div class="burger">
				<div class="burger__wrapper">
					<span class="burger__line"></span>
					<span class="burger__line"></span>
					<span class="burger__line"></span>
				</div>
			</div>

			<div class="region region-header">

				<div class="agile-branding">
					<?php
					// Site title or logo.
					agiledrop_site_logo();

					// Site description.
					agiledrop_site_description();
					?>
				</div><!-- .site-branding -->

				<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
					<nav class="menu agile-main-menu" aria-label="<?php esc_attr_e( 'Main Menu', 'agiledrop' ); ?>">
						<!--<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Main Menu', 'agiledrop' ); ?></button> -->
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'menu_class'     => 'menu-item',
								'depth'          => 1,
								'container'      => false,
							)
						);
						?>
					</nav><!-- .main-menu -->
				<?php endif; ?>
			</div><!-- .region-header -->
		</div><!-- .container -->
	</header><!-- .header-->
	<div class="agiledrop-custom-header">
		<?php if ( function_exists( 'the_custom_header_markup' ) ) {
			the_custom_header_markup();
		}
		else{
			the_header_image_tag();
		}?>
		<?php  $posts = query_posts( 'post_type=agiledrop-hero' );
		if ( !empty( $posts ) ) {
			foreach ( $posts as $one ) {
				$selected_page = get_post_meta( $one->ID, 'selected_page' );
				if ( $selected_page[0] == $post->ID ) : ?>
					<div class="agile-hero-text">
						<div class="container">
							<h1><?php echo $one->post_title;?></h1>
							<hr>
							<h4><?php echo $one->post_content; ?></h4>
						</div>
					</div>
				<?php endif;
			}
		}
		?>
	</div>







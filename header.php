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

	<header class="header">

		<div class="header__container">

				<div class="header__logo">
					<?php agiledrop_site_logo(); ?>
				</div>

				<div class="header__burger" data-js="burgerBtn">
					<div class="burger__wrapper">
						<span class="burger__line"></span>
						<span class="burger__line"></span>
						<span class="burger__line"></span>
					</div>
				</div>

				<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
					<nav class="header__menu" data-js="mainNav" aria-label="<?php esc_attr_e( 'Main Menu', 'agiledrop' ); ?>">
						<!--<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Main Menu', 'agiledrop' ); ?></button> -->
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'menu_class'     => 'menu-item',
								'depth'          => 2,
								'container'      => false,
								'walker' => new Agiledrop_Nav_Menu()
							)
						);
						?>
					</nav><!-- .main-menu -->
				<?php endif; ?>
		</div><!-- .container -->
	</header><!-- .header-->

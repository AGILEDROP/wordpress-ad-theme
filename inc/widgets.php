<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Agiledrop
 */

function agiledrop_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'agiledrop' ),
			'id'            => 'footer-info',
			'description'   => __( 'Add widgets here to appear in your footer.', 'agiledrop' ),
			'class'            => 'footer__info',
			'before_widget' => '<div class="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer__info-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'agiledrop_widgets_init' );
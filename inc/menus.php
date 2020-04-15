<?php
/**
 * Register menus. To use a menu in theme use wp_nav_menu().
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */

function agiledrop_menus() {

	$locations = array(
		'main-menu' => __( 'Main Menu', 'agiledrop' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'agiledrop_menus' );

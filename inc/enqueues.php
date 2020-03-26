<?php
/**
 * Register and Enqueue Styles.
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package Agiledrop
 * @subpackage
 * @since 1.0.0
 */

function agiledrop_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'agiledrop-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'agiledrop-style', 'rtl', 'replace' );

	// Add print CSS.
	//wp_enqueue_style( 'agiledrop-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'agiledrop_register_styles' );

/**
 * Register and Enqueue Scripts.
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 */
function agiledrop_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'agiledrop-js', get_template_directory_uri() . '/script.js', array(), $theme_version, false );
	wp_script_add_data( 'agiledrop-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'agiledrop_register_scripts' );

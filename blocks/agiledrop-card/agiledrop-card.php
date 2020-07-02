<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package wordpress-ad-theme
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function agiledrop_card_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = get_template_directory() . '/blocks';

	$index_js = 'agiledrop-card/dist/index.js';
	wp_register_script(
		'agiledrop-card-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-api-fetch',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'agiledrop-card/dist/editor.css';
	wp_register_style(
		'agiledrop-card-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'agiledrop-card/dist/style.css';
	wp_register_style(
		'agiledrop-card-block',
		get_template_directory_uri() . "/blocks/$style_css",
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'wordpress-ad-theme/agiledrop-card', array(
		'editor_script' => 'agiledrop-card-block-editor',
		'editor_style'  => 'agiledrop-card-block-editor',
		'style'         => 'agiledrop-card-block',
	) );
}
add_action( 'init', 'agiledrop_card_block_init' );

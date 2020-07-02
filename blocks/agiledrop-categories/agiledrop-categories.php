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
function agiledrop_categories_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = get_template_directory() . '/blocks';

	$index_js = 'agiledrop-categories/dist/index.js';
	wp_register_script(
		'agiledrop-categories-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-api-fetch',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'agiledrop-categories/dist/editor.css';
	wp_register_style(
		'agiledrop-categories-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'agiledrop-categories/dist/style.css';
	wp_register_style(
		'agiledrop-categories-block',
		get_template_directory_uri() . "/blocks/$style_css",
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'wordpress-ad-theme/agiledrop-categories', array(
		'editor_script' => 'agiledrop-categories-block-editor',
		'editor_style'  => 'agiledrop-categories-block-editor',
		'style'         => 'agiledrop-categories-block',
	) );
}
add_action( 'init', 'agiledrop_categories_block_init' );

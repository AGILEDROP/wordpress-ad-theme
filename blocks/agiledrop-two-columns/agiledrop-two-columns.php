<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package agiledrop
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function agiledrop_two_columns_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = get_template_directory() . '/blocks';

	$index_js = 'agiledrop-two-columns/dist/index.js';
	wp_register_script(
		'agiledrop-two-columns-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		array(
			'wp-blocks',
			'wp-components',
			'wp-editor',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'agiledrop-two-columns/dist/editor.css';
	wp_register_style(
		'agiledrop-two-columns-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'agiledrop-two-columns/dist/style.css';
	wp_register_style(
		'agiledrop-two-columns-block',
		get_template_directory_uri() . "/blocks/$style_css",
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'agiledrop/agiledrop-two-columns', array(
		'editor_script' => 'agiledrop-two-columns-block-editor',
		'editor_style'  => 'agiledrop-two-columns-block-editor',
		'style'         => 'agiledrop-two-columns-block',
	) );
}
add_action( 'init', 'agiledrop_two_columns_block_init' );

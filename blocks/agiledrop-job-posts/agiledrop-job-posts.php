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
function agiledrop_job_posts_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = get_template_directory() . '/blocks';

	$index_js = 'agiledrop-job-posts/dist/index.js';
	wp_register_script(
		'agiledrop-job-posts-block-editor',
		get_template_directory_uri() . "/blocks/$index_js",
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-api-fetch',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'agiledrop-job-posts/dist/editor.css';
	wp_register_style(
		'agiledrop-job-posts-block-editor',
		get_template_directory_uri() . "/blocks/$editor_css",
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'agiledrop-job-posts/dist/style.css';
	wp_register_style(
		'agiledrop-job-posts-block',
		get_template_directory_uri() . "/blocks/$style_css",
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'agiledrop/agiledrop-job-posts', array(
		'editor_script' => 'agiledrop-job-posts-block-editor',
		'editor_style'  => 'agiledrop-job-posts-block-editor',
		'style'         => 'agiledrop-job-posts-block',
	) );
}
add_action( 'init', 'agiledrop_job_posts_block_init' );

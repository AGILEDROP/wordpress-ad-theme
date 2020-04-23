<?php
/**
 * Agiledrop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agiledrop
 */

/**
 * Menus
 */
require get_template_directory() . '/inc/class-agiledrop-menus.php';
new Agiledrop_Menus();

/**
 * Theme support
 */
require get_template_directory() . '/inc/theme-support.php';

/**
 * Register and Enqueue Styles and Scripts.
 */
require get_template_directory() . '/inc/class-agiledrop-enqueues.php';
new Agiledrop_Enqueues();

/**
 * Implements site logo.
 */
require get_template_directory() . '/inc/site-logo.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Agiledrop Taxonomies
 */
require get_template_directory() . '/inc/class-agiledrop-taxonomies.php';
new Agiledrop_Taxonomies();


/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/class-agiledrop-cpt.php';
new Agiledrop_CPT();

require get_template_directory() . '/inc/class-agiledrop-save-post.php';
new Agiledrop_Save_Post();

/**
Custom Rest API
 */
require get_template_directory() . '/inc/class-agiledrop-rest-api.php';
new Agiledrop_Rest_Api();

/**
 * Agiledrop Helper
 */
require  get_template_directory() . '/inc/class-agiledrop-helper.php';


require get_template_directory() . '/inc/class-agiledrop-widget.php';
// Register and load the widget
function agiledrop_load_widget() {
	register_widget( 'agiledrop_widget' );
}
add_action( 'widgets_init', 'agiledrop_load_widget' );

require get_template_directory() . '/inc/class-agiledrop-widget-area.php';
new Agiledrop_Widget_Area();


require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'agiledrop_register_required_plugins' );

function agiledrop_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => 'Agiledrop Blocks',
			'slug'               => 'agiledrop-blocks',
			'source'             => get_template_directory() . '/plugins/agiledrop-blocks.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => true,
			'force_deactivation' => true,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Agiledrop Form',
			'slug'               => 'agiledrop-form',
			'source'             => get_template_directory() . '/plugins/agiledrop-form.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => true,
			'force_deactivation' => true,
			'external_url'       => '',
			'is_callable'        => '',
		),
		array(
			'name'               => 'Agiledrop Two Columns',
			'slug'               => 'agiledrop-two-columns',
			'source'             => get_template_directory() . '/plugins/agiledrop-two-columns.zip',
			'required'           => true,
			'version'            => '',
			'force_activation'   => true,
			'force_deactivation' => true,
			'external_url'       => '',
			'is_callable'        => '',
		),
	);

	$config = array(
		'id'           => 'agiledrop',
		'default_path' => '',
		'menu'         => 'agiledrop-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

/**
 * Enable SVG media.
 */
require get_template_directory() . '/inc/svg.php';

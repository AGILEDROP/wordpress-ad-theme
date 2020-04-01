<?php
/**
 * Agiledrop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agiledrop
 */

/**
 * Theme support
 */
require get_template_directory() . '/inc/theme-support.php';

/**
 * Register and Enqueue Styles and Scripts.
 */
require get_template_directory() . '/inc/enqueues.php';

/**
 * Implements site logo.
 */
require get_template_directory() . '/inc/site-logo.php';

/**
 * Menus.
 */
require get_template_directory() . '/inc/menus.php';

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom Admin Menu Items.
 */
require get_template_directory() . '/inc/admin-menus.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/custom-post-types.php';


/**
Custom Rest API
 */
require get_template_directory() . '/inc/agiledrop-rest-api.php';
new Agiledrop_Rest();

//Create custom categories
function create_business_locations () {
	if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
		require_once (ABSPATH.'/wp-admin/includes/taxonomy.php');
		if ( ! get_cat_ID( 'Business Locations' ) ) {
			wp_create_category( 'Business Locations' );
		}
	}
}
add_action ( 'after_setup_theme', 'create_business_locations' );


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
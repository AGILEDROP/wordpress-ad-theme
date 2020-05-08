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

/**
 * Enable SVG media.
 */
require get_template_directory() . '/inc/svg.php';

/**
 * Extend navigation menu walker.
 */
require get_template_directory() . '/inc/extend-nav-menu-walker.php';

require get_template_directory() . '/blocks/agiledrop-blocks.php';

require get_template_directory() . '/inc/class-agiledrop-form.php';
new Agiledrop_Form();


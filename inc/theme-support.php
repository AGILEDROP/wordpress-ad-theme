<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Register Theme Features
 * @link https://generatewp.com/theme-support/
 */

function agiledrop_theme_support()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );

	/*
	 * Add custom image sizes.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	add_image_size( 'agiledrop-fullscreen', 1980, 9999 );

	/*
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	$logo_args = array(
		'height'      => $logo_height,
		'width'       => $logo_width,
		'flex-height' => true,
		'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $logo_args );

	/*
	 * Add theme support for Custom Background
	 */
	$background_args = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	//add_theme_support( 'custom-background', $background_args );


	/*
	 * Add theme support for HTML5 Semantic Markup.
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/*
	 * Add theme support for document Title tag.
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add theme support for Translation.
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agiledrop, use a find and replace
	 * to change 'agiledrop' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'agiledrop', get_template_directory() . '/languages' );

	/*
	 * Add theme support for selective refresh for widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'White', 'agiledrop' ),
			'slug'  => 'white',
			'color'	=> '#FFFFFF',
		),
		array(
			'name'  => __( 'White Gray', 'agiledrop' ),
			'slug'  => 'white-gray',
			'color'	=> '#FEFEFF',
		),
		array(
			'name'  => __( 'Green', 'agiledrop' ),
			'slug'  => 'green',
			'color'	=> '#32633',
		),
		array(
			'name'  => __( 'Light Green', 'agiledrop' ),
			'slug'  => 'green-light',
			'color'	=> '#044761',
		),
		array(
			'name'  => __( 'Gray', 'agiledrop' ),
			'slug'  => 'gray',
			'color'	=> '#D4DBDE',
		),
		array(
			'name'  => __( 'Dark Gray', 'agiledrop' ),
			'slug'  => 'dark-gray',
			'color'	=> '#7F8689',
		),
		array(
			'name'  => __( 'Light Gray', 'agiledrop' ),
			'slug'  => 'light-gray',
			'color'	=> '#F7F9F9',
		),
		array(
			'name'  => __( 'Light Black', 'agiledrop' ),
			'slug'  => 'light-black',
			'color'	=> '#1F2122',
		),
		array(
			'name'  => __( 'Orange', 'agiledrop' ),
			'slug'  => 'orange',
			'color'	=> '#FF9F09',
		),
		array(
			'name'  => __( 'Silver', 'agiledrop' ),
			'slug'  => 'silver',
			'color'	=> '#cccccc',
		),
		array(
			'name'  => __( 'Red', 'agiledrop' ),
			'slug'  => 'red',
			'color'	=> '#ef4623',
		),
		array(
			'name'  => __( 'Light Red', 'agiledrop' ),
			'slug'  => 'light-red',
			'color'	=> '#FF7154',
		),
	) );
	
}
add_action( 'after_setup_theme', 'agiledrop_theme_support' );

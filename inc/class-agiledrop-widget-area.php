<?php

if ( ! class_exists('Agiledrop_Widget_Area' ) ) {
	class Agiledrop_Widget_Area {
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'register_widget_area' ) );
		}

		public function register_widget_area() {
			register_sidebar( array(
				'name'          => __( 'Footer Left Title', 'agiledrop' ),
				'id'            => 'top-left-footer',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Left (1/2)', 'agiledrop' ),
				'id'            => 'top-left-left-footer',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Left (2/2)', 'agiledrop' ),
				'id'            => 'top-left-right-footer',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Socials', 'agiledrop' ),
				'id'            => 'top-left-right-socials',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<span>',
				'after_title'   => '</span>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Right', 'agiledrop' ),
				'id'            => 'top-right-footer',
				'description'   => __( 'Add widgets here to appear in right column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
		}
	}
}

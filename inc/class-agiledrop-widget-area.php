<?php

if ( ! class_exists('Agiledrop_Widget_Area' ) ) {
	class Agiledrop_Widget_Area {
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'register_widget_area' ) );
		}

		public function register_widget_area() {
			register_sidebar( array(
				'name'          => __( 'Footer Left (1/2)', 'agiledrop' ),
				'id'            => 'left-first-footer',
				'description'   => __( 'Add widgets here to appear in left(1/2) column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Left (2/2)', 'agiledrop' ),
				'id'            => 'left-second-footer',
				'description'   => __( 'Add widgets here to appear in left(2/2) column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => __( 'Footer Socials', 'agiledrop' ),
				'id'            => 'footer-social',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<span>',
				'after_title'   => '</span>',
			) );
			register_sidebar( array(
				'name'          => __( 'Footer Right', 'agiledrop' ),
				'id'            => 'right-footer',
				'description'   => __( 'Add widgets here to appear in right column of the footer.', 'agiledrop' ),
				'before_widget' =>  '',
				'after_widget'  => '',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
		}
	}
}

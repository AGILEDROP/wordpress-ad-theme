<?php

if ( ! class_exists('Agiledrop_Widget_Area' ) ) {
	class Agiledrop_Widget_Area {
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'register_widget_area' ) );
		}

		public function register_widget_area() {
			register_sidebar( array(
				'name'          => __( 'Top Left Left Footer Area', 'agiledrop' ),
				'id'            => 'top-left-left-footer',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3><hr>',
			) );
			register_sidebar( array(
				'name'          => __( 'Top Left Right Footer Area', 'agiledrop' ),
				'id'            => 'top-left-right-footer',
				'description'   => __( 'Add widgets here to appear in left column of the footer.', 'agiledrop' ),
				'before_widget' =>  '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );
			register_sidebar( array(
				'name'          => __( 'Top Right Footer Area', 'agiledrop' ),
				'id'            => 'top-right-footer',
				'description'   => __( 'Add widgets here to appear in right column of the footer.', 'agiledrop' ),
				'before_widget' =>  '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3><hr>',
			) );
			register_sidebar( array(
				'name'          => __( 'Bottom Footer Area', 'agiledrop' ),
				'id'            => 'bottom-footer-area',
				'description'   => __( 'Add widgets here to appear in the bottom of the footer.', 'agiledrop' ),
				'before_widget' =>  '<div class="footer__copyright">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="textwidget"><p>',
				'after_title'   => '</p></div>',
			) );

		}
	}
}

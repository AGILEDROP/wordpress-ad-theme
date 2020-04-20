<?php

if ( ! class_exists( 'Agiledrop_Menus' ) ) {
	class Agiledrop_Menus {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'init', array( $this, 'theme_menus' ) );
		}

		public function admin_menu() {
			add_menu_page(
				__( 'Agiledrop Page', 'agiledrop'),
				__( 'Agiledrop', 'agiledrop' ),
				'manage_options',
				'agiledrop-page',
				false,
				get_template_directory_uri(). '/icon.png',
				3
			);
		}

		public function theme_menus() {

			$locations = array(
				'main-menu' => __( 'Main Menu', 'agiledrop' ),
			);

			register_nav_menus( $locations );
		}


	}
}
<?php

if ( ! class_exists( 'Agiledrop_Settings' ) ) {
	class Agiledrop_Settings {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'agiledrop_menu' ) );
		}

		public function agiledrop_menu() {
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

	}
}
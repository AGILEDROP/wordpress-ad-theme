<?php

if ( ! class_exists( 'Agiledrop_Taxonomies' ) ) {
	class Agiledrop_Taxonomies {

		private $cpt_names = array( 'Business Locations', 'Hero', 'Employees', 'Jobs' );

		public function __construct() {
			add_action( 'init', array( $this, 'create_terms' ) );
		}

		public function create_terms() {
			foreach ( $this->cpt_names as $name ) {
				if ( ! get_term( $name ) ) {
					wp_insert_term( $name, 'category' );
				}
			}
		}
	}
}

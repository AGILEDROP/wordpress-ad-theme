<?php

if ( ! class_exists( 'Agiledrop_Taxonomies' ) ) {
	class Agiledrop_Taxonomies {

		private $cpt_names = array( 'Business Locations', 'Hero', 'Employees', 'Jobs' );

		public function __construct() {
			add_action( 'init', array( $this, 'create_taxonomy' ) );
			add_action( 'after_theme_setup', array( $this, 'create_terms' ) );
		}

		public function create_taxonomy() {
			$labels = array(
				'name' => _x( 'Agiledrop Categories', 'taxonomy general name' ),
				'singular_name' => _x( 'Agiledrop Category', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Agiledrop Categories', 'agiledrop' ),
				'all_items' => __( 'All Agiledrop Categories', 'agiledrop' ),
				'parent_item' => __( 'Parent Agiledrop Category', 'agiledrop' ),
				'parent_item_colon' => __( 'Parent Agiledrop Category:', 'agiledrop' ),
				'edit_item' => __( 'Edit Agiledrop Category', 'agiledrop' ),
				'update_item' => __( 'Update Agiledrop Category', 'agiledrop' ),
				'add_new_item' => __( 'Add New Agiledrop Category', 'agiledrop' ),
				'new_item_name' => __( 'New Agiledrop Category Name', 'agiledrop' ),
				'menu_name' => __( 'Agiledrop Categories', 'agiledrop' ),
			);

			register_taxonomy('agiledrop-categories',array('post'), array(
				'hierarchical' => true,
				'public' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'agiledrop-categories' ),
			));
		}

		public function create_terms() {
			foreach ( $this->cpt_names as $name ) {
				if ( ! get_term( $name ) ) {
					wp_insert_term( $name, 'agiledrop-categories' );
				}
			}
		}
	}
}

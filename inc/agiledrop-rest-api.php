<?php
if ( !class_exists('Agiledrop_Rest ') ) {
	class Agiledrop_Rest extends WP_REST_Controller {
		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'register_api' ) );
		}

		public function register_api() {
			//Update for only backend with ajax
			register_rest_route( 'agiledrop/v1', '/custom-post-types/', array(
				'methods'   => 'GET',
				'callback'  => array( $this, 'custom_post_types' )
			));

			register_rest_route( 'agiledrop/v1', '/hero-posts/', array(
				'methods'   => 'GET',
				'callback'  => array( $this, 'all_hero_posts' )
			));

			register_rest_route( 'agiledrop/v1', '/job-posts/', array(
				'methods'   => 'GET',
				'callback'  => array( $this, 'all_jobs_posts' )
			));

		}

		public function custom_post_types() {
			return array( 'hero-posts', 'job-posts' );
		}

		public function all_hero_posts() {
			return get_posts(
				array(
					'post_type'         => 'agiledrop-hero',
					'post_status'       => 'publish',
					'numberposts'       => -1
				)
			);
		}

		public function all_jobs_posts() {
			return get_posts(
				array(
					'post_type'         => 'agiledrop-jobs',
					'post_status'       => 'publish',
					'numberposts'       => -1
				)
			);
		}

	}
}


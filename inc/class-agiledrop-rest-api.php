<?php
if ( !class_exists('Agiledrop_Rest_Api ') ) {
	class Agiledrop_Rest_Api extends WP_REST_Controller {

		private $post_types = array( 'agiledrop-hero', 'agiledrop-jobs', 'agiledrop-employees' );

		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'register_api' ) );
		}

		public function register_api() {

			register_rest_route( 'agiledrop/v1', '/custom-post-types/', array(
				'methods'   => 'GET',
				'callback'  => array( $this, 'custom_post_types' )
			));
			foreach ( $this->post_types as $type ) {
				register_rest_route( 'agiledrop/v1', $type, array(
					'methods'   => 'GET',
					'callback'  => array( $this, 'return_posts'),
					'args' => array( 'type' => $type ),
				));
			}
		}

		public function custom_post_types() {
			return $this->post_types;
		}

		private function get_all_posts( $type ) {
			return get_posts(
				array(
					'post_type'         => $type,
					'post_status'       => 'publish',
					'numberposts'       => -1
				)
			);
		}

		public function return_posts( $param ) {
			$attributes = $param->get_attributes();
			$type = $attributes['args']['type'];
			$all_posts = [];
			$posts = $this->get_all_posts( $type );
			foreach ( $posts as $post ) {
				$all_posts[$post->ID]['title'] = $post->post_title;
				$all_posts[$post->ID]['image'] = $this->get_image( $post->post_content );
				$all_posts[$post->ID]['text'] = $this->get_text( $post->post_content );
				$link = $this->get_link( $post->post_content );
				$all_posts[$post->ID]['link_text'] = $link[0];
				$all_posts[$post->ID]['link'] = $link[1];
			}
			return $all_posts;
		}

		private function get_image( $content ) {
			preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i',$content, $match );
			return $match[1];
		}

		private function get_text( $content ) {
			preg_match("'<p>(.*?)</p>'si", $content, $match);
			return $match[1];
		}

		private function get_link( $content ) {
			preg_match("/<a ?.*>(.*)<\/a>/",$content,$match);
			preg_match( '~<a(.*?)href="([^"]+)"(.*?)>~', $match[0], $link);
			return array( $match[1], $link[2] );
		}
	}
}


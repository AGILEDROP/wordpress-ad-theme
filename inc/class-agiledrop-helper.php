<?php
if ( !class_exists( 'Agiledrop_helper' ) ) {
	class Agiledrop_Helper {
		public function __construct() {

		}

		public function posts_from_cpt( $post_type ) {
			return get_posts( array( 'numberposts' => -1, 'post_type' => $post_type) );
		}


		public function checkbox_values( $post_id, $checkboxes, $checkbox_item ) {
			$selected_pages = get_post_meta( $post_id, 'selected_pages' );
			if ( ! empty( $selected_pages ) ) {
				$selected_pages = explode( '.', $selected_pages[0] );
				foreach ( $selected_pages as $selected ) {
					foreach ( $checkboxes as $a => $b ) {
						if ( $selected == $b['id'] ) {
							$checkboxes[$a][$checkbox_item]= $checkbox_item;
						}
					}
				}
			}
			return $checkboxes;
		}

		public function page_has_post( $post_type ) {
			$posts = $this->posts_from_cpt( $post_type );
			foreach ( $posts as $post ) {
				$selected_page = get_post_meta( $post->ID, 'selected_pages' );
				if ( !empty($selected_page) ) {
					if ( get_the_ID() == $selected_page[0] ) {
						$video_src = get_post_meta( $post->ID, 'featured_video');
						$image_url = get_the_post_thumbnail_url( $post->ID );
						return array( 'title' => $post->post_title, 'content' => $post->post_excerpt, 'background' => $this->select_background( $image_url, $video_src ) );
					}
				}

			}
		}

		private function select_background( $image, $video ) {
			if ( ! empty( $video[0] ) ) {
				return '<video autoplay muted loop id="myVideo">
  							<source src="' . $video[0] .  '" type="video/mp4">
						</video>
						<img src=' . $image . '>';
			}

			return '<img src=' . $image . '>';

		}

		public function verify_nonce( $action, $field ){
			if ( ! isset ( $_POST[$field] ) || ! wp_verify_nonce( $_POST[$field], $action ) ){
				return false;
			}
			return true;
		}

		public function posts_by_category( $category ) {
			$cat_id = get_cat_ID( $category );
			return get_posts( array( 'orderby' => 'date', 'order' => 'ASC', 'numberposts' => -1, 'category' => $cat_id, 'post_status' => 'publish' ) );
		}

		public function get_all_post_types() {
			$args = array(
				'public'   => true,
			);
			return get_post_types( $args );
		}
	}
}
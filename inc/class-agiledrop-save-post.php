<?php

if ( ! class_exists( 'Agiledrop_Save_Post' ) ) {
	class Agiledrop_Save_Post {
		public function __construct(){
			add_action( 'save_post', array( $this, 'save_cpt'));
		}

		public function save_cpt( ) {
			if ( isset ( $_POST['post_type'] ) ) {
				$helper = new Agiledrop_Helper();
				if ( $helper->verify_nonce( 'agiledrop_save', 'select_page_nonce')) {
					if ( $_POST['post_type'] === 'agiledrop-hero' ){
						if ( isset( $_POST['selected_pages' ] ) ) {
							$this->save_selected_page( $_POST['selected_pages']);
						}
						if ( isset( $_POST['video_URL'] ) ) {
							if ( $this->validate_video( $_POST['video_URL'] ) ) {
								update_post_meta( $_POST['ID'], 'featured_video', $_POST['video_URL'] );
							}
						}
					}
				}
			}
		}

		private function save_selected_page( $selected_pages ) {
			$selected = implode( '.', $selected_pages );
			update_post_meta( $_POST['ID'], 'selected_pages', $selected );
		}

		private function validate_video( $video ) {
			$allowed_formats = array('ogg', 'ogv', 'avi', 'mov', 'wmv', 'flv', 'mp4' );
			$input = explode( '.', $video );
			$input_format = end( $input );
			if ( in_array( $input_format, $allowed_formats ) ) {
				return true;
			}
			return false;
		}

	}
}

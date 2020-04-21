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
						if ( isset( $_POST['selected_page' ] ) ) {
							update_post_meta( $_POST['ID'], 'selected_page', $_POST['selected_page'] );
						}
						if ( isset( $_POST['video_URL'] ) ) {
							update_post_meta( $_POST['ID'], 'featured_video', $_POST['video_URL'] );
						}
					}
				}
			}
		}

	}
}

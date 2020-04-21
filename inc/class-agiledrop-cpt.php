<?php
if ( !class_exists( 'Agiledrop_CPT' ) ) {

	class Agiledrop_CPT {

		public function __construct() {
			add_action( 'init', array( $this, 'create_post_types' ) );
		}

		public function create_post_types() {
			register_post_type( 'agiledrop-hero',
				array(
					'labels' => array(
						'name'          => __( 'Hero', 'agiledrop' ),
						'singular_name' => __( 'Hero', 'agiledrop' ),
					),
					'description'           => __( 'This post will be displayed on hero image/video.', 'agiledrop' ),
					'supports'              => array( 'title', 'thumbnail', 'excerpt'),
					'taxonomies'            => array( 'agiledrop-categories' ),
					'public'                => true,
					'has_archive'           => true,
					'rewrite'               => array( 'slug' => 'hero-text' ),
					'show_in_rest'          => true,
					'register_meta_box_cb'  => array( $this, 'create_meta_boxes' ),
                    'show_ui'               => true,
                    'show_in_menu'          => 'agiledrop-page'
				)
			);

			register_post_type( 'agiledrop-jobs',
				array(
					'labels' => array(
						'name'          => __( 'Jobs', 'agiledrop' ),
						'singular_name' => __( 'Job', 'agiledrop' ),
					),
					'description'   => __( 'This post type is meant for jobs posts', 'agiledrop' ),
					'supports'      => array( 'title','editor'),
					'taxonomies'    => array( 'agiledrop-categories', 'category' ),
					'public'        => true,
					'has_archive'   => true,
					'rewrite'       => array( 'slug' => 'jobs' ),
					'show_in_rest'  => true,
					'show_ui'               => true,
					'show_in_menu'          => 'agiledrop-page'
				)
			);

			register_post_type( 'agiledrop-employees',
                array(
                        'labels' => array(
                                'name'          => __( 'Employees', 'agiledrop' ),
                                'singular_name' => __( 'Employee', 'agiledrop' ),
                        ),
                        'description'   => __( 'This post type is meant for employees', 'agiledrop' ),
                        'supports'      => array( 'title','editor'),
                        'taxonomies'    => array( 'agiledrop-categories','category' ),
                        'public'        => true,
                        'has_archive'   => true,
                        'rewrite'       => array( 'slug' => 'employees' ),
                        'show_in_rest'  => true,
                        'show_ui'               => true,
                        'show_in_menu'          => 'agiledrop-page'
                )
            );
		}

		public function create_meta_boxes() {
			add_meta_box(
				'agiledrop-video',
				__( 'Featured Video', 'agiledrop' ),
				array( $this, 'upload_video' ),
				'agiledrop-hero',
				'side',
				'low'
			);
			add_meta_box(
				'agiledrop-meta-box',
				__( 'Select page', 'agiledrop' ),
				array( $this, 'select_page'),
				'agiledrop-hero',
				'side',
				'low'
			);
		}

		public function upload_video() {
			wp_nonce_field( 'agiledrop_save', 'featured_video_nonce' );
			$value = get_post_meta( $_GET['post'], 'featured_video' ); ?>
            <label for="video_URL">Upload a video</label>
            <input id="video_URL" type="text" size="24" name="video_URL" placeholder="Upload a video" value="'<?php echo $value[0]; ?>'"/>
            <input id="upload_video_button" class="button" type="button" value="Upload" />
            <p>If there is no video, we set featured image as background</p>
			<?php
		}

		public function select_page( $post ) {
			wp_nonce_field( 'agiledrop_save', 'select_page_nonce' );
			$pages          = get_pages();

			$value = get_post_meta( $_GET['post'], 'selected_pages' );
			$selected_pages = explode( '.', $value[0] );

			$print_pages = array();
			foreach ( $pages as $page ) {
			    $print_pages[$page->ID] = array( 'title' => $page->post_title, 'checked' => '' );
			}

			foreach ( $selected_pages as $selected ) {
			    foreach ( $print_pages as $key => $value ) {
			        if ( $key == $selected ) {
			            $print_pages[$key]['checked'] = 'checked';
			        }
			    }
			}

			foreach ( $print_pages as $key => $value  ) : ?>
                <input type="checkbox" name="selected_pages[]" value="<?php echo $key; ?>" <?php echo $value['checked']?>><?php echo $value['title']; ?> <br>
			<?php endforeach;

		}
	}
}



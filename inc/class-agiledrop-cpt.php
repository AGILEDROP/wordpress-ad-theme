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
					'taxonomies'            => array( 'category' ),
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
					'taxonomies'    => array( 'category' ),
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
                        'taxonomies'    => array( 'category' ),
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
			$value = 'Upload Video';
			if ( isset( $_GET['post'] ) ) {
				$value = get_post_meta( $_GET['post'], 'featured_video' );
				if ( empty( $value ) ) {
					$value = array( 0 => 'Upload video' );
                }
            }
			?>
            <label for="video_URL">Upload a video</label>
            <input id="video_URL" type="text" size="24" name="video_URL" value="<?php echo $value[0]; ?>" placeholder="Insert video url"/>
            <input id="upload_video_button" class="button" type="button" value="Upload" />
            <p>If there is no video, we set featured image as background</p>
			<?php
		}


		public function select_page( $post ) {
		    $helper = new Agiledrop_Helper();
			wp_nonce_field( 'agiledrop_save', 'select_page_nonce' );

			$pages = get_pages();
			$checkboxes = array();
			if ( ! empty( $pages ) ) {
			    foreach ( $pages as $page) {
                   $checkboxes[] = array( 'id' => $page->ID, 'title' => $page->post_title, 'checked' => '', 'disabled' => '' );
                }

			    foreach ( $helper->posts_from_cpt( 'agiledrop-hero' ) as $key => $value ) {
			        if ( $value->ID != $post->ID ) {
			            $checkboxes = $helper->checkbox_values( $value->ID, $checkboxes, 'disabled' );
			        }
			        else {
			            $checkboxes = $helper->checkbox_values( $value->ID, $checkboxes, 'checked' );
			        }
			    }

			    foreach ( $checkboxes as $checkbox ) : ?>
			        <input type="checkbox" name="selected_pages[]" value="<?php echo $checkbox['id'];?>" <?php echo $checkbox['checked'], $checkbox['disabled'];?>> <?php echo $checkbox['title'];?> <br>
			    <?php endforeach;
            }
			else {
				echo "<p>No pages found</p>";
            }
		}
	}
}



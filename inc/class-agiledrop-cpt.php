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
						'name'          => __( 'Hero Texts', 'agiledrop' ),
						'singular_name' => __( 'Hero Text', 'agiledrop' ),
					),
					'description'           => __( 'This post will be displayed on hero image/video.', 'agiledrop' ),
					'supports'              => array( 'title','editor', 'thumbnail'),
					'public'                => true,
					'has_archive'           => true,
					'rewrite'               => array( 'slug' => 'hero-text' ),
					'show_in_rest'          => true,
					'register_meta_box_cb'  => array( $this, 'create_meta_boxes' ),
				)
			);

			register_post_type( 'agiledrop-jobs',
				array(
					'labels' => array(
						'name'          => __( 'Jobs', 'agiledrop' ),
						'singular_name' => __( 'Job', 'agiledrop' ),
					),
					'decription'    => __( 'This post type is meant for jobs posts', 'agiledrop' ),
					'public'        => true,
					'has_archive'   => true,
					'rewrite'       => array( 'slug' => 'jobs' ),
					'show_in_rest'  => true
				)
			);

			register_post_type( 'agiledrop-employees',
                array(
                        'labels' => array(
                                'name'          => __( 'Employees', 'agiledrop' ),
                                'singular_name' => __( 'Employee', 'agiledrop' ),
                        ),
                        'description'   => __( 'This post type is meant for employees', 'agiledrop' ),
                        'public'        => true,
                        'has_archive'   => true,
                        'rewrite'       => array( 'slug' => 'employees' ),
                        'show_in_rest'  => true
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
			wp_nonce_field( 'agiledrop_save', 'featured_video_nonce' ); ?>

			<label>Insert link video</label>
			<input type="url" name="featured_video" value="Insert link" >


			<?php
		}

		public function select_page( $post ) {
			wp_nonce_field( 'agiledrop_save', 'select_page_nonce' );
			$pages = get_pages();
			?>
			<p>
				<?php
				if ( !empty( $pages ) ) {
					foreach ( $pages as $page ) : ?>
						<input type="checkbox" name="selected_page" value="<?php echo $page->ID; ?> "> <?php echo $page->post_title; ?>
						<br>
					<?php endforeach;
				}
				?>

			</p>
			<?php
		}
	}
}



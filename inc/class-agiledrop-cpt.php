<?php
if ( !class_exists( 'Agiledrop_CPT' ) ) {

	class Agiledrop_CPT {

		public function __construct() {
			add_action( 'init', array( $this, 'create_post_types' ) );
			add_action('admin_print_scripts', array( $this,'my_admin_scripts'));
			add_action('admin_print_styles',  array( $this, 'my_admin_styles'));
		}


		function my_admin_scripts() { wp_enqueue_script('jquery'); wp_enqueue_script('media-upload');   wp_enqueue_script('thickbox'); }
		function my_admin_styles()  { wp_enqueue_style('thickbox'); }
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

			?>
            <label for="video_URL">Upload a video</label>
            <input id="video_URL" type="text" size="24" name="video_URL"  />
            <input id="upload_video_button" class="button" type="button" value="Upload" />
            <p>If there is no video, we set featured image as background</p>
            <script>


                jQuery(document).ready(function($){
                    $('#video-metabox.postbox').css('margin-top','30px');

                    var custom_uploader;
                    $('#upload_video_button').click(function(e) {

                        e.preventDefault();

                        //If the uploader object has already been created, reopen the dialog
                        if (custom_uploader) {
                            custom_uploader.open();
                            return;
                        }

                        //Extend the wp.media object
                        custom_uploader = wp.media.frames.file_frame = wp.media({
                            title: 'Choose a Video',
                            button: {
                                text: 'Choose a Video'
                            },
                            multiple: false
                        });

                        //When a file is selected, grab the URL and set it as the text field's value
                        custom_uploader.on('select', function() {
                            attachment = custom_uploader.state().get('selection').first().toJSON();
                            $('#video_URL').val(attachment.url);

                        });

                        //Open the uploader dialog
                        custom_uploader.open();

                    });


                });
            </script>
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



<?php
/**
 * Create custom post types.
 */
function agiledrop_create_post_type() {
	//Custom post type for header.
	register_post_type( 'agiledrop-hero',
		array(
			'labels' => array(
				'name'          => __( 'Hero Texts', 'agiledrop' ),
				'singular_name' => __( 'Hero Text', 'agiledrop' ),
			),
			'description'   => __( 'This post will be displayed on hero image/video.', 'agiledrop' ),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'       => array( 'slug' => 'hero-text' ),
		)
	);
}

add_action( 'init', 'agiledrop_create_post_type' );

/**
 * Adds the meta box to the post screen
 */

function agiledrop_add_meta_box() {
	add_meta_box(
		'agiledrop-meta-box',
		__( 'Select page', 'agiledrop' ),
		'agiledrop_select_page',
		'agiledrop-hero',
		'side',
		'low'
	);
}

add_action( 'add_meta_boxes', 'agiledrop_add_meta_box' );
/**
 * Callback function for our meta box.  Echos out the content
 */
function agiledrop_select_page( $post ) {
	//Todo Add nonce and fix multiple select with values checked
	//wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	//$post_meta = get_post_meta( $post->ID );
	$pages = get_pages();
	?>
	<p>
			<?php
				if ( !empty( $pages ) ) {
					foreach ( $pages as $page ) : ?>
						<input type="checkbox" name="selected_page" value="<?php echo $page->ID; ?>"> <?php echo $page->post_title; ?>
						<br>
					<?php endforeach;
				}
			?>

	</p>
<?php
}

/**
 * Saves the custom meta input
 */
function agiledrop_meta_save( $post_id ) {
	if ( isset( $_POST['selected_page'] ) ) {
		update_post_meta( $post_id, 'selected_page', $_POST['selected_page'] );
	}
}
add_action( 'save_post', 'agiledrop_meta_save' );


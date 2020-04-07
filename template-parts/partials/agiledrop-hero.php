<?php ?>
<div class="hero">
        <div class="agiledrop-opacity opacity">
            <div class="opacity"></div>
        </div>
		<?php if ( function_exists( 'the_custom_header_markup' ) ) {
			the_custom_header_markup();
		}
		else{
			the_header_image_tag();
		}?>
		<?php  $posts = query_posts( 'post_type=agiledrop-hero' );
		if ( !empty( $posts ) ) {
			foreach ( $posts as $one ) {
				$selected_page = get_post_meta( $one->ID, 'selected_page' );
				if ( $selected_page[0] == $post->ID ) : ?>

					<div class="container">
						<div class="hero-text">
							<h1><?php echo $one->post_title;?></h1>
							<hr>
							<h4><?php echo $one->post_content; ?></h4>
						</div>
					</div>
				<?php endif;
			}
		}
		?>
	</div>

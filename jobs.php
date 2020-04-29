<?php
/**
 * Template Name: Jobs Archive
 */

get_header();

get_template_part( 'template-parts/partials/agiledrop-hero');
$args = array(
	'numberposts'       => -1,
	'post_type'         => 'agiledrop-jobs',
	'post_status'       => 'publish'
);
$posts = get_posts( $args );
$output = array();

if ( isset ( $_GET['selected_technology'] ) && !empty( $_GET['selected_technology'] ) ) {
	foreach ( $_GET['selected_technology'] as $tech ) {
		foreach ( $posts as $one ) {
			if ( strpos( strtolower( $one->post_title ), $tech ) !== false ) {
				$output[] = $one;
			}
		}
	}
}

if (isset ( $_GET['search_keyword'] ) && !empty( $_GET['search_keyword'] ) ) {
	$keyword = sanitize_text_field( $_GET['search_keyword'] );
	foreach ( $output as $key => $value ) {
	    if ( strpos( strtolower( $value->post_content ), strtolower( $keyword ) ) === false ) {
	        unset( $output[$key] );
	    }
	}
}

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
            if ( ! empty( $output ) ) {
                foreach ( $output as $one ) { ?>
                    <div class="job-post">
                        <h3><?php echo $one->post_title;?></h3>
                        <p><?php echo $one->post_content; ?></p>
                    </div>
			<?php }}
            else {
                foreach ( $posts as $post ) { ?>
                    <div class="job-post">
                        <h3><?php echo $post->post_title;?></h3>
                        <p><?php echo $post->post_content; ?></p>
                    </div>
                <?php
            } }
            ?>
		</main>
	</div
<?php
get_footer();
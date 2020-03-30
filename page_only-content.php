<?php
/** Template Name: Page Content Only */


get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="page-container container">
	            <?php
	            echo $post->post_content;
	            ?>
            </div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

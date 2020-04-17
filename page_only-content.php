<?php
/** Template Name: Page Content Only */


get_header();

get_template_part( 'template-parts/partials/agiledrop-hero');
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="page-container container">
                <div class="widget-content">
                   <?php get_template_part( 'template-parts/partials/two-columns' );?>
                </div>
                <?php
	            echo $post->post_content;
	            ?>
            </div>
		</main>
	</div>

<?php
get_footer();

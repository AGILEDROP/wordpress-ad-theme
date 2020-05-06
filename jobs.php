<?php
/**
 * Template Name: Jobs Archive
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agiledrop
 */

get_header();
get_template_part( 'template-parts/partials/agiledrop-hero');
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/content/content', 'jobs' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Agiledrop
 */

get_header();
?>

<?php
	global $post;
	$hero_video = get_post_meta( $post->ID, 'featured_video');
	$hero_image = get_the_post_thumbnail_url( $post->ID );
	$hero_title = $post->post_title;
	$hero_excerpt = $post->post_excerpt;
?>

<div class="hero">
    <div class="hero__opacity"></div>
    <div class="hero__background">
    	<figure class="hero__video">
    	<?php if ( !empty($hero_video[0]) ) {
				echo '<video autoplay muted loop>
  							<source src="' . $hero_video[0] .  '" type="video/mp4">
						</video>';
			}
			if ( !empty($hero_image) ) {
				echo '<img src=' . $hero_image . '>';
			}
		?>
		</figure>   
    </div>
    <div class="hero__text">
        <div class="hero__container">
            <h1 class="hero__heading"><?php if ( !empty( $hero_title ) ) echo $hero_title; ?></h1>
            <div class="hero__description"><?php if ( !empty( $hero_excerpt ) ) echo $hero_excerpt; ?></div>
        </div>
    </div>
</div>

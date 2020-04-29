<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agiledrop
 */

?>
<footer class="footer">
    <div class="footer__top">
        <div class="footer__container container">

            <div class="footer__left">
            	<?php
                if ( is_active_sidebar( 'top-left-footer' ) ) {
	                dynamic_sidebar( 'top-left-footer' );
                }
                ?>
                <div class="footer__inner">
	                <div class="footer__inner-left">
		                <?php
		                if ( is_active_sidebar( 'top-left-left-footer' ) ) {
			                dynamic_sidebar( 'top-left-left-footer' );
		                }
		                ?>
	                </div>
	                <div class="footer__inner-right">
		                <?php
		                if ( is_active_sidebar( 'top-left-right-footer' ) ) {
			                dynamic_sidebar( 'top-left-right-footer' );
		                }
		                if ( is_active_sidebar( 'top-left-right-socials' ) ) { ?>
			                <div class="footer__inner-socials"><?php dynamic_sidebar( 'top-left-right-socials' ); ?></div>
		                <?php } ?>
	                </div>
	            </div>

            </div>
            <div class="footer__right">
	            <?php
	            if ( is_active_sidebar( 'top-right-footer' ) ) {
		            dynamic_sidebar( 'top-right-footer' );
	            }
	            ?>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__copyright">&copy; 2013-<?php echo date('Y'); ?> AGILEDROP D.O.O.</div>
			<div class="footer__cms">Sistem za izdelavo spletnih strani: <a href="#">Wordpress</a></div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

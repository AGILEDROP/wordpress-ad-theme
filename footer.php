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
	                ?>
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
            <?php
	            if ( is_active_sidebar( 'bottom-footer-area' ) ) {
		            dynamic_sidebar( 'bottom-footer-area' );
	            }
	        ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

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
        <div class="container">

                <?php
                    if ( is_active_sidebar( 'left-footer-area' ) ) {
                        dynamic_sidebar( 'left-footer-area' );
                    }
                ?>


                <?php
                    if ( is_active_sidebar( 'right-footer-area' ) ) {
                        dynamic_sidebar( 'right-footer-area' );
                    }
                 ?>

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

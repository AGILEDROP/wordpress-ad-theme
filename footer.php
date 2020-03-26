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

    <footer class="agile-footer">
        <div class="footer-container container">
            <div class="region region-footer">
                <div class="block-footerinfo">
                    <?php
                        $cat_id = get_cat_ID( 'Business Locations');
                        $posts = get_posts( array( 'orderby' => 'date', 'order' => 'ASC', 'numberposts' => -1, 'category' => $cat_id, 'post_status' => 'publish' ) );
                        if ( !empty( $posts ) ) {
                           foreach ( $posts as $post ) {
                               echo "<h4>$post->post_title</h4>";
                               echo "<p>$post->post_content</p>";
                           }
                        }
                    ?>
	                <?php if ( has_nav_menu( 'footer-social-menu' ) ) : ?>
                        <nav class="footer-social-menu">
			                <?php
			                wp_nav_menu(
				                array(
					                'theme_location' => 'footer-social-menu',
					                'menu_class'     => 'footer-social-menu__items',
					                'depth'          => 1,
				                )
			                );
			                ?>
                        </nav>
	                <?php endif; ?>
                </div>
                <div class="block-footer-menu">
	                <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
                        <nav class="footer-menu">
			                <?php
			                wp_nav_menu(
				                array(
					                'theme_location' => 'footer-menu',
					                'menu_class'     => 'footer-menu__items',
					                'depth'          => 1,
				                )
			                );
			                ?>
                        </nav>
	                <?php endif; ?>
                </div>
            </div>
        </div>

    </footer>
    <div class="agile-copyright">
        <div class="copyright-container container">
            <div class="region region-copyright">
                <div class="left"></div>
                <div class="right"></div>
            </div>
        </div>
    </div>

</div><!-- #app -->

<?php wp_footer(); ?>
</body>
<kldsjfsldk></kldsjfsldk>
</html>

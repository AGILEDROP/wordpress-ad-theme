<?php
/** Template Name: Page With Search */


get_header();

get_template_part( 'template-parts/partials/agiledrop-hero');
?>
    <div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="agiledrop-search">
                <h3>Search Job Posts</h3>
                <form action="/jobs-archive" method="get">
                    <input type="checkbox" name="selected_technology[]" value="drupal" checked>Drupal
                    <input type="checkbox" name="selected_technology[]" value="wordpress" checked>Wordpress
                    <input type="checkbox" name="selected_technology[]" value="magento" checked>Magento
                    <input type="checkbox" name="selected_technology[]" value="html/css" checked>HTML
                    <input type="checkbox" name="selected_technology[]" value="javascript" checked>JS
                    <input type="checkbox" name="selected_technology[]" value="angular" checked >Angular
                    <input type="search" name="search_keyword" placeholder="Enter job keyword" />
                    <button type="submit">Search</button>
                </form>
            </div>
			<?php echo $post->post_content; ?>
		</main>
	</div
<?php
get_footer();

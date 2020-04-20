
<form id="agiledrop-search" method="get" action="<?php echo home_url('/'); ?>">
	<fieldset>
        <input type="text" class="search-field" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
        <?php
        $helper = new Agiledrop_Helper();
        $post_types = $helper->get_all_post_types();
        foreach ( $post_types as $type ) { ?>
            <input type="hidden" name="post_type[]" value="<?php echo $type; ?>">
        <?php } ?>
        <input type="submit" value="Search">
	</fieldset>
</form>

<?php


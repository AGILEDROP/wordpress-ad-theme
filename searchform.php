
<form id="agiledrop-search" method="get" action="<?php echo home_url('/'); ?>">
	<fieldset>
		<legend>Select where to search</legend>
		<label for="taxonomies">Categories</label>
		<input type="checkbox" name="taxonomies">
		<label for="post-types">Post Types</label>
		<input type="checkbox" name="post-types">
		<input type="text" class="search-field" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
		<input type="submit" value="Search">
	</fieldset>
</form>

<?php

$helper = new Agiledrop_Helper();
$post_types = $helper->get_all_post_types();
$b = 1;
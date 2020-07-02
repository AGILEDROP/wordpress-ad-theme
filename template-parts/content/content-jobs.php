<?php
/**
 * Template part for displaying jobs archive in jobs.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agiledrop
 */

$args = array(
	'numberposts'       => -1,
	'post_type'         => 'agiledrop-jobs',
	'post_status'       => 'publish'
);
$posts = get_posts( $args );
$output = array();

if ( isset ( $_GET['selected_technology'] ) && !empty( $_GET['selected_technology'] ) ) {
	foreach ( $_GET['selected_technology'] as $tech ) {
		foreach ( $posts as $one ) {
			if ( strpos( strtolower( $one->post_title ), $tech ) !== false ) {
				$output[] = $one;
			}
		}
	}
}

if (isset ( $_GET['search_keyword'] ) && !empty( $_GET['search_keyword'] ) ) {
	$keyword = sanitize_text_field( $_GET['search_keyword'] );
	foreach ( $output as $key => $value ) {
	    if ( strpos( strtolower( $value->post_content ), strtolower( $keyword ) ) === false ) {
	        unset( $output[$key] );
	    }
	}
}

?>

<div class="search">
	<div class="container">
		<form class="form form-jobs" action="/jobs-archive" method="get">
			<div class="form__group">
				<input type="search" class="form__input" name="search_keyword" placeholder="Enter job keyword" />
			</div>
			<div class="form__group form__checkboxes">

				<label class="form__checkbox" for="drupal">
					Drupal
					<input type="checkbox" id="drupal" name="selected_technology[]" value="drupal" checked>
					<span class="checkmark"></span>
				</label>

				<label class="form__checkbox" for="wordpress">
					Wordpress
					<input type="checkbox" id="wordpress" name="selected_technology[]" value="wordpress" checked>
					<span class="checkmark"></span>
				</label>

				<label class="form__checkbox" for="magento">
					Magento
					<input type="checkbox" id="magento" name="selected_technology[]" value="magento" checked>
					<span class="checkmark"></span>
				</label>

				<label class="form__checkbox" for="html">
					HTML
					<input type="checkbox" id="html" name="selected_technology[]"value="html" checked>
					<span class="checkmark"></span>
				</label>

				<label class="form__checkbox" for="js">
					JS
					<input type="checkbox" id="js" name="selected_technology[]"value="js" checked>
					<span class="checkmark"></span>
				</label>

				<label class="form__checkbox" for="angular">
					Angular
					<input type="checkbox" id="angular" name="selected_technology[]" value="angular" checked>
					<span class="checkmark"></span>
				</label>

			</div>
			<button type="submit" class="form__button">Išči</button>
		</form>
	</div>
</div>
<div class="wp-block-group cards cards-60 cards-jobs">
	<div class="wp-block-group__inner-container">
<?php
if ( ! empty( $output ) ) {
    foreach ( $output as $one ) { ?>
        <div class="wp-block-agiledrop-agiledrop-card agiledrop-card">
            <div class="agiledrop-card__content">
                <h3><?php echo $one->post_title;?></h3>
                <p><?php echo $one->post_content; ?></p>
            </div>
        </div>
<?php }}
else {
    foreach ( $posts as $post ) { ?>
        <div class="wp-block-agiledrop-agiledrop-card agiledrop-card">
        	<div class="agiledrop-card__content">
                <h3><?php echo $post->post_title;?></h3>
                <p><?php echo $post->post_content; ?></p>
            </div>
        </div>
    <?php
} }
?>
</div>
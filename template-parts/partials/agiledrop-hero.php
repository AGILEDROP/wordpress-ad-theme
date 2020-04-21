<?php
$helper = new Agiledrop_Helper();
$hero = $helper->page_has_post( 'agiledrop-hero' );
 ?>
<div class="hero">
	<div class="hero__opacity"></div>
	<h1 class="hero__heading"><?php if ( !empty( $hero['title'] ) ) echo $hero['title']; ?></h1>
	<?php if ( !empty( $hero['content'] ) ) echo $hero['content']; ?>
</div>

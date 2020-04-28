<?php
	$helper = new Agiledrop_Helper();
	$hero = $helper->page_has_post( 'agiledrop-hero' );
?>


<div class="<?php if (is_front_page()) { echo 'hero'; } else { echo 'hero hero__subpage'; } ?>">
	<div class="hero__opacity"></div>
		<figure class="<?php if (is_front_page()) { echo 'hero__video'; } else { echo 'hero__image'; } ?>">
			<?php if ( !empty( $hero['background'] ) ) echo $hero['background']; ?>
		</figure>
	<div class="hero__text">
		<div class="hero__container">
			<h1 class="hero__heading"><?php if ( !empty( $hero['title'] ) ) echo $hero['title']; ?></h1>
			<div class="hero__description"><?php if ( !empty( $hero['content'] ) ) echo $hero['content']; ?></div>
		</div>
	</div>
</div>

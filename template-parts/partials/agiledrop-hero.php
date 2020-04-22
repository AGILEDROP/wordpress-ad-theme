<?php
$helper = new Agiledrop_Helper();
$hero = $helper->page_has_post( 'agiledrop-hero' );
 ?>
<div class="hero">
    <div class="hero__opacity"></div>
    <div class="hero__background">
        <figure class="hero__video">
        <?php if ( !empty( $hero['background'] ) ) echo $hero['background']; ?>
        </figure>
    </div>
    <div class="hero__text">
        <div class="hero__container">
            <h1 class="hero__heading"><?php if ( !empty( $hero['title'] ) ) echo $hero['title']; ?></h1>
            <div class="hero__description"><?php if ( !empty( $hero['content'] ) ) echo $hero['content']; ?></div>
        </div>
    </div>
</div>

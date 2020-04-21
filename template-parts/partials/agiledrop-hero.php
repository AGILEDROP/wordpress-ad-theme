<?php
$helper = new Agiledrop_Helper();
$hero = $helper->page_has_post( 'agiledrop-hero' );
 ?>
<div class="hero">
    <div class="opacity"></div>
    <div class="hero__background">
        <?php if ( !empty( $hero['background'] ) ) echo $hero['background']; ?>
    </div>
    <div class="hero__text">
        <h1 class="hero__heading"><?php if ( !empty( $hero['title'] ) ) echo $hero['title']; ?></h1>
        <hr>
        <p class="hero__description"><?php if ( !empty( $hero['content'] ) ) echo $hero['content']; ?></p>
    </div>
</div>

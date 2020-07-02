<?php
add_filter( 'render_block', function( $block_content, $block ) {
	if ( preg_match( '~^core/|core-embed/~', $block['blockName'] ) ) {
		$block_content = sprintf( '<div class="block__container">%s</div>', $block_content );
	}
	return $block_content;
}, 10, 2 );

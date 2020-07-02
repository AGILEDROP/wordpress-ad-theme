<div class="columns">
	<div class="columns__left">
		<?php
		if ( is_active_sidebar( 'left-main-content' ) ) {
			dynamic_sidebar( 'left-main-content' );
		}
		?>
	</div>
	<div class="columns__right">
		<?php
		if ( is_active_sidebar( 'right-main-content' ) ) {
			dynamic_sidebar( 'right-main-content' );
		}
		?>
	</div>
</div>
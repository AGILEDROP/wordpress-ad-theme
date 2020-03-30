<?php
if ( !class_exists('Agiledrop_Blocks' ) ) {
	class Agiledrop_Blocks {
		public function __construct() {
			add_action( 'enqueue_block_assets', array( $this, 'block_assets' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets') );
			//add_action( 'init', array( $this, 'register_blocks' ) );
		}

		public function block_assets(){
			wp_enqueue_style(
				'block_frontend_styles',
				get_stylesheet_directory_uri() . '/inc/blocks/column/style.css',
				array(),
				''
			);
		}
		public function block_editor_assets(){
			wp_enqueue_script(
				'block_editor_scripts',
				get_stylesheet_directory_uri() . '/inc/blocks/column/block-build.js',
				array( 'wp-blocks', 'wp-i18n', 'wp-editor', 'wp-components' ),
				''
			);

			wp_enqueue_style(
				'block_editor_styles',
				get_stylesheet_directory_uri() . '/inc/blocks/column/editor.css',
				array(),
				''
			);
		}

		public function register_blocks(){
			register_block_type(
				'agiledrop/column-2', array(
					'style'         => 'block_frontend_styles',
					'editor_script' => 'block_editor_scripts',
					'editor_style'  => 'block_editor_styles',
					'render_callback' =>array( $this, 'render_page_content' )
				)
			);
		}

		public function render_page_content( $attributes ) {
			ob_start();
			echo '<div class="'. $attributes['position'].'">';
			echo '<h1>' . $attributes['title'] . '</h1>';
			echo '<p>' . $attributes['description'] . '</p>';
			echo '<img src="'. $attributes['image'] .'">';
			echo '</div>';
			return ob_get_clean();
		}
	}
}

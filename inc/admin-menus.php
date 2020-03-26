<?php
/**
 * Custom admin menus.
 *
 * @link https://developer.wordpress.org/reference/hooks/admin_menu/
 *
 * @package Agiledrop
 */

/**
 * Submenu Page for Managing Reusable Blocks (Guttenberg)
 */
function agiledrop_admin_menus() {
	add_submenu_page( 'themes.php', 'Blocks', 'Blocks', 'manage_options',
		'edit.php?post_type=wp_block', $function = '', $position = null );
}
add_action('admin_menu', 'agiledrop_admin_menus');

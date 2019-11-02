<?php
/*
 * Plugin Name: Basic Matomo Integration
 * Description: Basic Matomo Integration
 * Author: Matomo
 * Author URI: https://matomo.org
 * Version: 1.0.0
 *
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

add_action( 'admin_init', function () {
	if ( is_plugin_active( 'matomo/matomo.php' ) ) {
		add_filter( 'page_row_actions', function ( $actions ) {
			if ( current_user_can( 'view_matomo' ) ) {
				$actions[] = '<a href="' . \WpMatomo\Admin\Menu::get_matomo_action_url( 'MyPlugin', 'MyAction' ) . '">My Link</a>';
			}

			return $actions;
		} );

	}
} );
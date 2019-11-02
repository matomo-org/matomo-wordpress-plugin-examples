<?php
/*
 * Plugin Name: Direct Data Access
 * Description: Fetch data from Matomo by directly accessing the database
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

add_action( 'admin_menu', function () {

	add_menu_page( 'Matomo Data Access', 'Matomo Data Access', 'view_matomo', 'data-access', null, 'dashicons-analytics' );

	add_submenu_page( 'data-access', __( 'List all sites', 'matomo' ), __( 'List all sites', 'matomo' ), 'view_matomo', 'data-access', function () {
		$db_settings = new WpMatomo\Db\Settings();
		$goal_table_name = $db_settings->prefix_table_name('site');

		$site = new WpMatomo\Site();
		$idsite = $site->get_current_matomo_site_id();

		global $wpdb;
		// see Matomo database schema: https://developer.matomo.org/guides/persistence-and-the-mysql-backend
		$sites = $wpdb->get_results('select * from ' . $goal_table_name . ' where idsite = '. (int) $idsite);
		var_export($sites);
	} );
});

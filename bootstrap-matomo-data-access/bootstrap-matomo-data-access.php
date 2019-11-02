<?php
/*
 * Plugin Name: Bootstrap Matomo Data Access
 * Description: Bootstrap Matomo and fetch data through a Matomo API
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

	add_menu_page( 'Matomo API Access', 'Matomo API Access', 'view_matomo', 'api-access', null, 'dashicons-analytics' );

	add_submenu_page( 'data-access', __( 'List all sites', 'matomo' ), __( 'List all sites', 'matomo' ), 'view_matomo', 'api-access', function () {
		\WpMatomo\Bootstrap::do_bootstrap();

		$site = new WpMatomo\Site();
		$idsite = $site->get_current_matomo_site_id();

		$sites = \Piwik\API\Request::processRequest('SitesManager.getSiteFromId', array('idSite' => $idsite));
		var_export($sites);
	} );
});

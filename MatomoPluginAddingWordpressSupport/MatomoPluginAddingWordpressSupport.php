<?php
/*
 * Plugin Name: Matomo Plugin adding support for WordPress
 * Description: This plugin was initially developed as a Matomo plugin and now wants to add some additional support for WordPress
 * Author: Matomo
 * Author URI: https://matomo.org
 * Version: 1.0.0
 *
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\MatomoPluginAddingWordpressSupport;

use Piwik\Widget\WidgetsList;

/**
 * WORDPRESS INTEGRATION START
 */
if ( defined( 'ABSPATH' ) && function_exists( 'add_action' ) ) {
	// the Matomo plugin is used within WordPress and not Matomo On-Premise

	$path = '/matomo/app/core/Plugin.php';
	if ( defined( 'WP_PLUGIN_DIR' ) && WP_PLUGIN_DIR && file_exists( WP_PLUGIN_DIR . $path ) ) {
		require_once WP_PLUGIN_DIR . $path;
	} elseif ( defined( 'WPMU_PLUGIN_DIR' ) && WPMU_PLUGIN_DIR && file_exists( WPMU_PLUGIN_DIR . $path ) ) {
		require_once WPMU_PLUGIN_DIR . $path;
		// plugin is used within WordPress but Matomo is not installed
	} else {
		return; // do nothing if Matomo for WordPress is not installed
	}
	add_action( 'plugins_loaded', function () {
		$is_matomo_activated = function_exists( 'matomo_add_plugin' );
		if ( $is_matomo_activated ) {
			// register the Matomo plugin
            // __FILE__ should point to the main WordPress plugin file. If the code is not in your main WordPress PHP file,
            // then you need to specify the path to the main WordPress PHP file.
			matomo_add_plugin( __DIR__, __FILE__ );
		}
	} );

	// HERE YOU CAN ADD FURTHER WP ACTIONS AND FILTERS TO INTEGRATE YOUR PLUGIN BETTER INTO WORDPRESS

	add_action( 'rest_api_init', function () {
		// add our API to the WordPress REST API
		$restApi = new \WpMatomo\API();
		$restApi->register_route('MatomoPluginAddingWordpressSupport', 'getExampleData');
	});
}

/**
 * WORDPRESS INTEGRATION END
 */

class MatomoPluginAddingWordpressSupport extends \Piwik\Plugin {

	public function registerEvents()
	{
		return array(
			'Tracker.isExcludedVisit' => 'isExcludedVisit',
			'Widget.filterWidgets' => 'filterWidgets',
		);
	}

	public function isExcludedVisit(&$isExcludedVisit, \Piwik\Tracker\Request $request)
	{
		if ($request->getIpString() === '10.10.10.10') {
			$isExcludedVisit = true;
		}
	}

	public function filterWidgets(WidgetsList $list)
	{
		// remove all widgets within this category
		$list->remove('About Matomo');
	}

}

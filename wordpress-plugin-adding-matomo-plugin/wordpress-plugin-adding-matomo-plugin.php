<?php
/*
 * Plugin Name: WordPress Plugin Adding Matomo Plugin
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

add_action('plugins_loaded', function () {
	$is_matomo_plugin_activated = function_exists('add_matomo_plugin');
	if ($is_matomo_plugin_activated) {
		// you can add one more multiple Matomo plugins here
		add_matomo_plugin( __DIR__ . '/plugins/MyCustomPlugin', __FILE__ );
	}
});

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

// We recommend placing this code in your main WordPress PHP plugin file.

add_action('plugins_loaded', function () {
	$is_matomo_plugin_activated = function_exists('matomo_add_plugin');
	if ($is_matomo_plugin_activated) {
		// you can add one more multiple Matomo plugins here
        // __FILE__ should point to the main WordPress plugin file. If the code is not in your main WordPress PHP file,
        // then you need to specify the path to the main WordPress PHP file.
		matomo_add_plugin( __DIR__ . '/plugins/MyCustomPlugin', __FILE__ );
	}
});

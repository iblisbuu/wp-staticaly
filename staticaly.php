<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/marsble/wp-staticaly
 * @since             1.0.0
 * @package           Staticaly
 *
 * @wordpress-plugin
 * Plugin Name:       Staticaly
 * Plugin URI:        https://github.com/marsble/wp-staticaly
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Staticaly Team
 * Author URI:        https://github.com/marsble/wp-staticaly
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       staticaly
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STATICALY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-staticaly-activator.php
 */
function activate_staticaly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-staticaly-activator.php';
	Staticaly_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-staticaly-deactivator.php
 */
function deactivate_staticaly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-staticaly-deactivator.php';
	Staticaly_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_staticaly' );
register_deactivation_hook( __FILE__, 'deactivate_staticaly' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-staticaly.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-staticaly-cdn.php';

function run_staticaly() {

	$plugin = new Staticaly();
	$converter = new Staticaly_CDN();

	foreach (array(
		'theme_root_uri',
		'plugins_url',
		'script_loader_src',
		'style_loader_src'
	) as $hook) {
		$plugin->loader->add_filter($hook, $converter, 'convert_core_url', 99, 1);
		$plugin->loader->add_filter($hook, $converter, 'convert_plugins_url', 99, 1);
		// $plugin->loader->add_filter($hook, $converter, 'convert_themes_url', 99, 1);
	}

	$plugin->run();

}
run_staticaly();

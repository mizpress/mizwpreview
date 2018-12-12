<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thepixeltribe.com
 * @since             1.0.0
 * @package           Neptune_Real_Estate
 *
 * @wordpress-plugin
 * Plugin Name:       Neptune Real Estate
 * Plugin URI:        
 * Description:       Neptune real estate, create and manage properties on WordPress, this is the free version but still fully functional, for additional features please upgrade to the pro version.
 * Version:           1.0.8
 * Author:            Fortisthemes
 * Author URI:        https://thepixeltribe.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       neptune-real-estate
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
if (defined( 'NEPTUNE_REAL_ESTATE_VERSION' )){
	define( 'NEPTUNE_REAL_ESTATE_VERSION', '1.0.0' );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-neptune-real-estate-activator.php
 */
function activate_neptune_real_estate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neptune-real-estate-activator.php';
	Neptune_Real_Estate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-neptune-real-estate-deactivator.php
 */
function deactivate_neptune_real_estate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neptune-real-estate-deactivator.php';
	Neptune_Real_Estate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_neptune_real_estate' );
register_deactivation_hook( __FILE__, 'deactivate_neptune_real_estate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-neptune-real-estate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_neptune_real_estate() {

	$plugin = new Neptune_Real_Estate();
	$plugin->run();

}
run_neptune_real_estate();

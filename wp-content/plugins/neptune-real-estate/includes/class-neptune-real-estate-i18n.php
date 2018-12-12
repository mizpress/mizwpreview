<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themespla.net
 * @since      1.0.0
 *
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 * @author     themes planet <support@themespla.net>
 */
class Neptune_Real_Estate_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'neptune-real-estate',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

<?php

/**
 * The file that defines the cpt plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themespla.net
 * @since      1.0.0
 *
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 * @author     themes planet <support@themespla.net>
 */
class Neptune_Real_Estate_Taxonomy {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Neptune_Real_Estate_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	}


	public function neptune_register_location() {

	/**
	 * Taxonomy: Location.
	 */

	$labels = array(
		"name" => __( "Location", "neptune" ),
		"singular_name" => __( "Location", "neptune" ),
	);

	$args = array(
		"label" => __( "Location", "neptune" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Location",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'location', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "location",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "location", array( "property" ), $args );
}

public function neptune_register_amenities() {

	/**
	 * Taxonomy: amenities.
	 */

	$labels = array(
		"name" => __( "amenities", "neptune" ),
		"singular_name" => __( "amenities", "neptune" ),
	);

	$args = array(
		"label" => __( "amenities", "neptune" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "amenities",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'amenities', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "amenities",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "amenities", array( "property" ), $args );
}
}
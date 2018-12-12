<?php

/**
 * The file that defines the core plugin class
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
class Neptune_Real_Estate {

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
		if ( defined( 'NEPTUNE_REAL_ESTATE_VERSION' ) ) {
			$this->version = NEPTUNE_REAL_ESTATE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'neptune-real-estate';
		$this->constants();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->load_acf_config();
		$this->define_public_hooks();
		$this->define_cpt_hooks();
		$this->define_tax_hooks();
		$this->define_property_hooks();
		$this->load_page_templates();
		$this->load_single_templates();
		$this->load_neptune_functions();


	}
		/**
		 * Defines constastants
		 *
		 * @access public
		 * @return void
		 */
		public function constants() {
			define( 'NEPTUNE_DIR', plugin_dir_path( dirname( __FILE__ ) ) );
		}
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Neptune_Real_Estate_Loader. Orchestrates the hooks of the plugin.
	 * - Neptune_Real_Estate_i18n. Defines internationalization functionality.
	 * - Neptune_Real_Estate_Admin. Defines all hooks for the admin area.
	 * - Neptune_Real_Estate_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-loader.php';
		/**
		 * The class is for registering the property custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-functions.php';
		/**
		 * The class is for registering the property custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-cpt.php';

		/**
		 * The class is for registering the property custom taxonomies
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-taxonomy.php';
		/**
		 * The class is for all functions related to property queries
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-properties.php';
		/**
		 * The class is for registering the property custom post type
		 */
		
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-real-estate-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-neptune-real-estate-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-neptune-real-estate-public.php';


		$this->loader = new Neptune_Real_Estate_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Neptune_Real_Estate_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Neptune_Real_Estate_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Neptune_Real_Estate_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}
	private function load_acf_config() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/config/class-neptune-real-estate-acf-config.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/libraries/TGM/class-tgm-plugin-activation.php';

	}
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Neptune_Real_Estate_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_cpt_hooks() {
		//cpt hooks
		$cpt = new Neptune_Real_Estate_Cpt( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'init', $cpt, 'neptune_register_my_cpts', 10 );



	}
	private function define_tax_hooks() {
		//register taxonomies
		$taxes = new Neptune_Real_Estate_Taxonomy( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'init', $taxes, 'neptune_register_location',20 );
		$this->loader->add_action( 'init', $taxes, 'neptune_register_amenities', 20 );	
	}
	/**
	 * Property related hooks
	 *
	 * @since    1.0.0
	 */
	private function define_property_hooks() {
		//register taxonomies
		$property = new Neptune_Real_Estate_Property( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action('neptune_property_location', $property, 'neptune_property_location');
		$this->loader->add_filter('acf/fields/google_map/api', $property, 'neptune_google_map_api');
		$this->loader->add_action('neptune_amenities', $property, 'neptune_property_amenities');
		$this->loader->add_action('neptune_details', $property, 'neptune_all_details');
		$this->loader->add_action('neptune_price',  $property, 'neptune_real_estate_price');
		$this->loader->add_action('neptune_real_estate_list_properties', $property, 'neptune_list_properties',30);
		$this->loader->add_action('neptune_real_estate_list_all_properties', $property, 'neptune_list_all_properties',30);
		$this->loader->add_action('plugin_init', $property, 'neptune_register_required_plugins',20);

	}
	/**
	 * Page templates
	 *
	 * @since    1.0.0
	 */
	private function load_page_templates() {
		//Loads page templates (home & property)
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'templates/class-neptune-real-estate-page-template.php';

		//Loads Single Property template
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'templates/class-neptune-real-estate-template.php';
	}
	/**
	 * Single templates
	 *
	 * @since    1.0.0
	 */
	private function load_single_templates() {
		$single = new Neptune_Real_Estate_Single_Template( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'template_include', $single, 'neptune_templates', 30 );

	}	
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_neptune_functions() {
		//cpt hooks
		$function = new Neptune_Real_Estate_Functions( $this->get_plugin_name(), $this->get_version() );
		//Start checking theme when it's live
		$this->loader->add_action('admin_notices', $function, 'neptune_theme_check');
		$this->loader->add_action('admin_notices', $function, 'neptune_upgrade');
		$this->loader->add_action('neptune_real_estate_header', $function, 'neptune_real_estate_header');
		$this->loader->add_action('neptune_real_estate_cta', $function, 'neptune_cta');
		$this->loader->add_action('neptune_list_blog', $function, 'neptune_list_blog', 10, 3);


	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Neptune_Real_Estate_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

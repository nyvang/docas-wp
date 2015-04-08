<?php
/**
 * The file that defines the core DoCAS class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://ccnn.dk
 * @since      1.0.0
 *
 * @package    Docas
 * @subpackage Docas/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, shortcodes, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the DoCAS plugin.
 *
 * @since      1.0.0
 * @package    Docas
 * @subpackage Docas/includes
 * @author     Nicolaj Nyvang <nyvang@ccnn.dk>
 */
class Docas {

	/**
	 * The loader is responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Docas_Loader    $loader    Maintains and registers all hooks for the DoCAS plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify the DoCAS plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of DoCAS.
	 */
	protected $version;

	/**
	 * Define the DoCAS core functionality.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'docas';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies.
	 *
	 * Include the following files that make up the logic:
	 *
	 * - Docas_Loader. Orchestrates the hooks of the DoCAS plugin.
	 * - Docas_i18n. Defines internationalization functionality.
	 * - Docas_Admin. Defines all hooks for the admin area.
	 * - Docas_Public. Defines all hooks and shortcodes for the public side of the DoCAS plugin.
	 *
	 * Create an instance of the loader used to register the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class is responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-docas-loader.php';

		/**
		 * The class is responsible for defining internationalization functionality
		 * of the DoCAS plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-docas-i18n.php';

		/**
		 * The class responsible for defining all admin area actions - Options, Menus etc.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-docas-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-docas-public.php';
		
		$this->loader = new Docas_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Docas_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Docas_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the DoCAS plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Docas_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'docas_register_settings' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'docas_register_options_page' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the DoCAS plugin.
	 * Add all shortcodes handling the ajax requests for the DoCAS data
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Docas_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		add_shortcode( 'docas_all_courses', array('Docas_Public' , 'get_all_courses') ); 
		// TODO: Create the different shortcodes ('Udbyder', 'Kurser', 'Skabeloner', 'Undervisere', 'Steder', 'Aktivitetslister', 'Kurv (tilmelding)');
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
	 * The name of the DoCAS plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the DoCAS plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with DoCAS plugin.
	 *
	 * @since     1.0.0
	 * @return    Docas_Loader    Orchestrates the hooks of the DoCAS plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the DoCAS version number.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

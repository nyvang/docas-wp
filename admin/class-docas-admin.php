<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://ccnn.dk
 * @since      1.0.0
 *
 * @package    Docas
 * @subpackage Docas/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and admin-specific stylesheet and JavaScript.
 * It is also responsible for defining the user settings such as the DoCAS API keys,
 * and loading the admin menu markup
 *
 * @package    Docas
 * @subpackage Docas/admin
 * @author     Nicolaj Nyvang <nyvang@ccnn.dk>
 */
class Docas_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Docas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Docas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/docas-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Docas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Docas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/docas-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create the admin options page
	 *
	 * @since    1.0.0
	 */
	public function docas_options_page() {
		add_options_page(
			'DoCAS instillinger',  							// Page title
			'DoCAS instillinger', 							// Menu item title
			'manage_options', 									// Capabillity
			'docas_menu', 											// Menu page slug
			'docas_load_admin_markup'						// Callback function
  	);
		
		// Display the markup 
		function docas_load_admin_markup() {
			include_once( plugin_dir_url( __FILE__ ) . 'partials/docas-admin-display.php' );
		}
	}
	

	/**
	 * Register group- & setting-names and allocate memory for the variables
	 *
	 * @since    1.0.0
	 */
	public function docas_register_settings() {
		register_setting( 'docas-user-settings-group', 'docas-vendor-id' );
		register_setting( 'docas-user-settings-group', 'docas-read-only-api-key' );
		register_setting( 'docas-user-settings-group', 'docas-api-key' );
		register_setting( 'docas-user-settings-group', 'docas-api-url' );
	}

}

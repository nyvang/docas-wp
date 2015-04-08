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
 * The admin-specific DoCAS functionality.
 *
 * Defines the plugin name, version, and admin-specific stylesheet and JavaScript.
 * It is also responsible for defining the user settings such as the DoCAS API keys,
 * and loading the admin menu markup.
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
	 * @var      string    $plugin_name    The ID of this DoCAS plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this DoCAS plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name     The name of this plugin.
	 * @param    string    $version    			The plugin version.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/docas-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/docas-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Register group- & setting-names and allocate memory for the variables
	 *
	 * @since    1.0.0
	 */
	public function docas_register_settings() {
		register_setting( 'docas-user-settings-group', 'docas_vendor_id' );
		register_setting( 'docas-user-settings-group', 'docas_read_only_api_key' );
		register_setting( 'docas-user-settings-group', 'docas_api_key' );
	}

	/**
	 * Create the admin options page
	 *
	 * @since    1.0.0
	 */
	public function docas_register_options_page() {
		add_options_page( 'DoCAS','DoCAS Settings','manage_options','docas_menu', array( $this, 'docas_display_markup' ) );
	}

	/**
	 * Defining the markup of the admin options page
	 * with the different settings
	 *
	 * @since    1.0.0
	 */
	function docas_display_markup() {?>  
    <div class='wrap'>
      <h2>DoCAS settings</h2>
      <p>Enter the API keys of your DoCAS account</p>
      <br />
      <small>Hint: All key formats is xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx</small>
      <hr />
      <form method='post' action='options.php'>
        <?php settings_fields( 'docas-user-settings-group' ); ?>
        <?php do_settings_sections( 'docas-user-settings-group' ); ?>
        
        <table class='form-table'>
	        <tr valign='top'>
		        <th scope='row'>Vendor ID</th>
		        <td>
		        	<input type='text' name='docas_vendor_id' class="docas-input" placeholder="Required" value='<?php echo get_option('docas_vendor_id'); ?>' />
	        	</td>
	        </tr>
	         
	        <tr valign='top'>
		        <th scope='row'>Read Only API Key</th>
		        <td>
		        	<input type='text' name='docas_read_only_api_key' class="docas-input" placeholder="Required" value='<?php echo get_option('docas_read_only_api_key'); ?>' />
	        	</td>
	        </tr>
	        
	        <tr valign='top'>
		        <th scope='row'>API Key</th>
		        <td>
		        	<input type='text' name='docas_api_key' class="docas-input" placeholder="Required" value='<?php echo get_option('docas_api_key'); ?>' />
		        </td>
	        </tr>
	      </table>
        <?php submit_button(); ?>
      </form>
    </div>
 <?php }
}

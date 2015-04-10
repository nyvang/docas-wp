<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://ccnn.dk
 * @since      1.0.0
 *
 * @package    Docas
 * @subpackage Docas/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Docas
 * @subpackage Docas/public
 * @author     Nicolaj Nyvang <nyvang@ccnn.dk>
 */
class Docas_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    	The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name     The name of the plugin.
	 * @param    string    $version    			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/docas-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/docas-public.js', array( 'jquery' ), $this->version, false );
	}



	/**
	 * The [docas_list_all] shortcode is responsible for fetching any data type where all results are needed.
	 * 	 * Available datatypes: Vendor, Courses, Instructors, Locations, Activitylists, 
	 *													Basket (ordering), Coursemodels, Courselists
	 *
	 * @since    1.0.1
	 * @param    array    $atts    			The datatype to request, and the id of the div container. 		default: courses
	 * @return 	 string   (HTML + JS)   The shortcode output - i.e. the data from the DoCAS server
	 */
	public function docas_list_all_shortcode( $atts, $content = null) {

		// Attributes
		$a = shortcode_atts( array(
				'name' => 'instructors'
			), $atts );

		$data_type = esc_attr($a['name']);
		$vendor_id = get_option('docas_vendor_id');
		$read_only_api_key = get_option('docas_read_only_api_key');

		$content = 
		'<script>
				jQuery(document).ready(function () {
				  jQuery.getJSON("http://docas.dk/api/' . $data_type . '/' . $vendor_id . '/' . $read_only_api_key . '?callback=?", function (result) {
					  var data = [];
					  for (i=0; i < result.length; i++) { 
							data = result[i];
					  	jQuery("#' . $data_type . '").append( "<tr>" );
					  	jQuery.each(data, function ( index, value ) {
					  		jQuery("#' . $data_type . '").append( "<td>" + value + "</td>" );
					  	});
							jQuery("#' . $data_type . '").append( "</tr>" );		  
					  }
					});
				});
		</script>';
		
	return '<div class="DocasDataList" id="' . $data_type . '"></div>' . $content;
	}
}


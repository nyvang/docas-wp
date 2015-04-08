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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
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

		
		// Add Shortcode
	function docas_shortcode( ) {

		// Code
		// Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}				
	  // get_option('docas_url') .'/'. get_option('vendor_id').'/'. get_option('read-only-api-key')
	  $json = file_get_contents('http://docas.dk/api/courses/56e7c52f-32c8-4f6b-9ae8-4da7463ab2cd/49307ff0-edf4-48c1-b7a0-a45000e9df5f');
	  return json_decode($json);
	}

	// TODO: Use wordpress´ built in JSON support instead
	/* EXAMPLE
	 * // accept incoming POST data, assumed to be in JSON notation
	 * $input = file_get_contents('php://input', 1000000);
	 * $value = $json->decode($input);
	 */

	// Add Shortcode
 	function test_shortcode( ) {

		// Code
		// Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}				
	  // get_option('docas_url') .'/'. get_option('vendor_id').'/'. get_option('read-only-api-key')
	 
	  return "Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}";
	}


		
	function get_all_courses() {
		return '<script>
		jQuery.noConflict();
			jQuery(document).ready(function () {
				jQuery.getJSON("http://docas.dk/api/courses/56e7c52f-32c8-4f6b-9ae8-4da7463ab2cd/49307ff0-edf4-48c1-b7a0-a45000e9df5f?callback=?", function (result) {
				for (var i = 0; i < result.length; i++) {
				  var navn = "<td>" + result[i].name + "</td>";
				  var start = "<td>" + result[i].start + "</td>";
				  var slut = "<td>" + result[i].end + "</td>";
				  var underviser = "<td>" + result[i].instructorName + "</td>";
				  var sted = "<td>" + result[i].locationName + "</td>";
				  var lokale = "<td>" + result[i].locationRoom + "</td>";
				  var pris = "<td>" + result[i].price + "</td>";
				  var pladser = "<td>" + result[i].maxParticipants + "</td>";
				  jQuery("#allCourses").append("<tr>" + navn + start + slut + underviser + sted + lokale + pris
				      + pladser + "</tr>");
				}
				});
      });
		</script>';
	}

}

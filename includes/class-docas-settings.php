<?php 

		

// Add Shortcode
	function docas_shortcode( ) {

		// Code
		// Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}				
	  // get_option('docas_url') .'/'. get_option('vendor_id').'/'. get_option('read-only-api-key')
	  $json = file_get_contents('http://docas.dk/api/courses/56e7c52f-32c8-4f6b-9ae8-4da7463ab2cd/49307ff0-edf4-48c1-b7a0-a45000e9df5f');
	  return json_decode($json);
	}

	


	// Add Shortcode
 function test_shortcode( ) {

		// Code
		// Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}				
	  // get_option('docas_url') .'/'. get_option('vendor_id').'/'. get_option('read-only-api-key')
	 
	  return "Pattern: docas.dk/api/courses/{Read-Only API Key}/{Vendor ID}";
	}


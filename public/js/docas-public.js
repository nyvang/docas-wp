(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

	$(function() {
			if (jQuery('body').hasClass('page-id-330')) { 
				//getDoCASdata();
			};
	});

	function getDoCASdata () {
		$.getJSON("http://docas.dk/api/courses/56e7c52f-32c8-4f6b-9ae8-4da7463ab2cd/49307ff0-edf4-48c1-b7a0-a45000e9df5f?callback=?", function (result) {          
	      for (var i = 0; i < result.length; i++) {
	          var name = "<td>" + result[i].name + "</td>";
	          var start = "<td>" + result[i].start + "</td>";
	          var slut = "<td>" + result[i].end + "</td>";
	          var underviser = "<td>" + result[i].instructorName + "</td>";
	          var sted = "<td>" + result[i].locationName + "</td>";
	          var lokale = "<td>" + result[i].locationRoom + "</td>";
	          var pris = "<td>" + result[i].price + "</td>";
	          var pladser = "<td>" + result[i].maxParticipants + "</td>";
	          $("#allCourses").append("<tr>" + name + start + slut + underviser + sted + lokale + pris + pladser + "</tr>");
	      }
	  });
	}

})( jQuery );

jQuery(document).ready(function($) {

	// Dynamically show/hide achievement meta inputs based on "Award By" selection
	$("#_badgeos_earned_by").change( function() {

		// Define our potentially unnecessary inputs
		var badgeos_sequential = $('#_badgeos_sequential').parent().parent();
		var badgeos_points_required = $('#_badgeos_points_required').parent().parent();

		// // Hide our potentially unnecessary inputs
		badgeos_sequential.hide();
		badgeos_points_required.hide();

		// Determine which inputs we should show
		if ( 'triggers' == $(this).val() )
			badgeos_sequential.show();
		else if ( 'points' == $(this).val() )
			badgeos_points_required.show();

	}).change();

	$('[href="#show-api-key"]').click( function(event) {
		event.preventDefault();
		$('#credly-settings tr, #credly-settings .toggle').toggle();
	});

	// Throw a warning on Achievement Type editor if title is > 20 characters
	$('#titlewrap').on( 'keyup', 'input[name=post_title]', function() {

		// Make sure we're editing an achievement type
		if ( 'achievement-type' == $('#post_type').val() ) {
			// Cache the title input selector
			var $title = $(this);
			if ( $title.val().length > 20 ) {
				// Set input to look like danger
				$title.css({'background':'#faa', 'color':'#a00', 'border-color':'#a55' });

				// Output a custom warning (and delete any existing version of that warning)
				$('#title-warning').remove();
				$title.parent().append('<p id="title-warning">Achievement Type supports a maximum of 20 characters. Please choose a shorter title.</p>');
			} else {
				// Set the input to standard style, hide our custom warning
				$title.css({'background':'#fff', 'color':'#333', 'border-color':'#DFDFDF'});
				$('#title-warning').remove();
			}
		}
	} );

	// Listen for Credly Badge Builder events
	window.addEventListener( 'message', function(e) {
		// Only continue if data is from credly.com
		if ( "https://credly.com" === e.origin && "object" === typeof( data = e.data ) ) {
			var win = window.dialogArguments || opener || parent || top;

			// Remove the badge builder thickbox
			tb_remove();

			win.WPSetThumbnailHTML('<p>Updating featured image, please wait...</p>');

			// Send the badge data along for uploading
			$.ajax({
				url: ajaxurl,
				data: {
					'action':     'credly-save-badge',
					'post_id':    $('#post_ID').val(),
					'image':      e.data.image,
					'icon_meta':  e.data.iconMetadata,
					'badge_meta': e.data.packagedData,
					'all_data':   e.data
				},
				dataType: 'json',
				success: function( response ) {
					console.log( response );

					// Update the featured image metabox
					win.WPSetThumbnailHTML(response.data.metabox_html);

				}
			});
		}
	});

	// Force ThickBox to be our specified width/height
	$('.badge-builder-link').on( 'click', function() {
		var $link = $(this);
		setTimeout( function() {

			var width  = $link.attr('data-width');
			var height = $link.attr('data-height');

			console.log( 'width: ' + width + ' height: ' + height );

			$('#TB_window').css({ 'marginLeft': -(width / 2) });
			$('#TB_window, #TB_iframeContent').width(width).height(height);

		}, 0 );
	});

});

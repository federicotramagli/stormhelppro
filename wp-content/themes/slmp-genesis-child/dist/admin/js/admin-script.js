jQuery(document).ready(function() {

	jQuery('div#acf-slmp_custom_shortcode .acf-repeater .remove').each(function() {

		let del = jQuery(this).find('.-minus');

		jQuery(del).click(function() {
			return confirm("This fields will permanently deleted! Click OK and 'remove'");
		});
	});
});
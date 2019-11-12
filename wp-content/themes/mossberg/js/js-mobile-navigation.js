function toggle_navigation(div_id) {
	jQuery('#'+div_id).slideToggle('fast');
}

jQuery(document).ready(function() {
	jQuery('a:first','.header_navigation_mobile_primary').attr('href','javascript:void(0)');
	jQuery('.header_navigation_mobile_primary').on('click', function() {
		jQuery('ul',this).slideToggle('fast');
	});
});  

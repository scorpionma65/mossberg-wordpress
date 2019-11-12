// Cookie Display
jQuery(document).ready(function(){
	if(document.cookie.indexOf('cookie-accept') > 0) {
		jQuery('#cookie-policy').hide();
	}
});

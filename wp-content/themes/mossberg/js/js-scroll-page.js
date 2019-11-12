function scroll_page(element){
    var scroll_anchor = jQuery('#'+ element +'');
	var scroll_position = scroll_anchor.offset().top;
    jQuery('html,body').animate({scrollTop: scroll_position},'slow');
}
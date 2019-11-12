function switch_type(element) {
	jQuery('.flex_menu_nav li').removeClass('flex_menu_nav_active');
	jQuery('.flex_parts_container').hide();
	jQuery('#tab-'+element).addClass('flex_menu_nav_active');
	jQuery('#parts-'+element).show();
}
function switch_part(part_id, part_image, part_type, part_lop, xpos, ypos) {
	jQuery('#slider-'+part_type+' .flex_parts_slider_tile').removeClass('flex_parts_slider_tile_active');
	jQuery('#tile-'+part_id).addClass('flex_parts_slider_tile_active');
	jQuery('#field-'+part_type).val(part_id);
	jQuery('#'+part_type).css('background-image', 'url('+part_image+')').css('background-position-x', xpos+'px').css('background-position-y', ypos+'px');
	if(part_type == 'stock'){
		set_recoil_pad(part_lop);
	}
	set_query();
}
function set_recoil_pad(lop) {
	var default_id = '23144';
	var default_image = 'http://www.mossberg.com/wp-content/uploads/2017/10/flex-configurator-95211-recoil-pad.png';
	jQuery('#slider-container-recoil-pad').css('display', 'inline-block');
	jQuery('#slider-note-recoil-pad').css('display', 'none');
	jQuery('#slider-no-recoil-pad').css('display', 'none');
	jQuery('#recoil-pad').removeClass('flex_model_lop_a');
	jQuery('#recoil-pad').removeClass('flex_model_lop_b');
	jQuery('#recoil-pad').removeClass('flex_model_lop_c');
	if(lop == '12.5') {
		jQuery('#recoil-pad').removeClass('flex_model_lop_d');
		jQuery('#recoil-pad').addClass('flex_model_lop_a');
	}
	if(lop == '13.5') {
		jQuery('#recoil-pad').removeClass('flex_model_lop_d');
		jQuery('#recoil-pad').addClass('flex_model_lop_b');
	}
	if(lop == '14.25') {
		jQuery('#recoil-pad').removeClass('flex_model_lop_d');
		jQuery('#recoil-pad').addClass('flex_model_lop_c');
	}	
	if(lop == 'N') {
		jQuery('#recoil-pad').addClass('flex_model_lop_d');
		jQuery('#slider-container-recoil-pad').css('display', 'none');
		jQuery('#slider-note-recoil-pad').css('display', 'none');
		jQuery('#slider-no-recoil-pad').css('display', 'inline-block');
	}
	if(!jQuery('#slider-recoil-pad .flex_parts_slider_tile').hasClass('flex_parts_slider_tile_active')) {
		switch_part(default_id, default_image, 'recoil-pad', '');
	}
}
function set_query() {
	var model = jQuery('#field-model').val();
	var barrel = jQuery('#field-barrel').val();
	var forend = jQuery('#field-forend').val();
	var stock = jQuery('#field-stock').val();
	var recoil = jQuery('#field-recoil-pad').val();
	var query = '?model='+model+'&barrel='+barrel+'&forend='+forend+'&stock='+stock+'&recoil='+recoil;
	jQuery('#flex-email-desktop').attr('href', 'http://www.mossberg.com/flex-email'+query);
	jQuery('#flex-cart-desktop').attr('href', 'http://www.mossberg.com/flex-cart'+query);
	jQuery('#flex-email-mobile').attr('href', 'http://www.mossberg.com/flex-email'+query);
	jQuery('#flex-cart-mobile').attr('href', 'http://www.mossberg.com/flex-cart'+query);
	Shadowbox.clearCache();
	Shadowbox.setup();
	Shadowbox.init();
}
function slide_prev(element,width) {
	jQuery('#'+element).animate({"left": '+='+width},{"easing": "swing"});
	slide_set_nav(element,'prev');	
}
function slide_next(element,width) {
	jQuery('#'+element).animate({"left": '-='+width},{"easing": "swing"});
	slide_set_nav(element,'next');	
}
function slide_set_nav(element,direction) {
	var total = jQuery('#'+element+'-total').val();
	var current = jQuery('#'+element+'-current').val();
	if(total == 0) {
		jQuery('#'+element+'-next').hide();
		jQuery('#'+element+'-prev').hide();
		} else {
		if(direction == 'next') {
			current++;
			jQuery('#'+element+'-current').val(current);
			jQuery('#'+element+'-prev').attr('onclick',"slide_prev('"+element+"','900')");
			jQuery('#'+element+'-prev').removeClass('flex_parts_end');
			current++;
			if(total == current) {
				jQuery('#'+element+'-next').attr('onclick','');
				jQuery('#'+element+'-next').addClass('flex_parts_end');
			}
		}
		if(direction == 'prev') {
			current--;
			jQuery('#'+element+'-current').val(current);
			jQuery('#'+element+'-next').attr('onclick',"slide_next('"+element+"','900')");
			jQuery('#'+element+'-next').removeClass('flex_parts_end');
			if(0 == current) {
				jQuery('#'+element+'-prev').attr('onclick','');
				jQuery('#'+element+'-prev').addClass('flex_parts_end');
			}
		}
	}	
}
function switch_form() {
	jQuery(".flex_cart_login").toggle();
	jQuery(".flex_cart_register").toggle();
}
function edit_pos() {
	var xpos = jQuery('#xpos').val();
	var ypos = jQuery('#ypos').val();
	jQuery('#barrel').css('background-position-x', xpos+'px').css('background-position-y', ypos+'px');
}
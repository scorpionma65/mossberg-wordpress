function highlight_activate(element) {
	jQuery('#partimg'+element).removeClass('schematic_image_inactive');
	jQuery('#partmark'+element).addClass('schematic_marker_active');
	jQuery('#partlist'+element).addClass('schematic_list_option_active');
	jQuery('#partecomm'+element).addClass('schematic_list_ecomm_active');
}
function highlight_deactivate(element) {
	jQuery('#partimg'+element).addClass('schematic_image_inactive');
	jQuery('#partmark'+element).removeClass('schematic_marker_active');
	jQuery('#partlist'+element).removeClass('schematic_list_option_active');
	jQuery('#partecomm'+element).removeClass('schematic_list_ecomm_active');
}
function ecomm_activate(element) {
	if(jQuery('#partecomm'+element).css('display') == 'block') {
		jQuery('#partecomm'+element).slideToggle();
		jQuery('#particon'+element).removeClass('schematic_list_icon_active');
		} else {
		jQuery('#particon'+element).addClass('schematic_list_icon_active');
		jQuery('#partecomm'+element).slideToggle();
	}
}
function ecomm_refocus(element) {
	refocus = jQuery('#partlist_container').scrollTop() + jQuery('#partlist'+element).position().top - 85;
	jQuery('#partlist_container').animate({scrollTop: refocus},'slow', function() {
		if(jQuery('#partecomm'+element).css('display') != 'block') {
			ecomm_activate(element);
		}
	})
}
function set_cookie(name, value, expires) {
	if(name) {
		if(!expires) {
			var expires = '';
		}
		document.cookie = name+"="+value+expires+"; path=/";
		jQuery('#'+name).fadeIn().show();
		jQuery('#select'+value).hide();
		jQuery('#selected'+value).show();
		var sku_list = jQuery('#sku_list').val();
		if(!sku_list) {
			jQuery('#sku_list').val(value);
			} else {
			var skus = sku_list.split(',');
			if(jQuery.inArray(value, skus) == -1 ) {
				skus.push(value);
				var new_list = skus.join();
				jQuery('#sku_list').val(new_list);
			}
		}
		set_message();
	}
}
function delete_cookie(name) {
	document.cookie = name +'=; path=/; expires=-1;';
	jQuery('#'+name).fadeOut().hide();
	var value = name.substring(3);
	jQuery('#select'+value).show();
	jQuery('#selected'+value).hide();
	var sku_list = jQuery('#sku_list').val();
	var skus = sku_list.split(',');
	var key = skus.indexOf(value);
	if(key > -1) {
		skus.splice(key, 1);
		var new_list = skus.join();
		jQuery('#sku_list').val(new_list);
	}
}
function read_cookie(name) {
	var cookie_value = null;
    var cookie_name = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(cookie_name) == 0) {
			var cookie_value = c.substring(cookie_name.length,c.length);
		}
    }
    return cookie_value;
}
function clear_selected() {
	var sku_list = jQuery('#sku_list').val();
	if(sku_list) {
		var skus = sku_list.split(',');
		for(var i=0;i < skus.length;i++) {
			delete_cookie('sku'+skus[i]);
		}
	}
	jQuery('#sku_list').val('');
	set_message();
}
function preset_selected() {
	var list = jQuery('#sku_list').val();
	var skus = list.split(',');
	for(i = 0; i < skus.length; i++) {
		var sku_id = 'sku'+skus[i];
		var sku_cookie = read_cookie(sku_id);
		if(sku_cookie) {
			jQuery('#'+sku_id).fadeToggle();
			jQuery('#select'+skus[i]).hide();
			jQuery('#selected'+skus[i]).show();
			set_message();
		}
	}
}
function set_message() {
	jQuery('#selected_message').html('View and purchase selected parts.');
}
function set_list_height() {
	if(jQuery(window).width() > 768) {
		jQuery('#partlist_container').height(jQuery('#image_container').outerHeight(false));
		} else {
		jQuery('#partlist_container').height('auto');
	}
}
function preload_images() {
	var image_list = jQuery('#part_images').val();
	var image_array = image_list.split(',');
	jQuery.each(image_array, function(index, value){
        image_array[index] = new Image();
		image_array[index].src = value;
    });
}
function scroll_selected(element){	
	var window_height = window.innerHeight;
    var scroll_anchor = jQuery('#'+element);
	var scroll_position = (scroll_anchor.offset().top) + window_height;
    jQuery('html,body').animate({scrollTop: scroll_position},'slow');
}
function scroll_top(){	
	jQuery('html,body').animate({scrollTop: '0px'},'slow');
}
function zoom_level(level) {
	jQuery('#zoom_one').removeClass('schematic_zoom_active');
	jQuery('#zoom_two').removeClass('schematic_zoom_active');
	jQuery('#zoom_three').removeClass('schematic_zoom_active');
	if(level == '1') {
		jQuery('#zoom_one').addClass('schematic_zoom_active');
		jQuery('#image_zoom').attr('class', 'schematic_zoom_one');
		jQuery('#image_container').addClass('schematic_image_container_zoom');
		jQuery('#image_zoom').css({top:'0', left:'0', width:'100%', height:'100%'});
		jQuery('#image_zoom').draggable();
		jQuery('#image_zoom').draggable('destroy');
	}
	if(level == '2') {
		jQuery('#zoom_two').addClass('schematic_zoom_active');
		jQuery('#image_zoom').attr('class', 'schematic_zoom_two');
		jQuery('#image_container').addClass('schematic_image_container_zoom');
		jQuery('#image_zoom').css({top:'0', left:'0', width:'1200px', height:'1200px'});
		jQuery('#image_zoom').draggable({cursor:'move'});
	}
	if(level == '3') {
		jQuery('#zoom_three').addClass('schematic_zoom_active');
		jQuery('#image_zoom').attr('class', 'schematic_zoom_three');
		jQuery('#image_container').addClass('schematic_image_container_zoom');
		jQuery('#image_zoom').css({top:'0', left:'0', width:'1600px', height:'1600px'});
		jQuery('#image_zoom').draggable({cursor:'move'});
	}
}
function switch_form() {
	jQuery(".schematic_cart_login").toggle();
	jQuery(".schematic_cart_register").toggle();
}
function switch_caliber() {
	if(jQuery('#caliber').length) {
		var caliber = jQuery('#caliber').val();
		if(caliber != '') {
			jQuery("#partlist_container > .schematic_list_ecomm > input").each(function() {
				var caliber_id = jQuery(this).attr("id");
				var caliber_val = jQuery(this).val();
				var calibers = caliber_val.split(","); 
				var ecomm_id = caliber_id.replace("caliber", "ecomm");
				if(jQuery.inArray(caliber, calibers) === -1) {
					jQuery('#'+ecomm_id).fadeOut();
					} else {
					jQuery('#'+ecomm_id).fadeIn();
				}
			});
			} else {
			jQuery("#partlist_container > .schematic_list_ecomm > input").each(function() {
				var caliber_id = jQuery(this).attr("id");
				var ecomm_id = caliber_id.replace("caliber", "ecomm");
				jQuery('#'+ecomm_id).fadeIn();
			});
		}
	}
}

jQuery(document).ready(function() {
	preset_selected();
	set_list_height();
	switch_caliber();
});
jQuery(window).on('resize', function(){
	set_list_height();
});

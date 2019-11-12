// Start
jQuery(document).ready(function(){
	// Config Slides
	slider = slide_config();
	if(slider['autoplay']) {
		var duration = 6000;
		if(slider['duration']) {
			var duration = slider['duration'];
		}
		var interval = setInterval(function(){slide_autoplay()}, duration);
		jQuery('#slide_interval').val(interval);
	}
});

// Reset Timer
function slide_timer() {
	// Config Slides
	slider = slide_config();
	var interval = jQuery('#slide_interval').val();
	clearInterval(interval);
	var duration = 6000;
	if(slider['duration']) {
		var duration = slider['duration'];
	}
	var interval = setInterval(function(){slide_autoplay()}, duration);
	jQuery('#slide_interval').val(interval);
}

// Change Auto
function slide_autoplay() {
	var current_slide = jQuery('#slide_current').val();
	var total_slides = jQuery('#slide_total').val();
	if(total_slides > 1) {
		if(current_slide == total_slides) {
			var next_slide = 1;
			} else {
			var next_slide = Number(current_slide) + 1;
		}
		slide_change(next_slide);
		// Change Button
		slide_change_button(next_slide);
	}
} 

// Change Next
function slide_next(interval) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Current Slide
	var current_slide = jQuery('#slide_current').val();
	// Slide Next
	if(current_slide == total_slides) {
		var slide_id = 1;
		} else {
		var slide_id = Number(current_slide) + 1;
	}
	// Transition Speed
	var transition_speed = 1000;
	if(slider['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Transition Effect
	switch(slider['transition_effect']) {
		case 'fade':
		slide_fade(slide_id);
		break;		
		case 'horizontal':
		slide_left(slide_id);
		break;		
		default:
		slide_fade(slide_id);
	}
	// Reset Timer
	slide_timer();	
}

// Change Previous
function slide_prev(interval) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Current Slide
	var current_slide = jQuery('#slide_current').val();
	// Slide Next
	if(current_slide == 1) {
		var slide_id = total_slides;
		} else {
		var slide_id = Number(current_slide) - 1;
	}
	// Transition Speed
	var transition_speed = 1000;
	if(slider['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Transition Effect
	switch(slider['transition_effect']) {
		case 'fade':
		slide_fade(slide_id);
		break;		
		case 'horizontal':
		slide_right(slide_id);
		break;		
		default:
		slide_fade(slide_id);
	}
	// Reset Timer
	slide_timer();	
}

// Change Jump
function slide_change(slide_id) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Transition Speed
	var transition_speed = 1000;
	if(slide_config['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Transition Effect
	switch(slider['transition_effect']) {
		case 'fade':
		slide_fade(slide_id);
		break;		
		case 'horizontal':
		slide_left(slide_id);
		break;		
		default:
		slide_fade(slide_id);
	}
	// Reset Timer
	slide_timer();
}

// Change Button
function slide_change_button(slide_id) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Inactive Button
	var button_class = 'slide_navigation_button';
	// Active Button
	var button_class_active = 'slide_navigation_button slide_navigation_button_active';
	// Reset Buttons
	for (i=1; i<=total_slides; i++) {
		jQuery('#slide_button'+i).attr('class', button_class);
	}
	// Activate Button
	jQuery('#slide_button'+slide_id).attr('class', button_class_active);
}

// Left Slide
function slide_left(slide_id) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Current Slide
	var current_slide = jQuery('#slide_current').val();
	// Transition Speed
	var transition_speed = 1000;
	if(slider['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Change Slide
	jQuery('#slide'+current_slide).animate({"left": '-=100%'},{"easing": "swing"});
	jQuery('#slide'+slide_id).css('left', '100%');
	jQuery('#slide'+slide_id).css('display', 'block');
	jQuery('#slide'+slide_id).animate({"left": '-=100%'},{"easing": "swing"});
	jQuery('#slide_current').val(slide_id);
	// Change Button
	slide_change_button(slide_id);
	// Video	
	var video = jQuery('#slide'+slide_id+' video:first-child');
	var video_id = video.attr('id');
	var video_class = video.attr('class');
	slide_video_play(video_id, video_class);
}

// Right Slide
function slide_right(slide_id) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Current Slide
	var current_slide = jQuery('#slide_current').val();
	// Transition Speed
	var transition_speed = 1000;
	if(slider['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Change Slide
	jQuery('#slide'+current_slide).animate({"left": '+=100%'},{"easing": "swing"});
	jQuery('#slide'+slide_id).css('left', '-100%');
	jQuery('#slide'+slide_id).css('display', 'block');
	jQuery('#slide'+slide_id).animate({"left": '+=100%'},{"easing": "swing"});
	jQuery('#slide_current').val(slide_id);
	// Change Button
	slide_change_button(slide_id);
	// Video	
	var video = jQuery('#slide'+slide_id+' video:first-child');
	var video_id = video.attr('id');
	var video_class = video.attr('class');
	slide_video_play(video_id, video_class);
}

// Fade Slide
function slide_fade(slide_id) {
	// Config Slides
	slider = slide_config();
	// Total Slides
	var total_slides = jQuery('#slide_total').val();
	// Transition Speed
	var transition_speed = 1000;
	if(slider['transition_speed']) {
		var transition_speed = slider['transition_speed'];
	}
	// Change Slide
	for (i=1; i<=total_slides; i++) { 
		jQuery('#slide'+i).fadeOut(transition_speed,'linear');
	}
	jQuery('#slide'+slide_id).css('left', '0');
	jQuery('#slide'+slide_id).fadeIn(transition_speed,'linear');
	jQuery('#slide_current').val(slide_id);
	// Change Button
	slide_change_button(slide_id);	
	// Video	
	var video = jQuery('#slide'+slide_id+' video:first-child');
	var video_id = video.attr('id');
	var video_class = video.attr('class');
	slide_video_play(video_id, video_class);
}

// Video Play 
function slide_video_play(video_id, video_class) {
	slide_videos_stop(video_class);
	document.getElementById(video_id).play(); 
}

// Video Stop
function slide_videos_stop(video_class){
	var sliders = document.getElementsByClassName(video_class);
	var i;
	for (i = 0; i < sliders.length; i++) {
		sliders[i].pause(); 
		sliders[i].currentTime = 0;
	}
}


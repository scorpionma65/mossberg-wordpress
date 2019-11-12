<script>
// Config Slider
function slide_config() {
	var slider = {
		duration:'15000',
		transition_effect:'horizontal',
		transition_speed:'1000',
		autoplay:true
	};
	return slider;
}
</script>
<?php
// Gallery Images
$args = array('post_type'=>'video-slider','orderby'=>'date','order'=>'asc');
query_posts($args);
$slide_images = NULL;
$slide_buttons = NULL;
$count = 1;
$total = $wp_query->post_count;
while(have_posts()):the_post();
	$slide_id = $post->ID;
	$slide_title = $post->post_title;
	$slide_content = wpautop($post->post_content);
	$slide_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$slide_image = $slide_image[0]; 
	$slide_link = get_post_meta($post->ID, 'wpcf-slider-link', true);
	$slide_video_mp4 = get_post_meta($post->ID, 'wpcf-slider-video-mp4', true);
	$slide_video_webm = get_post_meta($post->ID, 'wpcf-slider-video-webm', true);
	$slide_video_ogv = get_post_meta($post->ID, 'wpcf-slider-video-ogv', true);
	// Video
	$slide_video = NULL;
	$slide_video_play = NULL;
	if($count == 1) {
		$autoplay = "autoplay=\"autoplay\"";
		} else {
		$autoplay = NULL;
	}
	if($slide_video_mp4 && $slide_video_webm && $slide_video_ogv) {
		$slide_video = "<video class=\"slide_video_player\" $autoplay id=\"slide_video_player_{$slide_id}\" muted=\"muted\" onended=\"slide_next()\">
		<source src=\"$slide_video_mp4\" type=\"video/mp4\">
		<source src=\"$slide_video_webm\" type=\"video/webm\">
		<source src=\"$slide_video_ogv\" type=\"video/ogg\">
		</video>";
		$slide_video_play = "slide_video_play('slide_video_player_{$slide_id}','slide_video_player');";
	}
    // First Slide
	if($count == 1) {
		$slide_display = "slide_show";
		} else {
		$slide_display = "slide_hide";
	}
	// First Button
	if($count == 1) {
		$button_display = "slide_navigation_button_active";
		} else {
		$button_display = NULL;
	}
	// Image
	if($slide_video) {
		//$slide_image = NULL;
	}
	// Panels
	if($slide_link) {
		$slide_images .= "<a href=\"$slide_link\" id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\">$slide_video</a>";
		} else {
		$slide_images .= "<div id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\">$slide_video</div>";
	}
	// Navigation
	$slide_buttons .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count'); $slide_video_play\"><div class=\"slide_navigation_text\"><h3>$slide_title</h3>$slide_content</div></div>";	
	$slide_buttons_mobile .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count'); $slide_video_play\"></div>";
	$count++;
endwhile;
wp_reset_query();
?>
<div class="slide_container">
<div class="slide_prev" onclick="slide_prev()"></div>
<div class="slide_next" onclick="slide_next()"></div>
<?php echo $slide_images;?>
</div>
<div class="slide_navigation">
<?php echo $slide_buttons;?>
</div>
<input id="slide_current" name="slide_current" type="hidden" value="1" />
<input id="slide_total" name="slide_total" type="hidden" value="<?php echo $total;?>" />
<input id="slide_interval" name="slide_interval" type="hidden" value="" />

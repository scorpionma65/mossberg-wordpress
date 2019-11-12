<script>
// Config Slider
function slide_config() {
	var slider = {
		duration:'8000',
		transition_effect:'horizontal',
		transition_speed:'1000',
		autoplay:true
	};
	return slider;
} 
</script>
<?php
// Gallery Images
$cat_slug = 'home-slider-new';
$args = array('category_name'=>$cat_slug,'orderby'=>'date','order'=>'asc');
query_posts($args);
$slide_images = NULL;
$slide_buttons = NULL;
$count = 1;
$total = $wp_query->post_count;
while(have_posts()):the_post();
	$slide_title = $post->post_title;
	$slide_content = wpautop($post->post_content);
	$slide_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$slide_image = $slide_image[0]; 
	$slide_link = get_post_meta($post->ID, 'Slider Link', true);
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
	// Panels
	if($slide_link) {
		$slide_images .= "<a href=\"$slide_link\" id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></a>";
		} else {
		$slide_images .= "<div id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></div>";
	}
	// Navigation
	$slide_buttons .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count')\"><div class=\"slide_navigation_text\"><h3>$slide_title</h3>$slide_content</div></div>";	
	$slide_buttons_mobile .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count')\"></div>";
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

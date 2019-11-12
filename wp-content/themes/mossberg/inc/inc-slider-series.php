<script>
// Config Slider
function slide_config() {
	var slider = {
		duration:'8000',
		transition_effect:'fade',
		transition_speed:'1000',
		autoplay:true
	};
	return slider;
} 
</script>
<?php
if(!$cat_slug) { 
	$cat_slug = get_query_var('product_cat');
}
$slider_slug = 'series-slider-'.$cat_slug;

// Slider Post
$args = array('name'=>$slider_slug, 'post_type'=>'post');
$posts = get_posts($args);
if($posts) {
	$slider_post_id = $posts[0]->ID;
	$galleries = get_post_galleries_images($slider_post_id);
	if($galleries) {
		foreach($galleries as $gallery) {
			foreach($gallery as $image) {
				$slider_images[] = $image;
			}
		}
	}
}


// Gallery Images
if($slider_images) {
	$count = 1;
	$total = count($slider_images);
	foreach($slider_images as $slide_image) {
		// Attachment ID
		$attachment_id = get_attachment_id_from_url($slide_image);
		$attachment = get_attachment_data($attachment_id);
		$attachment_link = strip_tags($attachment['description']);
		
		// First Slide
		if($count == 1) {
			$slide_display = "slide_show";
			$button_display = "slide_navigation_button_active";
			} else {
			$slide_display = "slide_hide";
			$button_display = NULL;
		}
		// Panels
		if($attachment_link != NULL) {
			$slide_images .= "<a href=\"$attachment_link\" id=\"slide{$count}\" class=\"slide_fire_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></a>";
			} else {
			$slide_images .= "<div id=\"slide{$count}\" class=\"slide_fire_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></div>";
		}
		// Navigation
		$slide_buttons .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count')\"></div>";
		$count++;
	}
}
?>
<div class="slide_fire_container">
<?php echo $slide_images;?>
</div>
<div class="slide_navigation">
<?php 
if($total > 1) {
	echo $slide_buttons;
}
?>
</div>
<input id="slide_current" name="slide_current" type="hidden" value="1" />
<input id="slide_total" name="slide_total" type="hidden" value="<?php echo $total;?>" />
<input id="slide_interval" name="slide_interval" type="hidden" value="" />

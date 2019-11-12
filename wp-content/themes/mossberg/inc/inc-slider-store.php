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
// Slider Post
$args = array('name'=>'store-slider', 'post_type'=>'post');
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
		$attachment_embed = $attachment['description'];
		
		// First Slide
		if($count == 1) {
			$slide_display = "slide_show";
			} else {
			$slide_display = "slide_hide";
		}
		// Panels
		if($attachment_embed != NULL) {
			if(strpos($attachment_embed,'<script') !== FALSE) {
				$slide_images .= "<div id=\"slide{$count}\" class=\"slide_store_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\">$attachment_embed</div>";
				} else {
				$slide_images .= "<a href=\"$attachment_link\" id=\"slide{$count}\" class=\"slide_store_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></a>";
			}
			} else {
			$slide_images .= "<div id=\"slide{$count}\" class=\"slide_store_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></div>";
		}
		$count++;
	}
}
wp_reset_query();
?>
<div class="slide_store_container">
<?php 
if($total > 1) {
	echo "<div class=\"slide_prev\" onclick=\"slide_prev()\"></div>
	<div class=\"slide_next\" onclick=\"slide_next()\"></div>";
}
?>
<?php echo $slide_images;?>
</div>
<input id="slide_current" name="slide_current" type="hidden" value="1" />
<input id="slide_total" name="slide_total" type="hidden" value="<?php echo $total;?>" />
<input id="slide_interval" name="slide_interval" type="hidden" value="" />

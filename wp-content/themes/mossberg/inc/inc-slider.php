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
$cat_slug = 'home-slider';
$args = array('category_name'=>$cat_slug);
query_posts($args);
$slide_images = NULL;
$slide_captions = NULL;
$count = 1;
$total = $wp_query->post_count;
while(have_posts()):the_post();
	$slide_title = $post->post_title;
	$slide_content = $post->post_content;
	$slide_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$slide_image = $slide_image[0]; 
	$slide_alignment = get_post_meta($post->ID, 'Slider Text Position', true);
	// Alignment
	$slide_description_align = 'slide_description_left';
	if(strtoupper($slide_alignment) == 'R') {
		$slide_description_align = 'slide_description_right';
	}			
    // First Slide
	if($count == 1) {
		$slide_display = "slide_show";
		} else {
		$slide_display = "slide_hide";
	}
	// Panels
	$slide_images .= "<div id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\">
	<div class=\"slide_description $slide_description_align\">
	<div class=\"slide_title\">$slide_title</div>
	<div class=\"slide_text\">$slide_content</div>
	</div>
	</div>";
	$count++;
endwhile;
wp_reset_query();
?>
<div class="slide_container">
<div class="slide_prev" onclick="slide_prev()"></div>
<div class="slide_next" onclick="slide_next()"></div>
<?php echo $slide_images;?>
<div class="slide_down" onclick="scroll_page('feature')"></div>
</div>
<input id="slide_current" name="slide_current" type="hidden" value="1" />
<input id="slide_total" name="slide_total" type="hidden" value="<?php echo $total;?>" />
<input id="slide_interval" name="slide_interval" type="hidden" value="" />

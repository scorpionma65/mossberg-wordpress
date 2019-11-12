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
if(!$cat_slug) {
	$cat_slug = 'duck-slider';
}
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

    // First Slide
	if($count == 1) {
		$slide_display = "slide_show";
		} else {
		$slide_display = "slide_hide";
	}
	// Panels
	$slide_images .= "<div id=\"slide{$count}\" class=\"slide_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\">
	<div class=\"slide_description_ducks\">
	<div class=\"slide_title\">$slide_title</div>
	<div class=\"slide_text\">$slide_content</div>
	</div>
	</div>";
	$count++;
endwhile;
wp_reset_query();
?>
<div class="slide_container">
<?php echo $slide_images;?>
</div>
<input id="slide_current" name="slide_current" type="hidden" value="1" />
<input id="slide_total" name="slide_total" type="hidden" value="<?php echo $total;?>" />
<input id="slide_interval" name="slide_interval" type="hidden" value="" />

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
// Gallery Images
$category = get_category_by_slug($cat_slug); 
$cat_id = $category->term_id;
$args = array('category__in'=>array($cat_id), 'post_parent'=>0);
query_posts($args);
$slide_images = NULL;
$slide_captions = NULL;
$count = 1;
$total = $wp_query->post_count;
while(have_posts()):the_post();
	$slide_title = $post->post_title;
	$slide_content = $post->post_content;
	$slide_link = strip_tags(get_post_meta($post->ID, 'Slider Link', true));
	$slide_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
	$slide_image = $slide_image[0]; 

    // First Slide
	if($count == 1) {
		$slide_display = "slide_show";
		$button_display = "slide_navigation_button_active";
		} else {
		$slide_display = "slide_hide";
		$button_display = NULL;
	}
	// Panels
	if($slide_link != NULL) {
		$slide_images .= "<a href=\"$slide_link\" id=\"slide{$count}\" class=\"slide_fire_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></a>";
		} else {
		$slide_images .= "<div id=\"slide{$count}\" class=\"slide_fire_panel $slide_display\" style=\"background-image:url($slide_image); z-index:$count;\"></div>";
	}
	
	// Navigation
	$slide_buttons .= "<div id=\"slide_button{$count}\" class=\"slide_navigation_button $button_display\" onclick=\"slide_change('$count')\"></div>";
	$count++;
endwhile;
wp_reset_query();
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

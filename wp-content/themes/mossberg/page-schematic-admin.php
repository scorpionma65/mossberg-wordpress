<?php
/*
Template Name: Schematic Admin
*/
?>
<?php get_header(); ?>
<?php 
ini_set('display_errors', '1');
?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-schematic.js"></script>
<script>
function update_coordinates(element) {
	var xpos = jQuery('#xpos'+element).val();
	var ypos = jQuery('#ypos'+element).val();
	jQuery('#partmark'+element).css('left', xpos+"%");
	jQuery('#partmark'+element).css('top', ypos+"%");
}
</script>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-schematic-header.php');?>
<?php
// Update Coordinates
$updates = FALSE;
// Submit
if(isset($_POST['save'])) {
	// Coordinates
	$count = 1;
	query_posts($model_args);
	while(have_posts()):the_post();
		$part_id = $post->ID;
		$part_x_position = get_post_meta($part_id, 'wpcf-part-x-position', true);
		$part_y_position = get_post_meta($part_id, 'wpcf-part-y-position', true);	
		
		$xpos_field = 'xpos'.$part_id;
		$xpos = sanitize_text_field($_POST[$xpos_field]);
		$ypos_field = 'ypos'.$part_id;
		$ypos = sanitize_text_field($_POST[$ypos_field]);
		
		if($xpos != $part_x_position) {
			update_post_meta($part_id, 'wpcf-part-x-position', $xpos);
			$updates .= $count.'X, ';
		}
		if($ypos != $part_y_position) {
			update_post_meta($part_id, 'wpcf-part-y-position', $ypos);
			$updates .= $count.'Y, ';
		}
		$count++;
	endwhile;	
}
if($updates) {
	$updates = substr($updates,0,-2);
	echo "<h4>Marker Coordinates Updated for Part(s) $updates</h4>";
}
?>
<div class="content_eight content_left">
<div class="schematic_title">
<?php echo $model_title;?>
<div class="schematic_zoom">Zoom: 
<span id="zoom_one" class="schematic_zoom_active" onclick="zoom_level('1')">1</span> 
<span id="zoom_two" class="" onclick="zoom_level('2')">2</span> 
<span id="zoom_three" class="" onclick="zoom_level('3')">3</span>
</div>
</div>
<div class="schematic_image_container" id="image_container">
<div class="schematic_zoom_one" id="image_zoom" style="background-image:url(<?php echo $model_assembled;?>);">
<?php
// Images
query_posts($model_args);
$count = 1;
$part_ids = array();
$part_images = array();
while(have_posts()):the_post();
	$part_id = $post->ID;
	$part_title = $post->post_title;
	$part_x_position = get_post_meta($part_id, 'wpcf-part-x-position', true);
	$part_y_position = get_post_meta($part_id, 'wpcf-part-y-position', true);
	$part_image = get_post_meta($part_id, 'wpcf-part-image', true); 
	$part_marker_alignment = get_post_meta($part_id, 'wpcf-part-marker-alignment', true); 
	$part_text_class = 'schematic_marker_text_right';
	if($part_marker_alignment == 'L') {
		$part_text_class = 'schematic_marker_text_left';
	}
	echo "<div class=\"schematic_image schematic_image_inactive\" style=\"background-image:url($part_image); z-index:$count;\" id=\"partimg{$part_id}\"></div>	
	<div class=\"schematic_marker\" id=\"partmark{$part_id}\" style=\"top:{$part_y_position}%; left:{$part_x_position}%;\" onmouseover=\"highlight_activate('$part_id')\" onmouseout=\"highlight_deactivate('$part_id')\" onclick=\"ecomm_refocus('$part_id')\">
	$count
	<div class=\"$part_text_class\">$part_title</div>
	</div>";	
	$part_ids[] = $part_id;	
	$part_images[] = $part_image;	
	$count++;
endwhile;
wp_reset_query();
?>
<input name="part_images" id="part_images" type="hidden" value="<?php echo implode(',',$part_images);?>" />
</div>
</div>
</div>

<div class="content_four content_right">
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" name="markers">
<div class="schematic_list_title">Parts List <input name="save" type="submit" value="Save Coordinates" class="schematic_admin_button"/></div>
<div class="schematic_list_container" id="partlist_container">
<?php
// Parts
$count = 1;
foreach($part_ids as $key => $id) {
	$post = get_post($id);
	$part_id = $post->ID;
	$part_title = $post->post_title;
	$part_content = $post->post_content;
	$part_sku = get_post_meta($part_id, 'wpcf-part-sku', true);
	$part_restricted = get_post_meta($part_id, 'wpcf-part-restricted', true);
	$part_restriction = get_post_meta($part_id, 'wpcf-part-restriction', true);
	$part_note = get_post_meta($part_id, 'wpcf-part-note', true);
	$part_quantity = get_post_meta($part_id, 'wpcf-part-quantity', true);
	$part_diagram_number = get_post_meta($part_id, 'wpcf-part-diagram-number', true);
	$part_x_position = get_post_meta($part_id, 'wpcf-part-x-position', true);
	$part_y_position = get_post_meta($part_id, 'wpcf-part-y-position', true);	
	// List 
	echo "<div class=\"schematic_admin_marker_list\" id=\"partlist{$part_id}\" onmouseover=\"highlight_activate('$part_id')\" onmouseout=\"highlight_deactivate('$part_id')\">
	$count | $part_title<br/>
	X<input name=\"xpos{$part_id}\" id=\"xpos{$part_id}\" type=\"text\" value=\"$part_x_position\" onChange=\"update_coordinates('$part_id')\"/>
	Y<input name=\"ypos{$part_id}\" id=\"ypos{$part_id}\" type=\"text\" value=\"$part_y_position\" onChange=\"update_coordinates('$part_id')\"/>
	</div>";	
	$count++;
}
?>
</div>
</form>
<input type="hidden" id="sku_list" value=""/>
</div>
</div>

</div>
</div>

<?php get_footer(); ?>

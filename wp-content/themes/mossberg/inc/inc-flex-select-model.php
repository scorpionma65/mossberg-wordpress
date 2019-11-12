<?php
// Series
$parent = FALSE;
$parent_id = NULL;
$parent_name = NULL;
if(!empty($_GET['series'])) {
	$series_slug = 'flex-config-'.sanitize_title($_GET['series']);
	$parent = get_term_by('slug',$series_slug,'flex-model');
	if($parent) {
		$parent_id = $parent->term_id;
		$parent_name = $parent->name;
	}
}
// Gauge
$gauge = FALSE;
if(!empty($_GET['gauge'])) {
	$gauge = sanitize_text_field($_GET['gauge']);
}
// Capacity
$capacity = FALSE;
if(!empty($_GET['capacity'])) {
	$capacity = sanitize_text_field($_GET['capacity']);
}
?>

<div class="flex_select_header">SELECT <?php echo $parent_name;?> MODEL<a href="<?php echo get_bloginfo('url');?>/flex-models" rel="shadowbox[models];width=700;height=550;">Don't See Your Model?</a></div>
<div class="flex_select_model_container">

<?php
// Disabled
$disabled = array();

// Models
$args = array('taxonomy'=>'flex-model','hide_empty'=>false);
if($parent) {
	$args['parent'] = $parent_id;
}
$terms = get_terms($args);
foreach($terms as $term) {
	$display = TRUE;
	$model_id = $term->term_id;
	$model_title = $term->name;
	$model_slug = $term->slug;
	$model_parent = $term->parent;	
	$model_description = strip_tags($term->description);
	$model_image = NULL;
	preg_match_all('/<img[^>]+>/i',$term->description, $result);
	$model_image_tag = $result[0][0];
	if($model_image_tag) {
		$xpath = new DOMXPath(@DOMDocument::loadHTML($model_image_tag));
		$model_image = $xpath->evaluate("string(//img/@src)");
	}
	// Parent
	if($model_parent == '0') {
		$display = FALSE;
	}
	// Gauge
	if($display && $gauge && strpos($model_description,$gauge) === FALSE) {
		$display = FALSE;
	}
	// Capacity
	if($display && $capacity && strpos($model_description,$capacity) === FALSE) {
		$display = FALSE;
	}
	// Disabled
	if(in_array($model_id, $disabled)) {
		$display = FALSE;
	}
	
	if($display) {
		echo "<a href=\"".get_bloginfo('url')."/flex-configurator?model=$model_slug\" class=\"flex_select_model_block\">
		<div class=\"flex_select_model_image\" style=\"background-image:url($model_image);\"></div>
		<div class=\"flex_select_model_text\"><h5>$model_title</h5>$model_description</div>
		</a>";
	}
}
?>
</div>

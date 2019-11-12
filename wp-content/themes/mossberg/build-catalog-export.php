<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Catalog Export
*/
?>
<?php 
wp_head();
ini_set('display_errors', '1');
ini_set('max_execution_time', 300);
?>

<div class="content_container">
<div class="content">
<div class="content_twelve content_full">
<table style="font-size:9px;">
<tr style="background:#666; color:#FFF;">
<td>ID</td>
<td>SKU</td>
<td>Link</td>
<td>Title</td>
<td>Price</td>
<td>Caliber</td>
<td>Gauge</td>
<td>Capacity</td>
<td>Chamber</td>
<td>Barrel Type</td>
<td>Barrel Length</td>
<td>Sight Type</td>
<td>Scope Type</td>
<td>Choke</td>
<td>Twist</td>
<td>LOP Type</td>
<td>LOP</td>
<td>Barrel Finish</td>
<td>Stock</td>
<td>Weight</td>
<td>Length</td>
<td>Shell Size</td>
<td>UPC</td>
<td>Image Link</td>
<!-- Categories -->
<?php
$categories = array();
// Activities
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>24,'hide_empty'=>0);
$activities = get_categories($args);
foreach($activities as $activity) {
	$categories[] = $activity->term_id;
}
// Types
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>23,'hide_empty'=>0);
$types = get_categories($args);
foreach($types as $type) {
	$categories[] = $type->term_id;
}
// Subtypes
foreach($types as $type) {
	$type_id = $type->term_id;
	$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'child_of'=>$type_id,'hide_empty'=>0);
	$subtypes = get_categories($args);
	if(!empty($subtypes)) {
		foreach($subtypes as $subtype) {
			$categories[] = $subtype->term_id;
		}
	}
}
// Actions
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>122,'hide_empty'=>0);
$actions = get_categories($args);
foreach($actions as $action) {
	$categories[] = $action->term_id;
}
// Series
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>80,'hide_empty'=>0);
$serieses = get_categories($args);
foreach($serieses as $series) {
	$categories[] = $series->term_id;
}
// Special Series
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>108,'hide_empty'=>0);
$serieses = get_categories($args);
foreach($serieses as $series) {
	$categories[] = $series->term_id;
}
// LE
$categories[] = '96';
// New
$categories[] = '333';

// Category Header
foreach($categories as $key => $id) {
	$category = get_term($id,'product_cat');
	$category_name = $category->name;
	echo "<td align=\"center\">$category_name</td>";
}
?>
<!-- Categories -->
<td align="center">Active</td>
</tr>
<!-- Products -->
<?php
$args = array('post_type'=>'product','numberposts'=>-1,'post_status'=>'any','orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
query_posts($args);
$bg = '#FFFFFF';
while(have_posts()):the_post();
	$product_id = get_the_ID();
	$product_title = get_the_title();
	$product_description = get_the_content();
	$product_link = get_the_permalink();
	$product_title = $post->post_title;
	$product_active = get_post_status($product_id);
	$product_sku = get_post_meta($product_id, '_sku', true);
	$product_price = number_format(floatval(get_post_meta($product_id, '_price', true)),2);
	$product_caliber = get_post_meta($product_id, 'wpcf-caliber', true);
	$product_gauge = get_post_meta($product_id, 'wpcf-gauge', true);
	$product_capacity = get_post_meta($product_id, 'wpcf-capacity', true);
	$product_chamber = get_post_meta($product_id, 'wpcf-chamber', true);
	$product_barrel_type = get_post_meta($product_id, 'wpcf-barrel-type', true);
	$product_barrel_length = get_post_meta($product_id, 'wpcf-barrel-length', true);
	$product_sight_type = get_post_meta($product_id, 'wpcf-sight-type', true);
	$product_scope_type = get_post_meta($product_id, 'wpcf-scope-type', true);
	$product_choke = get_post_meta($product_id, 'wpcf-choke', true);
	$product_twist = get_post_meta($product_id, 'wpcf-twist', true);
	$product_lop_type = get_post_meta($product_id, 'wpcf-lop-type', true);
	$product_lop = get_post_meta($product_id, 'wpcf-lop', true);
	$product_barrel_finish = get_post_meta($product_id, 'wpcf-barrel-finish', true);
	$product_stock = get_post_meta($product_id, 'wpcf-stock', true);
	$product_weight = get_post_meta($product_id, 'wpcf-weight', true);
	$product_length = get_post_meta($product_id, 'wpcf-length', true);
	$product_shell_size = get_post_meta($product_id, 'wpcf-shell-size', true);
	$product_upc = get_post_meta($product_id, 'wpcf-upc', true);
	$product_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'large');
	$product_image = $product_image_src[0];
	$product_categories = array();
	$terms = wp_get_post_terms($product_id, 'product_cat');
	foreach($terms as $term) {
		$product_categories[] = $term->term_id;
	}
	$bg = ($bg=='#FFFFFF' ? '#EAEAEA' : '#FFFFFF');
	echo "<tr style=\"background:$bg;\">
	<td>$product_id</td>
	<td>$product_sku</td>
	<td>$product_link</td>
	<td>$product_title</td>
	<td>$product_price</td>
	<td>$product_caliber</td>
	<td>$product_gauge</td>
	<td>$product_capacity</td>
	<td>$product_chamber</td>
	<td>$product_barrel_type</td>
	<td>$product_barrel_length</td>
	<td>$product_sight_type</td>
	<td>$product_scope_type</td>
	<td>$product_choke</td>
	<td>$product_twist</td>
	<td>$product_lop_type</td>
	<td>$product_lop</td>
	<td>$product_barrel_finish</td>
	<td>$product_stock</td>
	<td>$product_weight</td>
	<td>$product_length</td>
	<td>$product_shell_size</td>
	<td>$product_upc</td>
	<td>$product_image</td>";
	foreach($categories as $key => $id) {
		if(in_array($id,$product_categories)) {
			echo "<td align=\"center\">Y</td>";
			} else {
			echo "<td align=\"center\">N</td>";
		}		
	}
	if($product_active == 'publish') {
		echo "<td align=\"center\">Y</td>";
		} else {
		echo "<td align=\"center\">N</td>";
	}	
	echo "</tr>";
endwhile;
?>    
<!-- Products -->
</table>

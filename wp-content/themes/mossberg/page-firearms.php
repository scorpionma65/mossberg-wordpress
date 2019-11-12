<?php
/*
Template Name: Firearms
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<!-- Slider -->
<div class="content_slider_firearms">
<?php 
$cat_slug = 'firearms-slider';
include(TEMPLATEPATH.'/inc/inc-slider-firearms.php');
?>
</div>
<!-- Slider -->

<div class="content">

<div class="content_three content_left content_sidebar">
<!-- Menu -->
<?php include(TEMPLATEPATH.'/inc/inc-menu-firearms.php');?>
<!-- Menu -->
</div>
<div class="content_nine content_right">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<!-- Categories -->
<?php
// Firearms Home
$landing_url = get_permalink(get_page_by_path('firearms'));
// Types
$cat_slug = 'types';
$cat = get_term_by('slug', $cat_slug, 'product_cat'); 
$category_id = $cat->term_id;
$category_name = $cat->name;
$category_description = $cat->description;
echo "<div class=\"catalog_tile_header\">$category_description</div>
<div class=\"catalog_tile_container\">";

$args = array(
   'hierarchical' => 1,
   'show_option_none' => '',
   'hide_empty' => 0,
   'parent' => $category_id,
   'taxonomy' => 'product_cat'
);
$subcats = get_categories($args);
foreach($subcats as $subcat) {
	$subcategory_id = $subcat->term_id;
	$subcategory_name = $subcat->name;
	$subcategory_description = $subcat->description;	
	$subcategory_slug = $subcat->slug;
	$subcategory_link = $landing_url.$subcategory_slug;
	$subscategory_image_id = get_woocommerce_term_meta($subcategory_id, 'thumbnail_id', true );
    $subcategory_image = wp_get_attachment_url($subscategory_image_id);
	
	echo "<a href=\"$subcategory_link\" class=\"catalog_tile_block\">
	<div class=\"catalog_tile_image\" style=\"background-image:url($subcategory_image);\"><div class=\"catalog_tile_mask\" >$subcategory_description</div></div>
	<div class=\"catalog_tile_title\">$subcategory_name</div>
	</a>";	
}
echo "</div>";

// Activities
$cat_slug = 'activities';
$cat = get_term_by('slug', $cat_slug, 'product_cat'); 
$category_id = $cat->term_id;
$category_name = $cat->name;
$category_description = $cat->description;
echo "<div class=\"catalog_tile_header\">$category_description</div>
<div class=\"catalog_tile_container\">";

$args = array(
   'hierarchical' => 1,
   'show_option_none' => '',
   'hide_empty' => 0,
   'parent' => $category_id,
   'taxonomy' => 'product_cat'
);
$subcats = get_categories($args);
foreach($subcats as $subcat) {
	$subcategory_id = $subcat->term_id;
	$subcategory_name = $subcat->name;
	$subcategory_description = $subcat->description;
	$subcategory_link = get_post_permalink($subcategory_id);
	$subcategory_slug = $subcat->slug;
	$subcategory_link = $landing_url.$subcategory_slug;
	$subscategory_image_id = get_woocommerce_term_meta($subcategory_id, 'thumbnail_id', true );
    $subcategory_image = wp_get_attachment_url($subscategory_image_id);
	
	echo "<a href=\"$subcategory_link\" class=\"catalog_tile_block\">
	<div class=\"catalog_tile_image\" style=\"background-image:url($subcategory_image);\"><div class=\"catalog_tile_mask\" >$subcategory_description</div></div>
	<div class=\"catalog_tile_title\">$subcategory_name</div>
	</a>";	
}
echo "</div>";

// Series
$cat_slug = 'specialty-series';
$cat = get_term_by('slug', $cat_slug, 'product_cat'); 
$category_id = $cat->term_id;
$category_name = $cat->name;
$category_description = $cat->description;
echo "<div class=\"catalog_tile_header\">$category_description</div>
<div class=\"catalog_tile_container\">";

$args = array('hierarchical'=>1,'show_option_none'=>'','hide_empty'=>1,'parent'=>$category_id,'taxonomy'=>'product_cat');
$subcats = get_categories($args);
shuffle($subcats);
$count = 0;
$limit = 3;
foreach($subcats as $subcat) {
	$subcategory_id = $subcat->term_id;
	$subcategory_name = $subcat->name;
	$subcategory_slug = $subcat->slug;	
	$subcategory_description = $subcat->description;
	$subcategory_link = get_term_link($subcategory_slug, 'product_cat');
	$subscategory_image_id = get_woocommerce_term_meta($subcategory_id, 'thumbnail_id', true );
    $subcategory_image = wp_get_attachment_url($subscategory_image_id);
	if($subcategory_description == NULL) {
		$subcategory_description = "Explore the $subcategory_name";
	}
	
	echo "<a href=\"$subcategory_link\" class=\"catalog_tile_block\">
	<div class=\"catalog_tile_image\" style=\"background-image:url($subcategory_image);\"><div class=\"catalog_tile_mask\" >$subcategory_description</div></div>
	<div class=\"catalog_tile_title\">$subcategory_name</div>
	</a>";	
	$count++;
	if($count == 3) {
		break;
	}
}
echo "</div>";
?>
<!-- Categories -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: Firearms Applications
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
global $post;
$slug = $post->post_name;
$cat_slug = $slug.'-slider';
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
// Activity
global $post;
$activity_slug = $post->post_name;
// Application
$parent = 959;
if($activity_slug == 'shotguns-by-application') {
	$filter = 'shotguns';
}
if($activity_slug == 'rifles-by-application') {
	$filter = 'rifles';
}

$args = array('taxonomy'=>'product_cat','parent'=>$parent,'hide_empty'=>0);
$serieses = get_categories($args);
echo "<div class=\"catalog_tile_container\">";
foreach($serieses as $series) {
	$series_id = $series->term_id;
	$series_name = $series->name;
	$series_slug = $series->slug;
	$series_description = $series->description;				
	$series_link = get_term_link($series_slug, 'product_cat');
	$series_image_id = get_woocommerce_term_meta($series_id, 'thumbnail_id', true );
	$series_image = wp_get_attachment_url($series_image_id);
	if(strpos($series_slug, $filter) !== FALSE) {
		echo "<a href=\"$series_link\" class=\"catalog_tile_block\">
		<div class=\"catalog_tile_image\" style=\"background-image:url($series_image);\"><div class=\"catalog_tile_mask\">$series_description</div></div>
		<div class=\"catalog_tile_title\">$series_name</div>
		</a>";	
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

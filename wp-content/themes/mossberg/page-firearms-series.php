<?php
/*
Template Name: Firearms Series
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
// Specialty
if($activity_slug == 'specialty-series') {
	$parent = 108;
	$new = 333;
	} else {
	$parent = 80;
	$new = FALSE;
}

$args = array('taxonomy'=>'product_cat','parent'=>$parent,'hide_empty'=>1);
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
	if($series_id != 108) {
		$series_activity = series_in_category($activity_slug,$series_slug);
		if($series_activity == 1) {
			echo "<a href=\"$series_link\" class=\"catalog_tile_block\">
			<div class=\"catalog_tile_image\" style=\"background-image:url($series_image);\"><div class=\"catalog_tile_mask\">$series_description</div></div>
			<div class=\"catalog_tile_title\">$series_name</div>
			</a>";	
		}
		$subserieses = get_term_children($series_id, 'product_cat');
		if(count($subserieses) > 0) {
			foreach($subserieses as $sub) {
				$subseries = get_term_by('id', $sub, 'product_cat');
				$subseries_id = $subseries->term_id;
				$subseries_name = $subseries->name;
				$subseries_slug = $subseries->slug;
				$subseries_description = $subseries->description;				
				$subseries_link = get_term_link($subseries_slug, 'product_cat');
				$subseries_image_id = get_woocommerce_term_meta($subseries_id, 'thumbnail_id', true );
				$subseries_image = wp_get_attachment_url($subseries_image_id);
				if($subseries_id != 108) {
					$subseries_activity = series_in_category($activity_slug,$subseries_slug);
					if($subseries_activity == 1) {
						echo "<a href=\"$subseries_link\" class=\"catalog_tile_block\">
						<div class=\"catalog_tile_image\" style=\"background-image:url($subseries_image);\"><div class=\"catalog_tile_mask\">$subseries_description</div></div>
						<div class=\"catalog_tile_title\">$subseries_name</div>
						</a>";	
					}
				}
			}
		}
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

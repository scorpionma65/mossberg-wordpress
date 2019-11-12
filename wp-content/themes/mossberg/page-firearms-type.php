<?php
/*
Template Name: Firearms Type
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
<div class="catalog_tile_container">
<?php
// Firearms Home
$landing_url = get_bloginfo('url').'/category/series/';
// Type
global $post;
$page_slug = $post->post_name;
if(strpos($page_slug, 'shotguns') !== FALSE) {
	$type_slug = 'shotguns';
	$series_slug = str_replace('-shotguns', '', $post->post_name);
}
if(strpos($page_slug, 'rifles') !== FALSE) {
	$type_slug = 'rifles';
	$series_slug = str_replace('-rifles', '', $post->post_name);
}
$args = array('post_type'=>'product','product_cat'=>$series_slug.'+'.$type_slug,'post_status'=>'publish','orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
query_posts($args);
$series = array();
while(have_posts()):the_post();
	$product_id = get_the_ID();	
	$terms = get_the_terms($product_id, 'product_cat');
    foreach($terms as $term) {
        $term_name = $term->name;
        $term_id = $term->term_id;
		$term_parent = $term->parent;
		if($term_parent == 80 && !in_array($term_id, $series)) {
			$series[$term_id] = $term_name;			
		}
    }
endwhile;
foreach($series as $id => $name) {
	$category = get_term_by('id', $id, 'product_cat');
	$category_id = $category->term_id;
	$category_name = $category->name;
	$category_description = $category->description;	
	$category_slug = $category->slug;
	$category_link = $landing_url.$category_slug;
	$category_image_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true );
    $category_image = wp_get_attachment_url($category_image_id);
	
	echo "<a href=\"$category_link\" class=\"catalog_tile_block\">
	<div class=\"catalog_tile_image\" style=\"background-image:url($category_image);\"><div class=\"catalog_tile_mask\" >$category_description</div></div>
	<div class=\"catalog_tile_title\">$category_name</div>
	</a>";	
}
?>
</div>
<!-- Categories -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: LE Distributors
*/
?>
<?php get_header(); ?>

<div class="content_container">

<!-- LE Banner -->
<?php include(TEMPLATEPATH.'/inc/inc-banner-le.php');?>
<!-- LE Banner -->

<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>

<div class="content_twelve content_full">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
<!-- Map -->
<div class="map_container">
<?php 
$cat_slug = 'le-distributors';
include(TEMPLATEPATH.'/inc/inc-map-locations.php');
?>
</div>
<!-- Map -->
<!-- Locations -->
<div class="location_container">
<?php
$args = array('category_name'=>$cat_slug,'showposts'=>-1,'orderby'=>array('meta_value'=>'ASC','title'=>'ASC'),'meta_key'=>'Location State','order'=>'ASC');
query_posts($args);
while(have_posts()):the_post();
	$location_title = $post->post_title;
	$location_content = wpautop($post->post_content);
	$location_address = get_post_meta($post->ID, 'Location Address', true);
	$location_state = get_post_meta($post->ID, 'Location State', true);
	$location_directions = urlencode(strip_tags($location_address));
	echo "<div class=\"location_block\">
	<div class=\"location_title\"><div class=\"location_state\">$location_state</div>$location_title</div>
	<div class=\"location_text\">
	$location_content
	<a href=\"https://maps.google.com/maps?q=$location_directions\" target=\"_blank\">Driving Directions &raquo;</a>
	</div>
	</div>";
endwhile;
?>
</div>
<!-- Locations -->
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<div class="content_container">
<!-- Banner -->
<?php
while ( have_posts() ) : the_post(); 
	$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'fullsize' );
	$banner_url = $banner_src[0];
endwhile;
?>
<div class="content_slider_firearms">
<div class="slide_fire_container">
<div class="slide_fire_panel" style="background-image:url(<?php echo $banner_url;?>);"></div>
</div>
</div>
<!-- Banner -->
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
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

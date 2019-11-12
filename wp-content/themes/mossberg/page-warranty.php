<?php
/*
Template Name: Warranty
*/
?>
<?php get_header(); ?>

<div class="content_banner_blog" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');?>);"></div>
<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<div class="content_ten content_left">
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
<div class="content_two content_right">
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

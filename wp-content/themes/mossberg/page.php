<?php
/**
* Pages
* @package Mossberg
* @since Mossberg 1.0
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<div class="content_eight content_left">
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
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar">
<?php include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');?>
</div>
<!-- CTA -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

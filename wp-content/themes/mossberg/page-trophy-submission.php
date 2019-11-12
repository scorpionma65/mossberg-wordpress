<?php
/*
Template Name: Trophy Submission
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">
<div class="content">
<div class="content_eight content_left">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
<!-- Trophy -->
<div class="trophy_upload">
<?php include(TEMPLATEPATH.'/inc/inc-trophy-submission.php');?>
</div>
<!-- Trophy -->
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar_padded">
<?php 
$cta_slug = 'cta-sidebar';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
<!-- CTA -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

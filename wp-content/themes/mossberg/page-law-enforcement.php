<?php
/*
Template Name: Law Enforcement
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<!-- LE Banner -->
<?php include(TEMPLATEPATH.'/inc/inc-banner-le.php');?>
<!-- LE Banner -->

<!-- Slider -->
<div class="content_slider_firearms">
<?php 
$cat_slug = 'law-enforcement-slider';
include(TEMPLATEPATH.'/inc/inc-slider-firearms.php');
?>
</div>
<!-- Slider -->
<div class="content">
<div class="content_three content_left content_sidebar">
<!-- Menu -->
<?php include(TEMPLATEPATH.'/inc/inc-menu-firearms-le.php');?>
<!-- Menu -->
</div>

<div class="content_two content_right">
<!-- CTA -->
<div class="cta_sidebar_padded desktop">
<?php 
$cta_slug = 'cta-skyscraper';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
<!-- CTA -->
</div>

<div class="content_seven content_right">
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
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

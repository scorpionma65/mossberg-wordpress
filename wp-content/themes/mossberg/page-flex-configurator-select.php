<?php
/*
Template Name: FLEX Configurator Select
*/
?>
<?php get_header('flex'); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init();</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="flex_header_pad"></div>
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
<div class="content_twelve content_full">

<div class="flex_text_container">
<div class="flex_text">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	the_content();
endwhile;
?>
</div>
<!-- Posts -->
<!-- Select -->
<?php
// Select
include(TEMPLATEPATH.'/inc/inc-flex-select-series.php');
if(isset($_GET['submit'])) {
	include(TEMPLATEPATH.'/inc/inc-flex-select-model.php');
}
?>
<!-- Select -->
</div>

<div class="flex_footer">
<div class="flex_footer_build">
</div>
<a href="<?php echo get_bloginfo('url');?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo.png" class="flex_footer_logo"/></a>
</div>

</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer('none'); ?>

<?php
/*
Template Name: FLEX Configurator Email
*/
?>
<?php get_header('flex'); ?>

<div class="flex_header_pad"></div>
<div class="flex_popup">
<div class="content_twelve content_full">
<div class="flex_popup_text">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	the_content();
endwhile;
?>
<!-- Posts -->
<!-- Form -->
<?php include(TEMPLATEPATH.'/inc/inc-flex-email.php');?>
<!-- Form -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer('none'); ?>

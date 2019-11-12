<?php
/*
Template Name: Search
*/
?>
<?php get_header(); ?>

<div class="content_container">

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
<!-- Search -->
<div class="search_form">
<div class="header_search">
<?php get_search_form( true ); ?>
</div>
</div>
<div class="search_results">

</div>
<!-- Search -->
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

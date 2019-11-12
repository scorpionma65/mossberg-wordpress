<?php
/*
Template Name: Data Removal Delete
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');?>
<div class="content_eight content_left">
<!-- Posts -->
<?php
if(!isset($_POST['submit'])) {
	while ( have_posts() ) : the_post(); 
		echo "<div class=\"post_text\">";
		the_content();
		echo "</div>";
	endwhile;
}
?>
<!-- Posts -->

<div class="post_text">
<?php include(TEMPLATEPATH.'/inc/inc-data-removal-delete.php');?>
</div>
</div>

<div class="content_four content_right">
<!-- Solutions -->

<!-- Solutions -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

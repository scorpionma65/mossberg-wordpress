<?php
/*
Template Name: Catalog Request
*/
?>
<?php get_header(); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');?>
<div class="content_eight content_left">
<!-- Posts -->
<?php
global $post;
while ( have_posts() ) : the_post(); 
	$page_content = wpautop($post->post_content);
	$page_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
endwhile;
if(!isset($_POST['submit'])) { 
		echo "<div class=\"post_text\">$page_content</div>";
}
?>
<!-- Posts -->
<div class="post_text">
<?php include(TEMPLATEPATH.'/inc/inc-catalog-request.php');?>
</div>
</div>

<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar">
<?php
// Catalog Image
if($page_image) {
	echo "<img src=\"$page_image\"/>";
}
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

<?php
/*
Template Name: Recalls
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

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
<!-- Recalls -->
<div class="recall_container">
<?php
$cat_slug = 'recalls';
$args = array('category_name'=>$cat_slug,'showposts'=>-1);
query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_text = wpautop($post->post_content);
	echo "<div class=\"recall_title\" onclick=\"toggle_slide('recall{$post_id}')\")>$post_title</div>
	<div class=\"recall_text\" id=\"recall{$post_id}\" style=\"display:none;\">$post_text</div>";
endwhile;
?>
</div>
<!-- Recalls -->
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

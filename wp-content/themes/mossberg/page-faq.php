<?php
/*
Template Name: FAQ
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
<!-- FAQ -->
<div class="faq_container">
<?php
$cat_slug = 'faq';
$args = array('category_name'=>$cat_slug,'showposts'=>-1,'meta_key'=>'Custom Post Order','orderby'=>'meta_value_num','order'=>'ASC');
query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_text = wpautop($post->post_content);
	echo "<div class=\"faq_question\" onclick=\"toggle_slide('faq{$post_id}')\")>$post_title</div>
	<div class=\"faq_answer\" id=\"faq{$post_id}\" style=\"display:none;\">$post_text</div>";
endwhile;
?>
</div>
<!-- FAQ -->
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

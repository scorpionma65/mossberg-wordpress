<?php
/*
Template Name: Owners Manuals
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
<!-- Manuals -->
<?php
$parent_id = '103';
$args = array('parent'=>$parent_id,'orderby'=>'id','order'=>'ASC');
$categories = get_categories($args);
foreach($categories as $category) {
	$bg = 'manual_row_a';
	$category_id = $category->term_id;
	$category_name = $category->name;
	$category_slug = $category->slug;
	echo "<div class=\"manual_section\">$category_name</div>
	<div class=\"manual_container\">";
	$args = array('category_name'=>$category_slug,'showposts'=>-1,'meta_key'=>'Custom Post Order','orderby'=>'meta_value_num','order'=>'ASC');
	query_posts($args);
	while(have_posts()):the_post();
		$bg = ($bg=='manual_row_a' ? 'manual_row_b' : 'manual_row_a');
		$post_id = $post->ID;
		$post_title = $post->post_title;
		$post_text = wpautop($post->post_content);
		$post_pdf = get_post_meta($post->ID, 'Owners Manual PDF', true);
		echo "<a href=\"$post_pdf\" class=\"manual_pdf $bg\" target=\"_blank\">
		<span class=\"manual_pdf_title\">$post_title</span>
		<span class=\"manual_pdf_link\">VIEW</span>
		</a>";
	endwhile;
	echo "</div>";
}
?>
<!-- Manuals -->
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

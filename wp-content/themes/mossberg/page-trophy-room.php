<?php
/*
Template Name: Trophy Room
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init({ continuous:	true });</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-trophy-header.php');?>
<div class="content_nine content_left">
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
<div class="trophy_container">
<?php
if(!empty($_GET['id'])) {
	$cat_slug = sanitize_text_field($_GET['id']);
	} else {
	$cat_slug = 'trophy-room';
}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('category_name'=>$cat_slug,'posts_per_page'=>12,'paged'=>$paged);
$paged_query = query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_image = wp_get_attachment_url(get_post_thumbnail_id($post_id),'large');
	echo "<a href=\"".get_bloginfo('home')."/trophy-profile?id=$post_id\" rel=\"shadowbox[trophy];width=700;height=550;\" class=\"trophy_block\" style=\"background-image:url($post_image);\"></a>";
endwhile;
?>
</div>
<div class="trophy_paginate">
<?php 
// Pagination
$big = 999999999; 
$args = array(
	'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'prev_next' => TRUE,
	'prev_text' => __('« Previous'),
	'next_text' => __('Next »')
); 
echo paginate_links($args);
?>
</div>
<!-- Trophy -->
</div>
<div class="content_three content_right">
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

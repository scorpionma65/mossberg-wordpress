<?php
/*
Template Name: Resources
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

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
<!-- Ebooks -->
<div class="offer_summary_container">
<?php 
global $post;
$page_slug = get_post($post)->post_name;
switch($page_slug) {
	case 'resources':
	$cta_slug = 'ebook';
	$cta_action = 'View/Download';	
	break;
	case 'offers':
	$cta_slug = 'current-offer';
	$cta_action = 'View Offer';
	break;
}

$args = array('category_name'=>$cta_slug);
query_posts($args);
while(have_posts()):the_post();
	$cta_title = $post->post_title;
	$cta_hubspot = $post->post_content;
	$cta_link = get_post_meta(get_the_ID(), 'CTA Link', true);
	$cta_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
	$cta_image = $cta_image[0]; 
	if($cta_image != NULL) {
		$cta_display = "<a href=\"$cta_link\" class=\"offer_summary_image\" target=\"_blank\"><img src=\"$cta_image\"/></a>";
		} else {
		if($cta_hubspot != NULL) {
			$cta_display = "<div class=\"offer_summary_image\">$cta_hubspot</div>";
		}
	}
	
	echo "<div class=\"offer_summary_block\">
	$cta_display
	<div class=\"offer_summary_title\"><a href=\"$cta_link\" target=\"_blank\">$cta_title</a></div>
	<div class=\"offer_summary_share\">
	<a href=\"$cta_link\" class=\"offer_summary_view\">&raquo; $cta_action</a>
	</div>
	</div>";
	
endwhile;
wp_reset_query();
?>
</div>
<!-- Ebooks -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

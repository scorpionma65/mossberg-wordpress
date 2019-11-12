<?php
/*
Template Name: Press Releases
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<div class="content_eight content_left">
<!-- Press Releases -->
<?php
$term = get_term_by('slug', 'press-releases', 'media_category');
$term_slug = $term->slug;
$term_name = $term->name;
echo "<div class=\"press_release_container\">";
$args = array('post_status'=>'any','showposts'=>-1,'post_type'=>'attachment','media_category'=>$term_slug,'orderby'=>'date','order'=>'DESC');
query_posts($args);
$bg = 'press_release_row_a';
while(have_posts()):the_post();
	$bg = ($bg=='press_release_row_a' ? 'press_release_row_b' : 'press_release_row_a');
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_slug = $post->post_name;
	$post_text = $post->post_content;
	$post_date = date('Y', strtotime($post->post_date));
	$post_link = wp_get_attachment_url($post_id);
	echo "<a href=\"$post_link\" class=\"press_release_pdf $bg\" target=\"_blank\">
	<span class=\"press_release_pdf_title\"><h3>$post_title</h3>$post_text</span>
	<span class=\"press_release_pdf_link\">$post_date</span>
	</a>";
endwhile;
echo "</div>";
?>
<!-- Press Releases -->
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar">
<?php include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');?>
</div>
<!-- CTA -->
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: Campus Waterfowl
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<?php 
// Post
global $post;
$page_id = get_the_ID();
$page_image = wp_get_attachment_url(get_post_thumbnail_id($page_id));
$page_slug = $post->post_name;
?>

<div class="content_container">
<div class="content">
<!-- Feature -->
<div class="content_full content_twelve">
<div class="promo_feature" style="background-image:url(<?php echo $page_image;?>);"></div>
</div>
<!-- Feature -->
<div class="content_left content_eight">
<?php
$post_title = get_the_title();
$post_content = $post->post_content;
$post_content_filters = apply_filters('the_content', $post_content);
echo "<div class=\"promo_title\">$post_title</div>
<div class=\"promo_intro\">$post_content_filters</div>";
?>
</div>
<!-- Form -->
<div class="content_right content_four">
<div class="promo_sidebar">
<?php
// Forms
$args = array('name'=>'campus-waterfowl-registration','posts_per_page'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	echo "<div class=\"promo_sidebar_text\">$post_content</div>";
endwhile;
wp_reset_query();
?>
</div>
</div>
<!-- Form -->
<div class="content_full content_twelve">
<div class="blog_summary_container">
<!-- Blog -->
<?php
// Blog Posts
$category_slug = 'campus-waterfowl';
$args = array('category_name'=>$category_slug,'posts_per_page'=>'3');
query_posts($args);
$count = 0;
while(have_posts()):the_post();	
	// Blog
	$blog_title = $post->post_title;
	$blog_content = $post->post_content;
	$blog_content_short = wp_trim_words(strip_shortcodes($blog_content), 70, '&hellip;');
	$blog_content_shorter = wp_trim_words(strip_shortcodes($blog_content), 30, '&hellip;');
	$blog_link = get_the_permalink();
	$blog_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');	
	echo "<div class=\"blog_summary_block\">
	<a href=\"$blog_link\" class=\"blog_summary_image\" style=\"background-image:url($blog_image);\"></a>
	<div class=\"blog_summary_title\"><a href=\"$blog_link\">$blog_title</a></div>
	<div class=\"blog_summary_text\">$blog_content_shorter</div>
	<div class=\"blog_summary_share\">
	<a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a>
	<div class=\"blog_summary_tags\"></div>
	</div>
	</div>";
	$count++;
endwhile;
wp_reset_query();
?>
<!-- Blog -->
</div>
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

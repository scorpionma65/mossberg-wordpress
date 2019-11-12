<?php
/*
Template Name: Community
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
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar desktop">
<?php 
$cta_limit = 1;
$cta_slug = 'sign-up';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
<!-- CTA -->
</div>
<div class="content_twelve content_full">
<div class="blog_summary_container">
<!-- Blog -->
<?php
$topics = array('product-highlights','tips-tricks','advocacy');
foreach($topics as $cat_slug) {
	$topic = get_category_by_slug($cat_slug); 
	$topic_name = $topic->name;	
	$topic_slug = $topic->slug;	
	// Blog Posts
	$args = array('category_name'=>$cat_slug,'posts_per_page'=>'5');
	$posts = query_posts($args);
	$count = 0;
	$total = count($posts);
	while(have_posts()):the_post();
		$blog_title = $post->post_title;
		$blog_content = $post->post_content;
		$blog_date = date('F j, Y', strtotime($post->post_date));
		$blog_content_short = wp_trim_words($blog_content, 70, '&hellip;');
		$blog_content_shorter = wp_trim_words($blog_content, 30, '&hellip;');
		$blog_link = get_the_permalink();
		$blog_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
		if(in_category('blog-article',$post->ID)) {
			$blog_type = 'Article';
		}
		if(in_category('blog-video',$post->ID)) {
			$blog_type = 'Video';
		}
		if($count == 0) {
			echo "<div class=\"blog_community_block\">
			<h2>$topic_name</h2>
			<div class=\"blog_community_block_summary\">
			<div class=\"blog_summary_type\">$blog_type</div>
			<a href=\"$blog_link\" class=\"blog_summary_image\" style=\"background-image:url($blog_image);\"></a>
			<div class=\"blog_summary_title\"><a href=\"$blog_link\">$blog_title</a></div>
			<div class=\"blog_summary_text\">$blog_content_shorter</div>
			<div class=\"blog_summary_share\"><a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a></div>
			</div>";
			} else {
			echo "<div class=\"blog_summary_recent desktop\">$blog_date <a href=\"$blog_link\">$blog_title</a></div>";		
		}
		$count++;
		if($count == $total) {
			echo "<a href=\"".get_bloginfo('home')."/community/mossberg-blog/?topic=$topic_slug\" class=\"blog_summary_recent_link\">More $topic_name &raquo;</a>
			</div>";
		}
	endwhile;
	wp_reset_query();
}
?>
<!-- Blog -->
</div>
</div>
</div>
</div>
<?php //include(TEMPLATEPATH.'/inc/inc-subscribe-tab.php');?>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

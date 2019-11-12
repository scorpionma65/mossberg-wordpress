<?php
/*
Template Name: Blog Home
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-blog-header.php');?>
<div class="content_twelve content_left">
<div class="blog_summary_container">
<!-- Featured Blog -->
<?php
// Pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// Exclude
$exclude_cat = '528';
// Featured Posts
if($paged == 1) {
	if(empty($_GET['tag'])) {
		$filter_cat = get_category_by_slug($cat_slug);
		$filter_id = $filter_cat->term_id;
		$feature_cat = get_category_by_slug('blog-featured');
		$feature_id = $feature_cat->term_id;
		
		$args = array('category__and' => array($filter_id,$feature_id),'category__not_in' => array($exclude_cat),'showposts'=>'1');
		query_posts($args);
		$count = 0;
		while(have_posts()):the_post();
			$blog_title = $post->post_title;
			$blog_content = $post->post_content;
			$blog_content_short = wp_trim_words(strip_shortcodes($blog_content), 70, '&hellip;');
			$blog_content_shorter = wp_trim_words(strip_shortcodes($blog_content), 30, '&hellip;');
			$blog_link = get_the_permalink();
			$blog_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
			// Tags
			$tags = array();
			$blog_tags = get_the_tag_list('', '***', '');
			if($blog_tags) {			
				$explode_tags = explode('***',strip_tags($blog_tags));
				foreach($explode_tags as $key => $value) {
					$tag = get_term_by('name',$value,'post_tag');
					$tag_name = ucwords($tag->name);
					$tag_slug = $tag->slug;
					$tag_link = "<a href=\"".get_bloginfo('home')."/community/mossberg-blog/?tag=$tag_slug\">$tag_name</a>";
					$tags[] = $tag_link;
				}
			}
			$blog_tags = implode(', ', $tags);		
			
			if(in_category('blog-article',$post->ID)) {
				$blog_type = 'Article';
			}
			if(in_category('blog-video',$post->ID)) {
				$blog_type = 'Video';
			}
			if(in_category('blog-cta',$post->ID)) {
				$blog_type = 'Promo';
			}
			if(in_category('buying-guides',$post->ID)) {
				$blog_type = 'Buying Guide';
			}
			echo "<div class=\"blog_feature_block\">
			<a href=\"$blog_link\" class=\"blog_feature_image\" style=\"background-image:url($blog_image);\"><div class=\"blog_summary_type\">$blog_type</div></a>
			<div class=\"blog_feature_title\"><a href=\"$blog_link\">$blog_title</a></div>
			<div class=\"blog_feature_text\">$blog_content_short</div>
			<div class=\"blog_feature_share\">
			<a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a>
			<div class=\"blog_feature_tags\"><em>$blog_tags</em></div>
			</div>
			</div>";
		endwhile;
	}
}
?>
<!-- Featured Blog -->
<!-- Blog -->
<?php
// Blog Posts
$args = array('category_name'=>$cat_slug,'category__not_in'=>array($exclude_cat),'posts_per_page'=>'36','paged'=>$paged);

if($tag_slug) {
	$args = array('tag'=>$tag_slug,'category__not_in'=>array($exclude_cat),'posts_per_page'=>'36','paged'=>$paged);
}
if($cat_slug) {
	$args = array('category_name'=>$cat_slug,'category__not_in'=>array($exclude_cat),'posts_per_page'=>'36','paged'=>$paged);
}
$paged_query = query_posts($args);
$count = 0;
while(have_posts()):the_post();
	$blog_title = $post->post_title;
	$blog_content = $post->post_content;
	$blog_content_short = wp_trim_words(strip_shortcodes($blog_content), 70, '&hellip;');
	$blog_content_shorter = wp_trim_words(strip_shortcodes($blog_content), 30, '&hellip;');
	$blog_link = get_the_permalink();
	$blog_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
	// Tags
	$tags = array();
	$blog_tags = get_the_tag_list('', '***', '');
	if($blog_tags) {			
		$explode_tags = explode('***',strip_tags($blog_tags));
		$tagcount = 0;
		foreach($explode_tags as $key => $value) {
			$tag = get_term_by('name',$value,'post_tag');
			$tag_name = ucwords($tag->name);
			$tag_slug = $tag->slug;
			$tag_link = "<a href=\"".get_bloginfo('home')."/community/mossberg-blog/?tag=$tag_slug\">$tag_name</a>";
			$tags[] = $tag_link;
			$tagcount++;
			if($tagcount == 6) {
				break;
			}
		}
	}
	$blog_tags = implode(', ', $tags);	
	
	if(in_category('blog-article',$post->ID)) {
		$blog_type = 'Article';
	}
	if(in_category('blog-video',$post->ID)) {
		$blog_type = 'Video';
	}
	if(in_category('blog-promo',$post->ID)) {
		$blog_type = 'Promo';
	}
	echo "<div class=\"blog_summary_block\">
	<div class=\"blog_summary_type\">$blog_type</div>
	<a href=\"$blog_link\" class=\"blog_summary_image\" style=\"background-image:url($blog_image);\"></a>
	<div class=\"blog_summary_title\"><a href=\"$blog_link\">$blog_title</a></div>
	<div class=\"blog_summary_text\">$blog_content_shorter</div>
	<div class=\"blog_summary_share\">
	<a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a>
	<div class=\"blog_summary_tags\"><em>$blog_tags</em></div>
	</div>
	</div>";
	$count++;
endwhile;
?>
<!-- Blog -->
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

</div>
</div>
</div>
<?php //include(TEMPLATEPATH.'/inc/inc-subscribe-tab.php');?>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

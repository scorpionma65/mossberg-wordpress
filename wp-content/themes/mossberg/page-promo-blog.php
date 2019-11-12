<?php
/*
Template Name: Blog Promo
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


<div class="content_full content_twelve">
<div class="blog_summary_container">
<!-- Blog -->
<?php
// Promo Post
$promo_content = FALSE;
$category_slug = 'blog-promo';
$tag_slug = $page_slug;
$args = array('tag'=>$tag_slug,'category_name'=>$category_slug,'posts_per_page'=>'1','orderby'=>'rand');
query_posts($args);
while(have_posts()):the_post();
	$promo_content = $post->post_content;
endwhile;
wp_reset_query();

// Blog Posts
$category_slug = 'buying-guides';
$tag_slug = $page_slug;
$args = array('tag'=>$tag_slug,'category_name'=>$category_slug,'posts_per_page'=>'-1');
query_posts($args);
$count = 0;
while(have_posts()):the_post();	
	// Promo
	if($count == 2) {
		if($promo_content) {
			echo "<div class=\"blog_summary_promo\">$promo_content</div>";
		}
	}
	// Blog
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
			$tag_name = $tag->name;
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
	if(in_category('blog-promo',$post->ID)) {
		$blog_type = 'Promo';
	}
	if(in_category('buying-guides',$post->ID)) {
		$blog_type = 'Buying Guide';
	}
	
	echo "<div class=\"blog_summary_block\">
	<div class=\"blog_summary_type\">$blog_type</div>
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

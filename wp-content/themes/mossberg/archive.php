<?php get_header(); ?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<div class="content_twelve content_left">
<div class="blog_summary_container">
<!-- Blog -->
<?php
$cat_slug = 'blog';
$args = array('category_name'=>$cat_slug,'posts_per_page'=>'100');
query_posts($args);
$count = 0;
while(have_posts()):the_post();
	$blog_title = $post->post_title;
	$blog_content = $post->post_content;
	$blog_content_short = wp_trim_words($blog_content, 70, '&hellip;');
	$blog_content_shorter = wp_trim_words($blog_content, 30, '&hellip;');
	$blog_link = get_the_permalink();
	$blog_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
	$blog_image = $blog_image[0];
	if(in_category('blog-article',$post->ID)) {
		$blog_type = 'Article';
	}
	if(in_category('blog-video',$post->ID)) {
		$blog_type = 'Video';
	}
	if($count == 0) {
		echo "<div class=\"blog_feature_block\">
		<a href=\"$blog_link\" class=\"blog_feature_image\" style=\"background-image:url($blog_image);\"><div class=\"blog_summary_type\">$blog_type</div></a>
		<div class=\"blog_feature_title\"><a href=\"$blog_link\">$blog_title</a></div>
		<div class=\"blog_feature_text\">$blog_content_short</div>
		<div class=\"blog_feature_share\"><a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a></div>
		</div>";
		} else {
		echo "<div class=\"blog_summary_block\">
		<div class=\"blog_summary_type\">$blog_type</div>
		<a href=\"$blog_link\" class=\"blog_summary_image\" style=\"background-image:url($blog_image);\"></a>
		<div class=\"blog_summary_title\"><a href=\"$blog_link\">$blog_title</a></div>
		<div class=\"blog_summary_text\">$blog_content_shorter</div>
		<div class=\"blog_summary_share\"><a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a></div>
		</div>";
	}
	$count++;
endwhile;
wp_reset_query();
?>
<!-- Blog -->
</div>
</div>
</div>
</div>

<?php get_footer(); ?>

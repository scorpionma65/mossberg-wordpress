<?php
/**
* Single
* @package Mossberg
* @since Mossberg 1.0
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553fdea33c12861b" async="async"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-scroll-page.js"></script>

<div class="content_container">
<div class="content single">
<?php include(TEMPLATEPATH.'/inc/inc-single-header.php');?>
<div class="content_eight content_left">
<!-- Post -->
<?php
global $post;
while ( have_posts() ) : the_post();
	$post_id = get_the_ID();
	$post_title = get_the_title();
	$post_content = wpautop(get_the_content());
	$post_content = apply_filters('the_content', $post_content);
	$post_date = get_the_date();
	$post_categories = wp_get_post_categories($post_id);
	$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );
	$author_image = get_avatar( get_the_author_meta( 'ID' ));
	$author = get_the_author();
	$author_email = get_avatar( get_the_author_meta('user_email'), '80', '' );
	$author_link = get_the_author_link();
	$author_description = get_the_author_meta('description');
	$author_display = TRUE;
	// Admins
	$admins = array('admin','Kahala','Dave Miles','Lisa Baker');
	if(in_array($author, $admins)) {
		$author_display = FALSE;
	}
	// Tags
	$tags = array();
	$tag_ids = array();
	$post_tags = get_the_tag_list('', '***', '');
	if($post_tags) {			
		$explode_tags = explode('***',strip_tags($post_tags));
		foreach($explode_tags as $key => $value) {
			$tag = get_term_by('name',$value,'post_tag');
			$tag_name = ucwords($tag->name);
			$tag_slug = $tag->slug;
			$tag_id = $tag->term_id;
			$tag_link = "<a href=\"".get_bloginfo('url')."/community/mossberg-blog/?tag=$tag_slug\">$tag_name</a>";
			$tags[] = $tag_link;
			$tag_ids[] = $tag_id;
		}
	}
	$post_tags = implode(', ', $tags);
	// Categories
	$category_unfilter = array('44','45','46','47','160','528');
	$category_ids = array_diff($post_categories, $category_unfilter);
	// Post
	echo "<div class=\"post_title\"><h1>$post_title</h1></div>
	<div class=\"post_sharing_wrap\">
	<div class=\"post_sharing\">";
	if($author_display) {
		echo"<div class=\"post_author_avatar\" onClick=\"scroll_page('author')\">$author_avatar</div>";
	}
	echo "<div class=\"post_author_top\">";
	if($author_display) {
		echo "by <span onClick=\"scroll_page('author')\">$author</span><br/>";
	}
	echo "$post_date</div>
	<div class=\"addthis_sharing_toolbox\"></div>
	</div>
	</div>
	<div class=\"post_text\">$post_content</div>";
	if($author_display) {
		echo "<div class=\"post_author_bio\" id=\"author\">
		$author_avatar
		<h3>$author</h3>
		$author_description
		</div>";
	}
	echo "<div class=\"post_link\">
	<div class=\"post_tags\">Tags: $post_tags</div>
	<a href=\"".get_bloginfo('home')."/community/mossberg-blog/\">&laquo; Return to Blog</a>
	</div>";
endwhile;
?>
<!-- Post -->
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar desktop">
<?php
$cta_limit = 3;
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
<!-- CTA -->
</div>
</div>

<!-- Related Posts -->
<?php
// Related Posts
$count = 0;
$args = array('category__in'=>$category_ids,'posts_per_page'=>'3','orderby'=>'rand');
$posts = query_posts($args);
while(have_posts()):the_post();
	if($count == 0) {
		echo "<div class=\"content\">
		<div class=\"content_twelve content_full\">
		<div class=\"blog_related_container\">
		<div class=\"blog_related_title\">Related Blog Posts</div>";
	}
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
if($count > 0) {
	echo "</div>
	</div>
	</div>";
}
?>
<!-- Related Posts -->

</div>
<?php //include(TEMPLATEPATH.'/inc/inc-subscribe-tab.php');?>
<?php get_footer(); ?>

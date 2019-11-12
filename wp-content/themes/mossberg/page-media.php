<?php
/*
Template Name: Media Resources
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<div class="content">
<div class="content_twelve content_full" style="min-height:150px;">
<?php include(TEMPLATEPATH.'/inc/inc-media-header.php');?>
<div class="media_search desktop">
<!--<form action="<?php //echo $media_downloads_link;?>" method="get" name="media_search" id="media_search" class="form_body">
<input name="keywords" type="text" class="form_field" placeholder="Keyword(s)" value="<?php //if(isset($_GET['keywords'])) { echo sanitize_text_field($_GET['keywords']);}?>" />
<input name="go" type="submit" value="Search" class="form_button" />
</form>-->
</div>
</div>

<div class="content_six content_left">
<?php
$term = get_term_by('slug', 'press-releases', 'media_category');
$term_slug = $term->slug;
$term_name = $term->name;
echo "<div class=\"post_title\">$term_name</div>
<div class=\"media_press_releases\">
<ul>";
$args = array('post_status'=>'any','showposts'=>15,'post_type'=>'attachment','media_category'=>$term_slug);
query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_slug = $post->post_name;
	$post_text = $post->post_content;
	$post_link = wp_get_attachment_url($post_id);
	echo "<li><a href=\"$post_link\" target=\"_blank\">$post_title</a><br/>$post_text</li>";
endwhile;
echo "</ul>
<a href=\"".get_bloginfo('home')."/media-resources/press-releases\">View All &raquo;</a>
</div>";
?>
</div>
<div class="content_six content_right">
<!-- Media Categories -->
<div class="media_container desktop">
<div class="post_title">Downloads</div>
<?php
$category_slug = 'dropbox-resources';
$category = get_category_by_slug($category_slug);
$category_title = category_description($category->term_id);
$args = array('category_name'=>$category_slug,'posts_per_page'=>'-1', 'orderby' => 'post_date', 'order'=> 'ASC');
query_posts($args);
while (have_posts()): the_post();
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	$post_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$dropbox_link = get_post_meta($post->ID, 'Dropbox Link', true);
	echo "<div class=\"media_category_block\">
	<div class=\"media_category_title\">$post_title</div>
	<div class=\"media_category_text\">$post_content</div>
	<div class=\"media_category_specs\">
	<a target=\"blank\" href=\"$dropbox_link\" class=\"media_category_button\">&raquo; View</a>";
	// if($media_category_slug != 'media' && $file_count != 0) {
	// 	echo "<a href=\"$media_download_link\" class=\"media_category_button\" target=\"_blank\">&raquo; Download</a>";
	// }
	echo "</div>
	</div>";
endwhile;
wp_reset_query();
?>
</div>
<!-- Media Categories -->
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

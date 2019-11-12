<?php
/*
Template Name: Media Downloads
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-media-header.php');?>

<div class="content_twelve content_fulle">
<div class="media_search">
<form action="<?php echo $media_downloads_link;?>" method="get" name="media_search" id="media_search" class="form_body">
<input name="keywords" type="text" class="form_field" placeholder="Keyword(s)" value="<?php if(isset($_GET['keywords'])) { echo sanitize_text_field($_GET['keywords']);}?>" />
<input name="go" type="submit" value="Search" class="form_button" />
</form>
</div>
<!-- Media Categories -->
<div class="media_file_container">
<?php
if(!empty($_GET['cat'])) {
	$cat_slug = sanitize_text_field($_GET['cat']);
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('post_status'=>'any','post_type'=>'attachment','media_category'=>$cat_slug,'posts_per_page'=>50,'paged'=>$paged);
	$paged_query = query_posts($args);
	while(have_posts()):the_post();
		$post_id = $post->ID;
		$post_title = $post->post_title;
		$post_file_url = wp_get_attachment_url($post_id);
		$post_file_type = get_post_mime_type($post_id);
		$media_class = "media_file_doc";
		if(strpos($post_file_type,'image') !== FALSE) {
			$post_file_image = wp_get_attachment_thumb_url($post_id);
			$media_class = "media_file_photo";
			} else {
			$post_file_image = NULL;
			$media_class = "media_file_doc";
		}
		if(strlen($post_title) > 50) {
			$post_title = substr($post_title,0,47).'...';
		}
		$post_file_extension = strtoupper(end(explode('.',$post_file_url)));
		$post_download = get_bloginfo('url')."/download?id=$post_id";
		echo "<div class=\"media_file_block\">
		<div class=\"media_file_type\">$post_file_extension</div>
		<a href=\"$post_file_url\" target=\"_blank\" class=\"media_file_image $media_class\" style=\"background-image:url($post_file_image);\"></a>
		<div class=\"media_file_title\"><a href=\"$post_file_url\" target=\"_blank\">$post_title</a></div>
		<div class=\"media_file_text\">
		
		<a href=\"$post_download\" target=\"blank\" class=\"media_file_button\">&raquo; Download</a>
		</div>
		</div>";
	endwhile;
}
if(!empty($_GET['keywords'])) {
	$cat_slug = 'media';
	$keywords = sanitize_text_field($_GET['keywords']);
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('post_status'=>'any','post_type'=>'attachment','media_category'=>$cat_slug,'posts_per_page'=>50,'paged'=>$paged,'s'=>$keywords);
	$paged_query = query_posts($args);
	while(have_posts()):the_post();
		$post_id = $post->ID;
		$post_title = $post->post_title;
		$post_file_url = wp_get_attachment_url($post_id);
		$post_file_type = get_post_mime_type($post_id);
		$media_class = "media_file_doc";
		if(strpos($post_file_type,'image') !== FALSE) {
			$post_file_image = wp_get_attachment_thumb_url($post_id);
			$media_class = "media_file_photo";
			} else {
			$post_file_image = NULL;
			$media_class = "media_file_doc";
		}
		if(strlen($post_title) > 50) {
			$post_title = substr($post_title,0,47).'...';
		}
		$post_file_extension = strtoupper(end(explode('.',$post_file_url)));
		$post_download = get_bloginfo('url')."/download?id=$post_id";
		echo "<div class=\"media_file_block\">
		<div class=\"media_file_type\">$post_file_extension</div>
		<a href=\"$post_file_url\" target=\"_blank\" class=\"media_file_image $media_class\" style=\"background-image:url($post_file_image);\"></a>
		<div class=\"media_file_title\"><a href=\"$post_file_url\" target=\"_blank\">$post_title</a></div>
		<div class=\"media_file_text\">
		
		<a href=\"$post_download\" target=\"blank\" class=\"media_file_button\">&raquo; Download</a>
		</div>
		</div>";
	endwhile;
}
?>
</div>
<div class="media_file_paginate">
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
<!-- Media Categories -->
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

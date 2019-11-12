<!-- Page -->
<?php
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_link = get_the_permalink();
$page_url = $post->name;
$page_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
// Topic
$term = FALSE;
if(!empty($_GET['topic'])) {
	$cat_slug = sanitize_text_field($_GET['topic']);
	$term = get_category_by_slug($cat_slug);
	$term_name = $term->name;
	$term_slug = $term->slug;
	$term_breadcrumb = " / <a href=\"$page_url?topic=$term_slug\">$term_name</a>";
	$term_title = $page_title.' &raquo; '.ucwords($term_name);
	} else {
	if(!empty($_GET['tag'])) {
		$tag_slug = sanitize_text_field($_GET['tag']);
		$term = get_term_by('slug', $tag_slug, 'post_tag', '', '');
		$term_name = $term->name;
		$term_slug = $term->slug;
		$term_breadcrumb = " / <a href=\"$page_url?tag=$term_slug\">$term_name</a>";
		$term_title = $page_title.' &raquo; '.ucwords($term_name);
		} else {		
		$cat_slug = 'blog';
		$term_breadcrumb = NULL;
		$term_title = NULL;
	}
}
?>
<div class="content_banner_blog" style="background-image:url(<?php echo $page_image;?>);"></div>
<div class="content_page">
<!-- Menu -->
<?php 
wp_nav_menu(array(
	'theme_location'  => 'blog',
	'container'       => 'div',
	'container_class' => 'blog_navigation',
	'container_id'    => 'blog-navigation',
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<!-- Menu -->
<!-- Title -->
<div class="container_title"><?php if($term) { echo $term_title; } ?></div>
<!-- Title -->
</div>
<!-- Page -->

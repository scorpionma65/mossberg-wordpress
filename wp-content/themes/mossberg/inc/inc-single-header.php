<!-- Page -->
<?php
global $post;
$post_id = get_the_ID();
$post_title = get_the_title();
$post_link = get_the_permalink();
?>
<?php
// Blog
$blog = FALSE;
$blog = get_category_by_slug('blog');
$blog_id = $blog->term_id;
$blog_page_id = 2526;
if(in_category($blog_id,$post_id)) {
	$blog = TRUE;
	$page = get_post($blog_page_id);
	$page_title = 'Mossberg Blog';
	$page_link = get_the_permalink($page);
	$blog_banner = wp_get_attachment_url(get_post_thumbnail_id($page->ID),'large');
	$banner = "<div class=\"content_banner_blog\" style=\"background-image:url($blog_banner);\"></div>";
}
// Trophy Room
$trophy = FALSE;
$trophy = get_category_by_slug('trophy-room');
$trophy_id = $trophy->term_id;
$trophy_page_id = 1209;
if(in_category($trophy_id,$post_id)) {
	$trophy = TRUE;
	$page = get_post($trophy_page_id);
	$page_title = $post_title;
	$page_link = get_the_permalink($page);
	$trophy_banner = wp_get_attachment_url(get_post_thumbnail_id($page->ID),'large');
	$banner = "<div class=\"content_banner_blog\" style=\"background-image:url($trophy_banner);\"></div>";
}
?>
<?php
// Banner
echo $banner;
// Menu
if($blog) {
	wp_nav_menu(array(
		'theme_location'  => 'blog',
		'container'       => 'div',
		'container_class' => 'blog_navigation',
		'container_id'    => 'blog-navigation',
		'menu_class'      => 'nav_menu',
		'menu_id'         => 'nav-menu'
	));
}
?>
<div class="content_page">

<!-- Breadcrumbs -->
<div class="breadcrumbs desktop">
<?php
// Buying Guide
$guide_title = FALSE;
$guide = get_category_by_slug('buying-guides');
$guide_id = $guide->term_id;
if(in_category($guide_id,$post_id)) {
	$page_title = 'Holiday Buying Guides';
}
?>
</div>
<!-- Breadcrumbs -->
<!-- Breadcrumb Nav -->
<?php 
if(!$blog) { 
	include(TEMPLATEPATH.'/inc/inc-menu-breadcrumb.php');
}
?>    
<!-- Breadcrumb Nav -->
<!-- Title -->
<div class="container_title">
<?php echo $page_title; ?>
</div>
<!-- Title -->
</div>
<!-- Page -->

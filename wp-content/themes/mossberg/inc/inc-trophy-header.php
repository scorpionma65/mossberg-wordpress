<!-- Page -->
<?php
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_link = get_the_permalink();
$page_image = wp_get_attachment_url(get_post_thumbnail_id($page->ID),'large');
?>
<div class="content_banner_blog" style="background-image:url(<?php echo $page_image;?>);"></div>
<div class="content_page">
<!-- Breadcrumbs -->
<div class="breadcrumbs desktop">
<?php 
$page_parents = get_post_ancestors($page_id); 
if(!is_front_page() && !$page_parents) {
	//echo "<a href=\"".home_url('/')."\">Home</a> / ";
	} else {
	array_reverse($page_parents);
	foreach ($page_parents as $page_parent_id) {
		$page_parent = get_post($page_parent_id);
		$page_parent_title = $page_parent->post_title;
		$page_parent_link = get_permalink($page_parent_id);
		echo "<a href=\"$page_parent_link\">$page_parent_title</a> / ";
	}
}
echo "<a href=\"$page_link\">$page_title</a>";
?>
</div>
<!-- Breadcrumbs -->
<!-- Breadcrumb Nav -->
<?php include(TEMPLATEPATH.'/inc/inc-menu-breadcrumb.php');?>
<!-- Breadcrumb Nav -->
<!-- Title -->
<div class="container_title">
<h1><?php echo $page_title;?></h1>
<?php
// Submit Photo
$submit_id = 1211;
$submit = get_post($submit_id);
$submit_title = strtoupper($submit->post_title);
$submit_link = get_permalink($submit_id);
echo "<a href=\"$submit_link\" class=\"trophy_submit_link\">$submit_title &raquo;</a>";
?>
<div class="trophy_camps">
<?php
echo "<a href=\"$landing_page\">All</a>";
$args = array('type'=>'post', 'parent'=>107, 'hide_empty'=>0, 'orderby'=>'count', 'order'=>'DESC');
$categories = get_categories($args);
foreach($categories as $category) {
	$link_title = $category->name;
	$link_slug = $category->slug;
	$link_icon = NULL;
	switch($link_slug) {
		case 'deer-camp':
		$link_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-trophy-deer.png\"/>";
		break;
		case 'duck-camp':
		$link_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-trophy-duck.png\"/>";
		break;
		case 'turkey-camp':
		$link_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-trophy-turkey.png\"/>";
		break;
		case 'dog-camp':
		$link_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-trophy-dog.png\"/>";
		break;
		case 'my-mossberg':
		$link_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-trophy-my-mossberg.png\"/>";
		break;
	}
	$link_url = $landing_url."?id=$link_slug";
	echo "<a href=\"$link_url\">$link_icon $link_title</a>";
}
?>
</div>
</div>
<!-- Title -->
</div>
<!-- Page -->

<!-- Page -->
<?php
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_link = get_the_permalink();
// Media Download URL
$media_downloads_link = get_permalink('5301');
?>
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
<!--<div class="blog_topic_menu desktop" onclick="toggle_slide('media_types')">
MEDIA TYPES
<div class="blog_topic_submenu" style="display:none;" id="media_types">
<?php
// Types
//$taxonomies = array('media_category');
//$args = array('orderby'=>'name','hide_empty'=>true); 
//$terms = get_terms($taxonomies, $args);
//foreach($terms as $term) {
//	$link_title = $term->name;
//	$link_slug = $term->slug;
//	$link_url = $media_downloads_link."?cat=$link_slug";
//	echo "<a href=\"$link_url\">$link_title</a>";
//}
?>
</div>
</div>-->
</div>
<!-- Title -->
</div>
<!-- Page -->

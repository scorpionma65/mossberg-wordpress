<!-- Page -->
<?php
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_link = get_the_permalink();
$page_slug = $post->post_name;
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
<div class="container_title"><h1><?php echo $page_title;?></h1></div>
<!-- Title -->
</div>
<!-- Page -->

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

<?php
/*
Template Name: OSP Offer
*/
?>
<?php get_header(); ?>

<div class="content_container">
<!-- Banner -->
<?php
while ( have_posts() ) : the_post(); 
	$banner_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'fullsize' );
	$banner_url = $banner_src[0];
endwhile;
?>
<div class="content_slider_firearms">
<div class="slide_fire_container">
<div class="slide_fire_panel" style="background-image:url(<?php echo $banner_url;?>);"></div>
</div>
</div>
<!-- Banner -->
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-offer-header.php');?>
<div class="content_eight content_left">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
<!-- Submission -->
<div class="osp_submission">
<?php include(TEMPLATEPATH.'/inc/inc-osp-submission.php');?>
</div>
<!-- Submission -->
<!-- Mail Option -->
<?php
// Mail-in
if($mail) {
	$firstname = urlencode($firstname);
	$lastname = urlencode($lastname);
	$address = urlencode($address);
	$city = urlencode($city);
	$state = urlencode($state);
	$zip = urlencode($zip);
	echo "<div class=\"post_text\">
	<h4>Having trouble redeeming online? <a href=\"".get_bloginfo('home')."/ospoffer-mail?firstname=$firstname&lastname=$lastname&email=$email&address=$address&city=$city&state=$state&zip=$zip\" target=\"_blank\">Print the Mail-in Form to Redeem by Mail &raquo;</a></h4>
	</div>";
}
?>
<!-- Mail Option -->
<!-- Offer Footer -->
<?php
$args = array('name'=>'osp-offer-footer', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
$posts = get_posts($args);
if($posts) { 
	$post_title = $posts[0]->post_title;
	$post_content = wpautop($posts[0]->post_content);
	echo "<div class=\"osp_submission_footer\">$post_content</div>";
}
?>
<!-- Offer Footer -->
</div>
<div class="content_four content_right">
<!-- Offer Sidebar -->
<?php
$args = array('name'=>'osp-offer-sidebar', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
$posts = get_posts($args);
if($posts) { 
	$post_title = $posts[0]->post_title;
	$post_content = wpautop($posts[0]->post_content);
	echo "<div class=\"osp_submission_sidebar\">$post_content</div>";
}
?>
<!-- Offer Sidebar -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: Privacy Center
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<div class="content_nine content_left">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\"><h1>".$post->post_title."</h1>".$post->post_content."</div>";
endwhile;
?>
<!-- Posts -->
<!-- Communication -->
<div class="post_text">
<h2>Communication Preferences</h2>
<p>Manage your email communication preferences. Opt-in and Opt-out of specific types of Mossberg emails.</p>
<?php include(TEMPLATEPATH.'/inc/forms/form-communication-preference-request.php');?>
</div>
<!-- Communication -->
<!-- Removal -->
<div class="post_text">
<h2>Data Removal</h2>
<p>Request removal of your Mossberg.com data. Information you provide us through purchases and site activity helps us to personalize your Mossberg.com experience and communication. <a href="<?php echo get_bloginfo('url').'/privacy-policy';?>" target="_blank">Learn More</a> before you request removal.</p>
<?php include(TEMPLATEPATH.'/inc/forms/form-data-removal-request.php');?>
</div>
<!-- Removal -->
</div>
<div class="content_three content_right">
<div class="post_text">
<h1>Privacy Links</h1>
<p>
<a href="<?php echo get_bloginfo('url').'/privacy-center';?>">Privacy Center &raquo;</a></br>
<a href="<?php echo get_bloginfo('url').'/privacy-policy';?>">Privacy Policy &raquo;</a></br>
<a href="<?php echo get_bloginfo('url').'/terms-of-use';?>">Terms of Use &raquo;</a></br>
<a href="<?php echo get_bloginfo('url').'/contact-us';?>">Contact Us &raquo;</a></br>
</p>
</div>
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

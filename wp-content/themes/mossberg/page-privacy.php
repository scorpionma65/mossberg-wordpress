<?php
/*
Template Name: Privacy
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<div class="content_nine content_left">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\"><h1>".$post->post_title."</h1>".wpautop($post->post_content)."</div>";
endwhile;
?>
<!-- Posts -->
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

<?php
/*
Template Name: Announcement
*/
?>
<?php get_header('modal'); ?>

<div class="content_container_popup">
<div class="content_popup_video">
<div class="content_twelve content_full">
<div class="announcement_container">
<?php 
while ( have_posts() ) : the_post(); 
	echo $post->post_content;
endwhile;
?>
</div>
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer('none'); ?>

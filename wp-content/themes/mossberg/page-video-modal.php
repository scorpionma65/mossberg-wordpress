<?php
/*
Template Name: Video Modal
*/
?>
<?php get_header('modal'); ?>

<div class="content_container_popup">
<div class="content_popup_video">
<div class="video_modal">
<?php 
$video = $post->post_content;
echo $video;
?>
</div>
</div>
</div>

<?php get_footer('none'); ?>
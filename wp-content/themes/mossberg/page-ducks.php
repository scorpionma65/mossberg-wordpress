<?php
/*
Template Name: Ducks Sweepstakes
*/
?>
<?php get_header(); ?>
<script>
function toggle_volume() {
	var video = document.getElementById('video_player');
	if(video.muted == true) {
		video.muted = false;
		} else {
		video.muted = true;
	}
}
</script>
<!-- Video -->
<?php
$video_display = "muted=\"muted\" style=\"display:none;\"";
if(empty($_COOKIE['mossberg_ducks']) || $_COOKIE['mossberg_ducks'] == 'video') {
	$video_display = "style=\"display:inherit;\"";
}
?>
<div class="video_volume" onclick="toggle_volume()" <?php echo $video_display;?>></div>
<div class="video">
<video class="video_player" autoplay="autoplay" id="video_player" <?php echo $video_display;?>>
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-ducks.mp4" type="video/mp4">
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-ducks.webm" type="video/webm">
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-ducks.ogv" type="video/ogg">
</video>
<!-- Video -->
<!-- Offer Text -->
<div class="ducks_offer">
<?php
while(have_posts()):the_post();
    echo "<div class=\"ducks_offer_text\">".wpautop($post->post_content)."</div>";
endwhile;
?>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
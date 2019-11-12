<?php
/*
Template Name: Home Video
*/
?>
<?php get_header(); ?>

<script async type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script async type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-scroll-page.js"></script>
<script>
function toggle_volume() {
	var video = document.getElementById('video_player');
	if(video.muted == true) {
		video.muted = false;
		} else {
		video.muted = true;
	}
}
function play_video() {
	var video = document.getElementById('video_player');
	video.play();
}
</script>

<!-- Welcome Video 
<div class="content_video desktop">
<?php
//// Video Poster
//$args = array('category_name'=>'video-poster');
//query_posts($args);
//while(have_posts()):the_post();
//	$poster_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
//endwhile;
?>
<div class="home_video">
<div class="home_video_volume" onclick="toggle_volume()"></div>
<video class="home_video_player" loop="loop" id="video_player" muted="muted" autoplay="autoplay">
<source src="<?php //bloginfo('home');?>/wp-content/uploads/video/mossberg-mc1.mp4" type="video/mp4">
<source src="<?php //bloginfo('home');?>/wp-content/uploads/video/mossberg-mc1.webm" type="video/webm">
<source src="<?php //bloginfo('home');?>/wp-content/uploads/video/mossberg-mc1.ogv" type="video/ogg">
</video>
<div class="home_video_text">
<?php
//$cat_slug = 'home-feature';
//$args = array('category_name'=>$cat_slug,'posts_per_page'=>'1');
//query_posts($args);
//while(have_posts()):the_post();
//    echo "<div class=\"feature_container\">
//	<div class=\"feature_title\">".$post->post_title."</div>
//	<div class=\"feature_text\">".$post->post_content."</div>
//	</div>";
//endwhile;
//wp_reset_query();
?>
</div>
</div>
</div>
 Welcome Video -->
<!-- Welcome Mobile 
<div class="content_container mobile">
<?php
//$cat_slug = 'home-feature';
//$args = array('category_name'=>$cat_slug,'posts_per_page'=>'1');
//query_posts($args);
//while(have_posts()):the_post();
//	$post_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
//    echo "<div class=\"home_welcome\" style=\"background-image:url($post_image);\">
//	<div class=\"feature_container\">
//	<div class=\"feature_title\">".$post->post_title."</div>
//	<div class=\"feature_text\">".$post->post_content."</div>
//	</div>
//	</div>";
//endwhile;
//wp_reset_query();
?>
</div>
 Welcome Mobile -->

<!-- Slider -->
<div class="content_slider_tab">
<?php include(TEMPLATEPATH.'/inc/inc-slider-tab-video.php');?>
</div>
<!-- Slider -->

<!-- Home Announcement -->
<?php
$cat_slug = 'home-announcement';
$args = array('category_name'=>$cat_slug,'posts_per_page'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$announcement_content = wpautop($post->post_content);
	$announcement_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
    echo "<div class=\"content_container\">
	<div class=\"content\">
	<div class=\"home_announcement_container\" style=\"background-image:url($announcement_image);\">
	<div class=\"home_announcement_text\">$announcement_content</div>
	</div>
	</div>
	</div>";
endwhile;
wp_reset_query();
?>
<!-- Home Announcement -->

<!-- Home Callouts -->
<div class="content_container_fade_home"></div>
<div class="content_container_black">
<div class="content_callouts">
<?php
$cat_slug = 'home-callouts';
$cat = get_category_by_slug($cat_slug); 
$cat_id = $cat->term_id;
$category = get_category($cat_id);
$category_name = $category->name;
echo "<div class=\"callouts_header\">$category_name</div>
<div class=\"callouts_container\">";
// Featured
$feature_slug = 'home-callouts-featured';
$feature_ids = array();
$args = array('category_name'=>$feature_slug,'posts_per_page'=>'5','orderby'=>'rand');
$featured_query = query_posts($args);
$callouts_open = 5 - count($featured_query);
while(have_posts()):the_post();
	$callout_title = $post->post_title;
	$callout_tags = get_the_tags();
	$callout_link = get_the_permalink();
	$callout_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
	$callout_image = $callout_image[0]; 
    echo "<a href=\"$callout_link\" class=\"callouts_block\">
	<div class=\"callouts_image\" style=\"background-image:url($callout_image);\"></div>
	<div class=\"callouts_text\">$callout_title</div>
	</a>";
	$feature_ids[] = $post->ID;
endwhile;
wp_reset_query();
// Callouts
$args = array('category_name'=>$cat_slug,'posts_per_page'=>$callouts_open,'orderby'=>'rand','post__not_in'=>$feature_ids);
query_posts($args);
while(have_posts()):the_post();
	$callout_title = $post->post_title;
	$callout_tags = get_the_tags();
	$callout_link = get_the_permalink();
	$callout_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
	$callout_image = $callout_image[0]; 
	echo "<a href=\"$callout_link\" class=\"callouts_block\">
	<div class=\"callouts_image\" style=\"background-image:url($callout_image);\"></div>
	<div class=\"callouts_text\">$callout_title</div>
	</a>";
endwhile;
wp_reset_query();
echo "</div>";
?>
</div>
</div>
<!-- Home Callouts -->

<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->

<?php get_footer(); ?>

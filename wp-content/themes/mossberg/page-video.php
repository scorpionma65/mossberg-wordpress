<?php
/*
Template Name: Video Full-Screen
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
function play_video() {
	var video = document.getElementById('video_player');
	video.play();
}
</script>
<!-- Video -->
<?php
// Video Poster
$args = array('category_name'=>'video-poster');
query_posts($args);
while(have_posts()):the_post();
	$poster_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
endwhile;
?>
<div class="video_volume" onclick="toggle_volume()"></div>
<div class="video">
<video class="video_player" loop="loop" id="video_player" muted="muted" autoplay="autoplay">
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-home.mp4" type="video/mp4">
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-home.webm" type="video/webm">
<source src="<?php bloginfo('home');?>/wp-content/uploads/video/mossberg-home.ogv" type="video/ogg">
</video>
<div class="video_text">
<!-- Home Feature -->
<?php
$cat_slug = 'home-feature';
$args = array('category_name'=>$cat_slug,'show_posts'=>'1');
query_posts($args);
while(have_posts()):the_post();
    echo "<div class=\"feature_container\">
	<div class=\"feature_title\">".$post->post_title."</div>
	<div class=\"feature_text\">".$post->post_content."</div>
	</div>";
endwhile;
wp_reset_query();
?>
<!-- Home Feature -->
</div>
</div>
<!-- Video -->

<!-- HubSpot -->
<script type="text/javascript">
(function(d,s,i,r) {
if (d.getElementById(i)){return;}
var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
n.id=i;n.src='//js.hs-analytics.net/analytics/'+(Math.ceil(new Date()/r)*r)+'/479666.js';
e.parentNode.insertBefore(n, e);
})(document,"script","hs-analytics",300000);
</script>
<!-- HubSpot -->
<!-- Centro -->
<script type="text/javascript">
var ssaUrl = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'centro.pixel.ad/iap/5c52bde2ffb70fb2';new Image().src = ssaUrl;
</script>
<!-- Centro -->

</body>
</html>
<?php
/**
* Single
* @package Mossberg
* @since Mossberg 1.0
*/
?>

<?php get_header('modal'); ?>

<div class="content_container_popup">
<div class="content_popup">
<div class="announcement_container">
<?php 
//Popup
global $post;
while ( have_posts() ) : the_post(); 
	$popup_slug = $post->post_name;
	$popup_content = $post->post_content;
	$popup_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
	$popup_type = get_post_meta($post->ID, 'wpcf-popup-type', true);
	$popup_expires = 60 * get_post_meta($post->ID, 'wpcf-popup-cookie-expiration', true);
	$popup_width = get_post_meta($post->ID, 'wpcf-popup-width', true);
	$popup_height = get_post_meta($post->ID, 'wpcf-popup-height', true);
	$popup_link = get_post_meta($post->ID, 'wpcf-popup-link', true);
	// Display
	if($popup_type == 'popup-video') {
		echo $popup_content;
		} else {
		if($popup_link) {
			echo "<a href=\"$popup_link\" target=\"_parent\"><img src=\"$popup_image\"/></a>";
			} else {
			echo "<img src=\"$popup_image\"/>";
		}
	}
	endwhile;
?>
</div>
</div>
</div>

<?php get_footer('none'); ?>
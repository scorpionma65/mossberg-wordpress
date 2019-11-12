<?php
// Popup
global $post;
$popup_tag = $post->post_name;  
if(!$popup_tag) {
	$popup_tag = 'home';
}
$args = array('tag'=>$popup_tag,'posts_per_page'=>'1','post_type'=>'popup');
query_posts($args);
if(have_posts()) {
	while(have_posts()):the_post();
		$popup_slug = $post->post_name;
		$popup_content = $post->post_content;
		$popup_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
		$popup_type = get_post_meta($post->ID, 'wpcf-popup-type', true);
		$popup_expires = 60 * get_post_meta($post->ID, 'wpcf-popup-cookie-expiration', true);
		$popup_width = get_post_meta($post->ID, 'wpcf-popup-width', true);
		$popup_height = get_post_meta($post->ID, 'wpcf-popup-height', true);
		$popup_cookie = 'popup-'.$popup_slug;
		// Cookie
		if(empty($_COOKIE[$popup_cookie])) {	
			setcookie($popup_cookie, $popup_cookie, time()+$popup_expires);
			// Shadowbox
			include(TEMPLATEPATH.'/inc/inc-popup-shadowbox.php');
		}
	endwhile;
}
?>

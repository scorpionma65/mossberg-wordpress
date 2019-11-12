<?php
// CTA Posts
if(!$cta_slug || $cta_slug == NULL) {
	$cta_slug = 'cta-sidebar';
}
if(!$cta_limit || $cta_limit == NULL) {
	$cta_limit = 2;
}
$args = array('category_name'=>$cta_slug,'posts_per_page'=>$cta_limit,'orderby'=>'rand');
query_posts($args);
$count = 1;
while(have_posts()):the_post();
	$cta_hubspot = $post->post_content;
	$cta_link = get_post_meta(get_the_ID(), 'CTA Link', true);
	$cta_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
	$cta_image = $cta_image[0]; 
	$cta_target = NULL;
	if(strpos($cta_link,'www.mossberg.com') === FALSE) {
		$cta_target = "target=\"_blank\"";
	}
	if($cta_image != NULL) {
		echo "<a href=\"$cta_link\" $cta_target><img src=\"$cta_image\"/></a>";
		} else {
		if($cta_hubspot != NULL) {
			echo $cta_hubspot;
		}
	}
endwhile;
wp_reset_query();
?>

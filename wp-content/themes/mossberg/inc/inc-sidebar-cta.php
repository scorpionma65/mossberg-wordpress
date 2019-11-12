<?php
// CTA Posts
if(!$cta_slug || $cta_slug == NULL) {
	$cta_slug = 'cta-sidebar';
}
if(!$cta_limit || $cta_limit == NULL) {
	$cta_limit = 2;
}

// Featured
$cta_category = get_category_by_slug($cta_slug); 
$cta_category_id = $cta_category->term_id;
$cta_featured_category = get_category_by_slug('cta-featured'); 
$cta_featured_category_id = $cta_featured_category->term_id;

$featured = FALSE;
$featured_id = FALSE;
$featured_categories = array($cta_category_id,$cta_featured_category_id);

if($cta_slug != 'sign-up') {
	$args = array('category__and'=>$featured_categories,'posts_per_page'=>'1','orderby'=>'rand');
	query_posts($args);
	$count = 1;
	while(have_posts()):the_post();
		$featured = TRUE;
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
}
if($featured) {
	$cta_limit = $cta_limit - 1;
	$featured_id = $post->ID;
}
wp_reset_query();

// Mixed
if($cta_limit > 0) {
	$args = array('category_name'=>$cta_slug,'posts_per_page'=>$cta_limit,'orderby'=>'rand','post__not_in' => array($featured_id));
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
}
?>

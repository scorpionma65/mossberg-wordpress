<?php
// Navigation Menus
add_action( 'after_setup_theme', 'register_menus' );
function register_menus() {
  register_nav_menu( 'primary', __( 'Main Menu', 'main-menu' ) );
  register_nav_menu( 'header', __( 'Header Menu', 'header-menu' ) );
  register_nav_menu( 'footer', __( 'Footer Menu', 'footer-menu' ) );
  register_nav_menu( 'mobile', __( 'Mobile Menu', 'mobile-menu' ) );
  register_nav_menu( 'law-enforcement', __( 'Law Enforcement Menu', 'law-enforcement-menu' ) );
  register_nav_menu( 'customer-service', __( 'Customer Service Menu', 'customer-service-menu' ) );
  register_nav_menu( 'firearms', __( 'Firearms Menu', 'firearms-menu' ) );
  register_nav_menu( 'community', __( 'Community Menu', 'community-menu' ) );
  register_nav_menu( 'top', __( 'Top Menu', 'top-menu' ) );
  register_nav_menu( 'blog', __( 'Blog Menu', 'blog-menu' ) );
  register_nav_menu( 'store', __( 'Store Menu', 'store-menu' ) );
  register_nav_menu( 'store-mobile', __( 'Store Mobile Menu', 'store-mobile-menu' ) );
}

// WooCommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Catergory/Series/Model Check
function series_in_category($category_id,$series_id) {
	$cpids = array();
	$args = array('post_type'=>'product','product_cat'=>$category_id,'posts_per_page'=>-1,'show_posts'=>-1);
	query_posts($args);
	while(have_posts()):the_post();
		$cpids[] = get_the_ID();
	endwhile;
	
	$spids = array();
	$args = array('post_type'=>'product','product_cat'=>$series_id,'posts_per_page'=>-1,'show_posts'=>-1);
	query_posts($args);
	while(have_posts()):the_post();
		$spids[] = get_the_ID();
	endwhile;
	
	if(!empty($cpids) && !empty($spids)) {
		$ids = array_intersect($spids,$cpids);
		if(!empty($ids)) {
			$result = 1;
			} else {
			$result = 0;
		}
		} else {
		$result = 0;
	}	
	return $result;
}

// Map Haversine
function map_haversine($latitude_start, $longitude_start, $latitude_end, $longitude_end, $units) {
	if($units) {
		switch($units) {
			case 'meters':
			$earth_radius = 6371000;
			break;
			case 'kilometers':
			$earth_radius = 6371;
			break;
			case 'miles':
			$earth_radius = 3959;
			break;
		}
		} else {
		$units = 'meters';
		$earth_radius = 6371000;
	}
	$latitude_start = deg2rad($latitude_start);
	$longitude_start = deg2rad($longitude_start);
	$latitude_end = deg2rad($latitude_end);
	$longitude_end = deg2rad($longitude_end);
	$latitude_delta = $latitude_start - $latitude_end;
	$longitude_delta = $longitude_start - $longitude_end;
	
	$angle = 2 * asin(sqrt(pow(sin($latitude_delta / 2), 2) + 
	cos($latitude_start) * cos($latitude_end) * pow(sin($longitude_delta / 2), 2)));
	$distance = $angle * $earth_radius;
	$haversine = array('distance'=>$distance,'units'=>$units);
	return $haversine;
}

// Attachment ID From URL
function get_attachment_id_from_url( $attachment_url = '' ) {
 	global $wpdb;
	$attachment_id = false;
 	if ( '' == $attachment_url )
		return;
 	$upload_dir_paths = wp_upload_dir();
 	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}
	return $attachment_id;
}

// Attachment Data
function get_attachment_data( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

// RSS Featured Image
function featuredtoRSS($content) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');

// RSS Custom Author
function custom_feed() {  
    load_template( TEMPLATEPATH . '/feed-rss2.php');  
}  
add_feed('rss2', 'custom_feed');

// Single Post Templates
define(SINGLE_PATH, TEMPLATEPATH . '/single');
add_filter('single_template', 'my_single_template');
function my_single_template($single) {
	global $wp_query, $post;
	// ID
	if(file_exists(SINGLE_PATH.'/single-'.$post->ID.'.php')) {
		return SINGLE_PATH.'/single-'.$post->ID.'.php';
	}	
	// Type
	foreach((array)get_post_type() as $type){ 
		if(file_exists(SINGLE_PATH.'/single-type-'.sanitize_title($type).'.php')) {
			return SINGLE_PATH.'/single-type-'.sanitize_title($type).'.php';
		}
	}
	// Category
	foreach((array)get_the_category() as $category){ 
		if(file_exists(SINGLE_PATH.'/single-category-'.$category->slug.'.php')) {
			return SINGLE_PATH.'/single-category-'.$category->slug.'.php';
		}
	}
	// Tag
	$wp_query->in_the_loop = true;
	foreach((array)get_the_tags() as $tag){	
		if(file_exists(SINGLE_PATH.'/single-tag-'.$tag->slug.'.php')) {
			return SINGLE_PATH.'/single-tag-'.$tag->slug.'.php';	
		}
	}
	$wp_query->in_the_loop = false;
	// Author
	$curauth = get_userdata($wp_query->post->post_author);	
	if(file_exists(SINGLE_PATH.'/single-author-'.$curauth->user_nicename.'.php')) {
		return SINGLE_PATH.'/single-author-'.$curauth->user_nicename.'.php';	
	}
	// Default
	if(file_exists(SINGLE_PATH.'/single.php')) {
		return SINGLE_PATH.'/single.php';	
	}	
	// Template
	return $single;
}

// MIME Uploads
add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types ) {
  $mime_types['ogv'] = 'video/ogv';
  return $mime_types;
}
?>
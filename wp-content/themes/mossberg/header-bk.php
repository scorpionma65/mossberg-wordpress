<?php
/**
* Header
* @package Mossberg
* @since Mossberg 1.0
*/
?>
<?php
// Redirect Cookie
//if(!is_page('video')) {
//	if(empty($_COOKIE['mossberg_visitor'])) {
//		if(setcookie("mossberg_visitor", "Welcome to Mossberg", time()+15000000)) {
//			if(is_front_page() && !wp_is_mobile()) {
//				header('Location: '.bloginfo('home').'/video/');	
//			}
//		}
//	}
//}
// Ducks Cookie
if(is_page('ducks')) {
	if(empty($_COOKIE['mossberg_ducks']) && !wp_is_mobile()) {
		setcookie("mossberg_ducks", "video", time()+15000000, '/');
		} else {
		setcookie("mossberg_ducks", "no-video", time()+15000000, '/');
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width"/>
<title>
<?php 
// Blog Title
if(is_single() && in_category('blog')) {
	echo 'Mossberg Blog | ';
}
wp_title( '|', true, 'right' );
?>
</title>
<link rel="stylesheet" type="text/css" href="//fast.fonts.net/cssapi/a28ad9b5-065c-4065-a810-7a64c971de15.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen"/>
<link rel="profile" href="//gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-mobile-navigation.js"></script>
</head>

<?php
// Set Background
$body_class = NULL;
$header_class = 'header_container';
if(!is_front_page()) {
	$body_class = "body_background";
	// LE
	$le_page = 'law-enforcement';
	$le_page_id = get_page_by_path($le_page);
    $le_page_id = $le_page_id->ID;
	if(is_page($le_page) || $post->post_parent==$le_page_id) {
		$body_class = 'body_background_le';
		} else {
		if(isset($_GET['le'])) {
			$body_class = 'body_background_le';
		}		
	}
	// Video
	$video_page = 'video';
	if(is_page($video_page)) {
		$body_class = 'body_video';
		$header_class = 'header_container_video';
	}
	// Ducks
	$ducks_page = 'ducks';
	if(is_page($ducks_page)) {
		$body_class = 'body_ducks';
		$header_class = 'header_container_video';
	}
}
?>
<body class="<?php echo $body_class;?>">
<!-- Header -->
<div class="<?php echo $header_class;?> desktop" id="header">
<?php
// Video Tab
if(is_front_page()) {
	echo "<a href=\"".get_bloginfo('home')."/video\" class=\"header_tab header_tab_right\">&raquo; Play Welcome Video</a>";
}
if(is_page('video')) {
	echo "<a href=\"".get_bloginfo('home')."/video\" class=\"header_tab header_tab_right\">&raquo; Replay Video</a>";
}
if(is_page('ducks')) {
	echo "<a href=\"".get_bloginfo('home')."/ducks-video\" class=\"header_tab header_tab_right\">&raquo; Replay Video</a>";
}
?>
<div class="header">
<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo.png" id="header_logo" class="header_logo"/></a>
<div class="header_tools">
<!-- Top Nav -->
<?php 
wp_nav_menu(array(
	'theme_location'  => 'top',
	'container'       => 'div',
	'container_class' => 'header_top',
	'container_id'    => 'header-top',
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<!-- Top Nav -->
<div class="header_search">
<form action="<?php bloginfo('home');?>/search" id="cse-search-box" class="form_body">
<input type="hidden" name="cx" value="015573841657081777872:uqqqydozhhk" />
<input type="hidden" name="cof" value="FORID:10" />
<input type="hidden" name="ie" value="UTF-8" />
<input type="hidden" name="-fileType" value="pdf" />
<input type="text" name="q" />
<input type="hidden" name="sa" value="Search" />
</form>
</div>
</div>
</div>
<!-- Main Nav -->
<?php 
wp_nav_menu(array(
	'theme_location'  => 'primary',
	'container'       => 'div',
	'container_class' => 'header_navigation',
	'container_id'    => 'header-navigation',
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<!-- Main Nav -->
</div>
<!-- Header -->

<!-- Header Mobile -->
<div class="header_mobile mobile" id="header_mobile" onClick="toggle_navigation('header-navigation-mobile')">
<div class="header">
<img src="<?php bloginfo('stylesheet_directory');?>/template/icons/icon-menu-mobile.png" class="header_menu"/>
<img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo-mobile.png" class="header_logo" id="header_logo" />
</div>
</div>
<!-- Mobile Nav -->
<?php 
wp_nav_menu(array(
	'theme_location'  => 'mobile',
	'container'       => 'div',
	'container_class' => 'header_navigation_mobile',
	'container_id'    => 'header-navigation-mobile',
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<!-- Mobile Nav -->
<!-- Header Mobile -->

<!-- Main -->

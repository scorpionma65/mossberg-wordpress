<?php
/**
* Header
* @package Mossberg
* @since Mossberg 1.0
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width"/>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="//fast.fonts.net/cssapi/a28ad9b5-065c-4065-a810-7a64c971de15.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen"/>
<link rel="profile" href="//gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_enqueue_script('jquery-ui-draggable');?> 
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-mobile-navigation.js"></script>
</head>

<?php
// Set Background
$body_class = 'body_background_store';
$header_class = 'header_container';
?>
<body class="<?php echo $body_class;?>">

<!-- Header -->
<div class="<?php echo $header_class;?> desktop" id="header">
<!-- Notice -->
<div class="header_notice"><a href="http://www.mossberg.com/maverickhunterrecall/" target="_blank">Maverick Hunter&trade; Over/Under Recall Notice &raquo;</a></div>
<!-- Notice -->

<div class="header">
<a href="<?php echo esc_url(home_url('/'));?>/parts-and-accessories"><img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo-store.png" id="header_logo" class="header_logo"/></a>
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
<?php get_search_form( true ); ?>
</div>
</div>
</div>
<!-- Store Nav -->
<?php 
wp_nav_menu(array(
	'theme_location'  => 'store',
	'container'       => 'div',
	'container_class' => 'header_navigation_store',
	'container_id'    => 'header-navigation-store',
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<!-- Store Nav -->
</div>
<!-- Header -->

<!-- Header Mobile -->
<div class="header_mobile mobile" id="header_mobile" onClick="toggle_navigation('header-navigation-mobile')">
<div class="header">
<img src="<?php bloginfo('stylesheet_directory');?>/template/icons/icon-menu-mobile.png" class="header_menu"/>
<img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo-store-mobile.png" class="header_logo" id="header_logo" />
</div>
</div>
<div id="header-navigation-mobile" class="header_navigation_mobile">
<?php 
wp_nav_menu(array(
	'theme_location'  => 'store-mobile',
	'container'       => FALSE,
	'menu_class'      => 'nav_menu',
	'menu_id'         => 'nav-menu'
));
?>
<div class="header_search">
<?php get_search_form( true ); ?>
</div>
</div>
<!-- Notice 
<div class="header_notice">ALERT: Mossberg.com will be unavailable between 2:00-5:00AM Eastern while we perform scheduled maintenance.</div> 
 Notice -->
<!-- Header Mobile -->

<!-- Main -->

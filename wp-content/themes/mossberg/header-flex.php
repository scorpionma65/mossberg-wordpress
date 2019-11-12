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
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen,print"/>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php wp_head(); ?>
</head>

<body class="body_flex">

<div class="flex_header">
<img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo-flex.png" class="flex_logo"/>
<img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-tagline-flex.png" class="flex_tagline"/>
</div>

<!-- Main -->

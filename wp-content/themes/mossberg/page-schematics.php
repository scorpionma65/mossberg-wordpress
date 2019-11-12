<?php
/*
Template Name: Schematics
*/
?>
<?php get_header('store'); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init({ });</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">

<div class="content_container">

<!-- Slider -->
<div class="content_slider_firearms">
<?php 
$cat_slug = 'schematics-slider';
include(TEMPLATEPATH.'/inc/inc-slider-firearms.php');
?>
</div>
<!-- Slider -->

<div class="content">

<div class="content_three content_left content_sidebar">
<!-- Menu -->
<?php include(TEMPLATEPATH.'/inc/inc-menu-schematics.php');?>
<!-- Menu -->
</div>
<div class="content_nine content_right">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<!-- Schematics -->
<div class="schematic_tile_container">
<?php
// Schematics
$terms = get_terms('schematic-model', array('hide_empty'=>false,));
foreach($terms as $key => $value) {
	$schematic_title = $value->name;
	$schematic_image = trim($value->description);
	$schematic_slug = $value->slug;
	$schematic_parent = $value->parent;
	$schematic_link = get_bloginfo('home').'/schematic?model='.$schematic_slug;
	if($schematic_parent) {
		$parent = get_term($schematic_parent, 'schematic-model'); 	
		$parent_slug = $parent->slug;
		if(strpos($schematic_title,'COMING SOON') !== FALSE) {
			$schematic_title = str_replace('COMING SOON', '', $schematic_title);
			echo "<div href=\"$schematic_link\" class=\"schematic_tile_block\">
			<div class=\"schematic_tile_image\" style=\"background-image:url($schematic_image);\">
			<div class=\"schematic_tile_mask\" >COMING SOON</div>
			</div>
			<div class=\"schematic_tile_title\">$schematic_title</div>
			</div>";
			} else {
			if($parent_slug == 'rifle-schematic') {
				echo "<a href=\"".get_bloginfo('home')."/schematic-caliber?id=$schematic_slug\" rel=\"shadowbox[];width=300;height=160;\" class=\"schematic_tile_block\">
				<div class=\"schematic_tile_image\" style=\"background-image:url($schematic_image);\">
				<div class=\"schematic_tile_mask\" >VIEW &amp; SHOP</div>
				</div>
				<div class=\"schematic_tile_title\">$schematic_title</div>
				</a>";
				} else {
				echo "<a href=\"$schematic_link\" class=\"schematic_tile_block\">
				<div class=\"schematic_tile_image\" style=\"background-image:url($schematic_image);\">
				<div class=\"schematic_tile_mask\" >VIEW &amp; SHOP</div>
				</div>
				<div class=\"schematic_tile_title\">$schematic_title</div>
				</a>";
			}
		}
	}
}
?>
</div>
<!-- Schematics -->
</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
* Woocommerce Product View
*/
if(!defined('ABSPATH')) {
	exit; 
}
?>
<?php get_header('shop'); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-tabs.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553fdea33c12861b" async="async"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init({ continuous:	true });</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">

<?php 
// Woocommerce Before Hook
//do_action( 'woocommerce_before_main_content' );
?>

<div class="content_container">
<?php
// Product
global $post;
$product_id = $post->ID;
$product_title = $post->post_title;
$product_slug = $post->post_name;
$product_status = $post->post_status;
$product_link = get_the_permalink($post_id);
$product_sku = get_post_meta($product_id, '_sku', true);
$product_price = number_format(get_post_meta($product_id, '_price', true),2);
$product_caliber = get_post_meta($product_id, 'wpcf-caliber', true);
$product_gauge = get_post_meta($product_id, 'wpcf-gauge', true);
$product_capacity = get_post_meta($product_id, 'wpcf-capacity', true);
$product_chamber = get_post_meta($product_id, 'wpcf-chamber', true);
$product_barrel_type = get_post_meta($product_id, 'wpcf-barrel-type', true);
$product_barrel_length = get_post_meta($product_id, 'wpcf-barrel-length', true);
$product_sight_type = get_post_meta($product_id, 'wpcf-sight-type', true);
$product_scope_type = get_post_meta($product_id, 'wpcf-scope-type', true);
$product_choke = get_post_meta($product_id, 'wpcf-choke', true);
$product_twist = get_post_meta($product_id, 'wpcf-twist', true);
$product_lop_type = get_post_meta($product_id, 'wpcf-lop-type', true);
$product_lop = get_post_meta($product_id, 'wpcf-lop', true);
$product_barrel_finish = get_post_meta($product_id, 'wpcf-barrel-finish', true);
$product_stock = get_post_meta($product_id, 'wpcf-stock', true);
$product_weight = get_post_meta($product_id, 'wpcf-weight', true);
$product_length = get_post_meta($product_id, 'wpcf-length', true);
$product_shell_size = get_post_meta($product_id, 'wpcf-shell-size', true);
$product_upc = get_post_meta($product_id, 'wpcf-upc', true);
$product_frame_type = get_post_meta($product_id, 'wpcf-frame-type', true);
$product_frame_finish = get_post_meta($product_id, 'wpcf-frame-finish', true);
$product_safety = get_post_meta($product_id, 'wpcf-safety', true);
$product_slide_finish = get_post_meta($product_id, 'wpcf-slide-finish', true);
$product_height = get_post_meta($product_id, 'wpcf-height', true);
$product_width = get_post_meta($product_id, 'wpcf-width', true);
$product_barrel_rifling = get_post_meta($product_id, 'wpcf-barrel-rifling', true);
$product_sight_radius = get_post_meta($product_id, 'wpcf-sight-radius', true);
$product_front_sight = get_post_meta($product_id, 'wpcf-front-sight', true);
$product_rear_sight = get_post_meta($product_id, 'wpcf-rear-sight', true);
$product_trigger = get_post_meta($product_id, 'wpcf-trigger', true);
$product_trigger_pull = get_post_meta($product_id, 'wpcf-trigger-pull', true);
$product_trigger_travel = get_post_meta($product_id, 'wpcf-trigger-travel', true);	
$product_gog = get_post_meta($product_id, 'wpcf-gog-active', true);
$product_nfdn = get_post_meta($product_id, 'wpcf-nfdn-active', true);
$product_tss = get_post_meta($product_id, 'wpcf-tss-active', true);
$product_schematic = get_post_meta($product_id, 'wpcf-schematic-model', true);
$product_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'full');
$product_image = $product_image_src[0];

//// Buy GOG
//$product_buy_gog = "http://www.galleryofguns.com/genie/default.aspx?item=$product_sku";
//$check_buy_gog = file_get_contents($product_buy_gog);
//if(strpos($check_buy_gog, 'Please try another item number or try again later.') === FALSE){ 
//	$button_buy_gog = "<a href=\"$product_buy_gog\" target=\"_blank\" class=\"model_buy_button\"><img src=\"".get_bloginfo('stylesheet_directory')."/template/buttons/button-buy-gog.png\"/></a>";
//	} else {
//	$button_buy_gog = NULL;
//}
//// Buy NFDN
//$product_buy_nfdn = "http://www.nfdnetwork.com/mossberg/catalog_detail.php?upc=$product_upc";
//$check_buy_nfdn = file_get_contents($product_buy_gog);
//if(strpos($check_buy_nfdn, '<div class="no_content">Coming Soon</div>') === FALSE){ 
//	$button_buy_nfdn = "<a href=\"$product_buy_nfdn\" target=\"_blank\" class=\"model_buy_button\"><img src=\"".get_bloginfo('stylesheet_directory')."/template/buttons/button-buy-nfdn.png\"/></a>";
//	} else {
//	$button_buy_nfdn = NULL;
//}
//// Buy TSS
//$product_buy_tss = "http://www.theshootingstore.com/product.php?id=3555&upc=$product_upc";
//$check_buy_tss = file_get_contents($product_buy_tss);
//if(strpos($check_buy_tss, 'Product Not Found') === FALSE){ 
//	$button_buy_tss = "<a href=\"$product_buy_tss\" target=\"_blank\" class=\"model_buy_button\"><img src=\"".get_bloginfo('stylesheet_directory')."/template/buttons/button-buy-tss.png\"/></a>";
//	} else {
//	$button_buy_tss = NULL;
//}

// Categories
$product_categories = wp_get_post_terms($product_id, 'product_cat');

// Specs
$product_specs = array(
'Caliber'=>$product_caliber,
'Gauge'=>$product_gauge,
'Frame'=>$product_frame_type,
'Capacity'=>$product_capacity,
'Safety'=>$product_safety,
'Chamber'=>$product_chamber,
'Barrel Type'=>$product_barrel_type,
'Barrel Length'=>$product_barrel_length,
'Barrel Rifling'=>$product_barrel_rifling,
'Sight/Base'=>$product_sight_type,
'Scope'=>$product_scope_type,
'Sight Radius'=>$product_sight_radius,
'Front Sight'=>$product_front_sight,
'Rear Sight'=>$product_rear_sight,
'Choke'=>$product_choke,
'Twist'=>$product_twist,
'LOP Type'=>$product_lop_type,
'LOP'=>$product_lop,
'Trigger'=>$product_trigger,
'Trigger Pull'=>$product_trigger_pull,
'Trigger Travel'=>$product_trigger_travel,
'Frame Finish'=>$product_frame_finish,
'Barrel Finish'=>$product_barrel_finish,
'Slide Finish'=>$product_slide_finish,
'Stock Finish'=>$product_stock,
'Weight'=>$product_weight,
'Length'=>$product_length,
'Height'=>$product_height,
'Width'=>$product_width,
'Shell Size'=>$product_shell_size,
'UPC'=>$product_upc
);

// Series
$parent = 80;
$children = get_term_children($parent, 'product_cat');
$terms = wp_get_post_terms($product_id, 'product_cat');
foreach($terms as $term) {
	$term_id = $term->term_id;
	$term_name = $term->name;
	$term_slug = $term->slug;
	$term_parent = $term->parent;
	$child_terms = get_term_children($term_id, 'product_cat'); 
	if(count($child_terms) == 0) {
		if(in_array($term_id,$children)) {
			$series_id = $term_id;
			$series_name = $term_name;
			$series_slug = $term_slug;
			$series_parent = $term_parent;
			$series_link = get_term_link($series_slug, 'product_cat');
			if($series_parent != 80 && $series_parent != 108) {
				$series_open_id = 'series'.$series_parent;
				$series_link_id = 'series'.$series_parent;
				} else {
				$series_open_id = 'series'.$series_id;
				$series_link_id = 'series'.$series_id;
			}
		}
	}
}
?>

<!-- LE Banner -->
<?php 
if(!empty($_GET['le'])){
	include(TEMPLATEPATH.'/inc/inc-banner-le.php');
}
?>
<!-- LE Banner -->

<!-- Slider -->
<div class="content_slider_firearms">
<?php 
$cat_slug = $series_slug;
include(TEMPLATEPATH.'/inc/inc-slider-series.php');
?>
</div>
<!-- Slider -->

<div class="content">
<div class="content_three content_left content_sidebar">
<!-- Menu -->
<?php 
include(TEMPLATEPATH.'/inc/inc-menu-sticky.php');
if(!empty($_GET['le'])){
	include(TEMPLATEPATH.'/inc/inc-menu-firearms-le.php');
	} else {
	include(TEMPLATEPATH.'/inc/inc-menu-firearms.php');
}
?>
<!-- Menu -->
</div>
<div class="content_nine content_right">

<!-- Title -->
<div class="content_page">
<?php 
$menu_title = 'Firearms';
$menu_slug = 'firearms';
include(TEMPLATEPATH.'/inc/inc-firearms-header.php');
?>
<div class="breadcrumbs">
<?php 
// Breadcrumbs
$landing = get_bloginfo('home').'/firearms';
$breadcrumbs = array();
if($series_parent != 0 && $series_parent != $parent) {
	$term = get_term($series_parent, 'product_cat');
	$link_name = $term->name;
	$link_slug = $term->slug;
	$link_parent = $term->parent;
	if($link_parent == 23) {
		$link_url = $landing.'/'.$link_slug;
		} else {
		$link_url = get_term_link($link_slug, 'product_cat');
	}
	$breadcrumbs[] = "<a href=\"$link_url?tab=m\">$link_name</a>";
	if($link_parent != 0 && $link_parent != $parent) {
		$term = get_term($link_parent, 'product_cat');
		$link_name = $term->name;
		$link_slug = $term->slug;
		$link_parent = $term->parent;
		if($link_parent == 23) {
			$link_url = $landing.'/'.$link_slug;
			} else {
			$link_url = get_term_link($link_slug, 'product_cat');
		}
		$breadcrumbs[] = "<a href=\"$link_url?tab=m\">$link_name</a>";
		if($link_parent != 0 && $link_parent != $parent) {
			$term = get_term($link_parent, 'product_cat');
			$link_name = $term->name;
			$link_slug = $term->slug;
			$link_parent = $term->parent;
			if($link_parent == 23) {
				$link_url = $landing.'/'.$link_slug;
				} else {
				$link_url = get_term_link($link_slug, 'product_cat');
			}
			$breadcrumbs[] = "<a href=\"$link_url?tab=m\">$link_name</a>";
		}
	}
}
$breadcrumbs = array_reverse($breadcrumbs);
echo "<a href=\"$landing/\">Firearms</a> / ";
foreach($breadcrumbs as $breadcrumb) {
	echo $breadcrumb.' / ';
}
echo "<a href=\"$series_link?tab=m\">$series_name</a>";
?>

</div>
<div class="model_title"><h1><?php echo $product_title;?></h1></div>
<div class="model_sku">
#<?php echo $product_sku;?>
<?php 
$new = get_term_by('slug', 'new', 'product_cat');
$new_title = $new->name;
if(has_term('new', 'product_cat', $product_id)) {
	echo "<div class=\"model_new\">$new_title</div>";
}
?>
</div>
</div>
<!-- Title -->

<!-- Image -->
<?php
if(!empty($product_image)) {
	echo "<div class=\"model_image\"><img src=\"$product_image\"/></div>";
}
?>
<!-- Image -->

<!-- Buy -->
<div class="model_buy">
<div class="model_media">
<?php
$highres_link = NULL;
$highres_download = NULL;
$highres_slug = $product_sku.'-media';
$highres =  get_page_by_path($highres_slug);
if($highres) {
	$highres_id = $highres->ID;
	$highres_url = $highres->guid;
	$highres_link = "<a href=\"$highres_url\" download=\"$highres_url\"target=\"_blank\">Download High-Res Image &raquo;</a>";
	$highres_download = "<a href=\"".get_bloginfo('stylesheet_directory')."/download.php?id=$highres_id\" target=\"_blank\">Download High-Res Image &raquo;</a>";
}
echo $highres_link;
?>
</div>
<div class="model_msrp">MSRP: $<?php echo $product_price;?></div>
<div class="model_buy_text">Compare prices and shop:</div>
<?php
// GOG
$product_gog_inc = "/inc/inc-dealer-gog.php?id=$product_sku&msrp=$product_price";
// NFDN
$product_nfdn_inc = "/inc/inc-dealer-nfdn.php?id=$product_upc&msrp=$product_price";
// TSS
$product_tss_inc = "/inc/inc-dealer-tss.php?id=$product_upc&msrp=$product_price";
// Buy Now
$dealers = array('gog'=>array($product_gog, $product_gog_inc),'tss'=>array($product_tss, $product_tss_inc),'nfdn'=>array($product_nfdn, $product_nfdn_inc));
shuffle($dealers);
foreach($dealers as $key => $dealer) {
	if($dealer[0] != 'N') {
		echo "<iframe src=\"".get_bloginfo('stylesheet_directory').$dealer[1]."\" class=\"model_buy_button_frame\" scrolling=\"no\" frameborder=\"0\"></iframe>";
	}
}
?>
<a href="<?php bloginfo('url');?>/dealer-locator" class="model_buy_button" id="locate_dealer"><img src="<?php bloginfo('stylesheet_directory');?>/template/buttons/button-locate-dealer.png"/></a>
<?php
// Schematic Button
if($product_schematic) {
	echo "<a href=\"".get_bloginfo('url')."/schematic?model=$product_schematic\" class=\"model_buy_button\" id=\"product_schematic\"><img src=\"".get_bloginfo('stylesheet_directory')."/template/buttons/button-parts-schematic.png\"/></a>";
}
?>
<div class="model_buy_video">
<a href="<?php bloginfo('home');?>/video-buying-a-gun-online" rel="shadowbox[video];width=700;height=424;">Video: Buying a Gun Online &raquo;</a>
</div>
<div class="model_share">
Share:<div class="addthis_sharing_toolbox" data-url="<?php echo $product_link;?>" data-title="<?php echo "Mossberg | $post_title";?>"></div>
</div>
</div>
<!-- Buy -->

<!-- Specs -->
<div class="model_specs_container">
<table class="model_specs_table">
<tr>
<td colspan="2" class="model_specs_header">SPECIFICATIONS</td>
</tr>
<?php
$bg = 'model_specs_row_a';
foreach($product_specs as $label => $value) {
	if($value != NULL) {
		$bg = ($bg=='model_specs_row_b' ? 'model_specs_row_a' : 'model_specs_row_b');
		echo "<tr class=\"$bg\">
		<td class=\"model_specs_label\">$label</td>
		<td class=\"model_specs_value\">$value</td>
		</tr>";
	}
}
?>
</table>
</div>
<!-- Specs -->

<!-- Prop 65 -->
<div class="model_warning_title" onclick="toggle_slide('prop65')">
<img src="<?php echo get_bloginfo('stylesheet_directory');?>/template/icons/icon-warning.png"/>Prop. 65 Warning for CA Residents &raquo;
</div>
<div class="model_warning_text" id="prop65">
<img src="<?php echo get_bloginfo('stylesheet_directory');?>/template/icons/icon-warning.png"/><strong>WARNING:</strong> Use of this product can expose you to chemicals including lead, which are known to the State of California to cause cancer and birth defects or other reproductive harm. For more informaton go to: <br/><a href="http://www.P65Warnings.ca.gov" target="_blank">http://www.P65Warnings.ca.gov</a>
</div>
<!-- Prop 65 -->

</div>
</div>
</div>

<?php 
// Woocommerce After Hook
//do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer( 'shop' ); ?>

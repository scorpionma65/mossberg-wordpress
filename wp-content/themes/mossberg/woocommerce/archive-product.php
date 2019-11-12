<?php
/*
* Woocommerce Product Archive
*/
if(!defined('ABSPATH')) {
	exit; 
}
?>
<?php
// Applications Redirect
if(strpos($_SERVER['REQUEST_URI'],'application') !== FALSE && $_SERVER['QUERY_STRING'] == '') {
	$redirect = get_bloginfo('url').$_SERVER['REQUEST_URI'].'?tab=m';
	header('Location: '.$redirect);
}
?>
<?php get_header('shop'); ?>
<?php include(TEMPLATEPATH.'/inc/magento/magento-api-config.php');?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-tabs.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle.js"></script>
<script>
fucntion toggle_thumbnail(element) {
	jQuery('#'+element).toggle();
}
</script>
<?php 
// Woocommerce Before Hook
//do_action( 'woocommerce_before_main_content' );
?>
<?php
// Series
$series_slug = get_query_var('product_cat');
$series_term = get_term_by('slug', $series_slug, 'product_cat');
$series_id = $series_term->term_id;
$series_name = $series_term->name;
$series_parent = $series_term->parent;
$series_parent_term = get_term_by('id', $series_parent, 'product_cat');
$series_grandparent = $series_parent_term->term_id;
if($series_parent != 80 && $series_parent != 108) {
	$series_open_id = 'series'.$series_parent;
	$series_link_id = 'series'.$series_parent;
	} else {
	$series_open_id = 'series'.$series_id;
	$series_link_id = 'series'.$series_id;
}
$series_children = get_term_children($series_id, 'product_cat');
?>
<div class="content_container">
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
$cat_slug = '';
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
<?php 
$menu_title = 'Firearms';
$menu_slug = 'firearms';
include(TEMPLATEPATH.'/inc/inc-firearms-header.php');
?>
<?php include(TEMPLATEPATH.'/inc/inc-menu-series.php');?>
<!-- Overview -->
<div id="overview" style="display:<?php activate_content($active_tab,'o');?>">
<div class="series_title"><h1><?php echo $series_name; ?></h1></div>
<table class="series_table">
<tr>
<td>
<div class="series_text">
<?php
$overview_slug = 'series-overview-'.$series_slug;
// Overview Post
$args = array('name'=>$overview_slug, 'post_type'=>'post', 'post_status'=>'publish');
query_posts($args);
while(have_posts()):the_post();
	the_content();
endwhile;
wp_reset_query();
?>
</div>
<?php
// Subseries
if(count($series_children) > 0) {
	echo "<div class=\"series_subseries_container\">";
	foreach($series_children as $subseries_id) {
		$subseries = get_term_by('id', $subseries_id, 'product_cat');
		$subseries_id = $subseries->term_id;
		$subseries_name = $subseries->name;
		$subseries_slug = $subseries->slug;
		$subseries_description = $subseries->description;				
		$subseries_link = get_term_link($subseries_slug, 'product_cat');
		$subseries_image_id = get_woocommerce_term_meta($subseries_id, 'thumbnail_id', true );
		$subseries_image = wp_get_attachment_url($subseries_image_id);
		echo "<a href=\"$subseries_link\" class=\"series_subseries_block\">
		<div class=\"series_subseries_image\" style=\"background-image:url($subseries_image);\"><div class=\"series_subseries_mask\">$subseries_description</div></div>
		<div class=\"series_subseries_title\">$subseries_name</div>
		</a>";	
	}
		
	echo "</div>";
}
?>
</td>
<td class="series_cta_column">
<div class="series_cta">
<?php 
$cta_slug = 'cta-skyscraper';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
</td>
</tr>
</table>
</div>
<!-- Overview -->
<!-- Models -->
<div id="models" style="display:<?php activate_content($active_tab,'m');?>;">
<div class="series_title"><h1> 
<?php 
// Application Title
if(strpos($_SERVER['REQUEST_URI'],'application') !== FALSE) { 
	echo $series_name; 
	} else {
	echo 'Models';
}
?>
<?php 
$new = get_term_by('slug', 'new', 'product_cat');
$new_title = $new->name;
$new_icon_path = get_bloginfo('stylesheet_directory')."/template/icons/icon-new-model-specs.png";
?>
<span class="series_key"><?php echo "<img src=\"$new_icon_path\"/> $new_title";?></span></h1></div>
<?php
$args = array('post_type'=>'product','product_cat'=>$series_slug,'post_status'=>'publish','orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
query_posts($args);
$bg = 'series_model_row_a';
$count = 0;
$previous_model = NULL;
$models = NULL;
while(have_posts()):the_post();
	$bg = ($bg=='series_model_row_a' ? 'series_model_row_b' : 'series_model_row_a');
	$product_id = get_the_ID();
	$product_title = get_the_title();
	$product_description = get_the_content();
	$product_link = get_the_permalink();
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
	$product_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'medium');
	$product_image = $product_image_src[0];
	$product_buy_gog = "http://www.galleryofguns.com/genie/default.aspx?item=$product_sku";
	$product_buy_nfdn = "http://www.nfdnetwork.com/mossberg/catalog_detail.php?upc=0$product_upc";
	$product_image_icon = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-series-thumbnail.png\"/>";	
	
	// LE
	if(!empty($_GET['le'])){
		$product_link = $product_link."/?le=1/";
	}
	
	// Scope
	if($product_scope_type == NULL) {
		$product_scope_type = 'N/A';
	}
	
	// Categories
	$product_categories = NULL;
	$terms = wp_get_post_terms($product_id, 'product_cat');
	foreach($terms as $term) {
		$product_categories[] = $term->slug;
	}
	
	// New
	$product_new = NULL;
	if(in_array('new', $product_categories)) {
		$product_new = "<img src=\"$new_icon_path\" class=\"series_model_new\"/>";
	}
	
	// Table
	if($count == 0) {
		echo "<div class=\"series_model_container desktop\">
		<table class=\"series_model_table\">";
		// Headings		
		if($series_slug == 'new') {
			echo "<tr class=\"series_model_header\">
			<td>ITEM #</td>
			<td>GAUGE</td>
			<td>CALIBER</td>
			<td>CAPACITY</td>
			<td>BARREL LENGTH</td>
			<td>BARREL TYPE</td>
			<td>CHOKES</td>
			<td>BARREL FINISH</td>
			<td>STOCK</td>
			<td>LENGTH</td>
			<td>WEIGHT</td>
			<td></td>
			</tr>";
			} else {	
			if(in_array('rifles', $product_categories)) {
				echo "<tr class=\"series_model_header\">
				<td>ITEM #</td>
				<td>CALIBER</td>
				<td>CAPACITY</td>
				<td>BARREL LENGTH</td>
				<td>BARREL TYPE</td>
				<td>SCOPE</td>
				<td>SIGHTS/BASES</td>
				<td>LOP</td>
				<td>BARREL FINISH</td>
				<td>STOCK</td>
				<td>LENGTH</td>
				<td>WEIGHT</td>
				<td></td>
				</tr>";
			}
			if(in_array('shotguns', $product_categories)) {
				echo "<tr class=\"series_model_header\">
				<td>ITEM #</td>
				<td>GAUGE</td>
				<td>CAPACITY</td>
				<td>BARREL LENGTH</td>
				<td>BARREL TYPE</td>
				<td>CHOKES</td>
				<td>SIGHTS/BASES</td>
				<td>LOP</td>
				<td>BARREL FINISH</td>
				<td>STOCK</td>
				<td>LENGTH</td>
				<td>WEIGHT</td>
				<td></td>
				</tr>";
			}
			if(in_array('handguns', $product_categories)) {
				echo "<tr class=\"series_model_header\">
				<td>ITEM #</td>
				<td>CALIBER</td>
				<td>FRAME</td>
				<td>CAPACITY</td>
				<td>SAFETY</td>
				<td>BARREL LENGTH</td>
				<td>SIGHTS/BASES</td>
				<td>TWIST</td>
				<td>FRAME FINISH</td>
				<td>BARREL FINISH</td>
				<td>SLIDE FINISH</td>
				<td>LENGTH</td>
				<td>WEIGHT</td>
				<td></td>
				</tr>";
			}
			if(in_array('pistol-grip-firearms-and-aows', $product_categories)) {
				echo "<tr class=\"series_model_header\">
				<td>ITEM #</td>
				<td>GAUGE</td>
				<td>CAPACITY</td>
				<td>BARREL LENGTH</td>
				<td>BARREL TYPE</td>
				<td>CHOKES</td>
				<td>SIGHTS/BASES</td>
				<td>LOP</td>
				<td>BARREL FINISH</td>
				<td>STOCK</td>
				<td>LENGTH</td>
				<td>WEIGHT</td>
				<td></td>
				</tr>";
			}
		}
	}
	
	// Caliber/Gauge/Scope/Choke
	if($series_slug != 'new') {
		if(in_array('rifles', $product_categories)) {
			$product_caliber_gauge_title = 'Caliber';
			$product_caliber_gauge = $product_caliber;
			$product_scope_choke_title = 'Scope';
			$product_scope_choke = $product_scope_type;
			$product_stock_slide_title = 'Stock Finish';
			$product_stock_slide = $product_stock;
			$product_lop_safety_title = 'LOP';
			$product_lop_safety = $product_lop;
			$specs = array(
			'0'=>$product_caliber,
			'1'=>$product_capacity,
			'2'=>$product_barrel_length,
			'3'=>$product_barrel_type,
			'4'=>$product_scope_type,
			'5'=>$product_sight_type,
			'6'=>$product_lop,
			'7'=>$product_barrel_finish,
			'8'=>$product_stock,
			'9'=>$product_length,
			'10'=>$product_weight);
		}
		if(in_array('shotguns', $product_categories)) {	
			$product_caliber_gauge_title = 'Gauge';
			$product_caliber_gauge = $product_gauge;
			$product_scope_choke_title = 'Choke';
			$product_scope_choke = $product_choke;
			$product_stock_slide_title = 'Stock Finish';
			$product_stock_slide = $product_stock;
			$product_lop_safety_title = 'LOP';
			$product_lop_safety = $product_lop;
			$specs = array(
			'0'=>$product_gauge,
			'1'=>$product_capacity,
			'2'=>$product_barrel_length,
			'3'=>$product_barrel_type,
			'4'=>$product_choke,
			'5'=>$product_sight_type,
			'6'=>$product_lop,
			'7'=>$product_barrel_finish,
			'8'=>$product_stock,
			'9'=>$product_length,
			'10'=>$product_weight);
		}		
		if(in_array('handguns', $product_categories)) {	
			$product_caliber_gauge_title = 'Caliber';
			$product_caliber_gauge = $product_caliber;
			$product_scope_choke_title = 'Frame';
			$product_scope_choke = $product_frame_type;
			$product_stock_slide_title = 'Slide Finish';
			$product_stock_slide = $product_slide_finish;
			$product_lop_safety_title = 'Safety';
			$product_lop_safety = $product_safety;
			$specs = array(
			'0'=>$product_caliber,
			'1'=>$product_frame_type,
			'2'=>$product_capacity,
			'3'=>$product_safety,
			'4'=>$product_barrel_length,
			'5'=>$product_sight_type,
			'6'=>$product_twist,
			'7'=>$product_frame_finish,
			'8'=>$product_barrel_finish,
			'9'=>$product_slide_finish,
			'10'=>$product_length,
			'11'=>$product_weight);
		}
		if(in_array('pistol-grip-firearms-and-aows', $product_categories)) {
			$product_caliber_gauge_title = 'Gauge';
			$product_caliber_gauge = $product_gauge;	
			$product_scope_choke_title = 'Choke';
			$product_scope_choke = $product_choke;
			$product_stock_slide_title = 'Stock Finish';
			$product_stock_slide = $product_stock;
			$product_lop_safety_title = 'LOP';
			$product_lop_safety = $product_lop;
			$specs = array(
			'0'=>$product_gauge,
			'1'=>$product_capacity,
			'2'=>$product_barrel_length,
			'3'=>$product_barrel_type,
			'4'=>$product_choke,
			'5'=>$product_sight_type,
			'6'=>$product_lop,
			'7'=>$product_barrel_finish,
			'8'=>$product_stock,
			'9'=>$product_length,
			'10'=>$product_weight);
		}
		} else {
		$specs = array(
		'0'=>$product_gauge,
		'1'=>$product_caliber,
		'2'=>$product_capacity,
		'3'=>$product_barrel_length,
		'4'=>$product_barrel_type,
		'5'=>$product_choke,
		'6'=>$product_barrel_finish,
		'7'=>$product_stock,
		'8'=>$product_length,
		'9'=>$product_weight);
	}
	
	$colspan = count($specs) + 3;
	
	$model_section = NULL;
	if(sanitize_title($product_title) != sanitize_title($previous_model)) {
		echo "<tr class=\"series_model_section\">
		<td colspan=\"$colspan\">$product_title</td>
		</tr>";
		$model_section = "<div class=\"series_model_mobile_section mobile\">$product_title</div>";
		$bg = 'series_model_row_a';
	}
	echo "<tr class=\"series_model_data $bg\" onclick=\"window.open('$product_link','_self')\" onmouseover=\"toggle('thumbnail{$product_id}')\" onmouseout=\"toggle('thumbnail{$product_id}')\">
	<td>$product_new
	<div id=\"thumbnail{$product_id}\" class=\"series_model_photo\" style=\"background-image:url($product_image);\">#$product_sku</div>
	#$product_sku
	</td>";
	
	foreach($specs as $key => $spec) {
		echo "<td>$spec</td>";
	}
		
	echo "<td><div class=\"series_model_button\">DETAILS</div></td>
	</tr>";
	
	// Mobile
	$models .= "$model_section
	<a href=\"$product_link\" class=\"series_model_mobile mobile\">
	<div class=\"series_model_mobile_photo\" style=\"background-image:url($product_image);\"></div>
	<div class=\"series_model_mobile_sku\">#$product_sku</div>
	<table class=\"series_model_mobile_specs\">
	<tr>
	<td>{$product_caliber_gauge_title}: $product_caliber_gauge</td>
	<td>Barrel Finish: $product_barrel_finish</td>
	</tr>
	<tr>
	<td>Capacity: $product_capacity</td>
	<td>{$product_stock_slide_title}: $product_stock_slide</td>
	</tr>
	<tr>
	<td>Barrel Length: $product_barrel_length</td>
	<td>Length: $product_length</td>
	</tr>
	<tr>
	<td>Barrel Type: $product_barrel_type</td>
	<td>Weight: $product_weight</td>
	</tr>
	<tr>
	<td>{$product_scope_choke_title}: $product_scope_choke</td>
	<td>Sights: $product_sight_type</td>
	</tr>
	<tr>
	<td>{$product_lop_safety_title}: $product_lop_safety</td>
	<td></td>
	</tr>
	</table>
	</a>";
	
	$previous_model = $product_title;
	$count++;
endwhile;
if($count != 0) {
	echo "</table>
	</div>";
}
echo $models;
?>
</div>
<!-- Models -->
<!-- Extras -->
<div id="extras" style="display:<?php activate_content($active_tab,'e');?>;">
<div class="series_title"><h1>Extras</h1></div>
<table class="series_table">
<tr>
<td>
<div class="series_blog_container">
<?php
$blog_slug = 'blog';
$args = array('category_name'=>$blog_slug,'tag'=>$series_slug);
query_posts($args);
$count = 0;
while(have_posts()):the_post();
	$blog_title = get_the_title();
	$blog_content = get_the_content();
	$blog_content_short = wp_trim_words($blog_content, 25, '&hellip;');
	$blog_link = get_the_permalink();
	$blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
	$blog_image = $blog_image[0];
	if(in_category('blog-article',$post->ID)) {
		$blog_type = 'Article';
	}
	if(in_category('blog-video',$post->ID)) {
		$blog_type = 'Video';
	}
	echo "<div class=\"series_blog_block\">
	<div class=\"blog_summary_type\">$blog_type</div>
	<a href=\"$blog_link\" class=\"series_blog_image\" style=\"background-image:url($blog_image);\"></a>
	<div class=\"series_blog_title\"><a href=\"$blog_link\">$blog_title</a></div>
	<div class=\"series_blog_text\">$blog_content_short</div>
	<div class=\"series_blog_share\"><a href=\"$blog_link\" class=\"blog_summary_view\">&raquo; View</a></div>
	</div>";
	$count++;
endwhile;
wp_reset_query();
if($count == 0 && $series_slug != 'mc1sc') {
	$blog_slug = 'blog';
	$extras_slug = 'series-extras';
	$args = array('category_name'=>$blog_slug,'tag'=>$extras_slug);
	query_posts($args);
	$count = 0;
	while(have_posts()):the_post();
		$blog_title = get_the_title();
		$blog_content = get_the_content();
		$blog_content_short = wp_trim_words($blog_content, 25, '&hellip;');
		$blog_link = get_the_permalink();
		$blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
		$blog_image = $blog_image[0];
		if(in_category('blog-article',$post->ID)) {
			$blog_type = 'Article';
		}
		if(in_category('blog-video',$post->ID)) {
			$blog_type = 'Video';
		}
		echo "<div class=\"series_blog_block\">
		<div class=\"blog_summary_type\">$blog_type</div>
		<a href=\"$blog_link\" class=\"series_blog_image\" style=\"background-image:url($blog_image);\"></a>
		<div class=\"series_blog_title\"><a href=\"$blog_link\">$blog_title</a></div>
		<div class=\"series_blog_text\">$blog_content_short</div>
		<div class=\"series_blog_share\"><a href=\"$blog_link\" class=\"series_blog_view\">&raquo; View</a></div>
		</div>";
		$count++;
	endwhile;
	wp_reset_query();
}
?>
</div>
</td>
<td>
<div class="series_cta">
<?php 
$cta_slug = 'cta-skyscraper';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
</td>
</tr>
</table>
</div>
<!-- Extras -->
<!-- Support -->
<div id="support" style="display:<?php activate_content($active_tab,'s');?>;">
<div class="series_title"><h1>Support</h1></div>
<table class="series_table">
<tr>
<td>
<div class="series_text">
<?php
$support_slug = 'series-support';
// Overview Post
$args = array('name'=>$support_slug, 'post_type'=>'post');
$posts = get_posts($args);
if($posts) {
	$support_content = wpautop($posts[0]->post_content);
	echo $support_content;
}
wp_reset_query();
?>
</div>
</td>
<td>
<div class="series_cta">
<?php 
$cta_slug = 'cta-skyscraper';
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
</td>
</tr>
</table>
</div>
<!-- Support -->
<!-- Parts -->
<div id="parts" style="display:<?php activate_content($active_tab,'p');?>;">
<div class="series_title"><h1>Parts &amp; Accessories</h1></div>
<table class="series_table">
<tr>
<td>
<div class="series_parts_container">
<?php
include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');
$models = array(
// 500
'312'=>'142,54,112,56',
// 590/590A1
'313'=>'113,57',
// 535
'314'=>'60',
// 835
'315'=>'61',
// 930
'316'=>'148,329,62,63,65,331',
// 935
'317'=>'66',
// Silver II
'318'=>'68,147',
// Maverick
'319'=>'69,143',
// Patriot
'320'=>'135,76,77,78,109,580',
// MVP
'321'=>'30,70,71,72,73,74,75',
// Blaze/Blaze 47
'322'=>'31,32',
// MMR
'323'=>'33,34,330',
// 464
'324'=>'35,131,136,137',
// 715T/715P
'325'=>'36,37',
// 702
'326'=>'39',
// FLEX 22
'327'=>'177',
// 802/817/801
'328'=>'40,41,42');
// Match
$model_id = FALSE;
foreach($models as $key => $value) {
	if(in_array($series_id,explode(',',$value))) {
		$model_id = $key;
		break;
	}
}
if($model_id) {
	$parts = TRUE;
	$query_m = "SELECT m_catalog_product_entity.entity_id, m_catalog_product_entity.row_id, m_catalog_product_entity.sku 
	FROM m_catalog_product_entity, m_catalog_category_product, m_catalog_product_entity_int 
	WHERE m_catalog_category_product.category_id='$model_id' 
	AND m_catalog_category_product.product_id=m_catalog_product_entity.entity_id 
	AND m_catalog_product_entity_int.row_id=m_catalog_product_entity.entity_id 
	AND m_catalog_product_entity_int.attribute_id='94' 
	AND m_catalog_product_entity_int.value='1' 
	ORDER BY RAND() LIMIT 8";
	$result_m = @mysql_query($query_m);
	if(@mysql_num_rows($result_m)) {
		while($row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC)) {
			$entity_id = $row_m['entity_id'];
			$row_id = $row_m['row_id'];
			$sku = $row_m['sku'];
			
			// Sku/Name/Price
			$query_a = "SELECT m_catalog_product_entity_varchar.value AS name, 
			m_catalog_product_entity_decimal.value AS price  
			FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.entity_id='$entity_id' 
			AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_varchar.attribute_id='70' 
			AND m_catalog_product_entity_decimal.attribute_id='74' 
			GROUP BY m_catalog_product_entity.entity_id";
			$result_a = @mysql_query($query_a);
			$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
			$name = $row_a['name'];
			$price = number_format($row_a['price'],2);
			// Link
			$query_b = "SELECT m_catalog_product_entity_varchar.value AS url_key 
			FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
			WHERE m_catalog_product_entity.entity_id='$entity_id' 
			AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
			AND m_catalog_product_entity_varchar.attribute_id='117'  
			GROUP BY m_catalog_product_entity.entity_id";
			$result_b = @mysql_query($query_b);
			$row_b = @mysql_fetch_array($result_b, MYSQL_ASSOC);
			$url_key = $row_b['url_key'];
			$link = get_bloginfo('url')."/store/".$url_key.'.html';
			// Image
			$query_c = "SELECT m_catalog_product_entity_varchar.value AS image  
			FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
			WHERE m_catalog_product_entity.entity_id='$entity_id' 
			AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
			AND m_catalog_product_entity_varchar.attribute_id='84'  
			GROUP BY m_catalog_product_entity.entity_id";
			$result_c = @mysql_query($query_c);
			$row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC);
			$image = get_bloginfo('url')."/store/pub/media/catalog/product/".$row_c['image'];
			
			echo "<div class=\"series_parts_block\">
			<a href=\"$link\" style=\"background-image:url($image);\" class=\"series_parts_image\"></a>
			<div class=\"series_parts_name\"><a href=\"$link\">$name</a></div>
			<div class=\"series_parts_price\">\$$price</div>
			<a href=\"$link\" class=\"series_parts_button\">View</a>
			</div>";
		}
		} else {
		$parts = FALSE;
	}
}
echo mysql_error();
?>
</div>
<div class="series_parts_link">
<?php
if($parts) {
	// Parts Link
	$query = "SELECT value FROM m_catalog_category_entity_varchar WHERE row_id='$model_id' AND attribute_id='116'";
	$result = @mysql_query($query);
	$row = @mysql_fetch_array($result, MYSQL_NUM);
	$parts_link = $row[0];
	echo "<a href=\"".get_bloginfo('home')."/store/{$parts_link}.html\">View All $series_name Parts &raquo;</a>";
	} else {
	echo "<a href=\"".get_bloginfo('home')."/store/parts.html\">Shop Parts &raquo;</a>";
}
?>
</div>
</td>
</tr>
</table>
</div>
<!-- Parts -->
</div>
</div>
</div>
<?php 
// Woocommerce After Hook
//do_action( 'woocommerce_after_main_content' );
?>
<?php get_footer( 'shop' ); ?>

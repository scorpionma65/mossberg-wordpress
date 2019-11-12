<?php
/*
Template Name: Schematic
*/
?>
<?php
// Preview
$preview_models = array('mvp-schematic');
$preview_ips = array('174.143.201.163','68.193.34.20','69.117.48.77','24.189.162.150','65.158.22.59','65.115.55.33','65.115.55.34','65.115.55.35','65.115.55.36','65.115.55.37','65.115.55.38','65.115.55.39','65.115.55.40','65.115.55.41','65.115.55.42','65.115.55.43','65.115.55.44','65.115.55.45','65.115.55.46','63.150.111.177','63.150.111.178','63.150.111.179','63.150.111.180','63.150.111.181','63.150.111.182','67.131.112.147','65.152.199.1','65.152.199.2','65.152.199.3','65.152.199.4','65.152.199.5','65.152.199.6','173.9.68.225','173.9.68.226','173.9.68.227','173.9.68.228','173.9.68.229','173.9.68.230','173.9.68.231','173.9.68.232','173.9.68.233','173.9.68.234','173.9.68.235','173.9.68.236','173.9.68.237','173.9.68.238','64.206.106.249','64.206.106.250','64.206.106.251','64.206.106.252','64.206.106.253','64.206.106.254','74.8.3.41','74.8.3.42','74.8.3.43','74.8.3.44','74.8.3.45','74.8.3.46','40.139.71.241','40.139.71.242','40.139.71.243','40.139.71.244','40.139.71.245','40.139.71.246','73.227.93.242','67.81.201.217','69.127.218.94','107.3.238.2','24.188.243.55','69.120.234.69','69.115.115.163','24.45.196.153','174.49.55.130','96.8.53.241','71.233.213.150','107.77.218.10','107.77.218.68','107.77.219.210','32.211.205.117','32.213.220.228','4.35.87.33','173.29.100.174','69.123.108.229','47.20.99.172','73.219.173.69');
if(in_array($_GET['model'],$preview_models) && !in_array($_SERVER['REMOTE_ADDR'],$preview_ips)) {
	header('Location: '.get_bloginfo('url').'/schematics/');
}
?>
<?php get_header('store'); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-schematic.js"></script>
<?php include(TEMPLATEPATH.'/inc/magento/magento-api-config.php');?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-schematic-header.php');?>
<div class="content_eight content_left">
<div class="schematic_title">
<?php echo $model_title;?>
<div class="schematic_zoom">Zoom: 
<span id="zoom_one" class="schematic_zoom_active" onclick="zoom_level('1')">1</span> 
<span id="zoom_two" class="" onclick="zoom_level('2')">2</span> 
<span id="zoom_three" class="" onclick="zoom_level('3')">3</span>
</div>
</div>
<div class="schematic_image_container" id="image_container">
<div class="schematic_zoom_one" id="image_zoom" style="background-image:url(<?php echo $model_assembled;?>);">
<?php
// Images
query_posts($model_args);
$count = 1;
$part_ids = array();
$part_images = array();
while(have_posts()):the_post();
	$part_id = $post->ID;
	$part_title = $post->post_title;
	$part_x_position = get_post_meta($part_id, 'wpcf-part-x-position', true);
	$part_y_position = get_post_meta($part_id, 'wpcf-part-y-position', true);
	$part_image = get_post_meta($part_id, 'wpcf-part-image', true); 
	$part_marker_alignment = get_post_meta($part_id, 'wpcf-part-marker-alignment', true); 
	$part_text_class = 'schematic_marker_text_right';
	if($part_marker_alignment == 'L') {
		$part_text_class = 'schematic_marker_text_left';
	}
	echo "<div class=\"schematic_image schematic_image_inactive\" style=\"background-image:url($part_image); z-index:$count;\" id=\"partimg{$part_id}\"></div>	
	<div class=\"schematic_marker\" id=\"partmark{$part_id}\" style=\"top:{$part_y_position}%; left:{$part_x_position}%;\" onmouseover=\"highlight_activate('$part_id')\" onmouseout=\"highlight_deactivate('$part_id')\" onclick=\"ecomm_refocus('$part_id')\">
	$count
	<div class=\"$part_text_class\">$part_title</div>
	</div>";	
	$part_ids[] = $part_id;	
	$part_images[] = $part_image;	
	$count++;
endwhile;
wp_reset_query();
?>
<input name="part_images" id="part_images" type="hidden" value="<?php echo implode(',',$part_images);?>" />
</div>
</div>
</div>

<div class="content_four content_right">
<div class="schematic_list_title">Parts List 
<?php
$parent = get_term($model_parent, 'schematic-model'); 	
$parent_slug = $parent->slug;
if($parent_slug == 'rifle-schematic') {
	// Caliber Select
	echo " <select id=\"caliber\" name=\"caliber\" id=\"caliber\" class=\"schematic_list_calibers\" onchange=\"switch_caliber()\">
	<option value=\"\">All Calibers</option>";
	include(TEMPLATEPATH.'/inc/inc-schematic-caliber.php');
	foreach($calibers[$model_slug] as $key => $value) {
		echo "<option value=\"$key\"";
		if(!empty($_GET['cal']) && $_GET['cal']==$key) {
			echo "selected=\"selected\"";
		}
		echo ">$value</option>";
	}
	echo "</select>";
}
?>
<div class="schematic_list_title_note">(R) Restricted Item</div>
</div>
<div class="schematic_list_container" id="partlist_container">
<?php
// Ecomm Parts
$ecomm_json = file_get_contents(TEMPLATEPATH.'/inc/schematic/schematic-ecomm.json');
$ecomm_skus = json_decode($ecomm_json);

// Parts
$count = 1;
$shop_skus = array();
foreach($part_ids as $key => $id) {
	$post = get_post($id);
	$part_id = $post->ID;
	$part_title = $post->post_title;
	$part_content = $post->post_content;
	$part_sku = get_post_meta($part_id, 'wpcf-part-sku', true);
	$part_restricted = get_post_meta($part_id, 'wpcf-part-restricted', true);
	$part_restriction = get_post_meta($part_id, 'wpcf-part-restriction', true);
	$part_note = get_post_meta($part_id, 'wpcf-part-note', true);
	$part_quantity = get_post_meta($part_id, 'wpcf-part-quantity', true);
	$part_diagram_number = get_post_meta($part_id, 'wpcf-part-diagram-number', true);
	$part_x_position = get_post_meta($part_id, 'wpcf-part-x-position', true);
	$part_y_position = get_post_meta($part_id, 'wpcf-part-y-position', true);
	$part_ecomm_skus = get_post_meta($part_id, 'wpcf-part-ecomm-skus', true);	
	// List 
	echo "<div class=\"schematic_list_option\" id=\"partlist{$part_id}\" onmouseover=\"highlight_activate('$part_id')\" onmouseout=\"highlight_deactivate('$part_id')\" onclick=\"ecomm_activate('$part_id')\">
	<div class=\"schematic_list_number\">$count</div>
	$part_title
	<div class=\"schematic_list_icon\" id=\"particon{$part_id}\"></div>";
	if($part_restricted) { 
		echo "<em>(R)</em>";
	}
	echo "</div>";
	// Ecomm
	echo "<div class=\"schematic_list_ecomm\" id=\"partecomm{$part_id}\" onmouseover=\"highlight_activate('$part_id')\" onmouseout=\"highlight_deactivate('$part_id')\" >";
	// Restricted
	if($part_restricted) { 
		echo "<div class=\"schematic_list_restricted\">Restricted: ";
		if($part_restriction) {
			echo strip_tags($part_restriction)."</div>";
			} else {
			echo "This part is not available for sale.</div>";
		}
		} else {
		// SKUs
		if($part_ecomm_skus) {
			$skus = explode(',',$part_ecomm_skus);
			$background = 'schematic_list_sku_b';
			foreach($skus as $key => $sku) {
				if($ecomm_skus->$part_id->$sku) {
					$background = ($background=='schematic_list_sku_a' ? 'schematic_list_sku_b' : 'schematic_list_sku_a');
					// Get Product
					$entity_id = $ecomm_skus->$part_id->$sku->entity_id;
					$name = $ecomm_skus->$part_id->$sku->name;
					$slug = sanitize_title($name);
					$price = number_format($ecomm_skus->$part_id->$sku->price,2);
					$stock = $ecomm_skus->$part_id->$sku->stock;
					$stock_qty = $ecomm_skus->$part_id->$sku->stock_qty;
					$image = $ecomm_skus->$part_id->$sku->image;
					$link = $ecomm_skus->$part_id->$sku->link;
					$caliber = $ecomm_skus->$part_id->$sku->caliber;
					// Stock 
					$stock_display = NULL;
					if($stock != 1) {
						$stock_display = ' | OUT OF STOCK';
					}
					echo "<div class=\"schematic_list_sku $background\" id=\"ecomm{$sku}\">
					<a href=\"$link\" target=\"_blank\" class=\"schematic_list_sku_image\" style=\"background-image:url(".get_bloginfo('home')."/store/pub/media/catalog/product/$image);\"></a>
					<div class=\"schematic_list_sku_text\">
					<div class=\"schematic_list_sku_title\">$name</div>
					<div class=\"schematic_list_sku_sku\">SKU $sku $stock_display</div>
					<div class=\"schematic_list_sku_price\">Reg. \$$price
					<a href=\"$link\" target=\"_blank\" class=\"schematic_list_sku_button\">View in Store</a>
					<a href=\"javascript:void(0)\" class=\"schematic_list_sku_button\" onclick=\"set_cookie('sku{$sku}','$sku','')\" id=\"select{$sku}\">Select</a>
					<a href=\"javascript:void(0)\" class=\"schematic_list_sku_button_selected\" onclick=\"scroll_selected('selected')\" id=\"selected{$sku}\">Selected</a>
					</div>
					</div>
					</div>
					<input type=\"hidden\" name=\"caliber{$sku}\" id=\"caliber{$sku}\" value=\"$caliber\"/>";
					$shop_skus[$sku] = array('name'=>$name,'link'=>$link,'price'=>$price,'image'=>$image,'stock'=>$stock_display,'caliber'=>$caliber);
				}
			}
			} else {
			echo "<div class=\"schematic_list_restricted\">Part is not currently available online.</div>";
		}
	}	
	echo "</div>";	
	$count++;
}
wp_reset_query();
?>
</div>
</div>
</div>

<div class="content">
<div class="content_full content_twelve" id="selected">
<div class="container_title">Selected Parts</div>
<div class="container_text">
<em id="selected_message">No parts are currently selected.</em>
<div class="schematic_selected_scrolltop">
<div class="schematic_selected_scrolltop_button" onclick="scroll_top()">To Top</div>
<div class="schematic_selected_scrolltop_button" onclick="clear_selected()">Clear All</div>
</div>
</div>
<div class="schematic_selected_container">
<?php
// Parts
$count = 1;
foreach($shop_skus as $key => $value) {
	$sku_id = 'sku'.$key;
	echo "<div class=\"schematic_selected_block\" id=\"sku{$key}\">
	<div class=\"schematic_selected_tile\">
	<div style=\"background-image:url(".get_bloginfo('home')."/store/pub/media/catalog/product/$value[image]);\" class=\"schematic_selected_image\">
	<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-x.png\" onclick=\"delete_cookie('sku{$key}')\"/>
	</div>
	<div class=\"schematic_selected_name\"><a href=\"$value[link]\">$value[name]</a></div>
	<div class=\"schematic_selected_sku\">SKU: $key $value[stock]</div>
	<div class=\"schematic_selected_price\">Reg. \$$value[price]</div>
	<a href=\"$value[link]\" target=\"_blank\" class=\"schematic_selected_button\">View in Store</a>
	</div>
	</div>";
}
?>
</div>
<div class="schematic_cart_container" id="cart">
<div class="container_title">Add Selected to Cart</div>
<div class="schematic_cart_form">
<?php include(TEMPLATEPATH.'/inc/magento/magento-schematic-cart.php');?>
<!-- 
MAGENTO CUSTOMIZATION - UPDATE REDIRECT URL
store\vendor\magento\module-customer\Controller\Account\Login.php
store\vendor\magento\module-customer\Controller\Account\LoginPost.php
SET: $resultRedirect->setPath('checkout/cart');
-->
</div>
</div>
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

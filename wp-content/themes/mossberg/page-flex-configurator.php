<?php
/*
Template Name: FLEX Configurator
*/
?>
<?php 
// Redirect
if(empty($_GET['model'])) {
	header("Location:".get_bloginfo('url')."/flex-select");
}
?>
<?php get_header('flex'); ?>
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');?>
<?php include(TEMPLATEPATH.'/inc/magento/magento-api-config.php');?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init();</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-configurator.js"></script>

<?php
// Pos Update
//if(isset($_GET['update'])) {
//	$receiver = $_GET['receiver'];
//	$xpos = $_GET['xpos'];
//	$ypos = $_GET['ypos'];
//	$model_barrel_xpos = 435 - $xpos;
//	$model_barrel_ypos = 132 - $ypos;
//	$x = update_post_meta($receiver, 'wpcf-flex-receiver-x', $model_barrel_xpos);
//	$y = update_post_meta($receiver, 'wpcf-flex-receiver-y', $model_barrel_ypos);
//	
//	echo "$receiver / $model_barrel_xpos / $model_barrel_ypos / $x / $y";
//}
?>

<?php
// Standard Equipment
function get_standard_equipment($model_sku, $part_type) {
	$args = array('post_type'=>'flex-configurations','numberposts'=>'1',
	'meta_query'=>array(array(
		'key'=>'wpcf-flex-standard-equipment',
		'value'=>$model_sku)),
	'tax_query'=>array(array(
		'taxonomy'=>'flex-part-types',
		'field'=>'slug',
		'terms'=>$part_type))
	);
	query_posts($args);
	while(have_posts()):the_post();
		$part_id = get_the_ID();
		$part_title = get_the_title();
		$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', false);
		$part_xpos = get_post_meta(get_the_ID(), 'wpcf-flex-receiver-x', true);
		$part_ypos = get_post_meta(get_the_ID(), 'wpcf-flex-receiver-y', true);
		$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
		$part = array('id'=>$part_id, 'title'=>$part_title, 'standard'=>$part_standard, 'image'=>$part_image, 'xpos'=>$part_xpos, 'ypos'=>$part_ypos);
	endwhile;
	wp_reset_query();
	return($part);
}
// FLEX Parts
function get_flex_parts($model_sku, $part_type) {
	$args = array('post_type'=>'flex-configurations','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc',
	'tax_query'=>array(
		array(
		'taxonomy'=>'flex-part-types',
		'field'=>'slug',
		'terms'=>$part_type),
		array(
		'taxonomy'=>'flex-model',
		'field'=>'slug',
		'terms'=>'flex-config-'.$model_sku))
	);
	query_posts($args);
	while(have_posts()):the_post();
		$part_id = get_the_ID();
		$part_title = get_the_title();
		$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
		$part_ecomm = get_post_meta(get_the_ID(), 'wpcf-flex-ecomm-sku', true);
		$part_lop = get_post_meta(get_the_ID(), 'wpcf-flex-lop', true);
		$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
		if(!$part_standard && $part_ecomm) {
			$parts[] = array('id'=>$part_id, 'title'=>$part_title, 'standard'=>$part_standard, 'image'=>$part_image, 'ecomm'=>$part_ecomm, 'lop'=>$part_lop);
		}
	endwhile;
	wp_reset_query();
	return($parts);
}
// Config
if(!empty($_GET['model'])) {
	$model = sanitize_text_field($_GET['model']);
	$term = get_term_by('slug',$model,'flex-model');
	if($term) {
		$model_id = $term->term_id;
		$model_title = $term->name;
		$model_slug = $term->slug;
		$model_parent = $term->parent;
		$model_sku = end(explode('-',$model_slug));		
		$model_description = strip_tags($term->description);
	}
	// Receiver
	$part = get_standard_equipment($model_sku, 'flex-receiver');
	$model_receiver_id = $part['id'];
	$model_receiver = $part['image'];
	$model_receiver_xpos = $part['xpos'];
	$model_receiver_ypos = $part['ypos'];
	// Barrel
	$part = get_standard_equipment($model_sku, 'flex-barrel');
	$model_barrel = $part['image'];
	$model_barrel_xpos = NULL;
	$model_barrel_ypos = NULL;
	if($model_receiver_xpos && $model_receiver_ypos) {
		$model_barrel_xpos = 435 - intval($model_receiver_xpos);
		$model_barrel_ypos = 132 - intval($model_receiver_ypos);
	}
	// Forend
	$part = get_standard_equipment($model_sku, 'flex-forend');
	$model_forend = $part['image'];
	// Stock
	$part = get_standard_equipment($model_sku, 'flex-stock');
	$model_stock = $part['image'];
	// Recoil Pad
	$model_recoil_pad = NULL;
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="get" name="pos" style="display:none; position:fixed; right:0px; top:100px; padding:20px; background:#FFC600; z-index:9999999;">
<input name="xpos" id="xpos" type="text" value="<?php echo $model_barrel_xpos;?>" onchange="edit_pos()" style="display:block; width:40px;"/>
<input name="ypos" id="ypos" type="text" value="<?php echo $model_barrel_ypos;?>" onchange="edit_pos()" style="display:block; width:40px;"/>
<input name="model" id="model" type="hidden" value="<?php echo $model;?>"/>
<input name="receiver" id="receiver" type="hidden" value="<?php echo $model_receiver_id;?>"/>
<input name="update" type="submit" value="Go" style="display:block; width:40px;"/>
</form>
<div class="content_container">
<div class="content">
<div class="content_twelve content_full">

<!-- Top -->
<div class="flex_top">
<!-- Model -->
<div class="flex_model_container">
<div class="flex_model_select"><a href="<?php echo get_bloginfo('url');?>/flex-select">&laquo; BACK TO GUN SELECTION</a> &nbsp;|&nbsp; <a href="<?php echo get_bloginfo('url');?>/flex-configurator?model=<?php echo $model;?>">RESET STANDARD EQUIPMENT</a></div>
<div class="flex_model_config">
<div class="flex_model_receiver" id="receiver" style="background-image:url(<?php echo $model_receiver;?>);"></div>
<div class="flex_model_barrel" id="barrel" style="background-image:url(<?php echo $model_barrel;?>); background-position-x:0px; background-position-y:0px;"></div>
<div class="flex_model_recoil_pad" id="recoil-pad" style="background-image:url(<?php echo $model_recoil_pad;?>);"></div>
<div class="flex_model_stock" id="stock" style="background-image:url(<?php echo $model_stock;?>);"></div>
<div class="flex_model_forend" id="forend" style="background-image:url(<?php echo $model_forend;?>);"></div>
<input name="field-barrel" id="field-barrel" type="hidden" value="" />
<input name="field-recoil-pad" id="field-recoil-pad" type="hidden" value="" />
<input name="field-stock" id="field-stock" type="hidden" value="" />
<input name="field-forend" id="field-forend" type="hidden" value="" />
<input name="field-model" id="field-model" type="hidden" value="<?php echo $model;?>" />
</div>
<?php
// Conversion Kit
$kit = FALSE;
switch($model_parent) {
	case '829':
	$kit = TRUE;
	break;
	case '785':
	$kit = FALSE;
	break;
	case '830':
	$kit = TRUE;
	break;
	case '831':
	$kit = TRUE;
	break;
	case '833':
	$kit = TRUE;
	break;
	case '832':	
	$kit = FALSE;
	break;
}
if($kit) {
	$args = array('category_name'=>'flex-configurator-adapter','show_posts'=>'1');
	query_posts($args);
	while(have_posts()):the_post();
		$post_title = $post->post_title;
		$post_content = $post->post_content;
		echo "<div class=\"flex_model_adapter\"><h5>$post_title</h5></div>";
	endwhile;
	wp_reset_query();
}
?>
<div class="flex_model_name">
<h3><?php echo $model_title;?></h3><?php echo $model_description;?>
</div>
</div>
<!-- Model -->
<!-- Menu -->
<div class="flex_menu_container">
<span class="flex_menu_title">SELECT ACCESSORIES:</span>
<ul class="flex_menu_nav">
<li id="tab-barrel" onclick="switch_type('barrel')">Barrel</li>
<li id="tab-recoil-pad" onclick="switch_type('recoil-pad')">Recoil Pad</li>
<li id="tab-stock" onclick="switch_type('stock')">Stock/Grip</li>
<li id="tab-forend" onclick="switch_type('forend')" class="flex_menu_nav_active">Forend</li>
</ul>
</div>
<!-- Menu -->
</div>
<!-- Top -->

<!-- Bottom -->
<div class="flex_bottom">
<!-- Parts -->
<?php
// Ecomm Parts
$ecomm_json = file_get_contents(TEMPLATEPATH.'/inc/configurator/configurator-ecomm.json');
$ecomm_skus = json_decode($ecomm_json);
?>
<!-- Forends -->
<div class="flex_parts_container" id="parts-forend" style="display:block;">
<?php
// Forends
$options = get_flex_parts($model_sku, 'flex-forend');
$block_width = 225;
$total_width = $block_width * count($options);
$total_slides = ceil($total_width / 900);
if($total_slides > 1) {
	echo "<div class=\"flex_parts_prev flex_parts_end\" id=\"slider-forend-prev\" onclick=\"\"></div>";
}
echo "<div class=\"flex_parts_slider\">
<div class=\"flex_parts_slider_container\" id=\"slider-forend\" >";
foreach($options as $key => $part) {
	$part_id = $part['id'];
	$part_title = $part['title'];
	$part_image = $part['image'];
	$part_ecomm = $part['ecomm'];
	$part_lop = $part['lop'];
	if($part_ecomm) {
		// Get Product
		$sku = trim($part_ecomm);
		$ecomm_price = number_format($ecomm_skus->$part_id->$sku->price,2);
		$ecomm_stock = $ecomm_skus->$part_id->$sku->stock;
		$ecomm_image = $ecomm_skus->$part_id->$sku->image;
		$ecomm_link = $ecomm_skus->$part_id->$sku->link;
		// Stock 
		$stock_display = NULL;
		if($ecomm_stock != 1) {
			$stock_display = ' | OUT OF STOCK';
		}
		echo "<div class=\"flex_parts_slider_block\">
		<div class=\"flex_parts_slider_tile\" id=\"tile-{$part_id}\" onclick=\"switch_part('$part_id', '$part_image', 'forend', '$part_lop');\">
		<div style=\"background-image:url($ecomm_image);\" class=\"flex_parts_slider_image\"></div>
		<div class=\"flex_parts_slider_name\">$part_title</div>
		<div class=\"flex_parts_slider_sku\">SKU: $part_ecomm</div>
		<div class=\"flex_parts_slider_price\">\$$ecomm_price</div>
		</div>
		<a href=\"$ecomm_link\" class=\"flex_parts_slider_button\" target=\"_blank\">View In Store</a>
		</div>";
	}
}
echo "<input name=\"slider-forend-total\" id=\"slider-forend-total\" type=\"hidden\" value=\"$total_slides\" />
<input name=\"slider-forend-current\" id=\"slider-forend-current\" type=\"hidden\" value=\"0\" />
</div>
</div>";
if($total_slides > 1) {
	echo "<div class=\"flex_parts_next\" id=\"slider-forend-next\" onclick=\"slide_next('slider-forend','900')\"></div>";
}
?>

</div>
<!-- Forends -->

<!-- Stocks -->
<div class="flex_parts_container" id="parts-stock">
<?php
// Stocks
$options = get_flex_parts($model_sku, 'flex-stock');
$block_width = 225;
$total_width = $block_width * count($options);
$total_slides = ceil($total_width / 900);
if($total_slides > 1) {
	echo "<div class=\"flex_parts_prev flex_parts_end\" id=\"slider-stock-prev\" onclick=\"\"></div>";
}
echo "<div class=\"flex_parts_slider\">
<div class=\"flex_parts_slider_container\" id=\"slider-stock\">";
foreach($options as $key => $part) {
	$part_id = $part['id'];
	$part_title = $part['title'];
	$part_image = $part['image'];
	$part_ecomm = $part['ecomm'];
	$part_lop = $part['lop'];
	if($part_ecomm) {
		// Get Product
		$sku = trim($part_ecomm);
		$ecomm_price = number_format($ecomm_skus->$part_id->$sku->price,2);
		$ecomm_stock = $ecomm_skus->$part_id->$sku->stock;
		$ecomm_image = $ecomm_skus->$part_id->$sku->image;
		$ecomm_link = $ecomm_skus->$part_id->$sku->link;
		// Stock 
		$stock_display = NULL;
		if($ecomm_stock != 1) {
			$stock_display = ' | OUT OF STOCK';
		}
		echo "<div class=\"flex_parts_slider_block\">
		<div class=\"flex_parts_slider_tile\" id=\"tile-{$part_id}\" onclick=\"switch_part('$part_id', '$part_image', 'stock', '$part_lop');\">
		<div style=\"background-image:url($ecomm_image);\" class=\"flex_parts_slider_image\"></div>
		<div class=\"flex_parts_slider_name\">$part_title</div>
		<div class=\"flex_parts_slider_sku\">SKU: $part_ecomm</div>
		<div class=\"flex_parts_slider_price\">\$$ecomm_price</div>
		</div>
		<a href=\"$ecomm_link\" class=\"flex_parts_slider_button\" target=\"_blank\">View In Store</a>
		</div>";
	}
}
echo "<input name=\"slider-stock-total\" id=\"slider-stock-total\" type=\"hidden\" value=\"$total_slides\" />
<input name=\"slider-stock-current\" id=\"slider-stock-current\" type=\"hidden\" value=\"0\" />
</div>
</div>";
if($total_slides > 1) {
	echo "<div class=\"flex_parts_next\" id=\"slider-stock-next\" onclick=\"slide_next('slider-stock','900')\"></div>";
}
?>
</div>
<!-- Stocks -->

<!-- Recoil Pads -->
<div class="flex_parts_container" id="parts-recoil-pad">
<?php 
// Recoil Pad Display
$slider_display = 'inline-block';
$note_display = 'none';
$no_display = 'none';
if($kit) {
	$slider_display = 'none';
	$note_display = 'inline-block';
}
?>
<?php
// Recoil Pad
$options = get_flex_parts($model_sku, 'flex-recoil-pad');
$block_width = 225;
$total_width = $block_width * count($options);
$total_slides = ceil($total_width / 900);
if($total_slides > 1) {
	echo "<div class=\"flex_parts_prev flex_parts_end\" id=\"slider-recoil-pad-prev\" onclick=\"\"></div>";
}
echo "<div class=\"flex_parts_slider\" id=\"slider-container-recoil-pad\" style=\"display:$slider_display;\">
<div class=\"flex_parts_slider_container\" id=\"slider-recoil-pad\">";
$options = get_flex_parts($model_sku, 'flex-recoil-pad');
foreach($options as $key => $part) {
	$part_id = $part['id'];
	$part_title = $part['title'];
	$part_image = $part['image'];
	$part_ecomm = $part['ecomm'];
	$part_lop = $part['lop'];
	if($part_ecomm) {
		// Get Product
		$sku = trim($part_ecomm);
		$ecomm_price = number_format($ecomm_skus->$part_id->$sku->price,2);
		$ecomm_stock = $ecomm_skus->$part_id->$sku->stock;
		$ecomm_image = $ecomm_skus->$part_id->$sku->image;
		$ecomm_link = $ecomm_skus->$part_id->$sku->link;
		// Stock 
		$stock_display = NULL;
		if($ecomm_stock != 1) {
			$stock_display = ' | OUT OF STOCK';
		}
		echo "<div class=\"flex_parts_slider_block\">
		<div class=\"flex_parts_slider_tile\" id=\"tile-{$part_id}\" onclick=\"switch_part('$part_id', '$part_image', 'recoil-pad', '$part_lop');\">
		<div style=\"background-image:url($ecomm_image);\" class=\"flex_parts_slider_image\"></div>
		<div class=\"flex_parts_slider_name\">$part_title</div>
		<div class=\"flex_parts_slider_sku\">SKU: $part_ecomm</div>
		<div class=\"flex_parts_slider_price\">\$$ecomm_price</div>
		</div>
		<a href=\"$ecomm_link\" class=\"flex_parts_slider_button\" target=\"_blank\">View In Store</a>
		</div>";
	}
}
echo "<input name=\"slider-recoil-pad-total\" id=\"slider-recoil-pad-total\" type=\"hidden\" value=\"$total_slides\" />
<input name=\"slider-recoil-pad-current\" id=\"slider-recoil-pad-current\" type=\"hidden\" value=\"0\" />
</div>
</div>
<div class=\"flex_parts_slider_note\" id=\"slider-note-recoil-pad\" style=\"display:$note_display;\">
FLEX Recoil Pads are compatible with FLEX Stocks only. Please select a Stock first.
</div>
<div class=\"flex_parts_slider_note\" id=\"slider-no-recoil-pad\" style=\"display:$no_display;\">
The selected stock does not use a recoil pad.
</div>";
if($total_slides > 1) {
	echo "<div class=\"flex_parts_next\" id=\"slider-recoil-pad-next\" onclick=\"slide_next('slider-recoil-pad','900')\"></div>";
}
?>
</div>
<!-- Recoil Pads -->

<!-- Barrels -->
<div class="flex_parts_container" id="parts-barrel">
<?php
// Barrels
$options = get_flex_parts($model_sku, 'flex-barrel');
$block_width = 225;
$total_width = $block_width * count($options);
$total_slides = ceil($total_width / 900);
if(count($options) > 0) {
	if($total_slides > 1) {
		echo "<div class=\"flex_parts_prev flex_parts_end\" id=\"slider-barrel-prev\" onclick=\"\"></div>";
	}
	echo "<div class=\"flex_parts_slider\">
	<div class=\"flex_parts_slider_container\" id=\"slider-barrel\">";
	foreach($options as $key => $part) {
		$part_id = $part['id'];
		$part_title = $part['title'];
		$part_image = $part['image'];
		$part_ecomm = $part['ecomm'];
		$part_lop = $part['lop'];
		if($part_ecomm) {
			// Get Product
			$sku = trim($part_ecomm);
			$ecomm_price = number_format($ecomm_skus->$part_id->$sku->price,2);
			$ecomm_stock = $ecomm_skus->$part_id->$sku->stock;
			$ecomm_image = $ecomm_skus->$part_id->$sku->image;
			$ecomm_link = $ecomm_skus->$part_id->$sku->link;
			// Stock 
			$stock_display = NULL;
			if($ecomm_stock != 1) {
				$stock_display = ' | OUT OF STOCK';
			}
			echo "<div class=\"flex_parts_slider_block\">
			<div class=\"flex_parts_slider_tile\" id=\"tile-{$part_id}\" onclick=\"switch_part('$part_id', '$part_image', 'barrel', '$part_lop', '$model_barrel_xpos', '$model_barrel_ypos');\">
			<div style=\"background-image:url($ecomm_image);\" class=\"flex_parts_slider_image\"></div>
			<div class=\"flex_parts_slider_name\">$part_title</div>
			<div class=\"flex_parts_slider_sku\">SKU: $part_ecomm</div>
			<div class=\"flex_parts_slider_price\">\$$ecomm_price</div>
			</div>
			<a href=\"$ecomm_link\" class=\"flex_parts_slider_button\" target=\"_blank\">View In Store</a>
			</div>";
		}
	}
	echo "<input name=\"slider-barrel-total\" id=\"slider-barrel-total\" type=\"hidden\" value=\"$total_slides\" />
	<input name=\"slider-barrel-current\" id=\"slider-barrel-current\" type=\"hidden\" value=\"0\" />
	</div>
	</div>";
	if($total_slides > 1) {
		echo "<div class=\"flex_parts_next\" id=\"slider-barrel-next\" onclick=\"slide_next('slider-barrel','900')\"></div>";
	}
	} else {
	echo "<div class=\"flex_parts_slider_note\">
	There are no Barrels available for this model.
	</div>";
}		
?>
</div>
<!-- Barrels -->

<!-- Footer -->
<div class="flex_footer">
<div class="flex_footer_build desktop">
<a href="<?php echo get_bloginfo('url');?>/flex-cart?model=<?php echo $model;?>" class="flex_footer_button" id="flex-cart-desktop" rel="shadowbox[cart];width=700;height=550;">Add Parts to Cart</a>
<a href="<?php echo get_bloginfo('url');?>/flex-email?model=<?php echo $model;?>" class="flex_footer_button" id="flex-email-desktop" rel="shadowbox[email];width=700;height=550;" style="visibility:hidden;">Email</a>
</div>
<div class="flex_footer_build mobile">
<a href="<?php echo get_bloginfo('url');?>/flex-cart?model=<?php echo $model;?>" class="flex_footer_button" id="flex-cart-mobile" target="_blank">Add Parts to Cart</a>
<a href="<?php echo get_bloginfo('url');?>/flex-email?model=<?php echo $model;?>" class="flex_footer_button" id="flex-email-mobile" target="_blank" style="visibility:hidden;">Email</a>
</div>
<a href="<?php echo get_bloginfo('url');?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo.png" class="flex_footer_logo"/></a>
</div>
<!-- Footer -->

</div>
<!-- Bottom -->

</div>
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer('none'); ?>

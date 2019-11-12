<?php
// Ecomm Parts
$ecomm_json = file_get_contents(TEMPLATEPATH.'/inc/configurator/configurator-ecomm.json');
$ecomm_skus = json_decode($ecomm_json);
?>

<?php
// Parts
$model = sanitize_text_field($_GET['model']);
$barrel_id = sanitize_text_field($_GET['barrel']);
$forend_id = sanitize_text_field($_GET['forend']);
$stock_id = sanitize_text_field($_GET['stock']);
$recoil_id = sanitize_text_field($_GET['recoil']);
$url =  get_bloginfo('url')."/flex-cart?model=$model&barrel=$barrel_id&forend=$forend_id&stock=$stock_id&recoil=$recoil_id";
// Forend
$forend = FALSE;
if($forend_id) {
	$part_title = get_the_title($forend_id);
	$ecomm_sku = get_post_meta($forend_id, 'wpcf-flex-ecomm-sku', true);	
	$ecomm_price = number_format($ecomm_skus->$forend_id->$ecomm_sku->price,2);
	$ecomm_stock = $ecomm_skus->$forend_id->$ecomm_sku->stock;
	$ecomm_image = $ecomm_skus->$forend_id->$ecomm_sku->image;
	$forend = array('name'=>$part_title,'image'=>$ecomm_image,'sku'=>$ecomm_sku,'price'=>$ecomm_price,'stock'=>$ecomm_stock);
}
// Stock
$stock = FALSE;
if($stock_id) {
	$part_title = get_the_title($stock_id);
	$ecomm_sku = get_post_meta($stock_id, 'wpcf-flex-ecomm-sku', true);	
	$ecomm_price = number_format($ecomm_skus->$stock_id->$ecomm_sku->price,2);
	$ecomm_stock = $ecomm_skus->$stock_id->$ecomm_sku->stock;
	$ecomm_image = $ecomm_skus->$stock_id->$ecomm_sku->image;
	$stock = array('name'=>$part_title,'image'=>$ecomm_image,'sku'=>$ecomm_sku,'price'=>$ecomm_price,'stock'=>$ecomm_stock);
}
// Recoil Pad
$recoil = FALSE;
if($recoil_id) {
	$part_title = get_the_title($recoil_id);
	$ecomm_sku = get_post_meta($recoil_id, 'wpcf-flex-ecomm-sku', true);	
	$ecomm_price = number_format($ecomm_skus->$recoil_id->$ecomm_sku->price,2);
	$ecomm_stock = $ecomm_skus->$recoil_id->$ecomm_sku->stock;
	$ecomm_image = $ecomm_skus->$recoil_id->$ecomm_sku->image;
	$recoil = array('name'=>$part_title,'image'=>$ecomm_image,'sku'=>$ecomm_sku,'price'=>$ecomm_price,'stock'=>$ecomm_stock);
}
// Barrel
$barrel = FALSE;
if($barrel_id) {
	$part_title = get_the_title($barrel_id);
	$ecomm_sku = get_post_meta($barrel_id, 'wpcf-flex-ecomm-sku', true);	
	$ecomm_price = number_format($ecomm_skus->$barrel_id->$ecomm_sku->price,2);
	$ecomm_stock = $ecomm_skus->$barrel_id->$ecomm_sku->stock;
	$ecomm_image = $ecomm_skus->$barrel_id->$ecomm_sku->image;
	$barrel = array('name'=>$part_title,'image'=>$ecomm_image,'sku'=>$ecomm_sku,'price'=>$ecomm_price,'stock'=>$ecomm_stock);
}
// Adapter
$term = get_term_by('slug',$model,'flex-model');
if($term) {
	$model_id = $term->term_id;
	$model_title = $term->name;
	$model_parent = $term->parent;	
	$model_description = strip_tags($term->description);
	// Gauge
	if(strpos($model_description,'20 Gauge') === FALSE) {
		$gauge = '12 Gauge';
		} else {
		$gauge = '20 Gauge';
	}
}
$kit = FALSE;
$adapter = FALSE;
switch($model_parent) {
	case '723':
	$kit = TRUE;
	break;
	case '724':
	$kit = FALSE;
	break;
	case '725':
	$kit = TRUE;
	break;
	case '726':
	$kit = TRUE;
	break;
	case '727':
	$kit = TRUE;
	break;
	case '788':	
	$kit = FALSE;
	break;
}
if($kit) {
	switch($gauge) {
		case '12 Gauge':
		$adapter = '96024';
		$adapter_name = "FLEX Conversion Kit: 12 Gauge Stock &amp; Forearm Adapters";
		break;
		case '20 Gauge':
		$adapter = '96025';
		$adapter_name = "FLEX Conversion Kit: 20 Gauge Stock &amp; Forearm Adapters";
		break;
	}
}

// Magento Cart
include(TEMPLATEPATH.'/inc/magento/magento-flex-cart.php');
?>

<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Configurator
*/
?>
<?php 
get_header(); 
ini_set('display_errors', '1');
ini_set('max_execution_time', 100000);
ini_set('memory_limit','1024M');
?>
<?php include(TEMPLATEPATH.'/inc/magento/magento-api-config.php');?>
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');?>

<div class="content_container">
<div class="content">
<div class="content_three content_left content_sidebar">
</div>
<div class="content_nine content_right">

<?php
$ecomm = array();
// Get Parts
$model_args = array('post_type'=>'flex-configurations', 'numberposts'=>'-1', 'orderby'=>'post_title', 'order'=>'asc');
query_posts($model_args);
while(have_posts()):the_post();
	$part_id = get_the_ID();
	$part_title = get_the_title();
	$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
	$part_ecomm = get_post_meta(get_the_ID(), 'wpcf-flex-ecomm-sku', true);
	$part_lop = get_post_meta(get_the_ID(), 'wpcf-flex-lop', true);
	$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
	echo "<p>$part_title</p>";
	if($part_ecomm) {
		echo "<p>$part_ecomm</p>";
		// Get Ecomm Parts
		$sku = trim($part_ecomm);
		// API Product
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');				
		$method = 'GET';
		$url = $api_base."/store/index.php/rest/V1/products/$sku"; 				
		$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);
		$content_json = NULL;
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => [
				'Authorization: OAuth ' . http_build_query($data, '', ','),
				'Content-Type: application/json'

			]
		]);
		$result = curl_exec($curl);
		curl_close($curl);
		$product = json_decode($result);
		$entity_id = $product->id;
		$name = $product->name;
		$price = $product->price;
		$stock = $product->extension_attributes->stock_item->is_in_stock;
		$stock_qty = $product->extension_attributes->stock_item->qty;
		$image = get_bloginfo('home')."/store/pub/media/catalog/product".$product->media_gallery_entries[0]->file;
		$url_key = $product->custom_attributes[12]->value;
		$query = "SELECT request_path FROM m_url_rewrite WHERE entity_type='product' AND entity_id='$entity_id'";
		$result = @mysql_query($query);
		$row = @mysql_fetch_array($result, MYSQL_NUM);
		$link = get_bloginfo('home')."/store/".$row[0];
		// Array				
		$ecomm[$part_id][$sku] = array('entity_id'=>$entity_id,'name'=>$name,'price'=>$price,'stock'=>$stock,'stock_qty'=>$stock_qty,'image'=>$image,'link'=>$link);	
	}
endwhile;
wp_reset_query();

// Write File
$ecomm = json_encode($ecomm);
$file = get_theme_root().'/mossberg/inc/configurator/configurator-ecomm.json';
if($file) {
	file_put_contents($file, $ecomm);
}
?>

</div>
</div>
</div>

<?php get_footer(); ?>

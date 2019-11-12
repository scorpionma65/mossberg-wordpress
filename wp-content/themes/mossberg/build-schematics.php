<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Schematics
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
// Get Schematics
$terms = get_terms(array('taxonomy'=>'schematic-model','hide_empty'=>FALSE));
foreach($terms as $term) {
	$model_name = $term->name;
	$model_slug = $term->slug;
	if($model_slug != 'rifle-schematic' && $model_slug != 'shotgun-schematic') {
		echo "<h3>$model_name</h3>";
		// Get Parts
		$model_args = array('post_type'=>'schematic', 'numberposts'=>'-1', 'orderby'=>'post_title', 'order'=>'asc', 'tax_query'=>array(array('taxonomy'=>'schematic-model','field'=>'slug','terms'=>$model_slug)));
		query_posts($model_args);
		while(have_posts()):the_post();
			$part_id = $post->ID;
			$part_title = $post->post_title;
			$part_restricted = get_post_meta($part_id, 'wpcf-part-restricted', true);
			$part_ecomm_skus = get_post_meta($part_id, 'wpcf-part-ecomm-skus', true);
			echo "<p>$part_title</p>";
			if(!$part_restricted && $part_ecomm_skus) {
				echo "<p>$part_ecomm_skus</p>";
				// Get Ecomm Parts
				$skus = explode(',',$part_ecomm_skus);
				foreach($skus as $key => $sku) {
					$sku = trim($sku);
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
					$image = $product->media_gallery_entries[0]->file;
					foreach($product->custom_attributes as $key => $attribute) {
						if($attribute->attribute_code == 'url_key') {
							$url_key = $attribute->value;
						}
						if($attribute->attribute_code == 'caliber') {
							$caliber = $attribute->value;
						}
					}
					$link = get_bloginfo('home')."/store/".$url_key.'.html';
					// Array				
					$ecomm[$part_id][$sku] = array('entity_id'=>$entity_id,'name'=>$name,'price'=>$price,'stock'=>$stock,'stock_qty'=>$stock_qty,'image'=>$image,'link'=>$link,'caliber'=>$caliber);				
				}
			}
		endwhile;
		wp_reset_query();
	}
}

// Write File
$ecomm = json_encode($ecomm);
$file = get_theme_root().'/mossberg/inc/schematic/schematic-ecomm.json';
if($file) {
	file_put_contents($file, $ecomm);
}
?>

</div>
</div>
</div>

<?php get_footer(); ?>

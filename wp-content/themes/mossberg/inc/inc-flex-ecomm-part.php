<?php
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
$mage_entity_id = $product->id;
$mage_name = $product->name;
$mage_price = number_format($product->price, 2);
$mage_stock = $product->extension_attributes->stock_item->is_in_stock;
$mage_stock_qty = $product->extension_attributes->stock_item->qty;
$mage_image = get_bloginfo('home')."/store/pub/media/catalog/product".$product->media_gallery_entries[0]->file;
$mage_url_key = $product->custom_attributes[12]->value;
$query = "SELECT request_path FROM m_url_rewrite WHERE entity_type='product' AND entity_id='$mage_entity_id'";
$result = @mysql_query($query);
$row = @mysql_fetch_array($result, MYSQL_NUM);
$mage_link = get_bloginfo('home')."/store/".$row[0];
?>
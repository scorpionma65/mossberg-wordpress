<?php ini_set('max_execution_time', 3600); ?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Dates
$this_hour = date('Y-m-d h:i:s');
$last_hour = date('Y-m-d h:i:s', strtotime('-1 hour'));
// Quotes
$query = "SELECT m_quote.entity_id, m_quote.created_at, m_quote.customer_email 
FROM m_quote 
WHERE m_quote.created_at BETWEEN '$last_hour' AND '$this_hour' 
AND m_quote.customer_email!='' 
ORDER BY m_quote.entity_id ASC";
$result = @mysql_query($query);
echo mysql_error();
while($row = @mysql_fetch_array($result,MYSQL_NUM)){
	$quote_id = $row[0];
	$quote_date = $row[1];
	$quote_email = strtolower($row[2]);
	// Order
	$query_o = "SELECT m_sales_order.increment_id FROM m_sales_order 
	WHERE m_sales_order.quote_id='$quote_id' AND (m_sales_order.status='complete' OR m_sales_order.status='processing' OR m_sales_order.status='repair')";
	$result_o = @mysql_query($query_o);
	if(@mysql_num_rows($result_o) == 0) {
		// SKUs
		$query_s = "SELECT m_quote_item.product_id, m_quote_item.sku, m_quote_item.name, m_quote_item.price  
		FROM m_quote_item 
		WHERE m_quote_item.quote_id='$quote_id'";
		$result_s = @mysql_query($query_s);
		if(@mysql_num_rows($result_s) > 0) {
			echo "<h3>$quote_id | $quote_email</h3>";
			$magento_abandoned_display = NULL;
			$magento_abandoned_skus = NULL;
			while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
				$item_id = $row_s[0];
				$item_sku = $row_s[1];
				$item_name = $row_s[2];
				$item_price = number_format($row_s[3],2);
				// Link
				$query_b = "SELECT m_catalog_product_entity_varchar.value AS url_key 
				FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
				WHERE m_catalog_product_entity.entity_id='$item_id' 
				AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
				AND m_catalog_product_entity_varchar.attribute_id='117'  
				GROUP BY m_catalog_product_entity.entity_id";
				$result_b = @mysql_query($query_b);
				$row_b = @mysql_fetch_array($result_b, MYSQL_ASSOC);
				$url_key = $row_b['url_key'];
				$item_link = "http://www.mossberg.com/store/".$url_key.'.html';
				// Image
				$query_c = "SELECT m_catalog_product_entity_varchar.value AS image  
				FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
				WHERE m_catalog_product_entity.entity_id='$item_id' 
				AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
				AND m_catalog_product_entity_varchar.attribute_id='84'  
				GROUP BY m_catalog_product_entity.entity_id";
				$result_c = @mysql_query($query_c);
				$row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC);
				$item_image = "http://www.mossberg.com/store/pub/media/catalog/product/".$row_c['image'];
				
				if(strpos($magento_abandoned_skus, $item_sku) === FALSE) {
					$magento_abandoned_skus .= $item_sku.'; ';
					$magento_abandoned_display .= "<table style=\"width:600px; border-top:1px solid #000; border-spacing:none; border-collapse:collapse; font-family:Arial; font-size:16px; line-height:22px;\">
					<tr>
					<td style=\"width:50%; padding:20px 0px; vertical-align:middle; text-align:left;\">
					<a href=\"$item_link\" target=\"_blank\"><img src=\"$item_image\" width=\"250\" style=\"width:250px; height:auto; border:none;\"/></a>
					</td>
					<td style=\"width:50%; padding:20px 0px; vertical-align:middle; text-align:left;\">
					<p><strong>$item_name</strong></p><p>Price: \$$item_price</p>
					<a href=\"$item_link\" target=\"_blank\"><img src=\"https://cdn2.hubspot.net/hubfs/479666/Email_Images/button-view-product.png\" style=\"border:none;\"/></a>
					</td>
					</tr>
					</table>";
				}
			}
			$magento_abandoned_skus = trim($magento_abandoned_skus);
			echo "<p>$magento_abandoned_skus</p>$magento_abandoned_display";
		}
		// Hubspot
		include('magento-hubspot-abandoned-cart-submission.php');
	}	
}
echo "$last_hour - $this_hour | $total Orders Synced \n";

?>
<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Report Ecomm Products
*/
ini_set('max_execution_time', 10000);
include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');
?>
<style>
.data_table { font-size:10px; text-align:left; font-family:Arial; }
.data_table tr:nth-child(odd) td { }
.data_table tr:nth-child(even) td{ background:#EBEBEB; }
.data_table td { min-width:80px; padding:5px; }
.data_table img { border:1px solid #666; }
.data_table_header td { background:#000; color:#FFF; font-weight:bold; }
</style>
<div class="content_container" style="background:#FFF;">
<div class="container_text">
<table class="data_table">
<tr class="data_table_header">
<td>Image</td>
<td>SKU</td>
<td>Product</td>
<td>Status</td>
<td style="text-align:right;">Price</td>
<td style="text-align:right;">SpecialPrice</td>
<td>URL</td>
<?php
// Attributes
$bg = "#555";
$attributes = array();
$query_a = "SELECT attribute_id, frontend_label, backend_type  
FROM m_eav_attribute 
WHERE entity_type_id='4' AND is_user_defined='1' 
ORDER BY frontend_label ASC";
$result_a = @mysql_query($query_a);
while($row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC)) {
	$attribute_id = $row_a['attribute_id'];
	$attribute_name = $row_a['frontend_label'];
	$attribute_type = $row_a['backend_type'];
	if($attribute_name != 'Cost' && $attribute_name != 'Manufacturer') {
		$attributes[$attribute_id] = $attribute_type;
		echo "<td style=\"background:{$bg};\">$attribute_name</td>";
	}
}
echo mysql_error();
?>
<?php
// Categories
$bg = "#333";
$categories = array();
$query_c = "SELECT m_catalog_category_entity.row_id AS category_id, m_catalog_category_entity.parent_id AS parent_id, m_catalog_category_entity_varchar.value AS category_name 
FROM m_catalog_category_entity, m_catalog_category_entity_varchar 
WHERE m_catalog_category_entity.row_id=m_catalog_category_entity_varchar.row_id 
AND m_catalog_category_entity_varchar.attribute_id='42' 
ORDER BY m_catalog_category_entity.path ASC";
$result_c = @mysql_query($query_c);
while($row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC)) {
	$category_id = $row_c['category_id'];
	$category_parent = $row_c['parent_id'];
	$category_name = $row_c['category_name'];
	if($category_parent != 0 && $category_parent != 1) {
		$categories[$category_id] = $category_name;
		echo "<td style=\"background:{$bg};\">$category_name</td>";
	}
}
echo mysql_error();
?>
</tr>
<?php
// Ecomm Products
$query_m = "SELECT m_catalog_product_entity.entity_id, m_catalog_product_entity.row_id, m_catalog_product_entity.sku 
FROM m_catalog_product_entity 
ORDER BY m_catalog_product_entity.sku ASC";
$result_m = @mysql_query($query_m);
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
	// Special Price
	$query = "SELECT value FROM m_catalog_product_entity_decimal 
	WHERE row_id='$row_id' 
	AND attribute_id='75'";
	$result = @mysql_query($query);
	$row = @mysql_fetch_array($result, MYSQL_NUM);
	$special_price = number_format($row_a[0],2);
	// Status
	$query = "SELECT value FROM m_catalog_product_entity_int 
	WHERE row_id='$row_id' 
	AND attribute_id='94'";
	$result = @mysql_query($query);
	$row = @mysql_fetch_array($result, MYSQL_NUM);
	$status = $row[0];
	if($status == 1) {
		$status = 'Enabled';
		} else {
		$status = 'Disabled';
	}	
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
	$image = "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-x.png\" style=\"width:60px; height:60px;\"/>";
	if($row_c['image']) {
		$image = "<img src=\"".get_bloginfo('url')."/store/pub/media/catalog/product/".$row_c['image']."\" style=\"width:60px; height:60px;\"/>";
	}
	echo mysql_error();
	echo "<tr>
	<td>$image</td>
	<td>$sku</td>
	<td>$name</td>
	<td>$status</td>
	<td style=\"text-align:right;\">\$$price</td>
	<td style=\"text-align:right;\">\$$special_price</td>
	<td>$link</td>";
	foreach($attributes as $key=>$value) {
		$attribute_value = NULL;
		switch($value) {
			case 'varchar':
			$query_ap = "SELECT value FROM m_catalog_product_entity_varchar WHERE attribute_id='$key' AND row_id='$row_id'";
			$result_ap = @mysql_query($query_ap);
			$row_ap = @mysql_fetch_array($result_ap, MYSQL_NUM);
			$attribute_value = $row_ap[0];
			$options = explode(',',$attribute_value);
			$option_values = array();
			foreach($options as $option_id) {
				$query_v = "SELECT value FROM m_eav_attribute_option_value WHERE option_id='$option_id' AND store_id='0'";
				$result_v = @mysql_query($query_v);
				$row_v = @mysql_fetch_array($result_v, MYSQL_NUM);
				$option_values[] = $row_v[0];
			}
			if(count($option_values) > 1) {
				$attribute_value = implode('<br/>',$option_values);
				} else {
				$attribute_value = $option_values[0];
			}
			break;
			case 'int':
			$query_ap = "SELECT value FROM m_catalog_product_entity_int WHERE attribute_id='$key' AND row_id='$row_id'";
			$result_ap = @mysql_query($query_ap);
			$row_ap = @mysql_fetch_array($result_ap, MYSQL_NUM);
			$attribute_value = $row_ap[0];
			$options = explode(',',$attribute_value);
			$option_values = array();
			foreach($options as $option_id) {
				$query_v = "SELECT value FROM m_eav_attribute_option_value WHERE option_id='$option_id' AND store_id='0'";
				$result_v = @mysql_query($query_v);
				$row_v = @mysql_fetch_array($result_v, MYSQL_NUM);
				$option_values[] = $row_v[0];
			}
			if(count($option_values) > 1) {
				$attribute_value = implode('<br/>',$option_values);
				} else {
				$attribute_value = $option_values[0];
			}
		}
		echo "<td>$attribute_value</td>";
	}
	foreach($categories as $key=>$value) {
		$query_cp = "SELECT product_id FROM m_catalog_category_product WHERE product_id='$row_id' AND category_id='$key'";
		$result_cp = @mysql_query($query_cp);
		if(@mysql_num_rows($result_cp) > 0) {
			echo "<td>X</td>";
			} else {
			echo "<td></td>";
		}
	}
	echo"</tr>";
}
?>
</table>
</div>
</div>

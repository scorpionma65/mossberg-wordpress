<?php ini_set('max_execution_time', 18000); ?>
<?php
// Config Timing
date_default_timezone_set('America/New_York');
echo "<p>".date('Y-m-d H:i:s')." | ".strtotime('now')."</p>";
$days = array(
'bf2018barrels'=>strtotime('2019-11-18 23:58:00'), 
'bf2018sights'=>strtotime('2019-11-19 23:58:00'), 
'bf2018stocks'=>strtotime('2019-11-20 23:58:00'), 
'bf2018cases'=>strtotime('2019-11-21 23:58:00'), 
'bf2018apparel'=>strtotime('2019-11-22 23:58:00')
);
?>
<?php 
// Connect Magento
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Base Categories
$reindex = FALSE;
$root_category_id = 440;
$query = "SELECT m_catalog_category_entity.row_id, m_catalog_category_entity_varchar.value, m_catalog_category_entity_int.value 
FROM m_catalog_category_entity, m_catalog_category_entity_varchar, m_catalog_category_entity_int 
WHERE m_catalog_category_entity.row_id=m_catalog_category_entity_varchar.row_id 
AND m_catalog_category_entity.row_id=m_catalog_category_entity_int.row_id 
AND m_catalog_category_entity.parent_id='$root_category_id' 
AND m_catalog_category_entity_varchar.attribute_id='115' 
AND m_catalog_category_entity_int.attribute_id='43' 
GROUP BY m_catalog_category_entity.row_id";
$result = @mysql_query($query);
while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
	$activation_check = FALSE;
	$activate = FALSE;
	$base_category_id = $row[0];
	$base_category_url_key = $row[1];
	$base_category_status = $row[2];
	// Check Activation
	if(array_key_exists($base_category_url_key,$days)) {
		$activation_check = TRUE;
	}
	if($activation_check) {
		if($days[$base_category_url_key] < strtotime('now')){
			$activate = TRUE;
			echo "<h3 style=\"color:#390;\">ACTIVATE</h3>";
		}
	}
	// Activate Base Category -----------------------------------------------------
	if($activate) {	
		if($base_category_status == 0) {
			$reindex = TRUE;
echo "1";
			echo "<h4 style=\"color:#390;\">ACTIVATE BASE CATEGORY</h4>";
			$query_abc = "UPDATE m_catalog_category_entity_int SET value='1' WHERE attribute_id='43' AND row_id='$base_category_id'";
			$result_abc = @mysql_query($query_abc);
			echo mysql_error();
		}
		} else {
		// Deactivate Base Category -----------------------------------------------
		if($base_category_status == 1) {
			$reindex = TRUE;
echo "2";
			echo "<h4 style=\"color:#C00;\">DEACTIVATE BASE CATEGORY</h4>";
			$query_abc = "UPDATE m_catalog_category_entity_int SET value='0' WHERE attribute_id='43' AND row_id='$base_category_id'";
			$result_abc = @mysql_query($query_abc);
			echo mysql_error();
		}
	}
	// ----------------------------------------------------------------------------	
	echo "<h2>KEY: $base_category_url_key // ID: $base_category_id // STATUS: $base_category_status</h2>";
	// Sub Categories
	$query_s = "SELECT m_catalog_category_entity.row_id, m_catalog_category_entity_varchar.value, m_catalog_category_entity_int.value 
	FROM m_catalog_category_entity, m_catalog_category_entity_varchar, m_catalog_category_entity_int 
	WHERE m_catalog_category_entity.row_id=m_catalog_category_entity_varchar.row_id 
	AND m_catalog_category_entity.row_id=m_catalog_category_entity_int.row_id 
	AND m_catalog_category_entity.parent_id='$base_category_id' 
	AND m_catalog_category_entity_varchar.attribute_id='115' 
	AND m_catalog_category_entity_int.attribute_id='43' 
	GROUP BY m_catalog_category_entity.row_id";
	$result_s = @mysql_query($query_s);
	while($row_s = @mysql_fetch_array($result_s, MYSQL_NUM)) {
		$sub_category_id = $row_s[0];
		$sub_category_url_key = $row_s[1];
		$sub_category_status = $row_s[2];
		$sub_category_discount = end(explode('-',$sub_category_url_key)) / 100;				
		// Activate Sub Category -----------------------------------------------------
		if($activate) {	
			if($sub_category_status == 0) {
				$reindex = TRUE;
echo "3";
				echo "<h4 style=\"color:#390;\">ACTIVATE SUB CATEGORY</h4>";
				$query_asc = "UPDATE m_catalog_category_entity_int SET value='1' WHERE attribute_id='43' AND row_id='$sub_category_id'";
				$result_asc = @mysql_query($query_asc);
				echo mysql_error();
			}
			} else {
			// Deactivate Sub Category -----------------------------------------------
			if($sub_category_status == 1) {
				$reindex = TRUE;
echo "4";
				echo "<h4 style=\"color:#C00;\">DEACTIVATE SUB CATEGORY</h4>";
				$query_asc = "UPDATE m_catalog_category_entity_int SET value='0' WHERE attribute_id='43' AND row_id='$sub_category_id'";
				$result_asc = @mysql_query($query_asc);
				echo mysql_error();
			}
		}
		// ----------------------------------------------------------------------------	
		echo "<h4>KEY: $sub_category_url_key // ID: $sub_category_id // STATUS: $sub_category_url_key // DISCOUNT: $sub_category_discount</h4>";
		// Products
		$query_p = "SELECT m_catalog_product_entity.row_id, m_catalog_product_entity.entity_id, m_catalog_product_entity.sku, m_catalog_product_entity_decimal.value, m_catalog_product_entity.type_id  
		FROM m_catalog_product_entity, m_catalog_category_product_index, m_catalog_product_entity_decimal    
		WHERE m_catalog_category_product_index.product_id=m_catalog_product_entity.entity_id 
		AND m_catalog_product_entity.row_id=m_catalog_product_entity_decimal.row_id 
		AND m_catalog_category_product_index.category_id='$sub_category_id' 
		AND m_catalog_product_entity_decimal.attribute_id='74' 
		AND m_catalog_product_entity.created_in='1'";
		$result_p = @mysql_query($query_p);
		while($row_p = @mysql_fetch_array($result_p, MYSQL_NUM)) {
			$active = "NO";
			$product_row_id = $row_p[0];
			$product_entity_id = $row_p[1];
			$product_sku = $row_p[2];
			$product_price = $row_p[3];
			$product_type = $row_p[4];
			$product_special_price = number_format($product_price * (1 - $sub_category_discount), 2);
			// Activate Pricing
			if($activate) {
				
				// Activate Root Category --------------------------------------------
				$query_aprc = "SELECT * FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$product_entity_id'";
				$result_aprc = @mysql_query($query_aprc);
				if(@mysql_num_rows($result_aprc) == 0) {
					$reindex = TRUE;	
echo "5";				
					echo "<h5 style=\"color:#390;\">ACTIVATE ROOT CATEGORY</h5>";
					$query_apr = "INSERT INTO m_catalog_category_product (category_id, product_id, position) 
					VALUES ('$root_category_id', '$product_entity_id', '10000')";
					$result_apr = @mysql_query($query_apr);
					echo mysql_error();
					$query_apri = "INSERT INTO m_catalog_category_product_index (category_id, product_id, position, is_parent, store_id, visibility) 
					VALUES ('$root_category_id', '$product_entity_id', '10000', '0', '1', '4')";
					$result_apri = @mysql_query($query_apri);
					echo mysql_error();
				}					
				// Activate Special Price --------------------------------------------
				$active = "YES";
				echo "<h5 style=\"color:#390;\">ACTIVATE SPECIAL PRICE</h5>";
				// Set Special Price
				$query_cpsp = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
				WHERE row_id='$product_row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
				$result_cpsp = @mysql_query($query_cpsp);
				if(@mysql_num_rows($result_cpsp) == 1) {
					$query_pspu = "UPDATE m_catalog_product_entity_decimal SET value='$product_special_price' WHERE row_id='$product_row_id' AND attribute_id='75'";
					$result_pspu = @mysql_query($query_pspu);
				}
				if(@mysql_num_rows($result_cpsp) == 0) {
					$query_pspi = "INSERT INTO m_catalog_product_entity_decimal (value, row_id, attribute_id) VALUES ('$product_special_price', '$product_row_id', '75')";
					$query_pspi = @mysql_query($query_pspi);
				}
				} else {
				// Deactivate Root Category ------------------------------------------
				$query_dprc = "SELECT * FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$product_entity_id'";
				$result_dprc = @mysql_query($query_dprc);
				if(@mysql_num_rows($result_dprc) > 0) {
					$reindex = TRUE;
echo "6";
					echo "<h5 style=\"color:#C00;\">DEACTIVATE ROOT CATEGORY</h5>";
					$query_dpr = "DELETE FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$product_entity_id'";
					$result_dpr = @mysql_query($query_dpr);
					echo mysql_error();
					$query_dpri = "DELETE FROM m_catalog_category_product_index WHERE category_id='$root_category_id' AND product_id='$product_entity_id'";
					$result_dpri = @mysql_query($query_dpri);
					echo mysql_error();
				}
				// Deactivate Special Price --------------------------------------------
				$active = "No";
				echo "<h5 style=\"color:#C00;\">DEACTIVATE SPECIAL PRICE</h5>";
				// Set Special Price
				$query_cpsp = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
				WHERE row_id='$product_row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
				$result_cpsp = @mysql_query($query_cpsp);
				if(@mysql_num_rows($result_cpsp) == 1) {
					//$query_pspd = "UPDATE m_catalog_product_entity_decimal SET value=NULL WHERE row_id='$product_row_id' AND attribute_id='75'";
					//$result_pspd = @mysql_query($query_pspd);
				}					
			}				
			echo "<p>SKU: $product_sku // ROW: $product_row_id // ENT: $product_entity_id // REG: \$$product_price // SPEC: \$$product_special_price // ACTIVE: $active</p>";
			if($product_type == 'configurable') {
				// Configurable Products
				$query_pc = "SELECT m_catalog_product_relation.child_id, m_catalog_product_entity.sku  
				FROM m_catalog_product_relation, m_catalog_product_entity, m_catalog_category_product  
				WHERE m_catalog_product_entity.entity_id=m_catalog_product_relation.child_id 
				AND m_catalog_product_entity.entity_id=m_catalog_category_product.product_id 
				AND m_catalog_category_product.category_id='$sub_category_id' 
				AND m_catalog_product_relation.parent_id='$product_row_id' 
				GROUP BY m_catalog_product_entity.entity_id";
				$result_pc = @mysql_query($query_pc);
				while($row_pc = @mysql_fetch_array($result_pc, MYSQL_NUM)) {
					$child_product_entity_id = $row_pc[0];		
					$query_pcp = "SELECT m_catalog_product_entity.row_id, m_catalog_product_entity.entity_id, m_catalog_product_entity.sku, m_catalog_product_entity_decimal.value  
					FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
					WHERE m_catalog_product_entity.row_id=m_catalog_product_entity_decimal.row_id 
					AND m_catalog_product_entity.entity_id='$child_product_entity_id' 
					AND m_catalog_product_entity_decimal.attribute_id='74' 
					AND m_catalog_product_entity.created_in='1'";
					$result_pcp = @mysql_query($query_pcp);
					$row_pcp = @mysql_fetch_array($result_pcp, MYSQL_NUM);
					$active = "NO";
					$config_product_row_id = $row_pcp[0];
					$config_product_entity_id = $row_pcp[1];
					$config_product_sku = $row_pcp[2];
					$config_product_price = $row_pcp[3];
					$config_product_special_price = number_format($config_product_price * (1 - $sub_category_discount), 2);
					// Activate Pricing
					if($activate) {
						
						// Activate Root Category --------------------------------------------
						$query_acprc = "SELECT * FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$config_product_entity_id'";
						$result_acprc = @mysql_query($query_acprc);
						if(@mysql_num_rows($result_acprc) == 0) {
							$reindex = TRUE;
echo "7";
							echo "<h5 style=\"color:#390;\">ACTIVATE ROOT CATEGORY</h5>";
							$query_acpr = "INSERT INTO m_catalog_category_product (category_id, product_id, position) 
							VALUES ('$root_category_id', '$config_product_entity_id', '10000')";
							$result_acpr = @mysql_query($query_acpr);
							echo mysql_error();
							$query_acpri = "INSERT INTO m_catalog_category_product_index (category_id, product_id, position, is_parent, store_id, visibility) 
							VALUES ('$root_category_id', '$config_product_entity_id', '10000', '0', '1', '4')";
							$result_acpri = @mysql_query($query_acpri);
							echo mysql_error();
						}
						// Activate Special Price --------------------------------------------
						$active = "YES";
						echo "<h5 style=\"color:#390;\">ACTIVATE SPECIAL PRICE</h5>";
						// Set Special Price
						$query_ccpsp = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
						WHERE row_id='$config_product_row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
						$result_ccpsp = @mysql_query($query_ccpsp);
						if(@mysql_num_rows($result_ccpsp) == 1) {
							$query_cpspu = "UPDATE m_catalog_product_entity_decimal SET value='$config_product_special_price' WHERE row_id='$config_product_row_id' AND attribute_id='75'";
							$result_cpspu = @mysql_query($query_cpspu);
						}
						if(@mysql_num_rows($result_cpsp) == 0) {
							$query_cpspi = "INSERT INTO m_catalog_product_entity_decimal (value, row_id, attribute_id) VALUES ('$config_product_special_price', '$config_product_row_id', '75')";
							$query_cpspi = @mysql_query($query_cpspi);
						}						
						} else {
						// Deactivate Root Category ------------------------------------------
						$query_dcprc = "SELECT * FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$config_product_entity_id'";
						$result_dcprc = @mysql_query($query_dcprc);
						if(@mysql_num_rows($result_dcprc) > 0) {
							$reindex = TRUE;
echo "8";
							echo "<h5 style=\"color:#C00;\">DEACTIVATE ROOT CATEGORY</h5>";
							$query_dcpr = "DELETE FROM m_catalog_category_product WHERE category_id='$root_category_id' AND product_id='$config_product_entity_id'";
							$result_dcpr = @mysql_query($query_dcpr);
							echo mysql_error();
							$query_dcpri = "DELETE FROM m_catalog_category_product_index WHERE category_id='$root_category_id' AND product_id='$config_product_entity_id'";
							$result_dcpri = @mysql_query($query_dcpri);
							echo mysql_error();
						}
						// Deactivate Special Price --------------------------------------------
						$active = "No";
						echo "<h5 style=\"color:#C00;\">DEACTIVATE SPECIAL PRICE</h5>";
						// Set Special Price
						$query_ccpsp = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
						WHERE row_id='$config_product_row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
						$result_ccpsp = @mysql_query($query_ccpsp);
						if(@mysql_num_rows($result_ccpsp) == 1) {
							//$query_cpspd = "UPDATE m_catalog_product_entity_decimal SET value=NULL WHERE row_id='$config_product_row_id' AND attribute_id='75'";
							//$result_cpspd = @mysql_query($query_cpspd);
						}							
					}	
					echo "<p>SKU: $config_product_sku // ROW: $config_product_row_id // ENT: $config_product_entity_id // REG: \$$config_product_price // SPEC: \$$config_product_special_price // ACTIVE: $active</p>";
				}
			}
		}
	}
}
?>
<?php
if($reindex) {
	// Reindex
	echo "<h3>REINDEX</h3>";
	include('/mnt/homevolume0/mossberg/public_html/store/reindex.php'); 
	} else {
	echo "<h3>NO REINDEX</h3>";
}
?>

<?php
// Connect
require_once('/var/www/html/wp-content/themes/mossberg/inc/inc-mysql-connect.php');

// Redirect SKU
if($_GET['id']) {
	// Product
	$sku = mysql_real_escape_string($_GET['id']);
	$query = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
	$result = @mysql_query($query);
	if(@mysql_num_rows($result) == 1) {
		$row = @mysql_fetch_array($result,MYSQL_NUM);
		$post_id = $row[0]; 
		// Redirect
		$query_p = "SELECT post_name FROM wp_posts WHERE ID='$post_id'";
		$result_p = @mysql_query($query_p);
		if(@mysql_num_rows($result_p) == 1) {
			$row_p = @mysql_fetch_array($result_p,MYSQL_NUM);
			$post_slug = $row_p[0];
			$product_link = "http://www.mossberg.com/product/$post_slug/";
			header("Location: $product_link");
			} else {
			header("Location: http://www.mossberg.com/404");
		}
		} else {
		header("Location: http://www.mossberg.com/404");
	}
	} else {
	header("Location: http://www.mossberg.com/404");
}
?>
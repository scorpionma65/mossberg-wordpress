<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Report Ecomm Orders
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
<td>OrderID</td>
<td>DateCreated</td>
<td>Status</td>
<td>CustomerID</td>
<td>Email</td>
<td>BillTo</td>
<td>BillingAddress</td>
<td>ShipTo</td>
<td>ShippingAddress</td>
<td>ShipMethod</td>
<td style="text-align:right;">Subtotal</td>
<td style="text-align:right;">Shipping</td>
<td style="text-align:right;">Tax</td>
<td style="text-align:right;">GrandTotal</td>
<td>AxID</td>
<td>ShippingID</td>
<td>InvoiceID</td>
<td>Tracking</td>
</tr>
<?php
// Limit
$limit = 1000;
if(!empty($_GET['limit'])) {
	$limit = mysql_real_escape_string($_GET['limit']);
}
// Orders
$query_m = "SELECT 
m_sales_order.entity_id AS entity_id, 
m_sales_order.increment_id AS increment_id, 
m_sales_order.status AS status, 
m_sales_order.shipping_description AS shipping_description, 
m_sales_order.grand_total AS grand_total, 
m_sales_order.subtotal AS subtotal, 
m_sales_order.shipping_amount AS shipping_amount, 
m_sales_order.tax_amount AS tax_amount,  
m_sales_order.created_at AS created_at 
FROM m_sales_order 
WHERE m_sales_order.status='processing' OR m_sales_order.status='complete' 
ORDER BY m_sales_order.entity_id DESC LIMIT $limit";
$result_m = @mysql_query($query_m);
while($row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC)) {
	$entity_id = $row_m['entity_id'];
	$increment_id = $row_m['increment_id'];
	$status = $row_m['status'];	
	$shipping_method = $row_m['shipping_description'];
	$grand_total = number_format($row_m['grand_total'],2);
	$subtotal = number_format($row_m['subtotal'],2);
	$shipping_total = number_format($row_m['shipping_and_handling'],2);
	$tax_total = number_format($row_m['tax_amount'],2);
	$created_at = $row_m['created_at'];

	// Customer
	$query_c = "SELECT 
	m_sales_order_grid.customer_id AS customer_id, 
	m_sales_order_grid.shipping_name AS shipping_name, 
	m_sales_order_grid.shipping_address AS shipping_address, 
	m_sales_order_grid.billing_name AS billing_name, 
	m_sales_order_grid.billing_address AS billing_address, 
	m_sales_order_grid.customer_email AS customer_email 
	FROM m_sales_order_grid 
	WHERE m_sales_order_grid.increment_id='$increment_id'";
	$result_c = @mysql_query($query_c);
	$row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC);
	$customer_id = $row_c['customer_id'];
	$shipping_name = $row_c['shipping_name'];
	$shipping_address = $row_c['shipping_address'];
	$billing_name = $row_c['billing_name'];
	$billing_address = $row_c['billing_address'];
	$email = $row_c['customer_email'];

	// AX ID
	$query_x = "SELECT target_order_id FROM m_i95dev_sales_flat_order WHERE source_order_id='$increment_id'";
	$result_x = @mysql_query($query_x);
	$row_x = @mysql_fetch_array($result_x, MYSQL_ASSOC);
	$ax_id = $row_x['target_order_id'];
	
	// Shipping ID
	$query_s = "SELECT target_id FROM m_i95dev_shipment_erp_report WHERE ref_name='$ax_id'";
	$result_s = @mysql_query($query_s);
	$row_s = @mysql_fetch_array($result_s, MYSQL_ASSOC);
	$shipping_id = $row_s['target_id'];
	
	// Invoice ID
	$query_s = "SELECT target_id FROM m_i95dev_invoice_erp_report WHERE ref_name='$ax_id'";
	$result_s = @mysql_query($query_s);
	$row_s = @mysql_fetch_array($result_s, MYSQL_ASSOC);
	$invoice_id = $row_s['target_id'];
 	
	// Tracking
	$query_t = "SELECT track_number FROM m_sales_shipment_track WHERE order_id='$entity_id'";
	$result_t = @mysql_query($query_t);
	$row_t = @mysql_fetch_array($result_t, MYSQL_ASSOC);
	$tracking = $row_t['track_number'];
	
	echo "<tr>
	<td>$increment_id</td>
	<td>$created_at</td>
	<td>$status</td>
	<td>$customer_id</td>
	<td>$email</td>
	<td>$billing_name</td>
	<td>$billing_address</td>
	<td>$shipping_name</td>
	<td>$shipping_address</td>
	<td>$shipping_method</td>
	<td style=\"text-align:right;\">\$$subtotal</td>
	<td style=\"text-align:right;\">\$$shipping_total</td>
	<td style=\"text-align:right;\">\$$tax_total</td>
	<td style=\"text-align:right;\">\$$grand_total</td>
	<td>$ax_id</td>
	<td>$shipping_id</td>
	<td>$invoice_id</td>
	<td>$tracking</td>";
	echo"</tr>";
}
echo mysql_error();
?>
</table>
</div>
</div>

<?php 
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Dates
date_default_timezone_set('America/Chicago');
$current = date('Y-m-d H:i:s');
$today = date('Y-m-d 12:00:00');
$yesterday = date('Y-m-d 12:00:01', strtotime('-1 days'));
$past_30 = date('Y-m-d 12:00:01', strtotime('-30 days'));
$past_180 = date('Y-m-d 12:00:01', strtotime('-180 days'));
$now = date('Y-m-d (g:i A T)');

// Daily Fulfillment
$processing = array();
$complete = array();
$pending = array();
$query_s = "SELECT m_sales_order.entity_id, m_sales_order.status, m_sales_order.shipping_description, m_i95dev_sales_flat_order.target_order_id, m_sales_order.increment_id, m_i95dev_sales_flat_order.target_order_status FROM m_sales_order, m_i95dev_sales_flat_order 
WHERE (m_sales_order.created_at BETWEEN '$yesterday' AND '$today') AND m_sales_order.status!='canceled' AND m_sales_order.status!='pending' AND m_sales_order.status!='repair' AND m_sales_order.increment_id=m_i95dev_sales_flat_order.source_order_id";
$result_s = @mysql_query($query_s);
while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
	$entity_id = $row_s[0];
	$status = $row_s[1];
	$method = $row_s[2];
	$ax_id = $row_s[3];
	$mage_id = $row_s[4];
	$ship_status = strtolower($row_s[5]);
	switch($ship_status) {
		case 'new':
		$processing[] = $mage_id;
		$pending[] = array($mage_id, $ax_id, $method);
		break;
		case 'completed':
		$complete[] = $mage_id;
		break;
		case 'shipped':
		$complete[] = $mage_id;
		break;
	}
		
}
$total_complete = count($complete);
$total_pending = count($processing);
$total = $total_complete + $total_pending;
$rate = number_format($total_complete / $total, 2);
$percentage = $rate * 100;

// Unsynced
$unsynced = array();
$query_p = "SELECT m_sales_order.entity_id, m_sales_order.shipping_description, m_i95dev_sales_flat_order.target_order_id, m_sales_order.created_at, m_sales_order.increment_id, m_sales_order.status  
FROM m_sales_order, m_i95dev_sales_flat_order 
WHERE (m_sales_order.created_at BETWEEN '$past_180' AND '$current') AND m_sales_order.status!='canceled' AND m_sales_order.status!='pending' AND m_sales_order.status!='repair' AND m_sales_order.increment_id=m_i95dev_sales_flat_order.source_order_id";
$result_p = @mysql_query($query_p);
while($row_p = @mysql_fetch_array($result_p,MYSQL_NUM)){
	$entity_id = $row_p[0];
	$method = $row_p[1];
	$ax_id = $row_p[2];
	$order_date = $row_p[3];
	$mage_id = $row_p[4];
	$status = $row_p[5];
	if(!$ax_id) {
		$unsynced[] = array($mage_id, $ax_id, $method, $order_date, $status);
	}
}

// Monthly Fulfillment
$past_processing = array();
$past_complete = array();
$past_pending = array();
$query_p = "SELECT m_sales_order.entity_id, m_sales_order.status, m_sales_order.shipping_description, m_i95dev_sales_flat_order.target_order_id, m_sales_order.created_at, m_sales_order.increment_id, m_i95dev_sales_flat_order.target_order_status 
FROM m_sales_order, m_i95dev_sales_flat_order 
WHERE (m_sales_order.created_at BETWEEN '$past_30' AND '$yesterday') AND m_sales_order.status!='canceled' AND m_sales_order.status!='pending' AND m_sales_order.status!='repair' AND m_sales_order.increment_id=m_i95dev_sales_flat_order.source_order_id";
$result_p = @mysql_query($query_p);
while($row_p = @mysql_fetch_array($result_p,MYSQL_NUM)){
	$entity_id = $row_p[0];
	$status = $row_p[1];
	$method = $row_p[2];
	$ax_id = $row_p[3];
	$order_date = $row_p[4];
	$mage_id = $row_p[5];
	$ship_status = strtolower($row_p[6]);
	switch($ship_status) {
		case 'new':
		$past_processing[] = $mage_id;
		$past_pending[] = array($mage_id, $ax_id, $method, $order_date);
		break;
		case 'completed':
		$past_complete[] = $mage_id;
		break;
		case 'shipped':
		$past_complete[] = $mage_id;
		break;
	}
}
$past_total_complete = count($past_complete);
$past_total_pending = count($past_processing);
$past_total = $past_total_complete + $past_total_pending;
$past_rate = number_format($past_total_complete / $past_total, 2);
$past_percentage = $past_rate * 100;

// Daily
$output = "<h1>Mossberg Store Daily Fulfillment Report</h1>
<h2>$now</h2>
<em>Orders received between Noon ".date('Y-m-d', strtotime($yesterday))." and Noon ".date('Y-m-d', strtotime($today))."</em><br/>
<h3>Fulfillment Status</h3>
Received: $total<br/>
Shipped: $total_complete<br/>
Pending: $total_pending<br/>
Fulfillment Rate: {$percentage}%";
if(count($pending) > 0) {
	$output .= "<h3>Pending Orders Report</h3><table width=\"600\"><tr><td>ID</td><td>AX ID</td><td>METHOD</td></tr>";
	foreach($pending as $key => $value) {
		$output .= "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td></tr>";
	}
	$output .= "</table>";;
}
// Unsynced
$output .= "<hr/>
<h2>Sync Failure</h2>
<em>Orders with AX sync failures received between Noon ".date('Y-m-d', strtotime($past_180))." and ".date('Y-m-d (g:i A T)', strtotime($current))."</em><br/><br/>";
if(count($unsynced) > 0) {
	$output .= "<table width=\"600\"><tr><td>ID</td><td>AX ID</td><td>METHOD</td><td>DATE</td><td>STATUS</td></tr>";
	foreach($unsynced as $key => $value) {
		$output .= "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td></tr>";
	}
	$output .= "</table>";;
}
// Past
$output .= "<hr/>
<h2>Past 30 Days</h2>
<em>Orders received between Noon ".date('Y-m-d', strtotime($past_30))." and Noon ".date('Y-m-d', strtotime($yesterday))."</em><br/>
<h3>Fulfillment Status - Past 30</h3>
Received: $past_total<br/>
Shipped: $past_total_complete<br/>
Pending: $past_total_pending<br/>
Fulfillment Rate: {$past_percentage}%";
if(count($past_pending) > 0) {
	$output .= "<h3>Pending Orders Report - Past 30</h3><table width=\"600\"><tr><td>ID</td><td>AX ID</td><td>METHOD</td><td>DATE</td></tr>";
	foreach($past_pending as $key => $value) {
		$output .= "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td></tr>";
	}
	$output .= "</table>";;
}


// Inventory
$query_i = "SELECT m_cataloginventory_stock_item.product_id, m_cataloginventory_stock_item.qty, m_catalog_product_entity.sku, m_catalog_product_entity_text.value, m_catalog_product_entity_int.value 
FROM m_cataloginventory_stock_item, m_catalog_product_entity, m_catalog_product_entity_text, m_catalog_product_entity_int 
WHERE m_cataloginventory_stock_item.product_id=m_catalog_product_entity.entity_id 
AND m_cataloginventory_stock_item.product_id=m_catalog_product_entity_text.row_id 
AND m_cataloginventory_stock_item.product_id=m_catalog_product_entity_int.row_id 
AND m_catalog_product_entity.type_id='simple'
AND m_catalog_product_entity_text.attribute_id='82' 
AND m_catalog_product_entity_int.attribute_id='94' 
AND m_cataloginventory_stock_item.qty < '11' 
AND m_cataloginventory_stock_item.is_in_stock='1' 
GROUP BY m_cataloginventory_stock_item.product_id 
ORDER BY m_cataloginventory_stock_item.qty ASC";
$result_i = @mysql_query($query_i);
$low_count = @mysql_num_rows($result_i);
$output .= "<hr/><h2>Low Inventory Report ($low_count)</h2><table width=\"600\"><tr><td>ID</td><td>SKU</td><td>PRODUCT</td><td>QTY</td></tr>";
while($row_i = @mysql_fetch_array($result_i,MYSQL_NUM)){
	$product_id = $row_i[0];
	$qty = number_format($row_i[1],0);
	$sku = $row_i[2];
	$name = strtoupper(substr($row_i[3],0,30));
	$status = $row_i[4];
	if($status == '1') {
		if(!$name) {
			$query_p = "SELECT m_catalog_product_entity_text.value FROM m_catalog_product_entity_text, m_catalog_product_relation WHERE m_catalog_product_relation.child_id='$product_id' AND m_catalog_product_relation.parent_id=m_catalog_product_entity_text.row_id";
			$result_p = @mysql_query($query_p);
			$row_p = @mysql_fetch_array($result_p, MYSQL_NUM);
			$name = strtoupper(substr($row_p[0],0,30));
		}
		$output .= "<tr><td>$product_id</td><td>$sku</td><td>$name</td><td>$qty</td></tr>";
	}
}
$output .= "</table>";

echo mysql_error();

echo $output;

// Email
$email_from = 'estore@mossberg.com';
$email_subject = "Mossberg Store Daily Fulfillment Report - $now";
$email_body = $output;
$email_headers = "From: $email_from" . "\r\n" . "Reply-To: $email_from" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.office365.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'azuresmtp@mossberg.com';
$mail->Password = '#Hab74Rt';
$mail->setFrom($email_from, 'Mossberg Store');
$mail->addReplyTo($email_from, 'Mossberg Store');
$mail->addAddress('bthode@snydergroupinc.com', 'SnyderGroup BT');
$mail->addAddress('swest@snydergroupinc.com', 'SnyderGroup SW');
$mail->addAddress('ecommercereports@mossberg.com', 'Mossberg Ecomm');
$mail->Subject = $email_subject;
$mail->msgHTML($email_body);
$mail->AltBody = $email_body;
$mail->send();
?>
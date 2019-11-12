<?php 
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Dates
$current = date('Y-m-d H:i:s');
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 days'));
$year_begin = date('Y-m-d', strtotime(date('Y-10-01') . (date('m') < 10 ? ' -1 year' : '')));
$month_begin = date('Y-m-01');
$past_30 = date('Y-m-d 12:00:01', strtotime('-30 days'));
$past_180 = date('Y-m-d 12:00:01', strtotime('-180 days'));
$now = date('Y-m-d (g:i A T)');

// Daily Sales
$sales = NULL;
$query_s = "SELECT SUM(subtotal) as subtotal, SUM(shipping_amount) as shipping, SUM(tax_amount) as tax, SUM(grand_total) as total, COUNT(increment_id) AS orders 
FROM m_sales_order 
WHERE (created_at BETWEEN '$yesterday' AND '$today') AND status!='canceled'";
$result_s = @mysql_query($query_s);
while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
	$subtotal = number_format($row_s[0],2);
	$shipping = number_format($row_s[1],2);
	$tax = number_format($row_s[2],2);
	$grandtotal = number_format($row_s[3],2);
	$orders = $row_s[4];
	$checkout_avg = number_format($row_s[0] / $orders, 2);
	$sales .= "<table>
	<tr><td>Orders:</td><td>$orders</td></tr>
	<tr><td>Subtotal:</td><td>\$$subtotal</td></tr>
	<tr><td>Shipping:</td><td>\$$shipping</td></tr>
	<tr><td>Tax:</td><td>\$$tax</td></tr>
	<tr><td>Total:</td><td>\$$grandtotal</td></tr>
	<tr><td>Avg Checkout:</td><td>\$$checkout_avg (Subtotal)</td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
}
echo mysql_error();

// Month to Date
$query_s = "SELECT SUM(subtotal) as subtotal 
FROM m_sales_order 
WHERE (created_at BETWEEN '$month_begin' AND '$today') AND status!='canceled'";
$result_s = @mysql_query($query_s);
while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
	$subtotal = number_format($row_s[0],2);
	$sales .= "<tr><td>Month to Date:</td><td>\$$subtotal (Subtotal)</td></tr>";
}
echo mysql_error();

// Year to Date
$query_s = "SELECT SUM(subtotal) as subtotal 
FROM m_sales_order 
WHERE (created_at BETWEEN '$year_begin' AND '$today') AND status!='canceled'";
$result_s = @mysql_query($query_s);
while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
	$subtotal = number_format($row_s[0],2);
	$sales .= "<tr><td>Fiscal Year to Date:</td><td>\$$subtotal (Subtotal)</td></tr>";
}
echo mysql_error();

$sales .= "</table>";

// Capture Errors
$collect = "<table width=\"600\"><tr><td>MAGE ID</td><td>AX ID</td><td>DATE</td><td align=\"right\">ORDER TOTAL</td><td align=\"right\">INVOICED</td></tr>";
$query_c = "SELECT m_sales_order.entity_id, m_i95dev_sales_flat_order.target_order_id, m_sales_order.created_at, m_sales_order.increment_id, m_sales_order.base_grand_total, m_sales_order.base_total_invoiced 
FROM m_sales_order, m_i95dev_sales_flat_order 
WHERE (m_sales_order.created_at BETWEEN '$past_180' AND '$current') AND m_sales_order.status!='canceled' AND m_sales_order.status!='pending' AND m_sales_order.status!='repair' AND m_sales_order.increment_id=m_i95dev_sales_flat_order.source_order_id AND m_sales_order.base_grand_total!=m_sales_order.base_total_invoiced";
$result_c = @mysql_query($query_c);
while($row_c = @mysql_fetch_array($result_c,MYSQL_NUM)){
	$entity_id = $row_c[0];
	$ax_id = $row_c[1];
	$order_date = $row_c[2];
	$mage_id = $row_c[3];
	$order_total = number_format($row_c[4],2);
	$invoiced = number_format($row_c[5],2);
	$collect .= "<tr><td>$mage_id</td><td>$ax_id</td><td>$order_date</td><td align=\"right\">\$$order_total</td><td align=\"right\">\$$invoiced</td></tr>";
}
$collect .= "</table>";

// Products
$products = "<table width=\"600\"><tr><td>SKU</td><td>PRODUCT</td><td>QTY</td></tr>";
$query = "SELECT m_sales_order_item.sku, m_sales_order_item.name, SUM(m_sales_order_item.qty_ordered) as qty 
FROM m_sales_order_item, m_sales_order, m_catalog_product_entity_decimal  
WHERE m_sales_order.status!='canceled' AND m_sales_order_item.product_id=m_catalog_product_entity_decimal.row_id AND m_catalog_product_entity_decimal.attribute_id='74' AND m_sales_order.entity_id=m_sales_order_item.order_id 
AND (m_sales_order.created_at BETWEEN '$yesterday' AND '$today') AND m_sales_order_item.product_type='simple' GROUP BY m_sales_order_item.sku ORDER BY qty DESC";
$result = @mysql_query($query);
while($row = @mysql_fetch_array($result,MYSQL_NUM)){
	$sku = strtoupper($row[0]);
	$name = ucwords(strtolower($row[1]));
	$qty = strtolower($row[2]);
	$products .= "<tr><td>$sku</td><td>$name</td><td>$qty</td></tr>";
}
$products .= "</table>";
echo mysql_error();

echo "<h1>Mossberg Store Daily Sales Report<br/>$yesterday</h1>
<h3>Sales</h3>$sales<br/><br/>
<h3>Products</h3>$products<br/><br/>
<h3>Invoice Errors (Past 180 Days)</h3>$collect";

// Email
$email_from = 'estore@mossberg.com';
$email_subject = "Mossberg Store Daily Sales Report - $yesterday";
$email_body = "<h1>Mossberg Store Daily Sales Report<br/>$yesterday</h1><h3>Sales</h3>$sales<br/><br/><h3>Products</h3>$products<h3>Invoice Errors (Past 180 Days)</h3>$collect";
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
$mail->addAddress('croth@snydergroupinc.com', 'SnyderGroup CR');
$mail->addAddress('dsnyder@snydergroupinc.com', 'SnyderGroup DS');
$mail->addAddress('ecommercereports@mossberg.com', 'Mossberg Ecomm');
$mail->Subject = $email_subject;
$mail->msgHTML($email_body);
$mail->AltBody = $email_body;
$mail->send();
?>
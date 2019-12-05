<?php
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Dates
date_default_timezone_set('America/New_York');
$start_hour = date('Y-m-d H:i:00', strtotime('-2 hours'));
$end_hour = date('Y-m-d H:i:00', strtotime('-1 hour'));
$week_begin = '2019-11-25 00:00:00';

// Display
$start_day_display = date('M j, Y', strtotime('-1 hour'));
$start_hour_display = date('g:iA', strtotime('-1 hour'));
$end_hour_display = date('g:iA');

// Hourly Sales
$sales = NULL;
$query_s = "SELECT SUM(subtotal) as subtotal, SUM(shipping_amount) as shipping, SUM(tax_amount) as tax, SUM(grand_total) as total, COUNT(increment_id) AS orders 
FROM m_sales_order 
WHERE (created_at BETWEEN '$start_hour' AND '$end_hour') AND status!='canceled' AND status!='pending' AND status!='repair'";
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

$sales .= "</table>";

// Campaign Sales
$campaign = NULL;
$query_s = "SELECT SUM(subtotal) as subtotal, SUM(shipping_amount) as shipping, SUM(tax_amount) as tax, SUM(grand_total) as total, COUNT(increment_id) AS orders 
FROM m_sales_order 
WHERE (created_at BETWEEN '$week_begin' AND '$end_hour') AND status!='canceled' AND status!='pending' AND status!='repair'";
$result_s = @mysql_query($query_s);
while($row_s = @mysql_fetch_array($result_s,MYSQL_NUM)){
	$subtotal = number_format($row_s[0],2);
	$shipping = number_format($row_s[1],2);
	$tax = number_format($row_s[2],2);
	$grandtotal = number_format($row_s[3],2);
	$orders = $row_s[4];
	$checkout_avg = number_format($row_s[0] / $orders, 2);
	$campaign .= "<table>
	<tr><td>Orders:</td><td>$orders</td></tr>
	<tr><td>Subtotal:</td><td>\$$subtotal</td></tr>
	<tr><td>Shipping:</td><td>\$$shipping</td></tr>
	<tr><td>Tax:</td><td>\$$tax</td></tr>
	<tr><td>Total:</td><td>\$$grandtotal</td></tr>
	<tr><td>Avg Checkout:</td><td>\$$checkout_avg (Subtotal)</td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
}
echo mysql_error();

$campaign .= "</table>";

echo "<h1>Hourly Sales Report<br/>$start_day_display<br/>$start_hour_display - $end_hour_display</h1>
<h3>Hourly Sales</h3>$sales<br/><br/>
<h3>Campaign Total Sales</h3>$campaign";

// Email
$email_from = 'estore@mossberg.com';
$email_subject = "Mossberg Hourly Sales Report -  $start_day_display $end_hour_display";
$email_body = "<h1>Mossberg Hourly Sales Report<br/>$start_day_display | $start_hour_display - $end_hour_display</h1><h3>Hourly Sales</h3>$sales<br/><h3>Campaign Total Sales</h3>$campaign";
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
$mail->addAddress('billthode@brilliantinternet.com', 'Snyder BT');
$mail->addAddress('wbeighley@mossberg.com', 'Mossberg WB');
$mail->Subject = $email_subject;
$mail->msgHTML($email_body);
$mail->AltBody = $email_body;
$mail->send();
?>
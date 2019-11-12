<?php 
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Databox Daily Sales
$begin = new DateTime('2016-10-01');
$yesterday   = date('Y-m-d', strtotime('yesterday'));
$end = new DateTime($yesterday);

for($i = $begin; $i <= $end; $i->modify('+1 day')){
    $start_day = $i->format("Y-m-d");
	$end_day = date("Y-m-d",strtotime($start_day . '+1 days'));
	// Check Day
	$query_c = "SELECT id FROM databox_sales_daily WHERE date='$start_day'";
	$result_c = @mysql_query($query_c);
	if(@mysql_num_rows($result_c) == 0) {
		// Get Sales
		$query = "SELECT 
		SUM(subtotal) AS subtotal, 
		SUM(shipping_amount) AS shipping, 
		SUM(tax_amount) AS tax, 
		SUM(grand_total) AS total, 
		COUNT(entity_id) AS orders 
		FROM m_sales_order 
		WHERE (created_at BETWEEN '$start_day' AND '$end_day') AND status!='canceled' AND status!='pending' AND status!='repair'";
		$result = @mysql_query($query);
		$row = @mysql_fetch_array($result, MYSQL_NUM);
		$subtotal = round($row[0],0);
		$shipping = round($row[1],0);
		$tax = round($row[2],0);
		$total = round($row[3],0);
		$orders = $row[4];
		// Insert Sales
		$query_i = "INSERT INTO databox_sales_daily (subtotal, shipping, tax, total, orders, date) VALUES ('$subtotal', '$shipping', '$tax', '$total', '$orders', '$start_day')";
		$result_i = @mysql_query($query_i);
		echo "<p>$start_day - $subtotal / $shipping / $tax / $total / $orders</p>";
	}
}
// Databox Monthly Sales
$start_day = date('Y-m-01');
$month = date('F Y');
$today = new DateTime('now');
$next_month = $today->modify('first day of next month');
$end_day = $next_month->format('Y-m-d');
// Get Sales
$query = "SELECT 
SUM(subtotal) AS subtotal 
FROM m_sales_order 
WHERE (created_at BETWEEN '$start_day' AND '$end_day') AND status!='canceled' AND status!='pending' AND status!='repair'";
$result = @mysql_query($query);
$row = @mysql_fetch_array($result, MYSQL_NUM);
$subtotal = round($row[0],0);
// Check Month
$query_c = "SELECT id FROM databox_sales_monthly WHERE date='$start_day'";
$result_c = @mysql_query($query_c);
if(@mysql_num_rows($result_c) == 0) {
	// Insert Sales
	$query_i = "INSERT INTO databox_sales_monthly (month, subtotal, date) VALUES ('$month', '$subtotal', '$start_day')";
	$result_i = @mysql_query($query_i);
	echo "<p>$start_day - $subtotal / $shipping / $tax / $total / $orders</p>";
	} else {
	$row_c = @mysql_fetch_array($result_c, MYSQL_NUM);
	$id = $row_c[0];
	$query_u = "UPDATE databox_sales_monthly SET subtotal='$subtotal' WHERE id='$id'";
	$result_u = @mysql_query($query_u);
	echo "<p>$start_day - $subtotal / $shipping / $tax / $total / $orders</p>";
}
?>
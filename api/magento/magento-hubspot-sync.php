<?php ini_set('max_execution_time', 3600); ?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect-magento.php');
?>
<?php
// Dates
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 days'));
// Orders
$query = "SELECT m_sales_order_address.firstname, m_sales_order_address.lastname, m_sales_order.customer_email, m_sales_order_address.city, m_sales_order_address.region, m_sales_order_address.postcode, m_sales_order_address.telephone, 
m_sales_order.subtotal, m_sales_order.coupon_code, m_sales_order.total_qty_ordered, m_sales_order.increment_id, m_sales_order.created_at, m_sales_order.status 
FROM m_sales_order, m_sales_order_address 
WHERE m_sales_order.entity_id=m_sales_order_address.parent_id AND m_sales_order_address.address_type='billing' 
AND m_sales_order.created_at BETWEEN '$yesterday' AND '$today' 
ORDER BY m_sales_order.increment_id ASC";
$result = @mysql_query($query);
$total = @mysql_num_rows($result);
while($row = @mysql_fetch_array($result,MYSQL_NUM)){
	$firstname = ucwords(strtolower($row[0]));
	$lastname = ucwords(strtolower($row[1]));
	$email = strtolower($row[2]);
	$city = ucwords(strtolower($row[3]));
	$state = ucwords(strtolower($row[4]));
	$zip = $row[5];
	$phone = $row[6];
	$magento_order_subtotal = number_format($row[7],2);
	$magento_order_coupon = $row[8];
	$magento_order_quantity = number_format($row[9],0);
	$magento_order_id = $row[10];
	$magento_order_date = $row[11];
	$magento_order_status = $row[12];
	// Status
	$hs_form_id = 'b192a53b-0f3d-4a5e-9646-9e41753c04b6';
	if($magento_order_status == 'canceled') {
		$hs_form_id = '23b35f8f-0833-4ec8-95cf-7c1f6a72912b';
	}	
	// Hubspot API
	include('magento-hubspot-submission.php');
}
echo "$yesterday | $total Orders Synced \n";
?>
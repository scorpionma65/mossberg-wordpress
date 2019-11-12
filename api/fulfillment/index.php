<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?>
<?php
// Set Dates
if(!empty($_GET['begin'])) {
	$begin = date('Y-m-d',strtotime(mysql_real_escape_string($_GET['begin'])));
	} else {
	$begin = date('Y-m-d',strtotime("-1 weeks monday"));
}
if(!empty($_GET['end'])) {
	$end = date('Y-m-d',strtotime(mysql_real_escape_string($_GET['end'])));
	} else {
	$end = date('Y-m-d',strtotime("-0 weeks monday"));
}
$begin_range = date('Y-m-d',strtotime("$begin -1 day"));
$end_range = date('Y-m-d',strtotime("$end -1 day"));
$filename = 'mossberg-catalog-fulfillment-'.$begin_range.'-'.$end_range.'.xls';
?>
<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
?>
<?php
$query = "SELECT * FROM data_catalog_request WHERE request_date_created BETWEEN '$begin' AND '$end' ORDER BY request_date_created ASC";
$result = @mysql_query($query);
if(@mysql_num_rows($result) > 0) {
echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
$first_name = trim(strip_tags($row['request_first_name']));
$last_name = trim(strip_tags($row['request_last_name']));
$email = trim(strip_tags($row['request_email']));
$address = trim(strip_tags($row['request_address']));
$city = trim(strip_tags($row['request_city']));
$state = trim(strip_tags($row['request_state']));
$postcode = trim(strip_tags($row['request_postcode']));
$date = trim(strip_tags($row['request_date_created']));
$label = ucwords($first_name.' '.$last_name.'<br style="mso-data-placement:same-cell;"/>'.$address.'<br style="mso-data-placement:same-cell;"/>'.$city.', '.$state.' '.$postcode);
echo "<tr><td>$label</td><td>$first_name</td><td>$last_name</td><td>$address</td><td>$city</td><td>$state</td><td style=\"mso-number-format:\@;\">$postcode</td><td>$email</td><td>$date</td></tr>";
}
echo "</table>";
}
?>
<?php ini_set('max_execution_time', 36000);?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?> 
<?php
$query = "SELECT * FROM woobox_entries WHERE wb_id > '9835'";
$result = @mysql_query($query);
$count = 0;
while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
	usleep(2000);
	$id = $row['wb_id'];
	$email = $row['wb_email'];
	$firstname = $row['wb_firstname'];
	$lastname = $row['wb_lastname'];
	$date = $row['wb_date'];
	$phone = preg_replace("/[^0-9]/", "", $row['wb_custom_4']);
	$persona = $row['wb_custom_16'];
	$promo_id = 'fvihtk';
	$submission_id = end(explode('/',$row['wb_entry']));
	$interests = NULL;
	// Interests
	if($row['wb_custom_6'] == 'on') {
		$interests .= 'Deer Hunting;';
	}
	if($row['wb_custom_7'] == 'on') {
		$interests .= 'Waterfowl Hunting;';
	}
	if($row['wb_custom_8'] == 'on') {
		$interests .= 'Turkey Hunting;';
	}
	if($row['wb_custom_9'] == 'on') {
		$interests .= 'Tactical Firearms;';
	}
	if($row['wb_custom_10'] == 'on') {
		$interests .= 'Home Security;';
	}
	if($row['wb_custom_11'] == 'on') {
		$interests .= 'Law Enforcement/Military;';
	}
	if($row['wb_custom_12'] == 'on') {
		$interests .= 'Sport Shooting;';
	}
	if($row['wb_custom_13'] == 'on') {
		$interests .= 'Shotguns;';
	}
	if($row['wb_custom_14'] == 'on') {
		$interests .= 'Rifles;';
	}
	if($row['wb_custom_15'] == 'on') {
		$interests .= 'Handguns;';
	}
	
	// Hubspot
	//include('hubspot-submission.php');
	echo "<p>$date / $firstname / $lastname / $email / $phone / $promo_id / $submission_id / $interests</p>";
	$count++;
	
}
echo "TOTAL: $count";
echo @mysql_error();
?>

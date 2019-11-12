<?php
header("realtimeapi: 76Hru");
//function callback_test() {
//	header("realtimeapi: {$_POST['realtimeapi_code']}");
//	file_put_contents('/mnt/homevolume0/mossberg/public_html/api/woobox/data.txt', $_POST['realtimeapi_code'], FILE_APPEND | LOCK_EX);
//}
//callback_test();
?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?>
<?php echo $_POST['realtimeapi_code'];?>
<?php
$entries = $_POST['entries'];
// Insert JSON
$query = "INSERT INTO woobox (entry_json, entry_date) VALUES ('$entries', NOW())";
$result = @mysql_query($query);
$entries_array = json_decode($entries,true);
$interests = NULL;
foreach($entries_array as $key => $item) {  
    $firstname = $item['firstname'];
    $lastname = $item['lastname'];
    $phone = $item['phone'];
    $email = $item['email'];
	$birth_date = date('m/d/Y', strtotime($item['custom_3']));
	$promo_id = $item['id'];
	$submission_id = $item['bonus_entry_url'];
//	// Interests
//	if($item['custom_6'] == 'on') {
//		$interests .= 'Deer Hunting;';
//	}
//	if($item['custom_7'] == 'on') {
//		$interests .= 'Waterfowl Hunting;';
//	}
//	if($item['custom_8'] == 'on') {
//		$interests .= 'Turkey Hunting;';
//	}
//	if($item['custom_9'] == 'on') {
//		$interests .= 'Tactical Firearms;';
//	}
//	if($item['custom_10'] == 'on') {
//		$interests .= 'Home Security;';
//	}
//	if($item['custom_11'] == 'on') {
//		$interests .= 'Law Enforcement/Military;';
//	}
//	if($item['custom_12'] == 'on') {
//		$interests .= 'Sport Shooting;';
//	}
//	if($item['custom_13'] == 'on') {
//		$interests .= 'Shotguns;';
//	}
//	if($item['custom_14'] == 'on') {
//		$interests .= 'Rifles;';
//	}
//	if($item['custom_15'] == 'on') {
//		$interests .= 'Handguns;';
//	}
//	$persona = $item['custom_16'];
	$woobox_ip = $_SERVER['REMOTE_ADDR'];
	
	// Insert Entry
	$query = "INSERT INTO woobox (entry_firstname, entry_lastname, entry_email, entry_phone, entry_promo_id, entry_submission_id, entry_birth_date, entry_date) VALUES ('$firstname', '$lastname', '$email', '$phone', '$promo_id', '$submission_id', '$birth_date', NOW())";
	$result = @mysql_query($query);

	// Hubspot API
	if($promo_id == '63e6xq') {
		include('hubspot-submission.php');
	} 
}
?>
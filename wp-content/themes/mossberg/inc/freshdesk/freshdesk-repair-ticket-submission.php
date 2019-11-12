<?php ini_set('max_execution_time', 3600); ?>
<?php
// Freshdesk IDs
$api_key = 'a3ISCL8xrvueBhgawtjz';
$api_base = 'https://mossbergservice.freshdesk.com';
$api_auth = base64_encode($api_key.':X');

// Ticket Fields
$ticket_fields = array();
if($serial_number) {
	$ticket_fields['serial_number'] = $serial_number;
}
if($firearm_type) {
	$ticket_fields['firearm_type'] = $firearm_type;
}
if($firearm_action) {
	$ticket_fields['action'] = $firearm_action;
}
if($firearm_model) {
	$ticket_fields['model'] = $firearm_model;
}
if($firearm_ammo) {
	$ticket_fields['gaugecaliber'] = $firearm_ammo;
}
if($primary_issues) {
	$ticket_fields['primary_issues'] = $primary_issues;
}
if($firearm_shipped) {
	$ticket_fields['shipping_contents'] = $firearm_shipped;
}
if($dealer_owner) {
	$ticket_fields['dealer_or_customer'] = $dealer_owner;
}
if($primary_contact) {
	$ticket_fields['primary_contact'] = $primary_contact;
}
if($dealer_company_name) {
	$ticket_fields['dealer_company_name'] = stripslashes($dealer_company_name);
}
if($dealer_contact_name) {
	$ticket_fields['dealer_contact_name'] = $dealer_contact_name;
}
if($dealer_address) {
	$ticket_fields['dealer_street_address'] = $dealer_address;
}
if($dealer_city) {
	$ticket_fields['dealer_city'] = $dealer_city;
}
if($dealer_state) {
	$ticket_fields['dealer_state'] = $dealer_state;
}
if($dealer_zip) {
	$ticket_fields['dealer_zip'] = $dealer_zip;
}
if($dealer_email) {
	$ticket_fields['dealer_email'] = $dealer_email;
}
if($dealer_phone) {
	$ticket_fields['dealer_phone'] = $dealer_phone;
}
if($dealer_ffl) {
	$ticket_fields['dealer_ffl'] = $dealer_ffl;
}
if($owner_name) {
	$ticket_fields['owner_name'] = $owner_name;
}
if($owner_address) {
	$ticket_fields['owner_street_address'] = $owner_address;
}
if($owner_city) {
	$ticket_fields['owner_city'] = $owner_city;
}
if($owner_state) {
	$ticket_fields['owner_state'] = $owner_state;
}
if($owner_zip) {
	$ticket_fields['owner_zip'] = $owner_zip;
}
if($owner_email) {
	$ticket_fields['owner_email'] = $owner_email;
}
if($owner_phone) {
	$ticket_fields['owner_phone'] = $owner_phone;
}
if($purchase_date) {
	$ticket_fields['owner_date_of_purchase'] = $purchase_date;
}

// Live/Test Ticket
if($_SERVER['SERVER_NAME'] != 'www.mossberg.com') {
	$title = "***TEST*** Firearm Service Request";
	$ticket_fields['test_ticket'] = 'Yes';
	} else {
	$title = 'Firearm Service Request';
	$ticket_fields['test_ticket'] = 'No';
}
	
// Create Ticket
$url = $api_base."/api/v2/tickets";
$data_array = array(
'subject'=>$title,
'email'=>$email_contact,
'type'=>'Firearm Service Request',
'priority'=>1,
'status'=>2,
'source'=>2,
'description'=>$title,
'cc_emails'=>array($email_cc),
'custom_fields'=>$ticket_fields);
$data_string = json_encode($data_array);

// cURL
$curl = curl_init();
@curl_setopt($curl, CURLOPT_POST, TRUE);
@curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
@curl_setopt($curl, CURLOPT_URL, $url);
@curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
@curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
	'Authorization: Basic '.$api_auth
));
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

// Response
//echo "<p>$status</p>";
//print_r($result);
$result = json_decode($result);
$ticket_id = $result->id;
?>
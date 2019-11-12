<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = 'f2276189-0930-45d7-8307-de9a091b8728';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/trophy-room-submission',
    'pageName' => 'Trophy Room Submission'
);
$hs_context_json = json_encode($hs_context);

// Interests
$interests = NULL;
if($i_am_interested_in_1) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_1);
}
if($i_am_interested_in_2) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_2);
}
if($i_am_interested_in_3) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_3);
}
if($i_am_interested_in_4) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_4);
}
if($i_am_interested_in_5) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_5);
}
if($i_am_interested_in_6) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_6);
}
if($i_am_interested_in_7) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_7);
}
if($i_am_interested_in_8) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_8);
}
if($i_am_interested_in_9) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_9);
}
if($i_am_interested_in_10) {
	$interests .= "&i_am_interested_in_=" . urlencode($i_am_interested_in_10);
}

// Form Values
$str_post = "firstname=" . urlencode($first_name) 
    . "&lastname=" . urlencode($last_name) 
    . "&email=" . urlencode($email) 
	. "&address=" . urlencode($address) 
	. "&city=" . urlencode($city) 
	. "&state=" . urlencode($state) 
	. "&zip=" . urlencode($zip) 
	. "&products_used=" . urlencode($model) 
    . "&marketing_opt_in=" . urlencode($subscribe) 
	. $interests
    . "&hs_context=" . urlencode($hs_context_json); 

// Endpoint
$endpoint = "https://forms.hubspot.com/uploads/form/v2/$hs_portal_id/$hs_form_id/";

// Request
$ch = @curl_init();
@curl_setopt($ch, CURLOPT_POST, true);
@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
@curl_close($ch);
//echo $status_code . " " . $response;
?>
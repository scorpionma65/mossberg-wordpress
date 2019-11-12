<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = '6733fa1a-a829-491b-bd27-c303b52fb981';
$hs_api = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';

// Get Contact
$qualified = TRUE;
$optin = TRUE;
$endpoint = "https://api.hubapi.com/contacts/v1/contact/email/$email/profile?property=hs_email_optout&propertyMode=value_only&formSubmissionMode=all&showListMemberships=false&hapikey=$hs_api";
$ch = @curl_init();
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); 
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
@curl_close($ch);
if($status_code == '200') {
    $result = json_decode($response, true);
	$hs_vid = $result['vid'];
	$hs_optout = $result['properties']['hs_email_optout']['value'];
	if($hs_optout == 'true') {
		$optin = FALSE;
	}	
	$hs_forms = $result['form-submissions'];
	foreach($hs_forms as $form) {
		$form_id = $form['form-id'];
		if($form_id == $hs_form_id || $form_id == $hs_form_id_v1) {
			$qualified = FALSE;
		}
	}
}


if($optin && $qualified) {
	// Process a new form submission in HubSpot in order to create a new Contact.
	$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
	$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
	$hs_context      = array(
		'hutk' => $hubspotutk,
		'ipAddress' => $ip_addr,
		'pageUrl' => 'http://resources.mossberg.com/join',
		'pageName' => 'Join the Mossberg Community'
	);
	$hs_context_json = json_encode($hs_context);
	
	// Form Values
	$str_post = "email=" . urlencode($email) 
		. "&hs_persona=" . urlencode($hs_persona) 
		. "&marketing_opt_in=" . urlencode($marketing_opt_in) 
		. "&i_am_interested_in_=" . urlencode($i_am_interested_in_) 
		. "&promo_community_signup=" . urlencode($promo_community_signup) 
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
}
?>
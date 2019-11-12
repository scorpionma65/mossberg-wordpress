<?php
// Hubspot IDs
$hs_portal_id = '479666';

// HS Config
$hs_api = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';

// Get Contact
$hs_vid = FALSE;
$optin = TRUE;
$endpoint = "https://api.hubapi.com/contacts/v1/contact/email/$email/profile?proprtyMode=value_only&formSubmissionMode=none&showListMemberships=false&hapikey=$hs_api";
$ch = @curl_init();
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); 
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
@curl_close($ch);
if($status_code == '200') {
    $result = json_decode($response, true);
	$hs_vid = $result['vid'];
	$hs_firstname = $result['properties']['firstname']['value'];
	$hs_lastname = $result['properties']['lastname']['value'];
	$hs_email = $result['properties']['email']['value'];
	$hs_optout = $result['properties']['hs_email_optout']['value'];
	if($hs_optout == 'true') {
		$optin = FALSE;
	}	
}
?>

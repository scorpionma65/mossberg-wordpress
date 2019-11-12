<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = '66b13207-febe-40f7-b756-bfc524719657';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/freshdesk-service-repair',
    'pageName' => 'Freshdesk Service Repair'
);
$hs_context_json = json_encode($hs_context);

// Contact
if($dealer_owner == 'Dealer') {
	$contact_company = $dealer_company_name;
	$contact_firstname = NULL;
	$contact_lastname = NULL;
	$contact_email = $dealer_email;
}
if($dealer_owner == 'Firearm Owner') {
	$contact_company = NULL;
	$contact_firstname = $owner_first_name;
	$contact_lastname = $owner_last_name;
	$contact_email = $owner_email;
}

// Form Values
$str_post = "company=" . urlencode($contact_company)
	. "&firstname=" . urlencode($contact_firstname) 
    . "&lastname=" . urlencode($contact_lastname) 
    . "&email=" . urlencode($contact_email) 
    . "&marketing_opt_in=" . urlencode($subscribe) 
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
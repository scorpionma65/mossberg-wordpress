<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = 'bbaf1a75-8297-4b18-beec-64a21c26c38b';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/catalog-request',
    'pageName' => 'Catalog Request'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "firstname=" . urlencode($firstname) 
    . "&lastname=" . urlencode($lastname) 
    . "&email=" . urlencode($email) 
    . "&address=" . urlencode($address) 
	. "&city=" . urlencode($city) 
	. "&state=" . urlencode($state) 
	. "&zip=" . urlencode($zip) 
	. "&marketing_opt_in=" . urlencode($marketing_opt_in) 
	. "&i_am_interested_in_=" . urlencode($i_am_interested_in_) 
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
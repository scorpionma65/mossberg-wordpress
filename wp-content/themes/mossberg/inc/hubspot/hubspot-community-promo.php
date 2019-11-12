<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = '1c055132-3762-44fe-bd7f-81297f207ebc';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => get_bloginfo('home').'/join-the-mossberg-community',
    'pageName' => 'Join the Mossberg Community'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "email=" . urlencode($email) 
	. "&hs_persona=" . urlencode($hs_persona) 
	. "&may_we_add_you_to_our_email_list_=" . urlencode($may_we_add_you_to_our_email_list_) 
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
?>
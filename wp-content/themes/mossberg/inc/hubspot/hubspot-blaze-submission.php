<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = 'eb667062-ff82-4914-a3ce-8c902607d607';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => $_SERVER['REQUEST_URI'],
    'pageName' => 'Blaze Offer Submission'
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
	. "&how_do_you_want_to_redeem_this_offer_=" . urlencode($how_do_you_want_to_redeem_this_offer_) 
	. "&select_a_blaze_magazine_type=" . urlencode($select_a_blaze_magazine_type) 
	. "&may_we_add_you_to_our_email_list_=" . urlencode($may_we_add_you_to_our_email_list_) 
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
<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = '1a33956b-1042-49d0-846d-ca406beb55f9';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/ecommerce-abandoned-cart',
    'pageName' => 'Ecommerce Abandoned Cart'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "email=" . urlencode($quote_email) 
	. "&magento_abandoned_skus=" . urlencode($magento_abandoned_skus) 
	. "&magento_abandoned_display=" . urlencode($magento_abandoned_display) 
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
$status_response = "<p>$status_code $response</p>";
?>
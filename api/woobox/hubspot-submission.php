<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = 'b569ac97-898d-4c7d-b944-85e70ea0ab19';

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/centennial-sweeps',
    'pageName' => 'MOSS19004 MC1 Centennial Sweeps'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "firstname=" . urlencode($firstname) 
	. "&lastname=" . urlencode($lastname) 
	. "&phone=" . urlencode($phone) 
	. "&email=" . urlencode($email) 
	. "&birth_date=" . urlencode($birth_date) 
	. "&woobox_promo_id=" . urlencode($promo_id) 
	. "&woobox_entry_id=" . urlencode($submission_id)
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
echo "<p>$status_code $response | email</p>";
?>
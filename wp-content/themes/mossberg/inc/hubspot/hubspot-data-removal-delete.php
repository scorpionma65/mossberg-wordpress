<?php
// Hubspot IDs
$hs_portal_id = '479666';

// HS Config
$hs_api = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';

// Get Contact
$endpoint = "https://api.hubapi.com/contacts/v1/contact/vid/$vid?hapikey=$hs_api";
$ch = curl_init();
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
@curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); 
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
@curl_close($ch);
?>

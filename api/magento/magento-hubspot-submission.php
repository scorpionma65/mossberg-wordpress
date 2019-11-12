<?php
// Hubspot IDs
$hs_portal_id = '479666';
if(!$hs_form_id) {
	$hs_form_id = 'b192a53b-0f3d-4a5e-9646-9e41753c04b6';
}

// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/ecommerce-order',
    'pageName' => 'Ecommerce Order'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "firstname=" . urlencode($firstname) 
	. "&lastname=" . urlencode($lastname) 
	. "&email=" . urlencode($email) 
	. "&city=" . urlencode($city) 
	. "&state=" . urlencode($state) 
	. "&zip=" . urlencode($zip) 
	. "&phone=" . urlencode($phone) 
	. "&magento_order_subtotal=" . urlencode($magento_order_subtotal) 
	. "&magento_order_coupon=" . urlencode($magento_order_coupon) 
	. "&magento_order_quantity=" . urlencode($magento_order_quantity) 
	. "&magento_order_id=" . urlencode($magento_order_id) 
	. "&magento_order_date=" . urlencode($magento_order_date) 
	. "&lifecyclestage=" . urlencode('customer') 
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
<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_form_id = '2d8cbbcb-9115-4ac9-ad52-55d304570b0d';


// Process a new form submission in HubSpot in order to create a new Contact.
$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://resources.mossberg.com/freshdesk-ticket',
    'pageName' => 'Freshdesk Ticket'
);
$hs_context_json = json_encode($hs_context);

// Form Values
$str_post = "firstname=" . urlencode($first_name) 
	. "&lastname=" . urlencode($last_name) 
	. "&email=" . urlencode($email) 
	. "&fresh_desk_source=" . urlencode($ticket_source) 
	. "&freshdesk_ticket_id=" . urlencode($ticket_id) 
	. "&freshdesk_ticket_url=" . urlencode($ticket_url) 
	. "&freshdesk_ticket_type=" . urlencode($ticket_type) 
	. "&hs_persona=" . urlencode($persona) 
	. "&may_we_add_you_to_our_email_list_=" . urlencode($optin) 
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
echo $status_response;
?>


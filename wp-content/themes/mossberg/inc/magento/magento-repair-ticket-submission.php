<?php

// Complete

$complete = FALSE;



// Ticket

$regions = array('AL'=>array('Alabama','1'),'AK'=>array('Alaska','2'),'AZ'=>array('Arizona','4'),'AR'=>array('Arkansas','5'),'CA'=>array('California','12'),'CO'=>array('Colorado','13'),'CT'=>array('Connecticut','14'),'DE'=>array('Delaware','15'),'DC'=>array('District of Columbia','16'),'FL'=>array('Florida','18'),'GA'=>array('Georgia','19'),'HA'=>array('Hawaii','21'),'ID'=>array('Idaho','22'),'IL'=>array('Illinois','23'),'IN'=>array('Indiana','24'),'IA'=>array('Iowa','25'),'KS'=>array('Kansas','26'),'KY'=>array('Kentucky','27'),'LA'=>array('Louisiana','28'),'ME'=>array('Maine','29'),'MD'=>array('Maryland','31'),'MA'=>array('Massachusetts','32'),'MI'=>array('Michigan','33'),'MN'=>array('Minnesota','34'),'MS'=>array('Mississippi','35'),'MO'=>array('Missouri','36'),'MT'=>array('Montana','37'),'NE'=>array('Nebraska','38'),'NV'=>array('Nevada','39'),'NH'=>array('New Hampshire','40'),'NJ'=>array('New Jersey','41'),'NM'=>array('New Mexico','42'),'NY'=>array('New York','43'),'NC'=>array('North Carolina','44'),'ND'=>array('North Dakota','45'),'OH'=>array('Ohio','47'),'OK'=>array('Oklahoma','48'),'OR'=>array('Oregon','49'),'PA'=>array('Pennsylvania','51'),'RI'=>array('Rhode Island','53'),'SC'=>array('South Carolina','54'),'SD'=>array('South Dakota','55'),'TN'=>array('Tennessee','56'),'TX'=>array('Texas','57'),'UT'=>array('Utah','58'),'VT'=>array('Vermont','59'),'VA'=>array('Virginia','61'),'WA'=>array('Washington','62'),'WV'=>array('West Virginia','63'),'WI'=>array('Wisconsin','64'),'WY'=>array('Wyoming','65'));



if($dealer_owner == 'Dealer') {

	$contact_company = NULL;

	$contact_firstname = $dealer_company_name;

	$contact_lastname = '#';

	$contact_street = $dealer_address;

	$contact_city = $dealer_city;

	$contact_state = $dealer_state;

	$contact_zip = $dealer_zip;

	$contact_email = $dealer_email;

	$contact_phone = $dealer_phone;

	$contact_region = $regions[$contact_state[0]];

	$contact_region_id = $regions[$contact_state[1]];

}

if($dealer_owner == 'Firearm Owner') {

	$contact_company = NULL;

	$contact_firstname = $owner_first_name;

	$contact_lastname = $owner_last_name;

	$contact_street = $owner_address;

	$contact_city = $owner_city;

	$contact_state = $owner_state;

	$contact_zip = $owner_zip;

	$contact_email = $owner_email;

	$contact_phone = $owner_phone;

	$contact_region = $regions[$contact_state[0]];

	$contact_region_id = $regions[$contact_state[1]];

}



// Log

$log = "



--{$ticket_id}--";

?>



<?php 

// API Config

include(TEMPLATEPATH.'/inc/magento/magento-api-config.php');

?>



<?php

// Message

$show = TRUE;



// Token

$token = FALSE;



// New Cart -----------------------------------------------------------------

include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');

$method = 'POST';

$url = $api_base."/store/index.php/rest/V1/guest-carts"; 

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$content_json = NULL;

// Request

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_POST => '1',

	CURLOPT_POSTFIELDS => $content_json,

	CURLOPT_HTTPHEADER => [

		'Authorization: OAuth ' . http_build_query($data, '', ','),

		'Content-Type: application/json',

		'Content-Length: ' . strlen($content_json)

	]

]);

// Response

$result = curl_exec($curl);

curl_close($curl);

$cart_id = json_decode($result);

//print_r($result);

$log .= '

--1--'.$result;





// Add Item -----------------------------------------------------------------

$sku = 'FirearmService';

include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');

$method = 'POST';

$url = $api_base."/store/index.php/rest/V1/guest-carts/$cart_id/items"; 

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$content_array = array('cartItem'=>array('sku'=>$sku,'qty'=>'1','quoteId'=>$cart_id));

$content_json = json_encode($content_array);

// Request

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_POST => '1',

	CURLOPT_POSTFIELDS => $content_json,

	CURLOPT_HTTPHEADER => [

		'Authorization: OAuth ' . http_build_query($data, '', ','),

		'Content-Type: application/json',

		'Content-Length: ' . strlen($content_json)

	]

]);

// Response

$result = curl_exec($curl);

curl_close($curl);

$response = json_decode($result);

$item = $response->sku;

//print_r($result);

$log .= '

--2--'.$result;



// Billing Address -----------------------------------------------------------------

include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');

$method = 'POST';

$url = $api_base."/store/index.php/rest/V1/guest-carts/$cart_id/billing-address"; 

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$content_array = array(

	'address' => array(

		'region' => $contact_region,

		'regionId' => $contact_region_id,

		'regionCode' => $contact_state,

		'countryId' => 'US',

		'street' => array($contact_street),

		'telephone' => $contact_phone,

		'postcode' => $contact_zip,

		'city' => $contact_city,

		'company' => $contact_company,

		'firstname' => $contact_firstname,

		'lastname' => $contact_lastname,

		'email' => $contact_email

	)

);

$content_json = json_encode($content_array);

// Request

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_POST => '1',

	CURLOPT_POSTFIELDS => $content_json,

	CURLOPT_HTTPHEADER => [

		'Authorization: OAuth ' . http_build_query($data, '', ','),

		'Content-Type: application/json',

		'Content-Length: ' . strlen($content_json)

	]

]);

// Response

$result = curl_exec($curl);

curl_close($curl);

$response = json_decode($result);

//print_r($result);

$log .= '

--3--'.$result;



// Payment Methods -----------------------------------------------------------------

$method = 'GET';

$url = $api_base."/store/index.php/rest/V1/guest-carts/$cart_id/payment-information"; 

$content_array = NULL;

$content_json = NULL;

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_HTTPHEADER => [

		'Authorization: Bearer ' . $token

	]

]);

// Response

$result = curl_exec($curl);

curl_close($curl);

$response = json_decode($result);

//print_r($result);

$log .= '

--4--'.$result;



// Order -----------------------------------------------------------------

include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');

$method = 'PUT';

$url = $api_base."/store/index.php/rest/V1/guest-carts/$cart_id/order"; 

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$content_array = array(
	
	'paymentMethod' => array(

		'method' => 'free'

   )

);

$content_json = json_encode($content_array);

// Request

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_CUSTOMREQUEST => "PUT",

	CURLOPT_POSTFIELDS => $content_json,

	CURLOPT_HTTPHEADER => [

		'Authorization: OAuth ' . http_build_query($data, '', ','),

		'Content-Type: application/json',

		'Content-Length: ' . strlen($content_json)

	]

]);

// Response

$result = curl_exec($curl);

$response = json_decode($result);

$order_id = $response;

//print_r($result);

$log .= '

--5--'.$result;



// Order Comment -----------------------------------------------------------------

include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');

$method = 'POST';

$url = $api_base."/store/index.php/rest/V1/orders/$order_id/comments"; 

$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);

$content_array = array(

	'statusHistory' => array(

		'comment' => "Ticket:{$ticket_id}/Serial:{$serial_number}",

		'isCustomerNotified' => '0',

		'isVisibleOnFront' => '0',

		'parentId' => '0',

		'status' => 'repair'

    ),

);

$content_json = json_encode($content_array);

// Request

$curl = curl_init();

curl_setopt_array($curl, [

	CURLOPT_RETURNTRANSFER => 1,

	CURLOPT_URL => $url,

	CURLOPT_POST => '1',

	CURLOPT_POSTFIELDS => $content_json,

	CURLOPT_HTTPHEADER => [

		'Authorization: OAuth ' . http_build_query($data, '', ','),

		'Content-Type: application/json',

		'Content-Length: ' . strlen($content_json)

	]

]);

// Response

$result = curl_exec($curl);

$response = json_decode($result);

//print_r($result);

$log .= '

--6--'.$result;



// Complete

if($result == 'true') {

	$complete = TRUE;

}



// Log

$file = TEMPLATEPATH.'/inc/magento/log/magento-repair-ticket-submission.txt';

if(file_exists($file)) {

	$data = file_get_contents($file);

}

$data .= $log;

file_put_contents($file, $data);

?>
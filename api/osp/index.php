<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?>
<?php
// HS Config
$hs_api = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';
$hs_list = '193';
$hs_url = "https://api.hubapi.com/contacts/v1/lists/$hs_list/contacts/all?hapikey=$hs_api&count=100";
// Get List
$json = file_get_contents($hs_url);
$list = json_decode($json,true);
//print_r($list);
foreach($list['contacts'] as $key => $profile){
	$hs_id = $profile['vid'];
	$firstname = ucwords($profile['properties']['firstname']['value']);
	$lastname = ucwords($profile['properties']['lastname']['value']);
	$email = $profile['identity-profiles'][0]['identities'][0]['value'];
	// Check Contact
	$query = "SELECT osp_id FROM data_osp_hubspot WHERE osp_hs_id='$hs_id' LIMIT 1";
	$result = mysql_query($query);
	if(@mysql_num_rows($result) == 0) {
		// Insert Contact
		$queryi = "INSERT INTO data_osp_hubspot (osp_hs_id, osp_first_name, osp_last_name, osp_email, osp_date_created, osp_date_edited, osp_active) 
		VALUES ('$hs_id', '$firstname', '$lastname', '$email', NOW(), NOW(), 'Y')";
		$resulti = mysql_query($queryi);
		echo "<p>$hs_id / $firstname / $lastname / $email</p>";
	}
}
?>
<?php
// OSP Config BETA
//$osp_api = 'fafc10097b35609a11bed3d66c38d99bdcb1612cb68b71a36e45efd281cd13feae6c79e27bd4ef8fbb645a0ffd96bb1c82b4e697fca56853ed570dcf5db4ef95';
//$osp_url = "https://beta.ospschool.com/api/v1/promotional_subscriptions";

// OSP Config Live
$osp_api = '0c02ea85adebf8ec5cb98024fa1cc590c4a80687be4a0110d2bc27e70bc3c8a5095674d425d3e05b48a0628f30abee14c8bcf8046832807f9dafd5a291644685';
$osp_url = "https://ospschool.com/api/v1/promotional_subscriptions";

// cURL Header
$curl_header = array();
$curl_header[] = "Content-Type:multipart/form-data";
$curl_header[] = "Authorization:$osp_api";

// Get Contacts
$query = "SELECT osp_id, osp_email FROM data_osp_hubspot WHERE osp_active='Y' ORDER BY osp_id ASC";
$result = mysql_query($query);
$count = 0;
$osp_ids = array();
while($row = @mysql_fetch_array($result,MYSQL_NUM)) {
	$osp_ids[] = $row[0];
	$osp_email = $row[1];
	
	// cURL Setup
	$curl_values = array();
	$curl_values['email'] = $osp_email;	
	${'curl'.$count} = curl_init();
	curl_setopt(${'curl'.$count}, CURLOPT_POST, 1);
	curl_setopt(${'curl'.$count}, CURLOPT_HTTPHEADER,$curl_header);
	curl_setopt(${'curl'.$count}, CURLOPT_POSTFIELDS, $curl_values);
    curl_setopt(${'curl'.$count}, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt(${'curl'.$count}, CURLOPT_URL, $osp_url);
	
	$count++;
}

// Run cURL
if($count > 0) {
	// cURL 
	$curl = curl_multi_init();
	
	// Add Handle
	for($i = 0; $i <= $count; $i++) {
		curl_multi_add_handle($curl, ${'curl'.$i});
	}
	// Execute
	$running = NULL;
	do {
		curl_multi_exec($curl, $running);
	} 
	while ($running);
	// Response
	for($i = 0; $i <= $count; $i++) {
		$info = curl_getinfo(${'curl'.$i});
		if($info['http_code'] == '201') {
			$queryu = "UPDATE data_osp_hubspot SET osp_date_approved=NOW(), osp_date_edited=NOW(), osp_active='N' WHERE osp_id='$osp_ids[$i]'";
			$resultu = @mysql_query($queryu);
		}
	}
	// Remove Handle
	for($i = 0; $i <= $count; $i++) {
		curl_multi_remove_handle($curl, ${'curl'.$i});
	}
	curl_multi_close($curl);	
}
?>
<?php
// Log
$file = fopen("log.txt","a");
$string = "Run ".date('Y-m-d-h:i:s').PHP_EOL;
echo fwrite($file,$string);
fclose($file);
?>
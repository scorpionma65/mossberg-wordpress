<?php ini_set('max_execution_time', 3600); ?>
<?php
// Freshdesk IDs
$api_key = 'UB52CVohVwQkgd0NWW3';
$api_base = 'https://mossberginc.freshdesk.com';
$api_auth = base64_encode($api_key.':X');

// Range
$range_date = strtotime('-1 day');
$range = TRUE;


// Get Tickets
for($i=1; $i<100; $i++) {
	if($range) {
		$url = $api_base."/api/v2/tickets?include=requester&order_by=created_at&order_type=desc&per_page=100&page=$i";
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => [ 
				'Authorization: Basic '.$api_auth
			]
		]);
		$result = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		
		// Ticket
		if($result) {
			echo "<h1>$i</h1>";
			$customer = json_decode($result);
			foreach($customer as $key => $value) {
				$ticket_id = $customer[$key]->id;
				$ticket_url = $api_base.'/helpdesk/tickets/'.$ticket_id;
				$ticket_source = $customer[$key]->source;
				$ticket_type = $customer[$key]->type;
				$first_name = $customer[$key]->custom_fields->first_name;
				$last_name = $customer[$key]->custom_fields->last_name;
				$persona = $customer[$key]->custom_fields->what_best_describes_you;
				$optin = $customer[$key]->custom_fields->may_we_add_you_to_our_email_list;
				$email = $customer[$key]->requester->email;
				$created = $customer[$key]->created_at;
								
				// Check Range
				if(strtotime($created) > $range_date) {
					if($optin == 'Yes' && $email) {
						// Hubspot API
						//include('freshdesk-hubspot-submission.php');
						echo "<p>$ticket_id / $optin / $persona / $email / $created / $status_response</p>";
					}
					} else {
					$range = FALSE;
					break;
				}
			}
			} else {
			$range = FALSE;
		}
		} else {
		echo "<h1>DONE</h1>";
		break;
	}
}
?>
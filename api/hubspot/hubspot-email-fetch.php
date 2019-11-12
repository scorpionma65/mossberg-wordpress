<?php ini_set('max_execution_time', 36000);?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?>
<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_api_key = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';

// Set IDs
$campaign_id = $_GET['c'];
$app_id = $_GET['a'];

// Get Email
$endpoint_a = "https://api.hubapi.com/email/public/v1/campaigns/$campaign_id?appId=$app_id&hapikey=$hs_api_key";
$response_a = file_get_contents($endpoint_a);
$result_a = json_decode($response_a, true);
$subject = $result_a['subject'];
$name = $result_a['name'];
$bounce = number_format($result_a['counters']['bounce'],0);
$delivered = number_format($result_a['counters']['delivered'],0);
$sent = number_format($result_a['counters']['sent'],0);
$click = number_format($result_a['counters']['click'],0);
$spamreport = number_format($result_a['counters']['spamreport'],0);
$unsubscribed = number_format($result_a['counters']['unsubscribed'],0);
$open = number_format($result_a['counters']['open'],0);
$scheduledAt = date('F j, Y - h:i a', $result_a['scheduledAt'] / 1000);
$datesent = date('Y-m-d H:i:s', $result_a['scheduledAt'] / 1000);

// Email Details
echo "<h1>$name</h1><h2>Subject: $subject<br/>Date: $scheduledAt ($datesent)</h2>
<table>
<tr><td>Sent: </td><td style=\"text-align:right;\">$sent</td></tr>
<tr><td>Delivered: </td><td style=\"text-align:right;\">$delivered</td></tr>
<tr><td>Bounced: </td><td style=\"text-align:right;\">$bounce</td></tr>
<tr><td>Spam Report: </td><td style=\"text-align:right;\">$spamreport</td></tr>
<tr><td>Unsubscribed: </td><td style=\"text-align:right;\">$unsubscribed</td></tr>
<tr><td>Opened: </td><td style=\"text-align:right;\">$open</td></tr>
<tr><td>Clicked: </td><td style=\"text-align:right;\">$click</td></tr>
</table>";

// Get Events
function get_email_events($hs_api_key, $campaign_id, $offset, $hour_24, $hour_48, $hour_168, $hour_336, $revenue) {
	$endpoint = "https://api.hubapi.com/email/public/v1/events?hapikey=$hs_api_key&campaignId=$campaign_id&eventType=OPEN&limit=1000&offset=$offset";
	$response = file_get_contents($endpoint);
	$result = json_decode($response, true);
	$more = $result{'hasMore'}; 
	$offset = $result{'offset'};
	foreach($result['events'] as $event) {
		$recipient = $event['recipient'];
		$opened = date('Y-m-d H:i:s', $event['sentBy']['created'] / 1000);
		$endpoint_b = "https://api.hubapi.com/contacts/v1/contact/email/$recipient/profile?hapikey=$hs_api_key&showListMemberships=false&property=magento_order_subtotal";
		$response_b = file_get_contents($endpoint_b);
		$result_b = json_decode($response_b, true);
		foreach($result_b['form-submissions'] as $form) {
			$form_conversion = $form['conversion-id'];
			$form_title = $form['title'];
			$form_timestamp = date('Y-m-d H:i:s', $form['timestamp'] / 1000);
			if($form_title == 'Ecommerce Order') {
				$start_date = new DateTime($opened);
				$purchase_date = new DateTime($form_timestamp);
				if($purchase_date > $start_date) {	
					$since_start = $start_date->diff(new DateTime($form_timestamp));
					if($since_start->days <= 14) {
						$order_subtotal = $result_b['properties']['magento_order_subtotal']['value'];
						echo "<p>$recipient // $opened<br/>$form_title | $form_timestamp<br/>";
						echo $since_start->y.' Years ';
						echo $since_start->m.' Months ';
						echo $since_start->d.' Days ';
						echo $since_start->h.' Hours ';
						echo $since_start->i.' Minutes';
						$total_hours = $since_start->h + ($since_start->d * 24);
						echo "<br/>$total_hours Total Hours<br/>\$$order_subtotal</p>";
						// Purchase
						$revenue = $revenue + $order_subtotal;
						// 24 Hours
						if($total_hours < 24) {
							$hour_24++;
							} else {
							// 48 Hours
							if($total_hours < 48) {
								$hour_48++;
								} else {
								// 168 Hours
								if($total_hours < 168) {
									$hour_168++;
									} else {
									// 336 Hours
									if($total_hours < 336) {
										$hour_336++;
									}
								}
							}
						}	
					}
				}
			}
		}
	}
	return (array('more'=>$more, 'offset'=>$offset, 'hour_24'=>$hour_24, 'hour_48'=>$hour_48, 'hour_168'=>$hour_168, 'hour_336'=>$hour_336, 'revenue'=>$revenue));
}

// Get Events
$hour_24 = 0;
$hour_48 = 0;
$hour_168 = 0;
$hour_336 = 0;
$revenue = 0;
$offset = NULL;
do { 
	$data = get_email_events($hs_api_key, $campaign_id, $offset, $hour_24, $hour_48, $hour_168, $hour_336, $revenue);
	$more = $data['more'];
	$offset = $data['offset'];
	$hour_24 = $data['hour_24'];
	$hour_48 = $data['hour_48'];
	$hour_168 = $data['hour_168'];
	$hour_336 = $data['hour_336'];
	$revenue = $data['revenue'];
}
while ($more == true);

echo "<p>24 Hours: $hour_24<br/>
2 Days: $hour_48<br/>
1 Week: $hour_168<br/>
2 Weeks: $hour_336<br/>
Subtotal: \$$revenue</p>";

// Archive Data
$query = "SELECT id FROM data_email_revenue WHERE campaign_id='$campaign_id' AND app_id='$app_id' LIMIT 1";
$result = @mysql_query($query);
if(@mysql_num_rows($result) == 0) {
	// Insert
	$query_i = "INSERT INTO data_email_revenue (campaign_id, app_id, campaign_name, campaign_subject, campaign_date, campaign_sent, campaign_delivered, campaign_bounced, campaign_spam, campaign_unsubscribed, campaign_opened, campaign_clicked, purchase_subtotal, purchase_24, purchase_48, purchase_168, purchase_336) VALUES ('$campaign_id', '$app_id', '$name', '$subject', '$datesent', '$sent', '$delivered', '$bounce', '$spamreport', '$unsubscribed', '$open', '$click', '$revenue', '$hour_24', '$hour_48', '$hour_168', '$hour_336')";
	$result_i = @mysql_query($query_i);
	} else {
	// Update
	$row = @mysql_fetch_array($result, MYSQL_NUM);
	$id = $row[0];
	$query_u = "UPDATE data_email_revenue SET campaign_name='$name', campaign_subject='$subject', campaign_sent='$sent', campaign_delivered='$delivered', campaign_bounced='$bounce', campaign_spam='$spamreport', campaign_unsubscribed='$unsubscribed', campaign_opened='$open', campaign_clicked='$click', purchase_subtotal='$revenue', purchase_24='$hour_24', purchase_48='$hour_48', purchase_168='$hour_168', purchase_336='$hour_336' WHERE id='$id'";
	$result_u = @mysql_query($query_u);
}
echo mysql_error();
?>




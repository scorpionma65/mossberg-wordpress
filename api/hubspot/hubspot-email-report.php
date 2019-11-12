<?php ini_set('max_execution_time', 3600);?>
<?php 
// Connect
require_once('../mysql/inc-mysql-connect.php');
?>
<?php
// Hubspot IDs
$hs_portal_id = '479666';
$hs_api_key = 'fba56954-9ea8-48ff-b1f0-23445cb99b40';

// Display Table
echo "<h1>Email Report</h1>
<table style=\"width:100%; color:#333; font-family:Arial; font-size:10px; line-height:15px;\">
<tr style=\"background:#333; color:#FFF; font-weight:bold; font-size:10px;\">
<td>CampaignID</td>
<td>AppID</td>
<td>ContentID</td>
<td>Name</td>
<td>Subject</td>
<td>Scheduled</td>
<td>Status</td>
<td style=\"text-align:right;\">Sent</td>
<td style=\"text-align:right;\">Delivered</td>
<td style=\"text-align:right;\">Bounced</td>
<td style=\"text-align:right;\">Reported</td>
<td style=\"text-align:right;\">Unsubscribed</td>
<td style=\"text-align:right;\">Opened</td>
<td style=\"text-align:right;\">Clicked</td>
<td style=\"text-align:right;\">1Day</td>
<td style=\"text-align:right;\">2Day</td>
<td style=\"text-align:right;\">1Week</td>
<td style=\"text-align:right;\">2Week</td>
<td style=\"text-align:right;\">Revenue</td>
<td></td>
</tr>";

// Get Campaigns
$count = 0;
$endpoint = "https://api.hubapi.com/email/public/v1/campaigns/by-id?hapikey=$hs_api_key&limit=100";
$response = file_get_contents($endpoint);
$result = json_decode($response, true);
foreach($result['campaigns'] as $campaign) {
	$campaign_id = $campaign['id'];
	$app_id = $campaign['appId'];
	$app_name = $campaign['appName'];
	if($app_name == 'Batch' && $campaign_id != '') {
		// Get Email
		$endpoint_a = "https://api.hubapi.com/email/public/v1/campaigns/$campaign_id?appId=$app_id&hapikey=$hs_api_key";
		$response_a = file_get_contents($endpoint_a);
		$result_a = json_decode($response_a, true);
		$id = $result_a['id'];
		$appId = $result_a['appId'];
		$appName = $result_a['appName'];
		$contentId = $result_a['contentId'];
		$subject = $result_a['subject'];
		$name = $result_a['name'];
		$deferred = number_format($result_a['counters']['deferred'],0);
		$bounce = number_format($result_a['counters']['bounce'],0);
		$forward = number_format($result_a['counters']['forward'],0);
		$dropped = number_format($result_a['counters']['dropped'],0);
		$delivered = number_format($result_a['counters']['delivered'],0);
		$sent = number_format($result_a['counters']['sent'],0);
		$click = number_format($result_a['counters']['click'],0);
		$spamreport = number_format($result_a['counters']['spamreport'],0);
		$processed = number_format($result_a['counters']['processed'],0);
		$unsubscribed = number_format($result_a['counters']['unsubscribed'],0);
		$print = number_format($result_a['counters']['print'],0);
		$statuschange = number_format($result_a['counters']['statuschange'],0);
		$mta_dropped = number_format($result_a['counters']['mta_dropped'],0);
		$open = number_format($result_a['counters']['open'],0);					
		$lastProcessingFinishedAt = date('Y-m-d H:i:s', $result_a['lastProcessingFinishedAt'] / 1000);
		$lastProcessingStartedAt = date('Y-m-d H:i:s', $result_a['lastProcessingStartedAt'] / 1000);
		$lastProcessingStateChangeAt = date('Y-m-d H:i:s', $result_a['lastProcessingStateChangeAt'] / 1000);
		$processingState = $result_a['processingState'];
		$scheduledAt = date('Y-m-d H:i:s', $result_a['scheduledAt'] / 1000);
		$type = $result_a['type'];
		
		// Get Report
		$one_day = '-';
		$two_day = '-';
		$one_week = '-';
		$two_week = '-';
		$revenue = '-';
		$query = "SELECT * FROM data_email_revenue WHERE campaign_id='$id' AND app_id='$appId' LIMIT 1";
		$result = @mysql_query($query);
		if(@mysql_num_rows($result) > 0) {
			$row = @mysql_fetch_array($result, MYSQL_ASSOC);
			$one_day = $row['purchase_24'];
			$two_day = $row['purchase_48'];
			$one_week = $row['purchase_168'];
			$two_week = $row['purchase_336'];
			$revenue = '$'.number_format($row['purchase_subtotal']);
		}
		
		echo "<tr style=\"border-bottom:1px solid #CCC;\">
		<td>$id</td>
		<td>$app_id</td>
		<td>$contentId</td>
		<td>$name</td>
		<td>$subject</td>
		<td>$scheduledAt</td>
		<td>$processingState</td>
		<td style=\"text-align:right;\">$sent</td>
		<td style=\"text-align:right;\">$delivered</td>
		<td style=\"text-align:right;\">$bounce</td>
		<td style=\"text-align:right;\">$spamreport</td>
		<td style=\"text-align:right;\">$unsubscribed</td>
		<td style=\"text-align:right;\">$open</td>
		<td style=\"text-align:right;\">$click</td>
		<td style=\"text-align:right;\">$one_day</td>
		<td style=\"text-align:right;\">$two_day</td>
		<td style=\"text-align:right;\">$one_week</td>
		<td style=\"text-align:right;\">$two_week</td>
		<td style=\"text-align:right;\">$revenue</td>
		<td style=\"font-weight:bold; text-align:center;\"><a href=\"hubspot-email-fetch.php?c=$id&a=$appId\" target=\"_blank\">FetchData</a></td>
		</tr>";
		$count++;
	}
}
echo "</table>";
?>

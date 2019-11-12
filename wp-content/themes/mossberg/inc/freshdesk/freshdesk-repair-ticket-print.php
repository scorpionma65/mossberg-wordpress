<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width"/>
<title>Service Repair Ticket</title>
<link rel="stylesheet" type="text/css" href="//fast.fonts.net/cssapi/a28ad9b5-065c-4065-a810-7a64c971de15.css"/>
<style>
* { font-family:'ITCFranklinGothicW01-Bk_812647', Arial; color:#333; }
p { margin:0px 0px 16px 0px; color:inherit; font-family:inherit; }
h1, h1 a:link, h1 a:visited { color:#111; font-size:28px; line-height:34px; margin:30px 0px 12px 0px; font-weight:normal; font-family:'ITCFranklinGothicW01-Hv_812689'; text-decoration:none; }
h2, h2 a:link, h2 a:visited { color:#111; font-size:26px; line-height:32px; margin:25px 0px 10px 0px; font-weight:normal; font-family:'ITCFranklinGothicW01-Hv_812689'; text-decoration:none; }
h3, h3 a:link, h3 a:visited { color:#111; font-size:22px; line-height:28px; margin:15px 0px 7px 0px; font-weight:normal; font-family:'ITCFranklinGothicW01-Dm_812668'; text-decoration:none; }
h4, h4 a:link, h4 a:visited { color:#111; font-size:16px; line-height:22px; margin:5px 0px 4px 0px; font-weight:normal; font-family:'ITCFranklinGothicW01-Dm_812668'; text-decoration:none; }
h5, h5 a:link, h5 a:visited { color:#111; font-size:14px; line-height:20px; margin:0px 0px 2px 0px; font-weight:normal; font-family:'ITCFranklinGothicW01-Dm_812668'; text-decoration:none; }
a:link, a:visited { color:#039; text-decoration:underline; font-family:inherit; }
a:hover, a:active { color:#039; text-decoration:underline; font-family:inherit; }
ul { padding:5px 0px 10px 35px; margin:0px; color:inherit; font-family:inherit; }
ol { padding:0px 0px 10px 35px; margin:0px; color:inherit; font-family:inherit; }
ol li { padding:0px 0px 7px 0px; margin:0px; color:inherit; font-family:inherit; }
ul li { padding:0px 0px 7px 0px; margin:0px; color:inherit; font-family:inherit; }
hr { margin:0px 0px 20px 0px; }
img { border:none; max-width:100%; height:auto; }
strong { color:inherit; font-family:inherit; }
em { color:inherit; font-family:inherit; }
span { color:inherit; font-family:inherit; }
iframe { max-width:100%; }
.freshdesk_ticket_container { width:640px; margin:0px 0px 20px 0px; padding:10px; font-size:13px; line-height:20px; text-align:left; border:1px solid #CCC; }
.freshdesk_ticket_section { margin:10px 5px; padding:0px 0px 10px 0px; border-bottom:1px solid #CCC; }
.freshdesk_ticket_section_last { margin:10px 5px; padding:0px 0px 10px 0px; border-bottom:none; }
.freshdesk_ticket_table { width:100%; margin:0px 0px 10px 0px; padding:0px; }
.freshdesk_ticket_table td { width:50%; margin:0px; padding:0px; vertical-align:top; }
.freshdesk_ticket_table ul { margin:0px; padding:10px 0px 0px 20px; }
.freshdesk_ticket_table li { margin:0px; padding:0px; }
.freshdesk_ticket_cutout { display:inline-block; margin:20px 0px; padding:30px 0px 30px 30px; border:3px dotted #CCC; }
@media print {
.print_break { page-break-after: always; }
}
</style>
<script type="text/javascript">
window.onload = function() { window.print(); }
</script>
</head>
<body>

<?php
// Freshdesk IDs
$api_key = 'a3ISCL8xrvueBhgawtjz';
$api_base = 'https://mossbergservice.freshdesk.com';
$api_auth = base64_encode($api_key.':X');

// Timezone
date_default_timezone_set('America/New_York');

// Get Ticket
if(!empty($_GET['id'])) {
	$ticket_id = preg_replace("/[^0-9]/", "", $_GET['id']);
	$url = $api_base."/api/v2/tickets/$ticket_id";

	// cURL
	$curl = curl_init();
	@curl_setopt($curl, CURLOPT_URL, $url);
	@curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	@curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic '.$api_auth
	));
	$result = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	
	// Response
	//echo "<p>$status</p>";
	//print_r($result);
	$result = json_decode($result);		
	$issue_detail = $result->description_text;
	$serial_number = $result->custom_fields->serial_number;
	$firearm_type = $result->custom_fields->firearm_type;
	$firearm_action = $result->custom_fields->action;
	$firearm_model = $result->custom_fields->model;
	$firearm_ammo = $result->custom_fields->gaugecaliber;
	$firearm_issues = explode(',',$result->custom_fields->primary_issues);
	$firearm_shipping = $result->custom_fields->shipping_contents;
	$created_at = date('F j, Y h:i:sA T', strtotime($result->created_at));
	$created_by = $result->custom_fields->dealer_or_customer;
	$primary_contact = $result->custom_fields->primary_contact;
	$dealer_company_name = $result->custom_fields->dealer_company_name;
	$dealer_contact_name = $result->custom_fields->dealer_contact_name;
	$dealer_address = $result->custom_fields->dealer_street_address;
	$dealer_city = $result->custom_fields->dealer_city;
	$dealer_state = $result->custom_fields->dealer_state;
	$dealer_zip = $result->custom_fields->dealer_zip;
	$dealer_email = $result->custom_fields->dealer_email;
	$dealer_phone = $result->custom_fields->dealer_phone;
	$dealer_ffl = $result->custom_fields->dealer_ffl;
	$owner_name = $result->custom_fields->owner_name;
	$owner_address = $result->custom_fields->owner_street_address;
	$owner_city = $result->custom_fields->owner_city;
	$owner_state = $result->custom_fields->owner_state;
	$owner_zip = $result->custom_fields->owner_zip;
	$owner_email = $result->custom_fields->owner_email;
	$owner_phone = $result->custom_fields->owner_phone;
	$owner_purchase_date = $result->custom_fields->owner_date_of_purchase;
	} else {
	echo "<h2>ERROR: No Service Ticket ID Provided</h2>";
}
?>

<div class="freshdesk_ticket_container print_break">

<div class="freshdesk_ticket_section">
<h3>Service Ticket ID: <?php echo $ticket_id;?></h3>
<strong>Date Created:</strong> <?php echo $created_at;?><br/>
<strong>Submitted By:</strong> <?php echo $created_by;?>
</div>

<div class="freshdesk_ticket_section">
<h3>Contact</h3>
<?php
// Contact
$dealer_contact = "$dealer_company_name ($dealer_contact_name)<br/>$dealer_address $dealer_city $dealer_state $dealer_zip<br/>$dealer_email<br/>$dealer_phone";
$owner_contact = str_replace("<br/><br/>","","$owner_name<br/>$owner_address $owner_city $owner_state $owner_zip<br/>$owner_email<br/>$owner_phone");
if($created_by == 'Dealer') {
	$ticket_contact = "<table class=\"freshdesk_ticket_table\">
	<tr>
	<td><h4>Dealer</h4>$dealer_contact</td>
	<td><h4>Firearm Owner</h4>$owner_contact</td>
	</tr>
	</table>
	<strong>Primary Contact:</strong> $primary_contact<br/>
	<strong>FFL:</strong> ";
	if($dealer_ffl) {
		$ticket_contact .= "<a href=\"$dealer_ffl\" target=\"_blank\">$dealer_ffl</a>";
		} else {
		$ticket_contact .= "FFL Not Uploaded";
	}
	} else {
	$ticket_contact = "<table>
	<tr>
	<td><h4>Firearm Owner</h4>$owner_contact</td>
	</tr>
	</table>
	<strong>Purchase Date:</strong> $owner_purchase_date";
}
echo $ticket_contact;
?>
</div>

<div class="freshdesk_ticket_section">
<h3>Firearm</h3>
<table class="freshdesk_ticket_table">
<tr>
<td>
<strong>Serial #:</strong> <?php echo $serial_number;?><br/>
<strong>Type:</strong> <?php echo $firearm_type;?><br/>
<strong>Action:</strong> <?php echo $firearm_action;?><br/>
<strong>Model:</strong> <?php echo $firearm_model;?><br/>
<strong>Gauge/Caliber:</strong> <?php echo $firearm_ammo;?>
</td>
<td>
<p><strong>Issue(s):</strong> <?php foreach($firearm_issues as $key => $value) { echo "<br/>$value";}?></p>
<p><strong>Shipping Contents:</strong> <?php echo $firearm_shipping;?></p>
</td>
</tr>
</table>
</div>

<div class="freshdesk_ticket_section_last" style="height:350px;">
<h3>Service Details</h3>
<em>Describe the service(s) you are requesting.</em>
<?php //echo $issue_detail;?>
</div>

</div>

<div class="freshdesk_ticket_container print_break">

<div class="freshdesk_ticket_section">
<h3>Shipping Instructions</h3>
<table class="freshdesk_ticket_table">
<tr>
<td>
<em><strong>PRINT A COPY OF THIS SERVICE TICKET WITH SERVICE DETAILS, AND PLACE INSIDE THE BOX WITH THE FIREARM YOU ARE RETURNING</strong></em>
<ul>
<li>Ship the firearm postage paid, via your chosen carrier to the address below. (We will not accept C.O.D. shipments)</li>
<li>Reference your service ticket number on the outside of the box. You may use the below shipping label for your convenience.</li>
<li><strong>IMPORTANT: Make absolutely certain your firearm is unloaded.</strong></li>
<li>Do not send ammunition with your firearm.</li>
<li>Remove all accessories (scopes, slings, etc).</li>
<li>Ship your firearm in a suitable container, packaging it securely to prevent parts from shifting and/or damage during shipping.</li>
</ul>
</td>
</tr>
</table>
</div>

<div class="freshdesk_ticket_section_last">
<h3>Ship To</h3>
<div class="freshdesk_ticket_cutout">
<table class="freshdesk_ticket_table">
<tr>
<td>
<h4>Mossberg Product Service Center</h4>
ATTN: Service Ticket ID <?php echo $ticket_id;?><br/>
Eagle Pass Industrial Park<br/>
1001 Industrial Blvd.<br/>
Eagle Pass, TX 78852
</td>
</tr>
</table>
</div>
</div>

</div>
</body>
</html>
<a href="<?php echo get_bloginfo('stylesheet_directory');?>/inc/freshdesk/freshdesk-repair-ticket-print.php?id=<?php echo $ticket_id;?>" target="_blank" class="freshdesk_ticket_print_button">Print Ticket</a>
<a href="<?php echo get_bloginfo('url');?>/customer-service" class="freshdesk_ticket_print_button freshdesk_ticket_return_button">Return to Customer Service</a>

<div class="freshdesk_ticket_container">

<div class="freshdesk_ticket_section">
<h3>Service Ticket ID: <?php echo $ticket_id;?></h3>
<strong>Date Created:</strong> 
<?php 
date_default_timezone_set('America/New_York');
echo date('F j, Y h:i:sA T');
?>
<br/>
<strong>Submitted By:</strong> <?php echo $dealer_owner;?>
</div>

<div class="freshdesk_ticket_section">
<h3>Contact</h3>
<?php
// Contact
$dealer_contact = "$dealer_company_name ($dealer_contact_name)<br/>$dealer_address $dealer_city $dealer_state $dealer_zip<br/>$dealer_email<br/>$dealer_phone";
$owner_contact = str_replace("<br/><br/>","","$owner_name<br/>$owner_address $owner_city $owner_state $owner_zip<br/>$owner_email<br/>$owner_phone");
if($dealer_owner == 'Dealer') {
	$ticket_contact = "<table class=\"freshdesk_ticket_table\">
	<tr>
	<td><h4>Dealer</h4>".stripslashes($dealer_contact)."</td>
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
	<strong>Purchase Date:</strong> $purchase_month/$purchase_year";
}
echo $ticket_contact;
?>
</div>

<div class="freshdesk_ticket_section_last">
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
<strong>Issue(s):</strong> <?php foreach($firearm_issues as $key => $value) { echo "<br/>$value";}?>
</td>
</tr>
</table>
</div>

<div class="freshdesk_ticket_section_last">
<h3>Service Details</h3>
<em>Please write in the service detail on the printed copy of this page and pack with your firearm.</em>
<?php //echo $issue_detail;?>
</div>

</div>

<div class="freshdesk_ticket_container">

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
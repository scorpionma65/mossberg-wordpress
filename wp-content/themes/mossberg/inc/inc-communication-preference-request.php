<?php
// Connect
include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');

// Setup
$message = NULL;
$show = TRUE;
$mail = FALSE;

// Submit
if(isset($_POST['management_submit'])) {
	// Check	
	$email = sanitize_text_field($_POST['management_email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
	}
	
	if($email) {	
	
		// HubSpot API
		include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-communication-preference-request.php');
		
		// Unsubscribed
		if(!$optin) {
			$message .="<h4>Looks like you have previously unsubscribed from Mossberg email communication.<br/>You'll need to resubscribe before you can manage your preferences.</em></h4>
			<p><a href=\"".get_bloginfo('url')."/privacy-center/resubscribe/\" class=\"link_button\">Resubscribe to Mossberg Email</a></p>";
			$show = FALSE;
			
			} else {
			if($hs_vid) {
				
				// Hubspot API
				include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-communication-preference-email.php');
				
				// Success
				$message .= "<h4>Instructions to manage your email communication preferences have been emailed to you at $email</h4>";
				$show = FALSE;
				} else {
				$message .= "<h4>No contacts with email address {$email} are currently in our marketing system.</h4>";
				$show = TRUE;
			}
		}
	}
}

// Message
if($message) {
	echo $message;
	} else {
	echo "<h4>To continue, enter your email address and follow the instructions provided in the email verification.</h4>";
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-communication-preference-request.php');
}
?>

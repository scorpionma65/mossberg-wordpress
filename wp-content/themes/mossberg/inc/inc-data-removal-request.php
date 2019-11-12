<?php
// Connect
include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');

// Setup
$message = NULL;
$show = TRUE;
$mail = FALSE;

// Submit
if(isset($_POST['removal_submit'])) {
	// Check	
	$email = sanitize_text_field($_POST['removal_email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
	}
	
	if($email) {	
	
		// HubSpot API
		include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-data-removal-request.php');
		
		// Unsubscribed
		if(!$optin) {
			$message .="<h4>Looks like you have previously unsubscribed from Mossberg email communication.<br/>You'll need to resubscribe before you can delete your data (we can't deliver your verification email while you are unsubscribed).</em></h4>
			<p><a href=\"".get_bloginfo('url')."/privacy-center/resubscribe/\" class=\"link_button\">Resubscribe to Mossberg Email</a></p>";
			$show = FALSE;
			} else {
			if($hs_vid) {
				
				// Token
				$token = md5(uniqid(rand(), true));
				$query = "INSERT INTO data_privacy_tokens (data_privacy_token_hsid, data_privacy_token_key, data_privacy_token_email, data_privacy_token_date_created, data_privacy_token_date_edited, data_privacy_token_type) 
				VALUES ('$hs_vid', '$token', '$email', NOW(), NOW(), 'D')";
				$result = @mysql_query($query);
				
				// Hubspot API
				include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-data-removal-email.php');
				
				// Success
				$message .= "<h4>Instructions to complete your data removal request have been emailed to you at $email</h4>";
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
	include(TEMPLATEPATH.'/inc/forms/form-data-removal-request.php');
}
?>

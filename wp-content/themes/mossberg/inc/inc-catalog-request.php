<?php
// Setup
$message = NULL;
$show = TRUE;

// Submit
if(isset($_POST['submit'])) {
	// Check
	$email = sanitize_text_field($_POST['email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
	}
	$firstname = sanitize_text_field($_POST['firstname']);
	if(!$firstname) {
		$message .= "<p class=\"form_message_fail\">Please enter your First Name</p>";
	}
	$lastname = sanitize_text_field($_POST['lastname']);
	if(!$lastname) {
		$message .= "<p class=\"form_message_fail\">Please enter your Last Name</p>";
	}
	$address = sanitize_text_field($_POST['address']);
	if(!$address) {
		$message .= "<p class=\"form_message_fail\">Please enter your Street Address</p>";
	}
	$city = sanitize_text_field($_POST['city']);
	if(!$city) {
		$message .= "<p class=\"form_message_fail\">Please enter your City</p>";
	}
	$state = sanitize_text_field($_POST['state']);
	if(!$state) {
		$message .= "<p class=\"form_message_fail\">Please enter your State</p>";
	}
	$zip = sanitize_text_field($_POST['zip']);
	if(!$zip) {
		$message .= "<p class=\"form_message_fail\">Please enter your Zip</p>";
	}
	$marketing_opt_in = 'Yes';
	// Interested
	$i_am_interested_in_ = NULL; 
	if(!empty($_POST['i_am_interested_in_1'])) {
		$i_am_interested_in_1 = sanitize_text_field($_POST['i_am_interested_in_1']);
		$i_am_interested_in_ .= $i_am_interested_in_1.';';
	}
	if(!empty($_POST['i_am_interested_in_2'])) {
		$i_am_interested_in_2 = sanitize_text_field($_POST['i_am_interested_in_2']);
		$i_am_interested_in_ .= $i_am_interested_in_2.';';
	}
	if(!empty($_POST['i_am_interested_in_3'])) {
		$i_am_interested_in_3 = sanitize_text_field($_POST['i_am_interested_in_3']);
		$i_am_interested_in_ .= $i_am_interested_in_3.';';
	}
	if(!empty($_POST['i_am_interested_in_4'])) {
		$i_am_interested_in_4 = sanitize_text_field($_POST['i_am_interested_in_4']);
		$i_am_interested_in_ .= $i_am_interested_in_4.';';
	}
	if(!empty($_POST['i_am_interested_in_5'])) {
		$i_am_interested_in_5 = sanitize_text_field($_POST['i_am_interested_in_5']);
		$i_am_interested_in_ .= $i_am_interested_in_5.';';
	}
	if(!empty($_POST['i_am_interested_in_6'])) {
		$i_am_interested_in_6 = sanitize_text_field($_POST['i_am_interested_in_6']);
		$i_am_interested_in_ .= $i_am_interested_in_6.';';
	}
	if(!empty($_POST['i_am_interested_in_7'])) {
		$i_am_interested_in_7 = sanitize_text_field($_POST['i_am_interested_in_7']);
		$i_am_interested_in_ .= $i_am_interested_in_7.';';
	}
	if(!empty($_POST['i_am_interested_in_8'])) {
		$i_am_interested_in_8 = sanitize_text_field($_POST['i_am_interested_in_8']);
		$i_am_interested_in_ .= $i_am_interested_in_8.';';
	}
	if(!empty($_POST['i_am_interested_in_9'])) {
		$i_am_interested_in_9 = sanitize_text_field($_POST['i_am_interested_in_9']);
		$i_am_interested_in_ .= $i_am_interested_in_9.';';
	}
	if(!empty($_POST['i_am_interested_in_10'])) {
		$i_am_interested_in_10 = sanitize_text_field($_POST['i_am_interested_in_10']);
		$i_am_interested_in_ .= $i_am_interested_in_10.';';
	}
	if($i_am_interested_in_ != NULL) {
		$i_am_interested_in_ = substr($i_am_interested_in_,0,-1);
		$i_am_interested_in_ = str_replace(';',', ',$i_am_interested_in_);
	}
	
	// Check CAPTCHA
	include(TEMPLATEPATH.'/inc/inc-captcha.php');
	
	if($firstname && $lastname && $email && $address && $city && $state && $zip && $captcha) {	
	
		// Form Response
		$args = array('category_name'=>'catalog-request-response', 'numberposts'=>1);
		$posts = get_posts($args);
		if($posts) { 
			$post_title = $posts[0]->post_title;
			$post_content = wpautop($posts[0]->post_content);
			$message .= $post_content;
		}
		
		// Data 
		$query = "INSERT INTO data_catalog_request (request_type, request_email, request_first_name, request_last_name, request_address, request_city, request_state, request_postcode, request_interests, request_optin, request_date_created, request_date_edited, request_active) VALUES ('Catalog', '$email', '$firstname', '$lastname', '$address', '$city', '$state', '$zip', '$i_am_interested_in_', '$marketing_opt_in', NOW(), NOW(), 'Y')";
		$result = @mysql_query($query);
		echo mysql_error();
		
		// HubSpot API
		include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-catalog-request.php');
		$show = FALSE;
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-catalog-request.php');
}
?>

<?php
// Setup
$message = NULL;
$show = TRUE;
$mail = FALSE;

// Submit
if(isset($_POST['submit'])) {
	// Check	
	$firstname = sanitize_text_field($_POST['firstname']);
	if(!$firstname) {
		$message .= "<p class=\"form_message_fail\">Please enter your First Name</p>";
	}
	$lastname = sanitize_text_field($_POST['lastname']);
	if(!$lastname) {
		$message .= "<p class=\"form_message_fail\">Please enter your Last Name</p>";
	}
	$email = sanitize_text_field($_POST['email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
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
	$may_we_add_you_to_our_email_list_ = sanitize_text_field($_POST['may_we_add_you_to_our_email_list_']);
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
	
	if($firstname && $lastname && $email && $address && $city && $state && $zip) {	
	
		// Online
		$args = array('name'=>'osp-offer-redeem-online', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
		$posts = get_posts($args);
		if($posts) { 
			$post_title = $posts[0]->post_title;
			$post_content = wpautop($posts[0]->post_content);
			echo $post_content;
		}
		
		// HubSpot API
		include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-osp-submission.php');
		$show = FALSE;
		$mail = TRUE;
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-osp-submission.php');
}
?>

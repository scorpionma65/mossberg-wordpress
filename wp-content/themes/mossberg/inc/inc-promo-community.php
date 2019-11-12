<?php
// Connect
include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');

// Setup
$message = NULL;
$show = TRUE;
$mail = FALSE;

// Submit
if(isset($_POST['submit'])) {
	// Check	
	$email = sanitize_text_field($_POST['email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
	}
	$may_we_add_you_to_our_email_list_ = 'Yes';
	// Persona
	$hs_persona = sanitize_text_field($_POST['hs_persona']);	
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
	
	if($email) {	
	
		// Success
		$args = array('name'=>'community-promo-response', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
		$posts = get_posts($args);
		if($posts) { 
			$post_title = $posts[0]->post_title;
			$post_content = wpautop($posts[0]->post_content);
			echo $post_content;
		}
		
		// Promo Code
		$query = "SELECT promo_id, promo_code FROM data_magento_promos WHERE promo_active='Y' ORDER BY promo_id ASC LIMIT 1";
		$result = @mysql_query($query);
		$row = @mysql_fetch_array($result,MYSQL_NUM);
		$promo_id = $row[0];
		$promo_community_signup = $row[1];
		
		$query_u = "UPDATE data_magento_promos SET promo_active='N', promo_date_edited=NOW() WHERE promo_id='$promo_id'";
		$result_u = @mysql_query($query_u);
		
		// HubSpot API
		include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-community-promo.php');
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
	include(TEMPLATEPATH.'/inc/forms/form-promo-community.php');
}
?>

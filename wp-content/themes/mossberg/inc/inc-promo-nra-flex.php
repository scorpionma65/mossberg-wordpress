<?php
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
	
	// Agree
	if(!empty($_POST['agree_terms'])) {
		$agree_terms = TRUE;
		} else {
		$message .= "<p class=\"form_message_fail\">Please check the box to agree to the Official Rules</p>";	
		$agree_terms = FALSE;
	}
	if(!empty($_POST['agree_age'])) {
		$agree_age = TRUE;
		} else {
		$message .= "<p class=\"form_message_fail\">Please check the box to Verify Your Age (18+)</p>";	
		$agree_age = FALSE;
	}
	
	if($email && $agree_terms && $agree_age) {
		
		// Check Entry
		$query_c = "SELECT entry_id FROM data_magento_entries WHERE entry_email='$email'";
		$result_c = @mysql_query($query_c);
		if(@mysql_num_rows($result_c) < 1) {
		
			// Promo Code
			$query = "SELECT promo_id, promo_code FROM data_magento_promos WHERE promo_active='Y' ORDER BY promo_id ASC LIMIT 1";
			$result = @mysql_query($query);
			$row = @mysql_fetch_array($result,MYSQL_NUM);
			$promo_id = $row[0];
			$promo_code = $row[1];
			
			// Deactivate Promo
			$query_u = "UPDATE data_magento_promos SET promo_active='N', promo_date_edited=NOW() WHERE promo_id='$promo_id'";
			$result_u = @mysql_query($query_u);
			
			// Entry
			$query_e = "INSERT INTO data_magento_entries (entry_email, entry_date_created, entry_date_edited, promo_id) VALUES ('$email', NOW(), NOW(), '$promo_id')";
			$result_e = @mysql_query($query_e);
		
			// Success
			$args = array('name'=>'flex-nra-response', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
			$posts = get_posts($args);
			if($posts) { 
				$post_title = $posts[0]->post_title;
				$post_content = wpautop($posts[0]->post_content);
				echo $post_content;
			}
			
			// Promo
			echo "<p>Your Promo Code: <span class=\"promo_code\">$promo_code</span></p><p><a href=\"".get_bloginfo('url')."/store\">Shop Now &raquo;</a></p>";
			
			// HubSpot API
			include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-nra-flex-promo.php');
			$show = FALSE;
			$mail = TRUE;
			
			} else {

			// Previously Entered
			$message .= "<p><em>Sorry, but you have already entered the sweepstakes. One entry per person please.</em></p>
			<p><a href=\"http://www.mossberg.com/flexnra/nra-show-flex-shotgun-sweepstakes/\" target=\"_blank\">Official Rules &raquo;</a></p>";
			$show = FALSE;
		}
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-promo-nra-flex.php');
}
?>

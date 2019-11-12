<?php
// Setup
$message = NULL;
$show = TRUE;

// Submit
if(isset($_POST['submit'])) {
	// Check
	$first_name = sanitize_text_field($_POST['first_name']);
	if(!$first_name) {
		$message .= "<p class=\"form_message_fail\">Please enter your First Name</p>";
	}
	$last_name = sanitize_text_field($_POST['last_name']);
	if(!$last_name) {
		$message .= "<p class=\"form_message_fail\">Please enter your Last Name</p>";
	}
	$email = sanitize_text_field($_POST['email']);
	if(!$email) {
		$message .= "<p class=\"form_message_fail\">Please enter your Email Address</p>";
	}
	$model = sanitize_text_field($_POST['model']);
	if(!$model) {
		$message .= "<p class=\"form_message_fail\">Please enter the Mossberg Product(s) Used</p>";
	}
	$location = sanitize_text_field($_POST['location']);
	if(!$location) {
		$message .= "<p class=\"form_message_fail\">Please enter the Location</p>";
	}
	$month = sanitize_text_field($_POST['trophy_month']);
	if(!$month) {
		$message .= "<p class=\"form_message_fail\">Please select a Month</p>";
	}
	$year = sanitize_text_field($_POST['trophy_year']);
	if(!$year) {
		$message .= "<p class=\"form_message_fail\">Please select a Year</p>";
	}
	$room = sanitize_text_field($_POST['room']);
	if(!$room) {
		$message .= "<p class=\"form_message_fail\">Please select a Trophy Album</p>";
	}
	
	// Dog Tags
	$dog_tags = false;
	if($dog_tags) {
		// Address
		$address = sanitize_text_field($_POST['address']);
		if(!$address) {
			$message .= "<p class=\"form_message_fail\">Please enter your Address</p>";
		}
		$city = sanitize_text_field($_POST['city']);
		if(!$city) {
			$message .= "<p class=\"form_message_fail\">Please enter your City</p>";
		}
		$state = sanitize_text_field($_POST['state']);
		if(!$state) {
			$message .= "<p class=\"form_message_fail\">Please select your State</p>";
		}
		$zip = sanitize_text_field($_POST['zip']);
		if(!$zip) {
			$message .= "<p class=\"form_message_fail\">Please enter your Zip Code</p>";
		}
		if($address && $city && $state && $zip) {
			$mailing_address = "$address - $city, $state $zip";
			} else {
			$mailing_address = FALSE;
		}
		} else {
		$dog_tags = 'N';
		$address = sanitize_text_field($_POST['address']);
		$city = sanitize_text_field($_POST['city']);
		$state = sanitize_text_field($_POST['state']);
		$zip = sanitize_text_field($_POST['zip']);
		$mailing_address = "$address - $city, $state $zip";
	}
	
	// Subscribe
	$subscribe = sanitize_text_field($_POST['subscribe']);
	if(!$subscribe) {
		$message .= "<p class=\"form_message_fail\">Please choose your Communication Preferences for Mossberg emails.</p>";
	}
	// Terms
	$agree = sanitize_text_field($_POST['agree']);
	if(!$agree) {
		$message .= "<p class=\"form_message_fail\">Please check the box to Agree to the Terms of Use</p>";
	}
	
	// Optional
	$story = sanitize_text_field($_POST['story']);
	$species = sanitize_text_field($_POST['species']);
	$i_am_interested_in_1 = sanitize_text_field($_POST['i_am_interested_in_1']);
	$i_am_interested_in_2 = sanitize_text_field($_POST['i_am_interested_in_2']);
	$i_am_interested_in_3 = sanitize_text_field($_POST['i_am_interested_in_3']);
	$i_am_interested_in_4 = sanitize_text_field($_POST['i_am_interested_in_4']);
	$i_am_interested_in_5 = sanitize_text_field($_POST['i_am_interested_in_5']);
	$i_am_interested_in_6 = sanitize_text_field($_POST['i_am_interested_in_6']);
	$i_am_interested_in_7 = sanitize_text_field($_POST['i_am_interested_in_7']);
	$i_am_interested_in_8 = sanitize_text_field($_POST['i_am_interested_in_8']);
	$i_am_interested_in_9 = sanitize_text_field($_POST['i_am_interested_in_9']);
	$i_am_interested_in_10 = sanitize_text_field($_POST['i_am_interested_in_10']);
	
	// Upload
	if(empty($_FILES['upload']['name'])) {
		$upload = FALSE;
		$message .= "<p class=\"form_message_fail\">Please select a Photo to Upload</p>";
		} else {
		$upload = TRUE;
	}	
	
	if($first_name && $last_name && $email && $model && $room && $location && $month && $year && $agree && $subscribe && $upload && $mailing_address) {	
						
		// Photo
		if (!function_exists('wp_handle_upload')) {
    		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		$upload_file = $_FILES['upload'];
		$upload_overrides = array('test_form'=>false);
		$move_file = wp_handle_upload($upload_file, $upload_overrides);
		if($move_file && !isset($move_file['error'])) {	
			$file_path = $move_file['file'];
			$file_mime = $move_file['type'];

			// Post
			$trophy_title = ucwords(strtolower($first_name)).' '.strtoupper(substr($last_name,0,1));
			$trophy_content = $story;
			$trophy_date = date('F', mktime(0, 0, 0, $month, 10)).' '.$year;
			
			// Room
			$room = get_category_by_slug($room); 
  			$room_id = $room->term_id;
			
			$trophy_post = array(
			  'post_title'    => $trophy_title,
			  'post_content'  => $trophy_content,
			  'post_status'   => 'draft',
			  'post_author'   => 1,
			  'post_category' => array(107,$room_id)
			);
			$trophy_post_id = wp_insert_post($trophy_post);
			if($trophy_post_id) {
				add_post_meta($trophy_post_id, 'Trophy Model', $model);
				add_post_meta($trophy_post_id, 'Trophy Date', $trophy_date);
				add_post_meta($trophy_post_id, 'Trophy Species', $species);
				add_post_meta($trophy_post_id, 'Trophy Location', $location);
				add_post_meta($trophy_post_id, 'Trophy Address', $mailing_address);
				
				// Attachment
				$wp_upload_dir = wp_upload_dir();
				$attachment = array(
					'guid'           => $wp_upload_dir['url'] . '/' . basename( $file_path ), 
					'post_mime_type' => $file_mime,
					'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_path ) ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);				
				$attach_id = wp_insert_attachment( $attachment, $file_path, $trophy_post_id );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
				wp_update_attachment_metadata( $attach_id, $attach_data );
				add_post_meta($trophy_post_id, '_thumbnail_id', $attach_id);
				
				// Success
				$message .= "<h2>Thank You!</h2>
				<p>Your Trophy Room submission is being reviewed by our team. Thanks for contributing! <a href=\"".get_bloginfo('home')."/community/trophy-room/\">Trophy Room &raquo;</a></p>";
				// HubSpot API
				include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-trophy-submission.php');
				$show = FALSE;
			}			
			} else {				
			$message .= "<p class=\"form_message_fail\">".$movefile['error']."</p>";
		}
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-trophy-submission.php');
}
?>

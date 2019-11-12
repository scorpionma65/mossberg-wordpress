<?php
// Setup
$message = NULL;
$show = TRUE;

// Remove Data
if(!empty($_GET['token']) && !empty($_GET['id'])) {
	$token = sanitize_text_field($_GET['token']);
	$email = sanitize_text_field(urldecode($_GET['id']));
	// Submit
	if(isset($_GET['submit'])) {
		// Check Token
		$query = "SELECT data_privacy_token_hsid, data_privacy_token_date_created FROM data_privacy_tokens WHERE data_privacy_token_key='$token' AND data_privacy_token_email='$email'";
		$result = @mysql_query($query);
		if(@mysql_num_rows($result) == 1) {
			$row = @mysql_fetch_array($result, MYSQL_NUM);
			$vid = $row[0];
			$expires = strtotime($row[1].'+1 hour');
			$now = new DateTime("now", new DateTimeZone('America/Chicago'));
			$now = strtotime($now->format('Y-m-d H:i:s'));
			if ($expires > $now) {
				// Hubspot API
				include(ABSPATH.'wp-content/themes/mossberg/inc/hubspot/hubspot-data-removal-delete.php');
				$message .= "<h3>Your personal data has been removed from the Mossberg marketing system.</h3><p><a href=\"".get_bloginfo('url')."/privacy-center\">Return to Privacy Center &raquo;</a></p>";
				$show = FALSE;
				} else {
				// Expired
				$message .= "<h3>Sorry, but your removal token has expired.</h3><p>Data removal request tokens expire after 1 hour. To complete your data removal request, please return to the <a href=\"".get_bloginfo('url')."/privacy-center\">Privacy Center</a> and start a new request.</p>";
			}
			} else {
			// Fail
			$message .= "<h3>Sorry, but your removal token is not valid.</h3><p>To complete your data removal request, please return to the <a href=\"".get_bloginfo('url')."/privacy-center\">Privacy Center</a> and start a new request.</p>";	
		}
	}
}
echo mysql_error();
// Message
if($message) {
	echo "<div class=\"form_message\">$message</div>";
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-data-removal-delete.php');
}	
?>
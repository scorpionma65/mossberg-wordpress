<?php
// URL
$model = sanitize_text_field($_GET['model']);
$barrel = sanitize_text_field($_GET['barrel']);
$forend = sanitize_text_field($_GET['forend']);
$stock = sanitize_text_field($_GET['stock']);
$recoil = sanitize_text_field($_GET['recoil']);
$url =  get_bloginfo('url')."/flex-email?model=$model&barrel=$barrel&forend=$forend&stock=$stock&recoil=$recoil";

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
	$url = sanitize_text_field($_POST['url']);

	if($email && $url) {	
	
		// Email
		$to = $email;
		$subject = "Mossberg - FLEX Configuration";
		$body_text = "Your Mossberg FLEX Configuration;\n$url";
		$body_html = "<html><body>".nl2br($body_text)."</body></html>";
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$headers[] = "From: Mossberg <info@mossberg.com>";
		wp_mail( $to, $subject, $body, $headers );
		
		// Success
		$message = "<p><em>Thank you! Configuration sent to $email</em></p>";
		$show = FALSE;
		
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-flex-email.php');
}
?>

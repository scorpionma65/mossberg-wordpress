<?php
// Run Captcha
require_once(TEMPLATEPATH.'/inc/recaptcha/recaptchalib.php');
$response = NULL;
$recaptcha = new ReCaptcha('6Ld2amUUAAAAAIZeBgIFJL8PfbkxwuyjLwxmx9mN');
if($_POST["g-recaptcha-response"]){
	$response = $recaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
}
// Check Captcha
if (!$response->success || $response->success!='1') {
	$captcha = FALSE;
	$message .= "<p class=\"form_message_fail\">Please complete the CAPTCHA verification.</p>";
	} else {
	$captcha = TRUE;
}
?>
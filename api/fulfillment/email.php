<?php
// Set Dates
$begin = date('Y-m-d',strtotime("-1 weeks monday"));
$end = date('Y-m-d',strtotime("-0 weeks monday"));

// Email
$email_from = 'estore@mossberg.com';
$email_subject = "Mossberg Catalog Fulfillment $begin to $end";
$email_body = "Download: http://www.mossberg.com/api/fulfillment?begin=$begin&end=$end";
$email_headers = "From: $email_from" . "\r\n" . "Reply-To: $email_from" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once '../phpmailer/src/PHPMailer.php';
require_once '../phpmailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.office365.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'azuresmtp@mossberg.com';
$mail->Password = '#Hab74Rt';
$mail->setFrom($email_from, 'Mossberg Fulfillment');
$mail->addReplyTo($email_from, 'Mossberg Fulfillment');
$mail->addAddress('team.robertson@alliedprinting.com', 'Allied');
$mail->addAddress('lbaker@mossberg.com', 'Mossberg');
$mail->addAddress('bthode@snydergroupinc.com', 'SnyderGroup');
$mail->Subject = $email_subject;
$mail->msgHTML($email_body);
$mail->AltBody = $email_body;
if (!$mail->send()) {
    echo "Not Sent: $begin to $end: " . $mail->ErrorInfo;
	} else {
    echo "Sent: $begin to $end";
}

?>
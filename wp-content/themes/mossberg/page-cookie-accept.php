<?php
/*
Template Name: Cookie Accept
*/
?>
<?php
// Set Cookie
$cookie_name = 'cookie-accept';
$cookie_value = 'accepted';
if(setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/")) {
	// Clear Popup Cookie
	unset($_COOKIE['mb_announcement']);	
	setcookie('mb_announcement', '', time() - 3600);	
	// Redirect
	$redirect = get_bloginfo('url');
	if(!empty($_GET['page'])) {
		$redirect = $redirect.'/'.$_GET['page'];
	}
	header('Location: '.$redirect);
}
?>
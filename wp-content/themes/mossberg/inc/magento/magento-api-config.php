<?php
// Sign
function sign($method, $url, $data, $consumerSecret, $tokenSecret) {
	$url = urlEncodeAsZend($url);
	$data = urlEncodeAsZend(http_build_query($data, '', '&'));
	$data = implode('&', [$method, $url, $data]);
	$secret = implode('&', [$consumerSecret, $tokenSecret]);
	return base64_encode(hash_hmac('sha1', $data, $secret, true));
}
// Encode
function urlEncodeAsZend($value) {
	$encoded = rawurlencode($value);
	$encoded = str_replace('%7E', '~', $encoded);
	return $encoded;
}
// Auth Data
$consumerKey = 'lcni82wtqpbu8khrak6qkdskr8bb4swx';
$consumerSecret = 'dh4ts81exbwmbfbc5n5d7l37s6i9obss';
$accessToken = 'b4p8erso2blva562trwqsbqpxjmllsp0';
$accessTokenSecret = 'ym6aqmmr19j9f2ru5nbe7qc7qmtcdakf';
// API Base URL
$api_base = str_replace('http://','https://',get_bloginfo('url'));
?>
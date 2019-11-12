<?php
// IP Protect
$ip = $_SERVER['REMOTE_ADDR'];
$allowed = array('69.119.93.245','65.158.22.59','67.131.112.147','173.9.68.228','64.206.106.248','66.30.84.203','71.232.3.193','73.219.173.69','73.186.89.63','24.188.243.55','32.211.86.99');
if(!in_array($ip,$allowed)) {
	header('Location:https://www.mossberg.com');
}
?>

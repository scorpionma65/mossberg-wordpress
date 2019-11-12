<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Dealers
*/
ini_set('max_execution_time', 10000); 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>
<?php get_header(); ?>
<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');?>
<div class="content_twelve content_full">
<div class="container_text">
<?php
// CRM Dealer Import

//// Clear Dealers
//$args = array('category_name'=>'us-dealers','posts_per_page'=>'500');
//query_posts($args);
//$count = 0;
//while(have_posts()):the_post();
//	$location_id = $post->ID;
//	$location_title = $post->post_title;
//	$location_slug = $post->post_name;
//	wp_delete_post($location_id, TRUE);
////	if(substr($location_slug,-2) == '-2') {
////		wp_delete_post($location_id, TRUE);
////		$count++;
////	}
////	if($location_title == NULL) {
////		wp_delete_post($location_id, TRUE);
////		$count++;
////	}
//endwhile;
//echo "<p>TOTAL DELETED: $count</p>";
//wp_reset_query();


//// Add Dealers
//$addresses = array();
//$query = "SELECT dealer_id, dealer_name, dealer_street, dealer_city, dealer_state, dealer_zip, dealer_phone, dealer_website FROM data_dealers WHERE dealer_id BETWEEN 2501 AND 3000";
//$result = @mysql_query($query);
//$count = 1;
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$id = $row[0];
//	$name = ucwords(strtolower($row[1]));
//	$street = ucwords(strtolower($row[2]));
//	$city = ucwords(strtolower($row[3]));
//	$state = strtoupper($row[4]);
//	$zip = trim($row[5]);
//	$phone = preg_replace("/[^0-9,.]/", "", trim($row[6]));
//	$website = strtolower($row[7]);
//	if(strlen($zip) < 5) {
//		$zip = '0'.$zip;
//	}
//	if(strlen($phone) == 10) {
//		$phone1 = substr($phone,0,3);
//		$phone2 = substr($phone,3,3);
//		$phone3 = substr($phone,6,4);
//		$phone = "($phone1) $phone2-$phone3";
//	}
//	//	 Street
//	$abbr = array(
//	'Ave'=>'Avenue',
//	'Ave.'=>'Avenue',
//	'St'=>'Street',
//	'St.'=>'Street',
//	'Rd'=>'Road',
//	'Rd.'=>'Road',
//	'Ln'=>'Lane',
//	'Ln.'=>'Lane',
//	'Hwy'=>'Highway',
//	'Hwy.'=>'Highway',
//	'Pkwy'=>'Parkway',
//	'Pkwy.'=>'Parkway',
//	'Blvd'=>'Boulevard',
//	'Blvd.'=>'Boulevard',
//	'Dr'=>'Drive',
//	'Dr.'=>'Drive',
//	'Tpk'=>'Turnpike',
//	'Tpk.'=>'Turnpike',
//	'Tpke'=>'Turnpike',
//	'Tpke.'=>'Turnpike',
//	'Rt'=>'Route',
//	'Rt.'=>'Route',
//	'Rte'=>'Route',
//	'Rte.'=>'Route',
//	'Terr'=>'Terrace',
//	'Terr.'=>'Terrace',
//	'Pl'=>'Place',
//	'Pl.'=>'Place',
//	'Cswy'=>'Causeway',
//	'Cswy.'=>'Causeway',	
//	'Ave,'=>'Avenue',
//	'Ave.,'=>'Avenue',
//	'St,'=>'Street',
//	'St.,'=>'Street',
//	'Rd,'=>'Road',
//	'Rd.,'=>'Road',
//	'Ln,'=>'Lane',
//	'Ln.,'=>'Lane',
//	'Hwy,'=>'Highway',
//	'Hwy.,'=>'Highway',
//	'Pkwy,'=>'Parkway',
//	'Pkwy.,'=>'Parkway',
//	'Blvd,'=>'Boulevard',
//	'Blvd.,'=>'Boulevard',
//	'Dr,'=>'Drive',
//	'Dr.,'=>'Drive',
//	'Tpk,'=>'Turnpike',
//	'Tpk.,'=>'Turnpike',
//	'Tpke,'=>'Turnpike',
//	'Tpke.,'=>'Turnpike',
//	'Rt,'=>'Route',
//	'Rt.,'=>'Route',
//	'Rte,'=>'Route',
//	'Rte.,'=>'Route',
//	'Terr,'=>'Terrace',
//	'Terr.,'=>'Terrace',
//	'Pl,'=>'Place',
//	'Pl.,'=>'Place',
//	'Cswy,'=>'Causeway',
//	'Cswy.,'=>'Causeway');
//	foreach($abbr as $key => $value) {
//		if(strpos($street, ' '.$key.' ') !== FALSE) {
//			$street = str_replace(' '.$key.' ', ' '.$value.' ', $street);
//		}
//	}	
//
//	// Encoding	
//	$name = iconv(mb_detect_encoding($name), "UTF-8", $name);
//	$street = iconv(mb_detect_encoding($street), "UTF-8", $street);
//	$city = iconv(mb_detect_encoding($city), "UTF-8", $city);
//
//	// Info
//	$info = "$street
//	$city, $state $zip";
//	if($website) {
//		$domain = $website;
//		if(strpos($website,'http://')!==FALSE) {
//			$domain = str_replace('http://','',$website);
//		}
//		if(strpos($website,'https://')!==FALSE) {
//			$domain = str_replace('http://','',$website);
//		}
//		$info .="
//		<a href=\"$website\" target=\"_blank\">$domain</a>";
//	}
//	if($phone) {
//		$info .="
//		$phone";
//	}
//	$address = "$street $city $state $zip";
//	
//	// Address Meta
//	if($street && $city && $state && $zip && !in_array($address,$addresses)) {
//		$addresses[] = $address;
//		$categories = array('132','133');
//		echo "<p>$count<br/>$info<br/>$address</p>";
//		$post = array('post_content'=>$info, 'post_title'=>$name, 'post_status'=>'publish', 'post_type'=>'post', 'post_category'=>$categories);  
//		$post_id = wp_insert_post($post);
//		add_post_meta($post_id, 'Location Address', $address, true);
//		add_post_meta($post_id, 'Location State', $state, true);
//		$count++;
//	
//		// Geocode Meta
////		$gapi_key = 'AIzaSyAmmJ4SrkrScT5-ZKiewvrN7cmVhDVpAcQ';
////		$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
////		$key = "&key=$gapi_key";
////		$request_url = $base_url.urlencode($address).$key;
////		usleep(200000);
////		$xml = simplexml_load_file($request_url);	
////		$status = $xml->status;
////		if($status == 'OK') {
////			$latitude = $xml->xpath('result/geometry/location/lat');
////			$location_latitude = (string)$latitude[0];
////			$longitude = $xml->xpath('result/geometry/location/lng'); 
////			$location_longitude = (string)$longitude[0];
////			add_post_meta($post_id, 'Location Latitude', $location_latitude, true);
////			add_post_meta($post_id, 'Location Longitude', $location_longitude, true);
////		}
//		// Display
//		echo "<p>ID: $post_id // NAME: $name // ADDRESS: $address // LAT: $location_latitude // LON:$location_longitude</p>";
//	}
//}
//echo "<p>$count ADDED</p>";
?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>

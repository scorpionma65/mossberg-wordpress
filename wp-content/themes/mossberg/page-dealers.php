<?php
/*
Template Name: Dealers
*/
?>
<?php get_header(); ?>
<script>
function track_zip() {
	var zip = document.getElementById('locator_zip').value;
	if(zip) {
		__gaTracker('send', 'event', 'Dealer Zip Search', 'Search', zip);
	}
}
function track_state() {
	var state = document.getElementById('locator_state').value;
	if(state) {
		__gaTracker('send', 'event', 'Dealer State Search', 'Search', state);
	}
}
</script>
<div class="content_container">

<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>

<div class="content_twelve content_full">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->

<!-- Dealers -->
<div class="dealer_filter">
<form action="<?php echo get_bloginfo('home');?>/dealers/dealer-locator" method="post" name="zip_search" id="zip_search" class="form_body">
Nearest to 
<input name="locator_zip" id="locator_zip" type="text" class="form_field" placeholder="Zip/Postal" value="<?php if(isset($_POST['locator_zip'])) { echo sanitize_text_field($_POST['locator_zip']);}?>" />
within 
<select name="locator_radius" id="locator_radius" class="form_dropdown">
<option value="10" <?php if($_POST['locator_radius'] == '10') { echo "selected=\"selected\""; }?>>10 mi</option>
<option value="20" <?php if($_POST['locator_radius'] == '20') { echo "selected=\"selected\""; }?>>20 mi</option>
<option value="50" <?php if($_POST['locator_radius'] == '50') { echo "selected=\"selected\""; }?>>50 mi</option>
<option value="100" <?php if($_POST['locator_radius'] == '100') { echo "selected=\"selected\""; }?>>100 mi</option>
</select>
<input name="go" type="submit" value="Go" class="form_button" onclick="track_zip()" />
</form>
<form action="<?php echo get_bloginfo('home');?>/dealers/" method="post" name="state_search" id="state_search" class="form_body">
Browse by State/Province 
<?php 
$states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HA'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota', 'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming','Canada'=>'--- Canada ---','AB'=>'Alberta','BC'=>'British Columbia','MB'=>'Manitoba','NB'=>'New Brunswick','NL'=>'Newfoundland','NS'=>'Nova Scotia','NT'=>'Northwest Territories','NU'=>'Nunavut',
'ON'=>'Ontario','PE'=>'Prince Edward Island','QC'=>'Quebec','SK'=>'Saskatchewan','YT'=>'Yukon');
?>
<select name="locator_state" class="form_dropdown" id="locator_state">
<option value="">-</option>
<?php 
foreach($states as $key => $value) { 
	echo "<option value=\"$key\""; 
	if($_POST['locator_state'] == $key){ 
		echo 'selected';
	} 
	echo ">$value</option>"; 
} 
?>
</select>
<input name="go" type="submit" value="Go" class="form_button" onclick="track_state()" />
</form>
<a href="<?php echo get_bloginfo('home');?>/international-distributors" class="dealer_filter_link">International Contacts &raquo;</a>
</div>

<!-- Map -->
<?php 
// API Key
$gapi_key = 'AIzaSyDMOUv5fHLXQy1vYsjYrHLM_K84RdiV-24';
$iapi_key = '2a3407c50d2dabaf1e730bc60d130a1028305f5a04ce01a74c1278ca';
// Category
$cat_slug = 'us-dealers';
// State
if(!empty($_POST['locator_state'])) {
	$state = sanitize_text_field($_POST['locator_state']);
	} else {
	$state = FALSE;
}
// Zip
if(!empty($_POST['locator_zip'])) {
	$zip = str_replace(' ','',sanitize_text_field($_POST['locator_zip']));
	if(strlen($zip) == 6) {
		$zip = implode(' ', str_split($zip,3));
	}
	if(!empty($_POST['locator_radius'])) {
		$map_radius = sanitize_text_field($_POST['locator_radius']);
		} else {
		$map_radius = 50;
	}
	} else {
	$zip = FALSE;
}

// Radius
if($map_radius) {
	switch($map_radius) {
		case '10':
		$map_zoom = 11;
		break;
		case '20':
		$map_zoom = 9;
		break;
		case '50':
		$map_zoom = 8;
		break;
		case '100':
		$map_zoom = 7;
		break;
	}
}

// Geolocate
if(!$zip && !$state) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$endpoint = "https://api.ipdata.co/$ip?api-key=$iapi_key";
	$response = file_get_contents($endpoint);
	if($response) { 
		$ipdata = json_decode($response);
		$zip = $ipdata->postal;
		$map_radius = 50;
		$map_zoom = 8;
	}
}

// Filter
$args = array('category_name'=>$cat_slug,'posts_per_page'=>36,'paged'=>$paged,'orderby'=>array('meta_value'=>'ASC','title'=>'ASC'),'meta_key'=>'Location State','order'=>'ASC');
if($zip) {
	$args = array('category_name'=>$cat_slug,'posts_per_page'=>-1);
	} else {
	if($state) {
		$args = array('category_name'=>$cat_slug,'posts_per_page'=>-1,'orderby'=>array('meta_value'=>'ASC','title'=>'ASC'),'meta_key'=>'Location State','order'=>'ASC','meta_value'=>$state);
	}
}    

// Radius
$cood = 0;
if($zip) {
	// Setup
	$map_list = array();
	$map_addresses = array();
	$location_count = 1;
	$location_radius = TRUE;
	// Geocode Center
	$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
	$address = $zip;
	$key = "&key=$gapi_key";
	$request_url = $base_url.urlencode($address).$key;
	$xml = simplexml_load_file($request_url);	
	$status = $xml->status;
	$results = $xml->error_message;
	if($status == 'OK') {
		$list = TRUE;
		$latitude = $xml->xpath('result/geometry/location/lat');
		$map_center_latitude = floatval($latitude[0]);
		$longitude = $xml->xpath('result/geometry/location/lng'); 
		$map_center_longitude = floatval($longitude[0]);
		} else {
		$list = FALSE;
		echo "<div class=\"post_text\"><h4>The zipcode entered could not be located. Please try again, or use the state filter to browse your area. ($status / $results)</h4></div>";
	}
	// Locations
	if($list) {
		$map_nearby = array();
		$paged_query = query_posts($args);
		while(have_posts()):the_post();
			$location_id = $post->ID;
			$location_title = $post->post_title;
			$location_content = wpautop($post->post_content);
			$location_address = get_post_meta($post->ID, 'Location Address', true);
			$location_state = get_post_meta($post->ID, 'Location State', true);
			$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
			$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
			// Icon
			$map_icon = get_bloginfo('template_url').'/template/icons/icon-map.png';
			if(in_category('triple-crown',$location_id)) {
				$map_icon = get_bloginfo('template_url').'/template/icons/icon-map-tc.png';
			}
			// Coordinates
			if($location_latitude != NULL && $location_longitude != NULL) {
				$location_coordinates = TRUE;
				} else {
				$location_coordinates = FALSE;
			}
			if(!$location_coordinates) {
				// Geocode
				$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
				$address = $location_address;
				$key = "&key=$gapi_key";
				$request_url = $base_url.urlencode($address).$key;
				sleep(1);
				$xml = simplexml_load_file($request_url);	
				$status = $xml->status;
				if($status == 'OK') {
					$latitude = $xml->xpath('result/geometry/location/lat');
					$location_latitude = (string)$latitude[0];
					$longitude = $xml->xpath('result/geometry/location/lng'); 
					$location_longitude = (string)$longitude[0];
					add_post_meta($location_id, 'Location Latitude', $location_latitude, true);
					add_post_meta($location_id, 'Location Longitude', $location_longitude, true);
				}
			}
			
			$location_directions = urlencode(strip_tags($location_address));
			$location_display = FALSE;
			if($location_latitude != NULL && $location_longitude != NULL) {
				// Radius
				$haversine = map_haversine($map_center_latitude, $map_center_longitude, $location_latitude, $location_longitude, 'miles');
				$location_distance = round($haversine['distance'],1);
				if($location_distance == 0) {
					$location_distance = '0.1';
				}
				$location_distance_display = NULL;
				switch($haversine['units']) {
					case 'miles':
					$location_distance_display = $location_distance.' mi';
					break;
					case 'kilomaters':
					$location_distance_display = $location_distance.' km';
					break;
					case 'meters':
					$location_distance_display = $location_distance.' m';
					break;
				}
					
				if($map_radius) {
					if($location_distance <= $map_radius) {
						$location_display = TRUE;
						} else {
						$location_display = FALSE;
					}
					} else {
					$location_display = TRUE;
				}	
			}
			if($location_display) {		
				$map_nearby[$location_distance] = "$location_distance_display{}$location_title<>$location_address<>$location_content<>$map_icon**$location_latitude,$location_longitude";	
			}
		endwhile;	
		// Display
		if(count($map_nearby) != 0) {
			ksort($map_nearby);
			$map_list = NULL;
			foreach($map_nearby as $key => $value) {
				$x1 = explode('{}',$value);
				$location_distance = $x1[0];
				$x2 = explode('**',end($x1));
				$x3 = explode('<>',$x2[0]);
				$location_coordinates = end($x2);
				$location_title = $x3[0];
				$location_address = $x3[1];
				$location_content = $x3[2];
				$location_directions = urlencode(strip_tags($location_address));
				$map_addresses[] = "$location_title<>$location_address<>$location_content<>$location_directions<>$map_icon**$location_coordinates";
								
				$map_list .= "<div class=\"location_block\">
				<div class=\"location_title\"><div class=\"location_state\">$location_distance</div>$location_title</div>
				<div class=\"location_text\">
				$location_content<a href=\"https://maps.google.com/maps?q=$location_directions\" target=\"_blank\">Map &amp; Directions &raquo;</a>
				</div>
				</div>";
			}
			// Map Addresses
			$map_center = "$map_center_latitude,$map_center_longitude";
			$map_addresses = htmlentities(implode('||',$map_addresses));
			echo "<div class=\"map_container\">";
			include(TEMPLATEPATH.'/inc/inc-map-dealers.php');
			echo "</div>";
			// Map List
			echo "<div class=\"location_container\">
			$map_list
			</div>";
			} else {
			echo "<div class=\"post_text\"><h4>No dealers are available within $map_radius miles of $zip. Please try expanding your search.</h4></div>";
		}
	}
	} else {
	// State
	if($state) {
		$paged_query = query_posts($args);
		while(have_posts()):the_post();
			$location_id = $post->ID;
			$location_title = htmlentities($post->post_title,ENT_QUOTES);
			$location_content = htmlentities(wpautop($post->post_content),ENT_QUOTES);
			$location_address = htmlentities(get_post_meta($post->ID, 'Location Address', true),ENT_QUOTES);
			$location_state = get_post_meta($post->ID, 'Location State', true);
			$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
			$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
			$location_directions = urlencode(strip_tags($location_address));
			// Icon
			$map_icon = get_bloginfo('template_url').'/template/icons/icon-map.png';
			if(in_category('triple-crown',$location_id)) {
				$map_icon = get_bloginfo('template_url').'/template/icons/icon-map-tc.png';
			}
			// Coordinates
			if($location_latitude != NULL && $location_longitude != NULL) {
				$location_coordinates = TRUE;
				} else {
				$location_coordinates = FALSE;
			}
			if(!$location_coordinates) {
				// Geocode
				$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
				$address = $location_address;
				$key = "&key=$gapi_key";
				$request_url = $base_url.urlencode($address).$key;
				sleep(1);
				$xml = simplexml_load_file($request_url);	
				$status = $xml->status;
				if($status == 'OK') {
					$latitude = $xml->xpath('result/geometry/location/lat');
					$location_latitude = (string)$latitude[0];
					$longitude = $xml->xpath('result/geometry/location/lng'); 
					$location_longitude = (string)$longitude[0];
					add_post_meta($location_id, 'Location Latitude', $location_latitude, true);
					add_post_meta($location_id, 'Location Longitude', $location_longitude, true);
				}
			}			
			// Map
			if($location_latitude != NULL && $location_longitude != NULL) {
				$map_center = "$location_latitude,$location_longitude";
				$map_addresses[] = "$location_title<>$location_address<>$location_content<>$location_directions<>$map_icon**$location_latitude,$location_longitude";
			}
		endwhile;
		if(have_posts()) {
			// Map Addresses
			$map_addresses = implode('||',$map_addresses);
			echo "<div class=\"map_container\">";
			include(TEMPLATEPATH.'/inc/inc-map-dealers.php');
			echo "</div>";
			} else {
			echo "<div class=\"post_text\"><h4>No dealers are available in $state. Please try expanding your search.</h4></div>";
		}
	}
	// List
	echo "<div class=\"map_key\"></div>";
	//echo "<div class=\"map_key\"><img src=\"".get_bloginfo('template_url')."/template/icons/icon-map.png\"/>Mossberg Dealer &nbsp;&nbsp; <img src=\"".get_bloginfo('template_url')."/template/icons/icon-map-tc.png\"/>Mossberg Triple Crown&reg; Stocking Dealer</div>";
	echo "<div class=\"location_container\">";
	$paged_query = query_posts($args);
	while(have_posts()):the_post();
		$location_title = $post->post_title;
		$location_content = wpautop($post->post_content);
		$location_address = get_post_meta($post->ID, 'Location Address', true);
		$location_state = get_post_meta($post->ID, 'Location State', true);
		$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
		$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
		$location_directions = urlencode(strip_tags($location_address));
		$map_icon = "<img src=\"".get_bloginfo('template_url')."/template/icons/icon-map.png\" class=\"location_icon\" alt=\"Mossberg Dealer\"/>";
		if(in_category('triple-crown',$post->ID)) {
			$map_icon = "<img src=\"".get_bloginfo('template_url')."/template/icons/icon-map-tc.png\" class=\"location_icon\" alt=\"Mossberg Triple Crown&reg; Stocking Dealer\"/>";
		}
		// Display
		echo "<div class=\"location_block\">
		<div class=\"location_title\"><div class=\"location_state\">$location_state</div>$location_title</div>
		<div class=\"location_text\">
		$location_content<a href=\"https://maps.google.com/maps?q=$location_directions\" target=\"_blank\">Map &amp; Directions &raquo;</a>
		$map_icon
		</div>
		</div>";
	endwhile;
	echo "</div>";
}
?>
<div class="dealer_paginate">
<?php 
// Pagination
$big = 999999999; 
$args = array(
	'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'prev_next' => TRUE,
	'prev_text' => __('« Previous'),
	'next_text' => __('Next »')
); 
echo paginate_links($args);
?>
</div>
<!-- Dealers -->
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

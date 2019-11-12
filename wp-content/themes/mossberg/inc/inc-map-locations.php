<?php
// Get Map
$map_addresses = NULL;
$map_prev = NULL;

$args = array('category_name'=>$cat_slug,'showposts'=>-1,'orderby'=>'ASC');
query_posts($args);
while (have_posts()): the_post(); 
	$location_id = $post->ID;
	$location_title = $post->post_title;
	$location_content = wpautop($post->post_content);
	$location_address = get_post_meta($post->ID, 'Location Address', true);
	$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
	$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
	
	if(!$location_latitude || !$location_longitude) {
		
		// Geocode
		$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
		$address = $location_address;
		$sensor = "&sensor=false";
		$key = "&key=AIzaSyAmmJ4SrkrScT5-ZKiewvrN7cmVhDVpAcQ";
		$request_url = $base_url.urlencode($address).$sensor.$key;
		$xml = simplexml_load_file($request_url);	
		$status = $xml->status;
		if($status == 'OK') {
			$latitude = $xml->xpath('result/geometry/location/lat');
			$location_latitude = (float)$latitude[0];
			$longitude = $xml->xpath('result/geometry/location/lng'); 
			$location_longitude = (float)$longitude[0];
			add_post_meta($location_id, 'Location Latitude', $location_latitude, true);
			add_post_meta($location_id, 'Location Longitude', $location_longitude, true);
			} else {
			echo "<div style=\"visibility: hidden;\">$location_address / $status</div>";
		}
	}
	
	$location_directions = urlencode(strip_tags($location_address));
	$map_addresses = "$location_title<>$location_content<><><>$location_directions**$location_latitude,$location_longitude||$map_addresses";
endwhile;

// Map Addresses
$map_addresses = htmlentities(substr($map_addresses,0,-2));
?>
<?php 
// Map
$map_icon = get_bloginfo('template_url').'/template/icons/icon-map.png';
if(!$map_center) { 
	$map_center = "39.00, -93.00";
}
if(!$map_zoom) { 
	$map_zoom = '4';
}
?>
<script type="text/javascript" async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmmJ4SrkrScT5-ZKiewvrN7cmVhDVpAcQ&sensor=true"></script> 
<script type="text/javascript">
var map;
var infowindow;
function initialize() {
	var address_list = document.getElementById('map_address').value;
	var address_array = address_list.split('||'); 

	var center = new google.maps.LatLng(<?php echo $map_center;?>);
	var myOptions = {
		zoom: <?php echo $map_zoom;?>,
		center: center,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	for(var i=0; i<address_array.length; i++){ 
		var location_array = address_array[i].split('**');
		var info_array = location_array[0].split('<>');
		var name = info_array[0];
		var address = info_array[1];
		var phone = info_array[2];
		var website = info_array[3];
		var directions = info_array[4];
		var latlon_array = location_array[1].split(',');
		var lat = latlon_array[0];
		var lon = latlon_array[1];
		var location = new google.maps.LatLng(lat,lon);
		var marker = new google.maps.Marker({
			map: map, 
			position: location, 
			title: name, 
			icon: '<?php echo $map_icon;?>', 
			html: '<div id="content" class="map_info"><p><span class="map_info_title">'+ name +'</span>'+ address +'<a href="https://maps.google.com/maps?q='+ directions +'" target="_blank">Driving Directions &raquo</a></p></div>'
			
		});	
				
		var contentString = '<div id="content" class="map_info"><p><span class="map_info_title">'+ name +'</span>'+ address +'<a href="https://maps.google.com/maps?q='+ directions +'" target="_blank">Driving Directions &raquo</a></div>';  
	
		var infowindow = new google.maps.InfoWindow({ content: contentString });

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(this.html); 
			infowindow.open(map,this);
		});
	}
}
</script>
<script type="text/javascript" language="javascript">window.onload=initialize</script>
<input name="map_address" id="map_address" type="hidden" value="<?php echo $map_addresses;?>" />
<div class="map" id="map_canvas"></div>
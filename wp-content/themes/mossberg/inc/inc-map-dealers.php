<?php 
// Map
if(!$map_zoom) { 
	$map_zoom = '5';
}
?>
<script type="text/javascript" async src="https://maps.googleapis.com/maps/api/js?key=<?php echo $gapi_key;?>"></script> 
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
		var content = info_array[2];
		var directions = info_array[3];
		var map_icon = info_array[4];
		var latlon_array = location_array[1].split(',');
		var lat = latlon_array[0];
		var lon = latlon_array[1];
		var location = new google.maps.LatLng(lat,lon);
		var marker = new google.maps.Marker({
			map: map, 
			position: location, 
			title: name, 
			icon: map_icon, 
			html: '<div id="content" class="map_info"><p><span class="map_info_title">'+ name +'</span>'+ content +'<a href="https://maps.google.com/maps?q='+ directions +'" target="_blank">Driving Directions &raquo</a></p></div>'
			
		});	
				
		var contentString = '<div id="content" class="map_info"><p><span class="map_info_title">'+ name +'</span>'+ content +'<a href="https://maps.google.com/maps?q='+ directions +'" target="_blank">Driving Directions &raquo</a></div>';  
	
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
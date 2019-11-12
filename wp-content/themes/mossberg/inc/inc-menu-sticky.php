<script>
jQuery(document).ready( function () {
	var series_open = document.getElementById('<?php echo $series_open_id;?>');
	var series_link = document.getElementById('<?php echo $series_link_id;?>');
	if(series_link) {
		series_link.className="sidebar_menu_link_active";
	}
	var lev1 = jQuery("#<?php echo $series_open_id;?>").parent("div").attr("id");
	var lev1_id = "#"+lev1;
	var lev2 = jQuery(lev1_id).parent("div").attr("id");
	var lev2_id = "#"+lev2;
	var lev3 = jQuery(lev2_id).parent("div").attr("id");
	var lev3_id = "#"+lev3;
	var lev4 = jQuery(lev3_id).parent("div").attr("id");
	var lev4_id = "#"+lev4;
	if(document.getElementById(lev1)) {
		document.getElementById(lev1).style.display='block';
	}
	if(document.getElementById(lev2)) {
		document.getElementById(lev2).style.display='block';
	}
	if(document.getElementById(lev3)) {
		document.getElementById(lev3).style.display='block';
	}	
	if(document.getElementById(lev4)) {
		document.getElementById(lev4).style.display='block';
	}	
});
</script>

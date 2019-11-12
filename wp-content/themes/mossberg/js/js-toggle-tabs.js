function toggle_tabs(element){
	// Clear Content
	document.getElementById('overview').style.display = 'none';
	document.getElementById('models').style.display = 'none';
	document.getElementById('extras').style.display = 'none';
	document.getElementById('support').style.display = 'none';
	document.getElementById('parts').style.display = 'none';	
	
	// Clear Tabs
	document.getElementById('overview_tab').className = 'series_menu_tab';
	document.getElementById('models_tab').className = 'series_menu_tab';
	document.getElementById('extras_tab').className = 'series_menu_tab';
	document.getElementById('support_tab').className = 'series_menu_tab';
	document.getElementById('parts_tab').className = 'series_menu_tab';
	
	// Activate Tab
	document.getElementById(element+'_tab').className = 'series_menu_tab_active';
	
	// Fade Content	
	jQuery('#'+element).fadeIn("fast", function() {	});
}

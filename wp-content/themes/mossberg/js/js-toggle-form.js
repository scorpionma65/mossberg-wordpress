function toggle_form(element){
	if(document.getElementById(element).classList.contains('tab_form_container_open')) {
		document.getElementById(element).className = 'tab_form_container tab_form_container_close';
		document.getElementById('tab_tab').className = 'tab_form_tab tab_form_tab_open';
		} else {
		document.getElementById(element).className = 'tab_form_container tab_form_container_open';
		document.getElementById('tab_tab').className = 'tab_form_tab tab_form_tab_close';
	}
}

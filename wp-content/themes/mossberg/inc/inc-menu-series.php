<?php
// Referrer
$referrer = $_SERVER['HTTP_REFERER'];
if(strpos($referrer,'product/') !== FALSE) {
	$active_tab = 'm';
}

// Active Tab
$active_tab = 'o';
if(!empty($_GET['tab'])) {
	$active_tab = strtolower(sanitize_text_field($_GET['tab']));
}
function activate_tab($active, $tab) {
	if($active == $tab) {
		echo "series_menu_tab_active";
		} else {
		echo "series_menu_tab";
	}
}
function activate_content($active, $tab) {
	if($active == $tab) {
		echo "block";
		} else {
		echo "none";
	}
}
?>
<div class="series_menu">
<div class="<?php activate_tab($active_tab, 'o');?>" id="overview_tab" onclick="toggle_tabs('overview')">OVERVIEW</div>
<div class="<?php activate_tab($active_tab, 'm');?>" id="models_tab" onclick="toggle_tabs('models')">MODELS</div>
<div class="<?php activate_tab($active_tab, 'e');?>" id="extras_tab" onclick="toggle_tabs('extras')">EXTRAS</div>
<div class="<?php activate_tab($active_tab, 's');?>" id="support_tab" onclick="toggle_tabs('support')">SUPPORT</div>
<div class="<?php activate_tab($active_tab, 'p');?>" id="parts_tab" onclick="toggle_tabs('parts')">PARTS</div>
</div>

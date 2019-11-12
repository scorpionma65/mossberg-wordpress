<?php
$terms = get_terms('schematic-model', array('hide_empty'=>false,));
if($terms) {
	echo "<div class=\"sidebar_menu_type\">SCHEMATICS</div>
	<div class=\"sidebar_menu_subtypes\">
	<div class=\"sidebar_menu_links\">";
	
	foreach($terms as $key => $value) {
		$schematic_title = $value->name;
		$schematic_image = trim($value->description);
		$schematic_slug = $value->slug;
		$schematic_parent = $value->parent;
		$schematic_link = get_bloginfo('home').'/schematic?model='.$schematic_slug;
		if($schematic_parent && strpos($schematic_title, 'COMING SOON') === FALSE) {
			// Schematics
			echo "<a href=\"$schematic_link\">$schematic_title</a>";	
		}
	}
	echo "</div>
	</div>";
}
?>
<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Menus
*/
?>
<?php 
get_header(); 
ini_set('display_errors', '1');
ini_set('max_execution_time', 100000);
ini_set('memory_limit','1024M');
?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>


<div class="content_container">
<div class="content">
<div class="content_three content_left content_sidebar">
<?php
############## FIREARMS
// Menu
$menu = NULL;

// Types
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>23,'hide_empty'=>1);
$types = get_categories($args);
foreach($types as $type) {
	$type_id = $type->term_id;
	$type_name = strtoupper($type->name);
	$type_slug = $type->slug;
	$type_display = 'none';
	$menu .= "<div id=\"type{$type_id}\" class=\"sidebar_menu_type\" onclick=\"toggle_slide('category{$type_id}')\">$type_name</div>
	<div id=\"category{$type_id}\" class=\"sidebar_menu_subtypes\" style=\"display:$type_display;\">";

	$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'child_of'=>$type_id,'hide_empty'=>1);
	$subtypes = get_categories($args);
	// Subtypes
	if(!empty($subtypes)) {
		foreach($subtypes as $subtype) {
			$subtype_id = $subtype->term_id;
			$subtype_name = strtoupper($subtype->name);
			$subtype_slug = $subtype->slug;
			$subtype_display = 'none';
			$menu .= "<div id=\"type{$type_id}-{$subtype_id}\" class=\"sidebar_menu_subtype\" onclick=\"toggle_slide('category{$type_id}-{$subtype_id}')\">$subtype_name</div>
			<div id=\"category{$type_id}-{$subtype_id}\" class=\"sidebar_menu_subtypes\" style=\"display:$subtype_display;\">";
			// Actions
			$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>122,'hide_empty'=>1);
			$actions = get_categories($args);
			foreach($actions as $action) {
				$action_id = $action->term_id;
				$action_name = strtoupper($action->name);
				$action_slug = $action->slug;
				$action_display = 'none';
				$type_action = series_in_category($subtype_slug,$action_slug);
				if($type_action == 1) {
					$menu .= "<div id=\"type{$type_id}-{$subtype_id}-{$action_id}\" class=\"sidebar_menu_subtype\" onclick=\"toggle_slide('category{$type_id}-{$subtype_id}-{$action_id}')\">$action_name</div>
					<div id=\"category{$type_id}-{$subtype_id}-{$action_id}\" class=\"sidebar_menu_links\" style=\"display:$action_display;\">";
					
					// Series
					$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>80,'hide_empty'=>1);
					$serieses = get_categories($args);
					foreach($serieses as $series) {
						$series_id = $series->term_id;
						$series_name = $series->name;
						$series_slug = $series->slug;				
						$series_link = get_term_link($series_slug, 'product_cat');
						$series_parent = $series->parent;
						$link_class = NULL;
						if($current_slug == $series_slug) {
							$link_class = "sidebar_menu_link_active";
						}
						if($series_id != 108 && $series_parent != 108) {
							$action_series = series_in_category($action_slug,$series_slug);
							$type_series = series_in_category($subtype_slug,$series_slug);
							if($action_series == 1 && $type_series == 1) {
								$menu .= "<a id=\"series{$series_id}\" href=\"$series_link\" class=\"$link_class\">$series_name</a>";
								// Subseries
								$subserieses = get_term_children($series_id, 'product_cat');
								foreach($subserieses as $subseries_id) {
									$subseries = get_term_by('id', $subseries_id, 'product_cat');
									$subseries_name = $subseries->name;
									$subseries_slug = $subseries->slug;
									$subseries_link = get_term_link($subseries_slug, 'product_cat');
									$series_parent = $series->parent;
									$link_class = NULL;
									if($current_slug == $subseries_slug) {
										$link_class = "sidebar_menu_link_active";
									}
									$menu .= "<a id=\"subseries{$subseries_id}\" href=\"$subseries_link\" class=\"$link_class\">&raquo; $subseries_name</a>";
								}
							}
						}						
					}			
					$menu .= "</div>";
				}
			}	
			$menu .= "</div>";		
		}
		} else {
		// Actions
		$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>122,'hide_empty'=>1);
		$actions = get_categories($args);
		foreach($actions as $action) {
			$action_id = $action->term_id;
			$action_name = strtoupper($action->name);
			$action_slug = $action->slug;
			$action_display = 'none';
			$type_action = series_in_category($type_slug,$action_slug);
			if($type_action == 1) {
				$menu .= "<div id=\"type{$type_id}-{$action_id}\" class=\"sidebar_menu_subtype\" onclick=\"toggle_slide('category{$type_id}-{$action_id}')\">$action_name</div>
				<div id=\"category{$type_id}-{$action_id}\" class=\"sidebar_menu_links\" style=\"display:$action_display;\">";
				
				// Series
				$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>80,'hide_empty'=>1);
				$serieses = get_categories($args);
				foreach($serieses as $series) {
					$series_id = $series->term_id;
					$series_name = $series->name;
					$series_slug = $series->slug;				
					$series_link = get_term_link($series_slug, 'product_cat');
					$series_parent = $series->parent;
					$link_class = NULL;
					if($current_slug == $series_slug) {
						$link_class = "sidebar_menu_link_active";
					}
					if($series_id != 108 && $series_parent != 108) {
						$action_series = series_in_category($action_slug,$series_slug);
						$type_series = series_in_category($type_slug,$series_slug);
						if($action_series == 1 && $type_series == 1) {
							$menu .= "<a href=\"$series_link\" id=\"series{$series_id}\" class=\"$link_class\">$series_name</a>";
							// Subseries
							$subserieses = get_term_children($series_id, 'product_cat');
							foreach($subserieses as $subseries_id) {
								$subseries = get_term_by('id', $subseries_id, 'product_cat');
								$subseries_name = $subseries->name;
								$subseries_slug = $subseries->slug;
								$subseries_link = get_term_link($subseries_slug, 'product_cat');
								$series_parent = $series->parent;
								$link_class = NULL;
								if($current_slug == $subseries_slug) {
									$link_class = "sidebar_menu_link_active";
								}
								$menu .= "<a href=\"$subseries_link\" id=\"series{$series_id}\" class=\"$link_class\">&raquo; $subseries_name</a>";
							}
						}
					}
				}			
				$menu .= "</div>";
			}
		}
	}
	$menu .= "</div>";	
}

//// Series
//$category_id = 108;
//$category = get_term($category_id,'product_cat');
//$category_id = $category->term_id;
//$category_name = strtoupper($category->name);
//$category_slug = $category->slug;
//$category_display = 'none';
//if(term_is_ancestor_of($category_id,$current_term,'product_cat')) {
//	$category_display = 'block';
//}
//$menu .= "<div id=\"type{$category_id}\" class=\"sidebar_menu_type\" onclick=\"toggle_slide('category{$category_id}')\">$category_name</div>
//<div id=\"category{$category_id}\" class=\"sidebar_menu_subtypes\" style=\"display:$category_display;\">
//<div id=\"special{$category_id}\" class=\"sidebar_menu_links\">";
//$subargs = array('taxonomy'=>'product_cat','hierarchical'=>1,'child_of'=>108,'hide_empty'=>1);
//$subcategories = get_categories($subargs);
//foreach($subcategories as $subcategory) {
//	$subcategory_id = $subcategory->term_id;
//	$subcategory_name = $subcategory->name;
//	$subcategory_slug = $subcategory->slug;	
//	$subcategory_link = get_term_link($subcategory_slug, 'product_cat');
//	$subcategory_parent = $subcategory->parent;
//	$link_class = NULL;
//	if($current_slug == $subcategory_slug) {
//		$link_class = "sidebar_menu_link_active\"";
//	}
//	$menu .= "<a href=\"$subcategory_link\" id=\"series{$subcategory_id}\" class=\"$link_class\">$subcategory_name</a>";
//}
//$menu .= "</div>
//</div>";

// Applications
$category_id = 959;
$category = get_term($category_id,'product_cat');
$category_id = $category->term_id;
$category_name = strtoupper($category->name);
$category_slug = $category->slug;
$category_display = 'none';
if(term_is_ancestor_of($category_id,$current_id,'product_cat')) {
	$category_display = 'block';
}
$menu .= "<div id=\"type{$category_id}\" class=\"sidebar_menu_type\" onclick=\"toggle_slide('category{$category_id}')\">$category_name</div>
<div id=\"category{$category_id}\" class=\"sidebar_menu_subtypes\" style=\"display:$category_display;\">
<div id=\"special{$category_id}\" class=\"sidebar_menu_links\">";
$subargs = array('taxonomy'=>'product_cat','hierarchical'=>1,'child_of'=>$category_id,'hide_empty'=>0);
$subcategories = get_categories($subargs);
foreach($subcategories as $subcategory) {
	$subcategory_id = $subcategory->term_id;
	$subcategory_name = $subcategory->name;
	$subcategory_slug = $subcategory->slug;	
	$subcategory_link = get_term_link($subcategory_slug, 'product_cat');
	$subcategory_parent = $subcategory->parent;
	$link_class = NULL;
	if($current_slug == $subcategory_slug) {
		$link_class = "sidebar_menu_link_active\"";
	}
	$menu .= "<a href=\"$subcategory_link\" id=\"series{$subcategory_id}\" class=\"$link_class\">$subcategory_name</a>";
}
$menu .= "</div>
</div>";
?>
<!-- Firearms Menu -->
<?php 
echo $menu;
$file = get_theme_root().'/mossberg/inc/inc-menu-firearms.php';
if($file) {
	file_put_contents($file, $menu);
}
?>
<!-- Firearms Menu -->

<?php
############## LAW ENFORCEMENT
// Menu
$menu = NULL;

// Firearms Home
$landing_url = get_permalink(get_page_by_path('firearms'));
// Category
$category_id = 96;
$category = get_term($category_id,'product_cat');
$category_id = $category->term_id;
$category_name = strtoupper($category->name);
$category_slug = $category->slug;

// Law Enforcement
$menu .= "<div class=\"sidebar_menu_type\" onclick=\"toggle_slide('le-nav')\">$category_name</div>
<div id=\"le-nav\" class=\"sidebar_menu_subtypes\">
<div class=\"sidebar_menu_links\">";

$le_menu_name = 'law-enforcement';
$le_menu_locations = get_nav_menu_locations();
$le_menu = wp_get_nav_menu_object($le_menu_locations[$le_menu_name]);
$le_menu_items = wp_get_nav_menu_items($le_menu->term_id);
foreach((array) $le_menu_items as $key => $le_menu_item) {
    $le_menu_title = $le_menu_item->title;
	$le_menu_link = $le_menu_item->url;
	$menu .= "<a href=\"$le_menu_link\" >$le_menu_title</a>";
}
$menu .= "</div>
</div>";

// Firearms
$menu .= "<div class=\"sidebar_menu_type\" onclick=\"toggle_slide('type{$category_id}')\">FIREARMS</div>
<div id=\"type{$category_id}\" class=\"sidebar_menu_subtypes\">";

// Types
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>23,'hide_empty'=>1);
$types = get_categories($args);
foreach($types as $type) {
	$type_id = $type->term_id;
	$type_name = strtoupper($type->name);
	$type_slug = $type->slug;
	
	$le_types = series_in_category($category_slug,$type_slug);
	if($le_types == 1) {
		$menu .= "<div class=\"sidebar_menu_subtype\" onclick=\"toggle_slide('category{$type_id}')\">$type_name</div>
		<div id=\"category{$type_id}\" class=\"sidebar_menu_subtypes\" style=\"display:block;\">
		<div class=\"sidebar_menu_links\">";
	
		// Series
		$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'child_of'=>80,'hide_empty'=>1);
		$serieses = get_categories($args);
		foreach($serieses as $series) {
			$series_id = $series->term_id;
			$series_name = $series->name;
			$series_slug = $series->slug;				
			$series_link = get_term_link($series_slug, 'product_cat')."/?le=1/";
			$series_parent = $series->parent;
			$link_class = NULL;
			if($current_slug == $series_slug) {
				$link_class = "sidebar_menu_link_active";
			}
			if($series_id != 108 && $series_parent != 108) {
				$series_children = get_term_children($series_id,'product_cat');
				if(count($series_children) == 0) {
					$type_series = series_in_category($type_slug,$series_slug);
					$le_series = series_in_category($category_slug,$series_slug);
					if($le_series == 1 && $type_series == 1) {					
						$menu .= "<a href=\"$series_link\" id=\"series{$series_id}\" class=\"$link_class\">$series_name</a>";
					}
				}
			}		
		}			
		$menu .= "</div>
		</div>";
	}
}
$menu .= "</div>";
?>
<!-- LE Menu -->
<?php 
echo $menu;
$file = get_theme_root().'/mossberg/inc/inc-menu-firearms-le.php';
if($file) {
	file_put_contents($file, $menu);
}
?>
<!-- LE Menu -->
</div>
<div class="content_nine content_right">
</div>
</div>
</div>

<?php get_footer(); ?>

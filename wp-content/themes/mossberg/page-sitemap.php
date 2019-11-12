<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
<div class="content_six content_left">
<div class="container_sitemap">
<!-- Sitemap -->
<?php
$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'parent' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
); 
$pages = get_pages($args);
if($pages) {
	foreach($pages as $page) {
		$page_id = $page->ID;
		$page_title = $page->post_title;
		$page_order = $page->menu_order;
		$page_link = get_permalink($page_id);
		if($page_order < 10000) {
			echo "<h3><a href=\"$page_link\">$page_title</a></h3>";
			$args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'page_title',
				'child_of' => $page_id,
				'post_type' => 'page',
				'post_status' => 'publish'
			);
			$subpages = get_pages($args);
			if($subpages) {
				echo "<p>";
				foreach($subpages as $page) {
					$page_id = $page->ID;
					$page_title = $page->post_title;
					$page_link = get_permalink($page_id);
					echo "<a href=\"$page_link\">$page_title</a><br/>";
				}
				echo "</p>";
			}
		}
	}
}
?>
<!-- Sitemap -->
</div>
</div>
<div class="content_six content_right">
<div class="container_sitemap">
<!-- Catalog -->
<?php
$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>23,'hide_empty'=>0);
$types = get_categories($args);
foreach($types as $type) {
	$type_id = $type->term_id;
	$type_name = $type->name;	
	$type_slug = $type->slug;
	echo "<h3><a href=\"".get_bloginfo('home')."/firearms/$type_slug/\">$type_name</a><br/></h3>";
	// Series
	$args = array('taxonomy'=>'product_cat','hierarchical'=>1,'parent'=>80,'hide_empty'=>0);
	$serieses = get_categories($args);
	foreach($serieses as $series) {
		$series_id = $series->term_id;
		$series_name = $series->name;
		$series_slug = $series->slug;				
		$series_link = get_term_link($series_slug, 'product_cat');
		$series_parent = $series->parent;
		if($series_id != 108 && $series_parent != 108) {
			$type_series = series_in_category($type_slug,$series_slug);
			if($type_series == 1) {
				echo "<a href=\"$series_link\">$series_name</a><br/>";
				// Subseries
				$subserieses = get_term_children($series_id, 'product_cat');
				foreach($subserieses as $subseries_id) {
					$subseries = get_term_by('id', $subseries_id, 'product_cat');
					$subseries_name = $subseries->name;
					$subseries_slug = $subseries->slug;
					$subseries_link = get_term_link($subseries_slug, 'product_cat');
					$series_parent = $series->parent;
					echo "<a href=\"$subseries_link\">$subseries_name</a><br/>";
				}
			}
		}						
	}
}
?>
<!-- Catalog -->
</div>
</div>

</div>
</div>

<?php get_footer(); ?>

<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Sitemap
*/
?>
<?php 
get_header(); 
ini_set('display_errors', '1');
ini_set('max_execution_time', 300);
?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>


<div class="content_container">
<div class="content">
<div class="content_twelve content_full">
<?php 
$sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
";
?>
<!-- Pages -->
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
$sitemap .= "<url>
<loc>$page_link</loc>
</url>
";
			$args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'page_title',
				'child_of' => $page_id,
				'post_type' => 'page',
				'post_status' => 'publish'
			);
			$subpages = get_pages($args);
			if($subpages) {
				foreach($subpages as $page) {
					$page_id = $page->ID;
					$page_title = $page->post_title;
					$page_link = get_permalink($page_id);
$sitemap .= "<url>
<loc>$page_link</loc>
</url>
";
				}
			}
		}
	}
}
?>
<!-- Pages -->
<!-- Catalog -->
<?php
// Series
$args = array('taxonomy'=>'product_cat','numberposts'=>-1,'hierarchical'=>1,'parent'=>80,'hide_empty'=>0);
$serieses = get_categories($args);
foreach($serieses as $series) {
	$series_id = $series->term_id;
	$series_name = $series->name;
	$series_slug = $series->slug;				
	$series_link = get_term_link($series_slug, 'product_cat');
	$series_parent = $series->parent;
$sitemap .= "<url>
<loc>$series_link</loc>
</url>
";
	// Subseries
	$subserieses = get_term_children($series_id, 'product_cat');
	foreach($subserieses as $subseries_id) {
		$subseries = get_term_by('id', $subseries_id, 'product_cat');
		$subseries_name = $subseries->name;
		$subseries_slug = $subseries->slug;
		$subseries_link = get_term_link($subseries_slug, 'product_cat');
		$series_parent = $series->parent;
$sitemap .= "<url>
<loc>$subseries_link</loc>
</url>
";
	}
}
?>
<!-- Catalog -->
<!-- Products -->
<?php
$args = array('post_type'=>'product','numberposts'=>-1,'orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
query_posts($args);
while(have_posts()):the_post();
	$product_id = get_the_ID();
	$product_title = get_the_title();
	$product_description = get_the_content();
	$product_link = get_the_permalink();
$sitemap .= "<url>
<loc>$product_link</loc>
</url>
";
endwhile;
?>    
<!-- Products -->
<?php 
$sitemap .= "</urlset>";
?>
<?php 
$sitemap_link = get_bloginfo('stylesheet_directory').'/sitemap.xml';
echo "<a href=\"$sitemap_link\" target=\"_blank\">XML Sitemap &raquo;</a>";
$file = '/var/www/html/wp-content/themes/mossberg/sitemap.xml';
file_put_contents($file, $sitemap);
?>
</div>
</div>
</div>

<?php get_footer(); ?>

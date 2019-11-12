<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Build Algolia
*/
?>
<?php 
get_header(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 100000);
ini_set('memory_limit','1024M');
$client = new \AlgoliaSearch\Client("G1S210VCE5", "35c54c541493abd21b667cf9fb504385");
$index = $client->initIndex('wp_searchable_posts');
?>

<div class="content_container">
<div class="content">
<div class="content_three content_left content_sidebar">
</div>
<div class="content_nine content_right">

<?php
// Reindex 
$reindex = TRUE;

// Clear Index
if($reindex) {
	$index->clearIndex();
}

// Pages
echo "<h1>PAGES</h1>";
$args = array(
	'sort_order' => 'asc',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'meta_key' => 'algolia_index',
	'meta_value' => '1',
	'child_of' => 0,
	'parent' => -1,
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
); 
$pages = get_pages($args);
foreach($pages as $post) {
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_slug = $post->post_name;
	$post_description = strip_tags(wpautop($post->post_content));
	$post_url = get_the_permalink($page_id);	
	// Add Index
	//$meta = add_post_meta($post_id, 'algolia_index', '1', true); 
	// Index
	if($reindex) {
		// Add
		$index->addObject(
		  [
			'type'=>'Page',
			'post_title'=>$post_title,
			'slug'=>$post_slug,
			'content'=>$post_description,
			'permalink'=>$post_url		
		  ]
		);
	}
	// Display
	echo "<p>$post_title<br/>$post_url</p>";		
}
// Series
echo "<h1>Series</h1>";
$args = array('taxonomy'=>'product_cat','hide_empty'=>1);
$serieses = get_categories($args);
foreach($serieses as $post) {
	$post_id = $post->term_id;
	$post_title = $post->name;
	$post_slug = $post->slug;
	$post_description = strip_tags(wpautop($post->description));				
	$post_url = get_term_link($post_slug, 'product_cat');
	$post_parent = $post->parent;
	if($post_parent != 0 && strpos($post_url,'/series/') !== FALSE) {	
		// Index
		if($reindex) {
			// Add
			$index->addObject(
			  [
				'type'=>'Series',
				'post_title'=>$post_title,
				'slug'=>$post_slug,
				'content'=>$post_description,
				'permalink'=>$post_url		
			  ]
			);
		}
		// Display
		echo "<p>$post_title<br/>$post_url</p>";		
	}
}
// Firearms
echo "<h1>Firearms</h1>";
$args = array(
	'order' => 'asc',
	'orderby' => 'post_title',
	'posts_per_page' => '-1',
	//'meta_key' => 'algolia_index',
	//'meta_value' => '1',
	'post_type' => 'product',
	'post_status' => 'publish'
); 
$products = get_posts($args);
foreach($products as $post) {
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_slug = $post->post_name;
	$post_url = get_the_permalink($post_id);
	$product_sku = get_post_meta($post_id, '_sku', true);
	$product_caliber = get_post_meta($post_id, 'wpcf-caliber', true);
	$product_gauge = get_post_meta($post_id, 'wpcf-gauge', true);
	$product_capacity = get_post_meta($post_id, 'wpcf-capacity', true);
	if($product_gauge) {
		$post_description = "$post_title | $product_gauge Gauge $product_capacity Shot - SKU $product_sku";
		} else {
		if($product_caliber) {
			$post_description = "$post_title | $product_caliber - SKU $product_sku";
		}
	}
	// Add Index
	$meta = add_post_meta($post_id, 'algolia_index', '1', true); 
	// Index
	if($reindex) {
		// Add
		$index->addObject(
		  [
			'type'=>'Firearm',
			'post_title'=>$post_title,
			'slug'=>$post_slug,
			'content'=>$post_description,
			'permalink'=>$post_url		
		  ]
		);
	}
	// Display
	echo "<p>$post_title<br/>$post_url</p>";		
}
// Blog
echo "<h1>BLOG</h1>";
$args = array(
	'order' => 'asc',
	'orderby' => 'post_title',
	'posts_per_page' => '-1',
	'meta_key' => 'algolia_index',
	'meta_value' => '1',
	'post_type' => 'post',
	'post_status' => 'publish',
	'category_name' => 'blog'
); 
$posts = get_posts($args);
foreach($posts as $post) {
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_slug = $post->post_name;
	$post_description = strip_tags(wpautop($post->post_content));
	$post_url = get_the_permalink($post_id);
	// Add Index
	//$meta = add_post_meta($post_id, 'algolia_index', '1', true); 	
	// Index
	if($reindex) {
		// Add
		$index->addObject(
		  [
			'type'=>'Blog',
			'post_title'=>$post_title,
			'slug'=>$post_slug,
			'content'=>$post_description,
			'permalink'=>$post_url		
		  ]
		);
	}
	// Display
	echo "<p>$post_title<br/>$post_url</p>";		
}
// Magento
include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');
echo "<h1>MAGENTO</h1>";
$query = "SELECT 
DISTINCT(m_catalog_product_entity.row_id) as row_id, m_catalog_product_entity.entity_id as entity_id, m_catalog_product_entity.sku AS sku, 
(SELECT m_catalog_product_entity_varchar.`value` FROM m_catalog_product_entity_varchar WHERE m_catalog_product_entity_varchar.attribute_id = '70' AND m_catalog_product_entity_varchar.row_id = m_catalog_product_entity.row_id LIMIT 1) AS title, 
(SELECT m_catalog_product_entity_varchar.`value` FROM m_catalog_product_entity_varchar WHERE m_catalog_product_entity_varchar.attribute_id = '117' AND m_catalog_product_entity_varchar.row_id = m_catalog_product_entity.row_id LIMIT 1) AS url_key 
FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_product_entity_int, m_catalog_category_product 
WHERE m_catalog_product_entity_int.attribute_id='94' AND m_catalog_product_entity_int.value='1' 
AND m_catalog_category_product.product_id = m_catalog_product_entity.entity_id 
AND m_catalog_product_entity_varchar.row_id = m_catalog_product_entity.row_id 
AND m_catalog_product_entity_int.row_id = m_catalog_product_entity.row_id 
ORDER BY sku ASC";
$result = @mysql_query($query);
while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
	$row_id = $row['row_id'];
	$entity_id = $row['entity_id'];
	$sku = $row['sku'];
	$post_title = mb_convert_encoding($row['title'], 'UTF-8', 'UTF-8');
	$post_slug = 'store/'.$row['url_key'];
	$post_description = "SKU: $sku | $post_title";
	// Link
	$queryl = "SELECT request_path FROM m_url_rewrite WHERE entity_type='product' AND entity_id='$entity_id'";
	$resultl = @mysql_query($queryl);
	$rowl = @mysql_fetch_array($resultl, MYSQL_NUM);
	$post_url = get_bloginfo('home')."/store/".$rowl[0];
	// Configurable
	$query_c = "SELECT parent_id FROM m_catalog_product_relation WHERE child_id='$entity_id'";
	$result_c = @mysql_query($query_c);
	if(@mysql_num_rows($result_c) == 0) {	
		// Index
		if($reindex) {
			// Add
			$index->addObject(
			  [
				'type'=>'Ecomm',
				'post_title'=>$post_title,
				'slug'=>$post_slug,
				'content'=>$post_description,
				'permalink'=>$post_url		
			  ]
			);
		}
		// Display
		echo "<p>$entity_id / $post_title<br/>$post_url</p>";		
	}
}
?>

</div>
</div>
</div>

<?php get_footer(); ?>

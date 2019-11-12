<?php
/*
Template Name: Store
*/
?>
<?php get_header('store'); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-fade.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-slide.js"></script>

<div class="content_container">

<!-- Store CTA -->
<div class="content_banner_store">
<?php include(TEMPLATEPATH.'/inc/inc-banner-store.php');?>
</div>
<!-- Store CTA -->

<!-- Slider -->
<div class="content_slider_store">
<?php include(TEMPLATEPATH.'/inc/inc-slider-store.php');?>
</div>
<!-- Slider -->

<div class="content">
<div class="content_full content_twelve">
<!-- Featured Products -->
<div class="store_header_a">
<div class="store_header_span">Featured Products</div>
<div class="store_header_strike"></div>
</div>
<div class="store_parts_container">
<?php
// Feature Products
$category_id = '426';
include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');
$query_m = "SELECT m_catalog_product_entity.entity_id, m_catalog_product_entity.row_id, m_catalog_product_entity.sku 
FROM m_catalog_product_entity, m_catalog_category_product, m_catalog_product_entity_int 
WHERE m_catalog_category_product.category_id='$category_id' 
AND m_catalog_category_product.product_id=m_catalog_product_entity.entity_id 
AND m_catalog_product_entity_int.row_id=m_catalog_product_entity.row_id 
AND m_catalog_product_entity_int.attribute_id='94' 
AND m_catalog_product_entity_int.value='1' 
GROUP BY m_catalog_product_entity.entity_id 
ORDER BY RAND() LIMIT 20";
$result_m = @mysql_query($query_m);
while($row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC)) {
	$entity_id = $row_m['entity_id'];
	$row_id = $row_m['row_id'];
	$sku = $row_m['sku'];
	$price = FALSE;
	$special_price = FALSE;
	// CFG
	if(strpos($sku,'CFG') !== FALSE) {
		$query_s = "SELECT child_id FROM m_catalog_product_relation WHERE parent_id='$row_id'";
		$result_s = @mysql_query($query_s);
		$price = 0;
		while($row_s = @mysql_fetch_array($result_s, MYSQL_NUM)) {
			$child_id = $row_s[0];
			// Price
			$query_a = "SELECT m_catalog_product_entity_decimal.value AS price 
			FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.entity_id='$child_id' 
			AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_decimal.attribute_id='74' 
			GROUP BY m_catalog_product_entity.entity_id";
			$result_a = @mysql_query($query_a);
			$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
			$simple_price = number_format($row_a['price'],2);
			if($simple_price > $price) {
				$price = $simple_price;
			}
			// Special Price
			$query_a = "SELECT m_catalog_product_entity_decimal.value AS price 
			FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.entity_id='$child_id' 
			AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_decimal.attribute_id='75' 
			GROUP BY m_catalog_product_entity.entity_id";
			$result_a = @mysql_query($query_a);
			$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
			$simple_special_price = number_format($row_a['price'],2);
			if($simple_special_price > $special_price) {
				$special_price = $simple_special_price;
			}
		}
	}
	
	// Sku/Name/Price
	$query_a = "SELECT m_catalog_product_entity_varchar.value AS name, 
	m_catalog_product_entity_decimal.value AS price  
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_product_entity_decimal 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_varchar.attribute_id='70' 
	AND m_catalog_product_entity_decimal.attribute_id='74' 
	GROUP BY m_catalog_product_entity.entity_id";
	$result_a = @mysql_query($query_a);
	$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
	$name = $row_a['name'];
	if(!$price) {
		$price = number_format($row_a['price'],2);
	}
	// Special Price
	$query_a = "SELECT m_catalog_product_entity_decimal.value AS special_price  
	FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_decimal.attribute_id='75' 
	GROUP BY m_catalog_product_entity.entity_id";
	$result_a = @mysql_query($query_a);
	$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
	if(!$special_price) {
		$special_price = number_format($row_a['special_price'],2);
	}
	// Link
	$query_b = "SELECT m_catalog_product_entity_varchar.value AS url_key 
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
	AND m_catalog_product_entity_varchar.attribute_id='117'  
	GROUP BY m_catalog_product_entity.entity_id";
	$result_b = @mysql_query($query_b);
	$row_b = @mysql_fetch_array($result_b, MYSQL_ASSOC);
	$url_key = $row_b['url_key'];
	$link = get_bloginfo('url')."/store/".$url_key.'.html';
	// Image
	$query_c = "SELECT m_catalog_product_entity_varchar.value AS image  
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
	AND m_catalog_product_entity_varchar.attribute_id='84'  
	GROUP BY m_catalog_product_entity.entity_id";
	$result_c = @mysql_query($query_c);
	$row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC);
	$image = get_bloginfo('url')."/store/pub/media/catalog/product/".$row_c['image'];
	// Display
	echo "<div class=\"store_parts_block\">
	<a href=\"$link\" class=\"store_parts_tile\">
	<div style=\"background-image:url($image);\" class=\"store_parts_image\"></div>
	<div class=\"store_parts_name\">$name</div>
	";
	if($special_price != 0) {
		echo "<div class=\"store_parts_special_price\"><span class=\"store_parts_price_label\">Special Price:</span> \$$special_price</div>";
		} else {
		echo "<div class=\"store_parts_price\">\$$price</div>";
	}
	echo "
	</a>
	</div>";
}
?>
</div>
<!-- Featured Products -->

<!-- Best Sellers -->
<div class="store_header_b">
<div class="store_header_span">Best Sellers</div>
<div class="store_header_strike"></div>
</div>
<div class="store_parts_container">
<?php
// Best Sellers
$category_id = '427';
include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');
$query_m = "SELECT m_catalog_product_entity.entity_id, m_catalog_product_entity.row_id, m_catalog_product_entity.sku 
FROM m_catalog_product_entity, m_catalog_category_product, m_catalog_product_entity_int 
WHERE m_catalog_category_product.category_id='$category_id' 
AND m_catalog_category_product.product_id=m_catalog_product_entity.entity_id 
AND m_catalog_product_entity_int.row_id=m_catalog_product_entity.row_id 
AND m_catalog_product_entity_int.attribute_id='94' 
AND m_catalog_product_entity_int.value='1' 
GROUP BY m_catalog_product_entity.entity_id 
ORDER BY RAND() LIMIT 20";
$result_m = @mysql_query($query_m);
while($row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC)) {
	$entity_id = $row_m['entity_id'];
	$row_id = $row_m['row_id'];
	$sku = $row_m['sku'];
	$price = FALSE;
	$special_price = FALSE;
	// CFG
	if(strpos($sku,'CFG') !== FALSE) {
		$query_s = "SELECT child_id FROM m_catalog_product_relation WHERE parent_id='$row_id'";
		$result_s = @mysql_query($query_s);
		$price = 0;
		while($row_s = @mysql_fetch_array($result_s, MYSQL_NUM)) {
			$child_id = $row_s[0];
			// Price
			$query_a = "SELECT m_catalog_product_entity_decimal.value AS price 
			FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.entity_id='$child_id' 
			AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_decimal.attribute_id='74' 
			GROUP BY m_catalog_product_entity.entity_id";
			$result_a = @mysql_query($query_a);
			$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
			$simple_price = number_format($row_a['price'],2);
			if($simple_price > $price) {
				$price = $simple_price;
			}
			// Special Price
			$query_a = "SELECT m_catalog_product_entity_decimal.value AS price 
			FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.entity_id='$child_id' 
			AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
			AND m_catalog_product_entity_decimal.attribute_id='75' 
			GROUP BY m_catalog_product_entity.entity_id";
			$result_a = @mysql_query($query_a);
			$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
			$simple_special_price = number_format($row_a['price'],2);
			if($simple_special_price > $special_price) {
				$special_price = $simple_special_price;
			}
		}
	}
	// Sku/Name/Price
	$query_a = "SELECT m_catalog_product_entity_varchar.value AS name, 
	m_catalog_product_entity_decimal.value AS price  
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_product_entity_decimal 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_varchar.attribute_id='70' 
	AND m_catalog_product_entity_decimal.attribute_id='74' 
	GROUP BY m_catalog_product_entity.entity_id";
	$result_a = @mysql_query($query_a);
	$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
	$name = $row_a['name'];
	if(!$price) {
		$price = number_format($row_a['price'],2);
	}
	// Special Price
	$query_a = "SELECT m_catalog_product_entity_decimal.value AS special_price  
	FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_decimal.row_id=m_catalog_product_entity.row_id 
	AND m_catalog_product_entity_decimal.attribute_id='75' 
	GROUP BY m_catalog_product_entity.entity_id";
	$result_a = @mysql_query($query_a);
	$row_a = @mysql_fetch_array($result_a, MYSQL_ASSOC);
	if(!$special_price) {
		$special_price = number_format($row_a['special_price'],2);
	}
	// Link
	$query_b = "SELECT m_catalog_product_entity_varchar.value AS url_key 
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
	AND m_catalog_product_entity_varchar.attribute_id='117'  
	GROUP BY m_catalog_product_entity.entity_id";
	$result_b = @mysql_query($query_b);
	$row_b = @mysql_fetch_array($result_b, MYSQL_ASSOC);
	$url_key = $row_b['url_key'];
	$link = get_bloginfo('url')."/store/".$url_key.'.html';
	// Image
	$query_c = "SELECT m_catalog_product_entity_varchar.value AS image  
	FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
	WHERE m_catalog_product_entity.entity_id='$entity_id' 
	AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id  
	AND m_catalog_product_entity_varchar.attribute_id='84'  
	GROUP BY m_catalog_product_entity.entity_id";
	$result_c = @mysql_query($query_c);
	$row_c = @mysql_fetch_array($result_c, MYSQL_ASSOC);
	$image = get_bloginfo('url')."/store/pub/media/catalog/product/".$row_c['image'];
	// Display
	echo "<div class=\"store_parts_block\">
	<a href=\"$link\" class=\"store_parts_tile\">
	<div style=\"background-image:url($image);\" class=\"store_parts_image\"></div>
	<div class=\"store_parts_name\">$name</div>
	";
	if($special_price != 0) {
		echo "<div class=\"store_parts_special_price\"><span class=\"store_parts_price_label\">Special Price:</span> \$$special_price</div>";
		} else {
		echo "<div class=\"store_parts_price\">\$$price</div>";
	}
	echo "
	</a>
	</div>";
}
?>
</div>
<!-- Best Sellers -->

<!-- Store -->
<div class="store_container">
<?php
wp_reset_query();
// Maintenance Post
$args = array('name'=>'store-maintenance', 'post_type'=>'post', 'post_status'=>'publish');
$posts = get_posts($args);
if($posts) {
	echo "<div class=\"store_maintenance\">".wpautop($posts[0]->post_content)."</div>";
	} else {
	// Store Posts
	$args = array('category_name'=>'store-callouts','posts_per_page'=>'-1','orderby'=>'date','order'=>'asc');
	query_posts($args);
	while(have_posts()):the_post();
		$post_title = $post->post_title;
		$post_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
		$post_link = get_post_meta($post->ID, 'CTA Link', true);
		echo "<a href=\"$post_link\" class=\"store_block\">
		<div class=\"store_image\" style=\"background-image:url($post_image);\"></div>
		<div class=\"store_text\">$post_title</div>
		</a>";
	endwhile;
	wp_reset_query();
}
?>
</div>
<!-- Store -->
</div>
</div>

</div>

<?php //include(TEMPLATEPATH.'/inc/inc-subscribe-tab.php');?>

<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->

<?php get_footer(); ?>

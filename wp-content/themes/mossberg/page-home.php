<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/brilliantslider/slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-scroll-page.js"></script>

<!-- Slider -->
<div class="content_slider">
<?php include(TEMPLATEPATH.'/inc/inc-slider.php');?>
</div>
<!-- Slider -->

<div class="content_feature" id="feature">
<div class="content_transparent">
<!-- Home Feature -->
<?php
$cat_slug = 'home-feature';
$args = array('category_name'=>$cat_slug,'show_posts'=>'1');
query_posts($args);
while(have_posts()):the_post();
    echo "<div class=\"feature_container\">
	<div class=\"feature_title\">".$post->post_title."</div>
	<div class=\"feature_text\">".$post->post_content."</div>
	</div>";
endwhile;
wp_reset_query();
?>
<!-- Home Feature -->
</div>
<div class="feature_footer"></div>
</div>
<div class="content_container_border">
<div class="content_callouts">
<!-- Home Callouts -->
<?php
$cat_slug = 'home-callouts';
$cat = get_category_by_slug($cat_slug); 
$cat_id = $cat->term_id;
$category = get_category($cat_id);
$category_name = $category->name;
echo "<div class=\"callouts_header\">$category_name</div>
<div class=\"callouts_container\">";
// Featured
$feature_slug = 'home-callouts-featured';
$feature_ids = array();
$args = array('category_name'=>$feature_slug,'posts_per_page'=>'5','orderby'=>'rand');
$featured_query = query_posts($args);
$callouts_open = 5 - count($featured_query);
while(have_posts()):the_post();
	$callout_title = $post->post_title;
	$callout_tags = get_the_tags();
	$callout_link = get_the_permalink();
	$callout_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
	$callout_image = $callout_image[0]; 
    echo "<div class=\"callouts_block\">
	<a href=\"$callout_link\" class=\"callouts_image\" style=\"background-image:url($callout_image);\"></a>
	<div class=\"callouts_text\"><a href=\"$callout_link\">$callout_title</a><img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-arrow-yellow.png\"/></div>
	<div class=\"callouts_tags\">";
	$feature_ids[] = $post->ID;
	echo "</div>
	</div>";
endwhile;
wp_reset_query();
// Callouts
$args = array('category_name'=>$cat_slug,'posts_per_page'=>$callouts_open,'orderby'=>'rand','post__not_in'=>$feature_ids);
query_posts($args);
while(have_posts()):the_post();
	$callout_title = $post->post_title;
	$callout_tags = get_the_tags();
	$callout_link = get_the_permalink();
	$callout_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
	$callout_image = $callout_image[0]; 
    echo "<div class=\"callouts_block\">
	<a href=\"$callout_link\" class=\"callouts_image\" style=\"background-image:url($callout_image);\"></a>
	<div class=\"callouts_text\"><a href=\"$callout_link\">$callout_title</a><img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-arrow-yellow.png\"/></div>
	<div class=\"callouts_tags\">";
	echo "</div>
	</div>";
endwhile;
wp_reset_query();
echo "</div>";
?>
<!-- Home Callouts -->
</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

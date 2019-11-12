<?php
/*
Template Name: Arm Yourself
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-scroll-page.js"></script>

<div class="content_container">
<div class="content">

<?php include(TEMPLATEPATH.'/inc/inc-content-banner.php');?>

<div id="top">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>
</div>

<div id="arm_yourself_intro" class="post_text">
<?php
$post_title = get_the_title();
$post_content = $post->post_content;
$post_content_filters = apply_filters('the_content', $post_content);
echo $post_content_filters;
?>
<ul>
<?php
// Arm Yourself Intro
$category_slug = 'arm-yourself';
$args = array('category_name'=>$category_slug,'posts_per_page'=>'3', 'orderby' => 'date', 'order' => 'ASC');
query_posts($args);
while(have_posts()):the_post();	
$post_title = get_the_title();
$post_slug = $post->post_name;
$post_content = $post->post_content;
$post_content_filters = apply_filters('the_content', $post_content);
	// Scroll Nav
	echo "<li class=\"scroll_link\" onClick=\"scroll_page('$post_slug')\">$post_title</li>
	";
endwhile;
wp_reset_query();
?>
</ul>
</div>
<div id="arm_yourself_content">
<?php
// Arm Yourself Content
$category_slug = 'arm-yourself';
$args = array('category_name'=>$category_slug,'posts_per_page'=>'3', 'orderby' => 'date', 'order' => 'ASC');
query_posts($args);
while(have_posts()):the_post();	
$post_title = get_the_title();
$post_slug = $post->post_name;
$post_content = $post->post_content;
$post_content_filters = apply_filters('the_content', $post_content);
	// Arm Yourself Section
	echo "<div id=\"$post_slug\"><div class=\"post_title\"><h1>$post_title</h1></div>
	<div class=\"post_text\">$post_content_filters
	<a class=\"to_top\" onClick=\"scroll_page('top')\">To Top</a>
	</div>
	</div>
	";
endwhile;
wp_reset_query();
?>
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

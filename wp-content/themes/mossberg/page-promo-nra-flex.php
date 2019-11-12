<?php
/*
Template Name: Promo NRA FLEX
*/
?>
<?php get_header(); ?>

<?php 
// Post
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_content = wpautop($post->post_content);
$page_content_filters = apply_filters('the_content', $page_content);
$page_image = wp_get_attachment_url(get_post_thumbnail_id($page_id));
$page_date = get_the_date();
$page_categories = wp_get_post_categories($page_id);
?>

<div class="content_container">
<div class="content">

<!-- Feature -->
<div class="content_full content_twelve">
<div class="promo_feature" style="background-image:url(<?php echo $page_image;?>);"></div>
</div>
<!-- Feature -->

<!-- Form -->
<div class="content_right content_four">
<div class="promo_sidebar">
<div class="promo_sidebar_text">
<h3>Enter Here for Your Chance to Win a FLEX 500 and Gun Bag!</h3>
<?php include(TEMPLATEPATH.'/inc/inc-promo-nra-flex.php');?>
</div>
</div>
</div>
<!-- Form -->

<!-- Promos -->
<div class="content_left content_eight">
<div class="promo_intro"><?php echo $page_content_filters;?></div>
</div>
<!-- Promos -->

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

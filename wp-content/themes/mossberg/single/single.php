<?php
/**
* Single
* @package Mossberg
* @since Mossberg 1.0
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553fdea33c12861b" async="async"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-scroll-page.js"></script>

<div class="content_container">
<div class="content single">
<?php include(TEMPLATEPATH.'/inc/inc-single-header.php');?>
<div class="content_eight content_left">
<!-- Posts -->
<?php
while ( have_posts() ) : the_post();
	$post_id = get_the_ID();
	$post_title = get_the_title();
	$post_content = wpautop(get_the_content());
	$post_content = apply_filters('the_content', $post_content);
	$post_date = get_the_date();
	// Post
	echo "<div class=\"post_title\"><h1>$post_title</h1></div>
	<div class=\"post_sharing_wrap\">
	<div class=\"post_sharing\">$post_date</div>
	<div class=\"addthis_sharing_toolbox\"></div>
	</div>
	</div>
	<div class=\"post_text\">$post_content</div>";
endwhile;
?>
<!-- Posts -->
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar desktop">
<?php
$cta_limit = 3;
include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');
?>
</div>
<!-- CTA -->
</div>
</div>
</div>

<?php get_footer(); ?>

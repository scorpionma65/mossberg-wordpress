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
	$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 40 );
	$author_image = get_avatar( get_the_author_meta( 'ID' ));
	$author = get_the_author();
	$author_email = get_avatar( get_the_author_meta('user_email'), '80', '' );
	$author_link = get_the_author_link();
	$author_description = get_the_author_meta('description');
	$author_display = TRUE;
	// Trophy
	$trophy_model = get_post_meta($post_id, 'Trophy Model', true);
	$trophy_date = get_post_meta($post_id, 'Trophy Date', true);
	$trophy_location = get_post_meta($post_id, 'Trophy Location', true);
	$trophy_species = get_post_meta($post_id, 'Trophy Species', true);
	$trophy_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'large');
	echo "<div class=\"post_sharing\">
	<div class=\"addthis_sharing_toolbox\"></div>
	</div>
	<div class=\"post_text\">
	<img src=\"$trophy_image[0]\" class=\"trophy_post_image\"/>
	<h5>The Story</h5>$post_content
	<h5>Mossberg Product(s)</h5>$trophy_model
	<h5>When / Where</h5>$trophy_date / $trophy_location
	<h5>Species</h5>$trophy_species
	</div>
	<div class=\"post_link\"><a href=\"".get_bloginfo('home')."/community/trophy-room/\">&laquo; Trophy Room</a></div>";
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

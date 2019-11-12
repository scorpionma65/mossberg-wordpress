<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div class="content_container">
<div class="content">
<div class="content_eight content_left">
<!-- Posts -->
<div class="container_text">
<h2>Sorry, we couldn't find what you were looking for.</h2>
<p>Visit the <a href="<?php bloginfo('home');?>">Homepage</a>. Need help? <a href="<?php bloginfo('home');?>/contact/">Contact Us</a>.</p>
</div>
<!-- Posts -->
</div>
<div class="content_four content_right">
<!-- CTA -->
<div class="cta_sidebar">
<?php include(TEMPLATEPATH.'/inc/inc-sidebar-cta.php');?>
</div>
<!-- CTA -->
</div>
</div>
</div>

<?php get_footer(); ?>

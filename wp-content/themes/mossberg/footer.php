<?php
/**
* Footer
* @package Mossberg
* @since Mossberg 1.0
*/
?>

<!-- Main -->

<!-- Footer Desktop -->
<div class="content_container_fade"></div>
<div class="footer_container desktop" id="footer">
<!-- CTA -->
<div class="footer_cta">
<?php 
$cta_limit = 1;
$cta_slug = 'cta-footer';
include(TEMPLATEPATH.'/inc/inc-footer-cta.php');
?>
</div>
<!-- CTA -->
<!-- Menu -->
<div class="footer_menu">
<?php 
wp_nav_menu(array(
'theme_location'  => 'footer',
'container'       => 'div',
'container_class' => 'footer_navigation',
'container_id'    => 'footer-navigation',
'menu_class'      => 'nav_menu',
'menu_id'         => 'nav-menu'
));
?>
</div>
<!-- Menu -->
<!-- Footer -->
<div class="footer">
<div class="footer_left">
<!-- Info -->
<div class="footer_info">
<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/footer/footer-logo.png"/></a>
<p>&copy; Copyright <?php echo date('Y');?><br/><?php bloginfo('name');?></p>
</div>
<!-- Info -->
</div>
<div class="footer_center">
<?php
$cat_slug = 'footer-social';
$args = array('category_name'=>$cat_slug,'showposts'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_text = apply_filters('the_content', $post->post_content);
	echo "<div class=\"footer_social\">$post_text</div>";
endwhile;
?>
</div>
<div class="footer_right">
<!-- Callout -->
<div class="footer_info">
&nbsp;
</div>
<!-- Callout -->
</div>
</div>
<!-- Footer -->
<span style="color:#111;"><?php echo $_SERVER['REMOTE_ADDR'];?> || <?php echo $_SERVER['SERVER_ADDR'];?></span>
</div>


<!-- Footer Mobile -->
<div class="footer_mobile mobile" id="footer_mobile">
<div class="footer">

<!-- Social -->
<?php
$cat_slug = 'footer-social';
$args = array('category_name'=>$cat_slug,'showposts'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_id = $post->ID;
	$post_title = $post->post_title;
	$post_text = apply_filters('the_content', $post->post_content);
	echo "<div class=\"footer_social\">$post_text</div>";
endwhile;
?>
<!-- Social -->
<!-- Info -->
<div class="footer_info">
<p>
<a href="<?php echo get_bloginfo('url');?>/privacy-center">Privacy Center</a> | 
<a href="<?php echo get_bloginfo('url');?>/privacy-policy">Privacy Policy</a> | 
<a href="<?php echo get_bloginfo('url');?>/terms-of-use">Terms of Use</a> | 
<a href="<?php echo get_bloginfo('url');?>/contact-us">Contact Us</a>
</p>
<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/footer/footer-logo.png" id="footer_logo" class="footer_logo"/></a>
<p>&copy; Copyright <?php echo date('Y');?><br/><?php bloginfo('name');?></p>
</div>
<!-- Info -->
<!-- Callout -->
<div class="footer_callout">

</div>
<!-- Callout -->

</div>
</div>
<!-- Footer Mobile -->

<?php wp_footer(); ?>

<!-- Cookie Policy -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-cookie-policy.js"></script>
<?php 
// Cookie Policy
if(!$_COOKIE['cookie-accept'] || $_COOKIE['cookie-accept'] != 'accepted') {
	include(TEMPLATEPATH.'/inc/inc-cookie-policy.php');
}
?>
<!-- Cookie Policy -->

<!-- Tracking -->
<?php include(TEMPLATEPATH.'/inc/inc-tracking.php');?>
<!-- Tracking -->

</body>
</html>

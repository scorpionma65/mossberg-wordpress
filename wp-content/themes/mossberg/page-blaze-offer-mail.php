<?php
/*
Template Name: Blaze Offer Mail-in
*/
?>
<?php get_header('print'); ?>
<script>window.onload = function() { window.print(); }</script>
<div class="blaze_mail_container">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"blaze_mail_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
<table>
<tr>
<td>SEND ME</td>
<td colspan="2" class="blaze_mail_field">
<?php 
if(strpos($_GET['magazine'],'10') !== FALSE) {
	echo "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-checked.png\" class=\"blaze_mail_check\"/>";
	} else {
	echo "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-check.png\" class=\"blaze_mail_check\"/>";
}
?>Two (2) 10-Round Magazines<br/>
<?php 
if(strpos($_GET['magazine'],'25') !== FALSE) {
	echo "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-checked.png\" class=\"blaze_mail_check\"/>";
	} else {
	echo "<img src=\"".get_bloginfo('stylesheet_directory')."/template/icons/icon-check.png\" class=\"blaze_mail_check\"/>";
}
?>Two (2) 25-Round Magazines*
</td>
</tr>
<tr>
<td>NAME</td>
<td colspan="2" class="blaze_mail_field"><?php if(isset($_GET['firstname'])) { echo sanitize_text_field($_GET['firstname']); }?> <?php if(isset($_GET['lastname'])) { echo sanitize_text_field($_GET['lastname']); }?></td>
</tr>
<tr>
<td>EMAIL</td>
<td colspan="2" class="blaze_mail_field"><?php if(isset($_GET['email'])) { echo sanitize_text_field($_GET['email']); }?></td>
</tr>
<tr>
<td>ADDRESS</td>
<td colspan="2" class="blaze_mail_field"><?php if(isset($_GET['address'])) { echo sanitize_text_field($_GET['address']); }?></td>
</tr>
<tr>
<td>CITY / STATE / ZIP</td>
<td colspan="2" class="blaze_mail_field"><?php if(isset($_GET['city'])) { echo sanitize_text_field($_GET['city']); }?> 
<?php if(isset($_GET['state'])) { echo sanitize_text_field($_GET['state']); }?> 
<?php if(isset($_GET['zip'])) { echo sanitize_text_field($_GET['zip']); }?></td>
</tr>
<tr>
<td>ITEM #</td>
<td class="blaze_mail_field">&nbsp;</td>
<td rowspan="3" class="blaze_mail_label">
<img src="http://www.mossberg.com/wp-content/themes/mossberg/template/content/blaze-serial.jpg"/>
</td>
</tr>
<tr>
<td>SERIAL #</td>
<td class="blaze_mail_field">&nbsp;</td>
</tr>
</table>
<!-- Offer Footer -->
<?php
$args = array('name'=>'blaze-offer-footer', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
$posts = get_posts($args);
if($posts) { 
	$post_title = $posts[0]->post_title;
	$post_content = wpautop($posts[0]->post_content);
	echo "<div class=\"blaze_submission_footer\">$post_content</div>";
}
?>
<!-- Offer Footer -->
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php wp_footer(); ?>

<?php
/*
Template Name: OSP Offer Mail-in
*/
?>
<?php get_header('print'); ?>
<script>window.onload = function() { window.print(); }</script>
<div class="osp_mail_container">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"osp_mail_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
<table>
<tr>
<td>NAME</td>
<td colspan="2" class="osp_mail_field"><?php if(isset($_GET['firstname'])) { echo sanitize_text_field($_GET['firstname']); }?> <?php if(isset($_GET['lastname'])) { echo sanitize_text_field($_GET['lastname']); }?></td>
</tr>
<tr>
<td>EMAIL</td>
<td colspan="2" class="osp_mail_field"><?php if(isset($_GET['email'])) { echo sanitize_text_field($_GET['email']); }?></td>
</tr>
<tr>
<td>ADDRESS</td>
<td colspan="2" class="osp_mail_field"><?php if(isset($_GET['address'])) { echo sanitize_text_field($_GET['address']); }?></td>
</tr>
<tr>
<td>CITY / STATE / ZIP</td>
<td colspan="2" class="osp_mail_field"><?php if(isset($_GET['city'])) { echo sanitize_text_field($_GET['city']); }?> 
<?php if(isset($_GET['state'])) { echo sanitize_text_field($_GET['state']); }?> 
<?php if(isset($_GET['zip'])) { echo sanitize_text_field($_GET['zip']); }?></td>
</tr>
<tr>
<td>ITEM #</td>
<td class="osp_mail_field">&nbsp;</td>
<td rowspan="3" class="osp_mail_label">
<img src="http://www.mossberg.com/wp-content/themes/mossberg/template/content/blaze-serial.jpg"/>
</td>
</tr>
<tr>
<td>SERIAL #</td>
<td class="osp_mail_field">&nbsp;</td>
</tr>
</table>
<!-- Offer Footer -->
<?php
$args = array('name'=>'osp-offer-footer', 'post_type'=>'post', 'post_status'=>'publish', 'numberposts'=>1);
$posts = get_posts($args);
if($posts) { 
	$post_title = $posts[0]->post_title;
	$post_content = wpautop($posts[0]->post_content);
	echo "<div class=\"osp_submission_footer\">$post_content</div>";
}
?>
<!-- Offer Footer -->
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php wp_footer(); ?>


<?php

/*

Template Name: Data Resubscribe

*/

?>

<?php get_header(); ?>

<script>

jQuery(document).ready(function() {

	jQuery('#check_status').click(function() {

		hide_status()

		var status = jQuery('.hs-error-msgs li label a').html();

		if(!status) {

			jQuery('.resubscribe_message').show();		

		}

	});

});

function hide_status() {

	jQuery('.resubscribe_message').hide();	

}

</script>

<div class="content_container">

<div class="content">

<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>

<div class="content_eight content_left">

<!-- Resubscribe -->

<div class="resubscribe_text">

<?php

while ( have_posts() ) : the_post(); 

	the_content();

endwhile;

?>

<div class="resubscribe_message">This email address is not currently unsubscribed.<br/>Return to <a href="<?php echo get_bloginfo('url');?>/privacy-center">Privacy Center</a> to manage your subscription preferences.</div>

<a href="javascript:void(0);" class="link_button" id="check_status">Check Subscription Status</a>

</div>

<!-- Resubscribe -->

</div>

<div class="content_four content_right">



</div>

</div>

</div>

<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->

<?php get_footer(); ?>


<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>

<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-page-header.php');?>

<div class="content_seven content_left">
<!-- Freshdesk -->
<div class="freshdesk_form">
<script type="text/javascript" src="https://s3.amazonaws.com/assets.freshdesk.com/widget/freshwidget.js"></script>
<style type="text/css" media="screen, projection">@import url(https://s3.amazonaws.com/assets.freshdesk.com/widget/freshwidget.css);</style> 
<iframe title="Feedback Form" class="freshwidget-embedded-form" id="freshwidget-embedded-form" src="https://mossberginc.freshdesk.com/widgets/feedback_widget/new?&widgetType=embedded&submitTitle=Submit&submitThanks=Thank+you.+A+Mossberg+representative+will+review+and+respond+to+your+request.&screenshot=no&searchArea=no" scrolling="no" height="1075px" width="100%" frameborder="0" >
</iframe>
<!-- Freshdesk -->
</div>
</div>

<div class="content_five content_right">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	echo "<div class=\"post_text\">";
	the_content();
	echo "</div>";
endwhile;
?>
<!-- Posts -->
</div>

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

<?php
/*
Template Name: FLEX Configurator Popup
*/
?>
<?php get_header('flex'); ?>

<div class="flex_header_pad"></div>
<div class="flex_popup">
<div class="content_twelve content_full">
<div class="flex_popup_text">
<!-- Posts -->
<?php 
while ( have_posts() ) : the_post(); 
	the_content();
endwhile;
?>
<!-- Posts -->
</div>
</div>
</div>

<?php get_footer('none'); ?>

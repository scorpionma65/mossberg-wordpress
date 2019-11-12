<?php
/*
Template Name: Trophy Profile
*/
?>
<?php get_header('modal'); ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553fdea33c12861b" async="async"></script>

<div class="content_container_popup">
<div class="content_popup">
<?php
// Trophy
if(!empty($_GET['id'])) {
	$post_id = sanitize_text_field($_GET['id']);
	$post = get_post($post_id);
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	$post_link = get_the_permalink($post_id);
	$post_model = get_post_meta($post_id, 'Trophy Model', true);
	$post_date = get_post_meta($post_id, 'Trophy Date', true);
	$post_location = get_post_meta($post_id, 'Trophy Location', true);
	$post_species = get_post_meta($post_id, 'Trophy Species', true);
	$post_image = wp_get_attachment_url(get_post_thumbnail_id($product_id),'large');
	
}
?>
<div class="content_twelve content_full">
<table class="trophy_profile">
<tr>
<td>
<div class="trophy_image">
<?php echo "<img src=\"$post_image\"/>";?>
Share: <div class="addthis_sharing_toolbox" data-url="<?php echo $post_link;?>" data-title="<?php echo "Mossberg Trophy Room | $post_title";?>"></div>
</div>
</td>
<td>
<div class="trophy_text">
<h1><?php echo $post_title;?></h1>
<h5>The Story</h5><?php echo $post_content;?>
<h5>Mossberg Product(s)</h5><?php echo $post_model;?>
<h5>When / Where</h5><?php echo $post_date;?> / <?php echo $post_location;?>
<h5>Species</h5><?php echo $post_species;?>
</div>
</td>
</tr>
</table>

</div>
</div>

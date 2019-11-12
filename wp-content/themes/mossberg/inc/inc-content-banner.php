<?php
// Content Banner
$parent_id = wp_get_post_parent_id( $post_ID );
$page_image = wp_get_attachment_url(get_post_thumbnail_id($page->ID));
$page_image_parent = wp_get_attachment_url(get_post_thumbnail_id($parent_id));
echo "<div class=\"content_banner\" style=\"background-image: url($page_image);\"></div>";
?>
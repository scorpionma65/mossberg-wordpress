<?php
// Store Banner
$args = array('category_name'=>'store-banner','posts_per_page'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	echo "<div class=\"store_banner\">$post_content</div>";
endwhile;
wp_reset_query();
?>
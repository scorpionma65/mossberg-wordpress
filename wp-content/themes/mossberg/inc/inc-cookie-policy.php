<div class="content_cookie" id="cookie-policy">
<?php
// Cookie Disclaimer
$args = array('category_name'=>'cookie-disclaimer','posts_per_page'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_title = $post->post_title;
	$post_content = wpautop($post->post_content);
	$post_link = get_post_meta($post->ID, 'CTA Link', true);
	echo "<div class=\"cookie_text\">
	<div class=\"cookie_button\"><a href=\"{$post_link}?page=".$_SERVER['REQUEST_URI']."\">Continue</a></div>
	<h3>$post_title</h3>$post_content
	</div>";
endwhile;
wp_reset_query();
?>
</div>

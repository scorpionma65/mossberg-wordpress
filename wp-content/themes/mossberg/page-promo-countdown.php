<?php
/*
Template Name: Promo Countdown
*/
?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-countdown-timer.js"></script>
<script>
window.onload = function() {
	for(i=0; i>-1; i++) {
		if(document.getElementById('clocktime'+i)) {
			var clocktime = document.getElementById('clocktime'+i).value;
			var clocktimedate = clocktime.split(',');
			var deadline = new Date(clocktimedate[0],clocktimedate[1],clocktimedate[2],clocktimedate[3],clocktimedate[4],clocktimedate[5]);
			if(deadline) { 
				initializeClock(i, deadline);
			}
			} else {
			break;
		}
	}
};
</script>

<?php 
// Post
global $post;
$page_id = get_the_ID();
$page_title = get_the_title();
$page_content = wpautop($post->post_content);
$page_content_filters = apply_filters('the_content', $page_content);
$page_image = wp_get_attachment_url(get_post_thumbnail_id($page_id));
$page_date = get_the_date();
$page_categories = wp_get_post_categories($page_id);
$page_note = get_post_meta(get_the_ID(), 'Promo Note', true);
?>

<div class="content_container">
<div class="content">

<!-- Feature -->
<div class="content_full content_twelve">
<div class="promo_feature" style="background-image:url(<?php echo $page_image;?>);"></div>
</div>
<!-- Feature -->

<!-- Form -->
<div class="content_right content_four">
<div class="promo_sidebar promo_countdown_sidebar">
<?php
// Forms
$args = array('category_name'=>'promo-countdown-registration','posts_per_page'=>'1');
query_posts($args);
while(have_posts()):the_post();
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	echo "<div class=\"promo_sidebar_text\">$post_content</div>";
endwhile;
wp_reset_query();
?>
</div>
<div class="post_text"><strong><?php echo $page_note;?></strong></div>
</div>
<!-- Form -->

<!-- Promos -->
<div class="content_left content_eight">
<div class="promo_intro"><?php echo $page_content_filters;?></div>
<div class="promo_countdown_container">
<?php
// Promos
date_default_timezone_set('America/New_York');
$args = array('category_name'=>'promo-countdown','posts_per_page'=>'-1','orderby'=>'date','order'=>'asc');
query_posts($args);
$count = 0;
while(have_posts()):the_post();
	$post_title = $post->post_title;
	$post_content = $post->post_content;
	$post_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'large');
	$post_promo_date = get_post_meta(get_the_ID(), 'Promo Countdown Date', true);
	$post_promo_link = get_post_meta(get_the_ID(), 'Promo Countdown Link', true);
	$countdown_date = date('Y-m-d H:i:s',strtotime($post_promo_date));
	$countdown_month = date('F',strtotime($post_promo_date));
	$countdown_day = date('j',strtotime($post_promo_date));
	$countdown_weekday = date('l',strtotime($post_promo_date));
	$deadline_year = date('Y',strtotime($post_promo_date));
	$deadline_month = date('m',strtotime($post_promo_date)) - 1;
	$deadline_day = date('d',strtotime($post_promo_date));
	$deadline_hour = date('H',strtotime($post_promo_date));
	$deadline_minute = date('i',strtotime($post_promo_date));
	$deadline_second = date('s',strtotime($post_promo_date));
	$deadline = $deadline_year.','.$deadline_month.','.$deadline_day.','.$deadline_hour.','.$deadline_minute.','.$deadline_second;
	
	// Revealed		
	$block_class_alt = "promo_countdown_block_released";
	$block_style_alt = $post_image;
	$block_link_alt = $post_promo_link;	
	if(strtotime(date('Y-m-d H:i:s')) <= strtotime($countdown_date)) {
		$block_class = "promo_countdown_block";
		$block_style = NULL;
		$block_link = "javascript:void(0)";
		} else {
		$block_class = $block_class_alt;
		$block_style = "background-image:url($block_style_alt);";
		$block_link = $block_link_alt;
	}
	
	// Timer
	echo "<div class=\"promo_countdown_background\">
	<a href=\"$block_link\" class=\"$block_class\" style=\"$block_style\" id=\"timer{$count}\">
	<div class=\"promo_countdown_date desktop\">
	<div class=\"promo_countdown_month\">$countdown_month</div>
	<div class=\"promo_countdown_day\">$countdown_day</div>
	<div class=\"promo_countdown_weekday\">$countdown_weekday</div>
	</div>
	<div class=\"promo_countdown_date mobile\">$countdown_weekday, $countdown_month $countdown_day</div>
	<div class=\"promo_countdown_content\">
	<div class=\"promo_countdown_title\">$post_content</div>
	<div class=\"promo_countdown_unlock\">Deal Unlocks to the Public In:</div>		
	<div id=\"clockdiv{$count}\" class=\"promo_countdown_timer\">
	<input type=\"hidden\" id=\"clocktime{$count}\" name=\"clocktime{$count}\" value=\"$deadline\"/>
	<input type=\"hidden\" id=\"timervals{$count}\" name=\"timervals{$count}\" value=\"{$block_class_alt}|||{$block_style_alt}|||{$block_link_alt}\"/>
	<div class=\"promo_countdown_timer_block\">Days<span class=\"promo_countdown_timer_clock days\"></span></div><span class=\"promo_countdown_timer_sep\">:</span><div class=\"promo_countdown_timer_block\">Hours<span class=\"promo_countdown_timer_clock hours\"></span></div><span class=\"promo_countdown_timer_sep\">:</span><div class=\"promo_countdown_timer_block\">Minutes<span class=\"promo_countdown_timer_clock minutes\"></span></div><span class=\"promo_countdown_timer_sep\">:</span><div class=\"promo_countdown_timer_block\">Seconds<span class=\"promo_countdown_timer_clock seconds\"></span></div>
	</div>		
	</div>
	</a>
	</div>";
	$count++;
endwhile;
wp_reset_query();
?>
</div>
</div>
<!-- Promos -->

</div>
</div>
<!-- Popups -->
<?php include(TEMPLATEPATH.'/inc/inc-popup.php'); ?>
<!-- Popups -->
<?php get_footer(); ?>

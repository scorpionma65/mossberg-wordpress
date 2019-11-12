<!-- Popup Shadowbox -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.css">
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/inc/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init({ continuous:	false });</script>
<script type="text/javascript">
window.onload = function() {
	Shadowbox.open({
		content:    '<?php echo get_bloginfo('url').'/'.$popup_slug;?>',
		player:     'iframe',
		height:     <?php echo $popup_height;?>,
		width:      <?php echo $popup_width;?>
	});	
}
</script>
<!-- Popup Shadowbox -->

<div class="content_banner_le">
<?php
$le_id = get_page_by_path('law-enforcement');
$le_link = get_the_permalink($le_id->ID);
?>
<a href="<?php echo $le_link;?>"><img src="<?php bloginfo('stylesheet_directory');?>/template/header/header-logo-le.png" class="header_logo_le"/></a>
</div>

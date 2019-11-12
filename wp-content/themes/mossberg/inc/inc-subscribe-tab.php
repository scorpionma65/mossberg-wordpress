<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/js-toggle-form.js"></script>
<div class="tab_form_tab <?php if(isset($_POST['submit'])) { echo "tab_form_tab_close"; } else { echo "tab_form_tab_open"; } ?>" onclick="toggle_form('tab_form')" id="tab_tab">Join Us and Get 10% OFF*</div>
<div class="tab_form_container <?php if(isset($_POST['submit'])) { echo "tab_form_container_open"; } else { echo "tab_form_container_close"; } ?>" id="tab_form">
<div class="tab_form_block">
<div class="tab_form_intro">
<img src="<?php bloginfo('stylesheet_directory');?>/template/icons/icon-x.png" onclick="toggle_form('tab_form')" class="tab_form_close"/>
<h3>Join the Community</h3>
<p>Get 10% OFF your next purchase in the Mossberg Store*</p>
</div>
<?php include(TEMPLATEPATH.'/inc/inc-promo-community-tab.php');?>
<div class="tab_form_notes">*Offer available for new community members. Applies to online orders only.</div>
</div>
</div>
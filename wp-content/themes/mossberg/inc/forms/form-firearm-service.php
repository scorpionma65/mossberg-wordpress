<form action="<?php bloginfo('home');?>/service/request/" method="post" enctype="multipart/form-data" name="service_request" id="service_request" class="form_body">

<!-- Firearm -->
<h4>Firearm Information</h4>
<div class="form_section">
Serial Number (located on receiver)<br/>
<input name="serial_number" type="text" class="form_field" id="serial_number" value="<?php if(isset($_POST['serial_number'])) { echo stripslashes(sanitize_text_field($_POST['serial_number']));}?>" />
Type of Firearm *<br/>
<select name="firearm_type" id="firearm_type" class="form_dropdown" onchange="display_actions(1)">
<option value="">-</option>
<option value="Shotgun" <?php if($_POST['firearm_type']=='Shotgun/Shockwave/Pistol Grip Firearm') { echo "selected=\"selected\"";}?>>Shotgun/Shockwave/Pistol Grip Firearm</option>
<option value="Centerfire Rifle" <?php if($_POST['firearm_type']=='Centerfire Rifle') { echo "selected=\"selected\"";}?>>Centerfire Rifle</option>
<option value="Rimfire Rifle" <?php if($_POST['firearm_type']=='Rimfire Rifle') { echo "selected=\"selected\"";}?>>Rimfire Rifle</option>
<option value="Handgun" <?php if($_POST['firearm_type']=='Handgun') { echo "selected=\"selected\"";}?>>Handgun</option>
<option value="Pistol" <?php if($_POST['firearm_type']=='Pistol') { echo "selected=\"selected\"";}?>>715P</option>
</select>

<?php
// Shoguns
$options = array('Pump Action','Break Action','Semi-Auto','Bolt Action');
build_actions('firearm_action_shotgun',$options);
// Centerfire Rifles
$options = array('Bolt Action','Lever Action','Semi-Auto');
build_actions('firearm_action_centerfire_rifle',$options);
// Rimfire Rifles
$options = array('Bolt Action','Lever Action','Semi-Auto');
build_actions('firearm_action_rimfire_rifle',$options);
// Handguns
$options = array('Semi-Auto');
build_actions('firearm_action_handgun',$options);
// Pistols
$options = array('Semi-Auto');
build_actions('firearm_action_pistol',$options);
?>

<div id="firearm_model" style="display:none;">
<?php
// Shoguns Pump Action
$options = array('500','590','590A1','535','835','Maverick 88','505','510','Maverick 91');
build_models('firearm_model_shotgun_pump_action',$options);
// Shoguns Break Action
$options = array('Silver Reserve','Maverick O/U');
build_models('firearm_model_shotgun_break_action',$options);
// Shoguns Semi Auto
$options = array('935','930','SA-20','SA-28','9200');
build_models('firearm_model_shotgun_semi_auto',$options);
// Shoguns Bolt Action
$options = array('695');
build_models('firearm_model_shotgun_bolt_action',$options);
// Centerfire Rifles Bolt Action
$options = array('Patriot','MVP','ATR','4X4','Maverick Rifle');
build_models('firearm_model_centerfire_rifle_bolt_action',$options);
// Centerfire Rifles Lever Action
$options = array('464 Centerfire');
build_models('firearm_model_centerfire_rifle_lever_action',$options);
// Centerfire Rifles Semi Auto
$options = array('MMR');
build_models('firearm_model_centerfire_rifle_semi_auto',$options);
// Rimfire Rifles Bolt Action
$options = array('801 Half Pint','802 Plinkster','817 HMR');
build_models('firearm_model_rimfire_rifle_bolt_action',$options);
// Rimfire Rifles Lever Action
$options = array('464 Rimfire');
build_models('firearm_model_rimfire_rifle_lever_action',$options);
// Rimfire Rifles Semi Auto
$options = array('Blaze','Blaze 47','702 Plinkster','715T Plinkster');
build_models('firearm_model_rimfire_rifle_semi_auto',$options);
// Handgun Semi Auto
$options = array('MC1sc');
build_models('firearm_model_handgun_semi_auto',$options);
// Pistol Semi Auto
$options = array('715P');
build_models('firearm_model_pistol_semi_auto',$options);
?>
</div>

<div id="firearm_ammo" style="display:none;">
<?php
// Shoguns Pump Action 500
$options = array('12 Gauge','20 Gauge','410 Bore');
build_ammo('firearm_ammo_500',$options);
// Shoguns Pump Action 590
$options = array('12 Gauge');
build_ammo('firearm_ammo_590',$options);
// Shoguns Pump Action 590A1
$options = array('12 Gauge');
build_ammo('firearm_ammo_590a1',$options);
// Shoguns Pump Action 535
$options = array('12 Gauge');
build_ammo('firearm_ammo_535',$options);
// Shoguns Pump Action 835
$options = array('12 Gauge');
build_ammo('firearm_ammo_835',$options);
// Shoguns Pump Action Maverick 88
$options = array('12 Gauge','20 Gauge');
build_ammo('firearm_ammo_maverick_88',$options);
// Shoguns Pump Action 505
$options = array('20 Gauge','410 Bore');
build_ammo('firearm_ammo_505',$options);
// Shoguns Pump Action 510
$options = array('20 Gauge','410 Bore');
build_ammo('firearm_ammo_510',$options);
// Shoguns Pump Action Maverick 91
$options = array('12 Gauge');
build_ammo('firearm_ammo_maverick_91',$options);

// Shoguns Break Action Silver Reserve
$options = array('12 Gauge','20 Gauge','410 Bore','28 Gauge');
build_ammo('firearm_ammo_silver_reserve',$options);
// Shoguns Break Action Maverick O/U
$options = array('12 Gauge');
build_ammo('firearm_ammo_maverick_o_u',$options);

// Shoguns Semi Auto 935
$options = array('12 Gauge');
build_ammo('firearm_ammo_935',$options);
// Shoguns Semi Auto 930
$options = array('12 Gauge');
build_ammo('firearm_ammo_930',$options);
// Shoguns Semi Auto SA-20
$options = array('20 Gauge');
build_ammo('firearm_ammo_sa_20',$options);
// Shoguns Semi Auto SA-28
$options = array('28 Gauge');
build_ammo('firearm_ammo_sa_28',$options);
// Shoguns Semi Auto 9200
$options = array('12 Gauge');
build_ammo('firearm_ammo_9200',$options);

// Shoguns Bolt Action 695
$options = array('12 Gauge');
build_ammo('firearm_ammo_695',$options);

// Centerfire Rifle Bolt Action Patriot
$options = array('.243 WIN','.308 WIN','.270 WIN','.30-06 SPRG','.300 WIN MAG','.375 Rug','6.5 Creedmoor','.22.250 REM','.25-06 REM','7MM MAG','7MM-08 REM','.338 WIN MAG','.270 WSM');
build_ammo('firearm_ammo_patriot',$options);
// Centerfire Rifle Bolt Action MVP
$options = array('5.56/.223','7.62/.308','6.5 Creedmoor','.204 Ruger');
build_ammo('firearm_ammo_mvp',$options);
// Centerfire Rifle Bolt Action ATR
$options = array('.243 WIN','.308 WIN','.270 WIN','.30-06 SPRG','.300 WIN MAG','.375 Rug','.22.250 REM','.25-06 REM','7MM-08 REM','.338 WIN MAG','.270 WSM');
build_ammo('firearm_ammo_atr',$options);
// Centerfire Rifle Bolt Action 4x4
$options = array('.243 WIN','.308 WIN','.270 WIN','.30-06 SPRG','.300 WIN MAG','.375 Rug','.22.250 REM','.25-06 REM','7MM-08 REM','.338 WIN MAG','.270 WSM');
build_ammo('firearm_ammo_4x4',$options);
// Centerfire Rifle Bolt Action Maverick Rifle
$options = array('.243 WIN','.270 WIN','.308 WIN','.30-06 SPRG');
build_ammo('firearm_ammo_maverick_rifle',$options);

// Centerfire Rifle Lever Action 464 Centerfire
$options = array('30-30 WIN');
build_ammo('firearm_ammo_464_centerfire',$options);

// Centerfire Rifle Semi Auto MMR
$options = array('5.56-.223');
build_ammo('firearm_ammo_mmr',$options);

// Rimfire Rifle Bolt Action 801 Half Pint
$options = array('.22 LR');
build_ammo('firearm_ammo_801_half_pint',$options);
// Rimfire Rifle Bolt Action 802 Plinkster
$options = array('.22 LR');
build_ammo('firearm_ammo_802_plinkster',$options);
// Rimfire Rifle Bolt Action 817 HMR
$options = array('.17 HMR');
build_ammo('firearm_ammo_817_hmr',$options);

// Rimfire Rifle Lever Action 464 Rimfire
$options = array('.22 LR');
build_ammo('firearm_ammo_464_rimfire',$options);

// Centerfire Rifle Semi Auto Blaze
$options = array('.22 LR');
build_ammo('firearm_ammo_blaze',$options);
// Centerfire Rifle Semi Auto Blaze 47
$options = array('.22 LR');
build_ammo('firearm_ammo_blaze_47',$options);
// Centerfire Rifle Semi Auto 702 Plinkster
$options = array('.22 LR');
build_ammo('firearm_ammo_702_plinkster',$options);
// Centerfire Rifle Semi Auto 715T Plinkster
$options = array('.22 LR');
build_ammo('firearm_ammo_715t_plinkster',$options);

// Hendgun Semi Auto MC1sc
$options = array('9mm');
build_ammo('firearm_ammo_mc1sc',$options);

// Pistol Semi Auto 715P
$options = array('.22 LR');
build_ammo('firearm_ammo_715p',$options);
?>
</div>

<div id="firearm_issue" style="display:none;">
Select Service Type(s) (you can describe in detail once the form is submitted) *<br/>
<?php
// Shotgun Pump Action
$options = array('0','1','2','3','6','9','10','11','12','13','14','16','17','20','21','23','26');
build_issues('firearm_issue_shotgun_pump_action', $options, $issues);
// Shotgun Break Action
$options = array('0','1','2','7','9','10','11','13','14','16','17','20','23','26');
build_issues('firearm_issue_shotgun_break_action', $options, $issues);
// Shotgun Semi Auto
$options = array('0','1','2','3','6','8','9','10','11','13','14','16','17','20','22','23','26');
build_issues('firearm_issue_shotgun_semi_auto', $options, $issues);
// Shotgun Bolt Action
$options = array('0','1','2','6','9','10','11','12','13','14','16','17','20','23','26');
build_issues('firearm_issue_shotgun_bolt_action', $options, $issues);
// Centerfire Rifle Bolt Action
$options = array('0','1','2','3','9','10','12','13','16','17','18','20','23','26');
build_issues('firearm_issue_centerfire_rifle_bolt_action', $options, $issues);
// Centerfire Rifle Lever Action
$options = array('0','1','2','3','9','10','12','13','16','17','19','20','23','26');
build_issues('firearm_issue_centerfire_rifle_lever_action', $options, $issues);
// Centerfire Rifle Semi Auto
$options = array('0','1','2','3','8','9','10','11','13','16','17','25','20','23','26');
build_issues('firearm_issue_centerfire_rifle_semi_auto', $options, $issues);
// Rimfire Rifle Bolt Action
$options = array('0','1','2','3','9','10','12','13','16','17','18','20','23','26');
build_issues('firearm_issue_rimfire_rifle_bolt_action', $options, $issues);
// Rimfire Rifle Lever Action
$options = array('0','1','2','3','9','10','12','13','16','17','19','20','23','26');
build_issues('firearm_issue_rimfire_rifle_lever_action', $options, $issues);
// Rimfire Rifle Semi Auto
$options = array('0','1','2','3','4','9','10','13','16','17','18','20','23','26');
build_issues('firearm_issue_rimfire_rifle_semi_auto', $options, $issues);
// Handgun Semi Auto
$options = array('0','1','2','3','9','10','13','16','17','18','20','23','27','28','26');
build_issues('firearm_issue_handgun_semi_auto', $options, $issues);
// Pistol Semi Auto
$options = array('0','1','2','3','9','10','13','16','17','18','20','23','26');
build_issues('firearm_issue_pistol_semi_auto', $options, $issues);
?>
</div>

I will send for service: *<br/>
<select name="firearm_shipped" id="firearm_shipped" class="form_dropdown" onchange="display_shipnote()">
<option value="Complete Firearm" <?php if($_POST['firearm_shipped']=='Complete Firearm') { echo "selected=\"selected\"";}?>>Complete Firearm</option>
<option value="Affected Compontent(s)" <?php if($_POST['firearm_shipped']=='Affected Compontent(s)') { echo "selected=\"selected\"";}?>>Affected Component(s) Only</option>
</select>
<p class="form_note" id="shipnote" style="display:none;">NOTE: To ensure our ability to perform service, we always recommend sending your complete firearm.</p>
</div>
<!-- Firearm -->

<!-- Issue
<h4>Service Details</h4>
<div class="form_section">
Please describe the issue(s) you are having with this firearm. *<br/>
<textarea name="issue_detail" class="form_textarea" id="issue_detail"><?php // if(isset($_POST['issue_detail'])) { echo stripslashes(sanitize_text_field($_POST['issue_detail']);}?></textarea>
</div>
 Issue -->

<!-- Contact -->
<h4>Contact</h4>
<div class="form_section">
Which address will this firearm be shipped from? *<br/>
<select name="dealer_owner" id="dealer_owner" class="form_dropdown" onchange="display_contact()">
<option value="">-</option>
<option value="Dealer" <?php if($_POST['dealer_owner']=='Dealer') { echo "selected=\"selected\"";}?>>Dealer's Address</option>
<option value="Firearm Owner" <?php if($_POST['dealer_owner']=='Firearm Owner') { echo "selected=\"selected\"";}?>>Firearm Owner's Address</option>
</select>
<p class="form_note">NOTE: A firearm will only be returned to the address from which it was shipped.</p>
<div id="contact_primary" style="display:none;">
Should we contact the Dealer or Firearm Owner regarding questions or charges associated with this repair? *<br/>
<select name="primary_contact" id="primary_contact" class="form_dropdown" onchange="display_primary()">
<option value="">-</option>
<option value="Dealer" <?php if($_POST['primary_contact']=='Dealer') { echo "selected=\"selected\"";}?>>Dealer</option>
<option value="Firearm Owner" <?php if($_POST['primary_contact']=='Firearm Owner') { echo "selected=\"selected\"";}?>>Firearm Owner</option>
</select>
</div>
<div id="contact_purchase" style="display:none;">
What was the approximate purchase date of the firearm?<br/>
<select name="purchase_month" id="purchase_month" class="form_dropdown form_field_half">
<option value="">Month</option>
<option value="01" <?php if($_POST['purchase_month']=='01') { echo "selected=\"selected\"";}?>>Jan</option>
<option value="02" <?php if($_POST['purchase_month']=='02') { echo "selected=\"selected\"";}?>>Feb</option>
<option value="03" <?php if($_POST['purchase_month']=='03') { echo "selected=\"selected\"";}?>>Mar</option>
<option value="04" <?php if($_POST['purchase_month']=='04') { echo "selected=\"selected\"";}?>>Apr</option>
<option value="05" <?php if($_POST['purchase_month']=='05') { echo "selected=\"selected\"";}?>>May</option>
<option value="06" <?php if($_POST['purchase_month']=='06') { echo "selected=\"selected\"";}?>>Jun</option>
<option value="07" <?php if($_POST['purchase_month']=='07') { echo "selected=\"selected\"";}?>>Jul</option>
<option value="08" <?php if($_POST['purchase_month']=='08') { echo "selected=\"selected\"";}?>>Aug</option>
<option value="09" <?php if($_POST['purchase_month']=='09') { echo "selected=\"selected\"";}?>>Sep</option>
<option value="10" <?php if($_POST['purchase_month']=='10') { echo "selected=\"selected\"";}?>>Oct</option>
<option value="11" <?php if($_POST['purchase_month']=='11') { echo "selected=\"selected\"";}?>>Nov</option>
<option value="12" <?php if($_POST['purchase_month']=='12') { echo "selected=\"selected\"";}?>>Dec</option>
</select>
<input name="purchase_year" type="text" class="form_field form_field_half" id="purchase_year" placeholder="Year" value="<?php if(isset($_POST['purchase_year'])) { echo stripslashes(sanitize_text_field($_POST['purchase_year']));}?>" />
</div>
</div>
<!-- Contact -->

<!-- Dealer -->
<div id="contact_dealer" style="display:none;">
<h4>Dealer Information</h4>
<div class="form_section">
Dealer Company Name *<br/>
<input name="dealer_company_name" type="text" class="form_field" id="dealer_company_name" value="<?php if(isset($_POST['dealer_company_name'])) { echo stripslashes(sanitize_text_field($_POST['dealer_company_name']));}?>" />
Dealer Contact First Name  *<br/>
<input name="dealer_contact_first_name" type="text" class="form_field" id="dealer_contact_first_name" value="<?php if(isset($_POST['dealer_contact_first_name'])) { echo stripslashes(sanitize_text_field($_POST['dealer_contact_first_name']));}?>" />
Dealer Contact Last Name  *<br/>
<input name="dealer_contact_last_name" type="text" class="form_field" id="dealer_contact_last_name" value="<?php if(isset($_POST['dealer_contact_last_name'])) { echo stripslashes(sanitize_text_field($_POST['dealer_contact_last_name']));}?>" />
Dealer Street Address (No PO Boxes) *<br/>
<input name="dealer_address" type="text" class="form_field" id="dealer_address" value="<?php if(isset($_POST['dealer_address'])) { echo stripslashes(sanitize_text_field($_POST['dealer_address']));}?>" />
Dealer City *<br/>
<input name="dealer_city" type="text" class="form_field" id="dealer_city" value="<?php if(isset($_POST['dealer_city'])) { echo stripslashes(sanitize_text_field($_POST['dealer_city']));}?>" />
Dealer State *<br/>
<?php $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HA'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota', 'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');?>
<select name="dealer_state" class="form_dropdown">
<option value="">-</option>
<?php 
foreach($states as $key => $value) { 
	echo "<option value=\"$key\""; 
	if($_POST['dealer_state'] == $key){ 
		echo 'selected';
	} 
	echo ">$value</option>"; 
} 
?>
</select>
Dealer Zip Code *<br/>
<input name="dealer_zip" type="text" class="form_field" id="dealer_zip" value="<?php if(isset($_POST['dealer_zip'])) { echo stripslashes(sanitize_text_field($_POST['dealer_zip']));}?>" />
Dealer Email Address *<br/>
<input name="dealer_email" type="text" class="form_field" id="dealer_email" value="<?php if(isset($_POST['dealer_email'])) { echo stripslashes(sanitize_text_field($_POST['dealer_email']));}?>" />
Dealer Phone Number *<br/>
<input name="dealer_phone" type="text" class="form_field" id="dealer_phone" value="<?php if(isset($_POST['dealer_phone'])) { echo stripslashes(sanitize_text_field($_POST['dealer_phone']));}?>" />
Upload FFL<br/>
<input name="dealer_ffl" type="file" class="form_upload" id="dealer_ffl"/>
<p class="form_note">NOTE: If you choose not to upload your FFL then you must include a copy in your shipment. Mossberg will not initiate a repair without your FFL.</p>
</div>
</div>
<!-- Dealer -->

<!-- Dealer Owner -->
<div id="contact_dealer_owner" style="display:none;">
<h4>Firearm Owner Information</h4>
<div class="form_section">
Owner First Name *<br/>
<input name="dealer_owner_first_name" type="text" class="form_field" id="dealer_owner_first_name" value="<?php if(isset($_POST['dealer_owner_first_name'])) { echo stripslashes(sanitize_text_field($_POST['dealer_owner_first_name']));}?>" />
Owner Last Name *<br/>
<input name="dealer_owner_last_name" type="text" class="form_field" id="dealer_owner_last_name" value="<?php if(isset($_POST['dealer_owner_last_name'])) { echo stripslashes(sanitize_text_field($_POST['dealer_owner_last_name']));}?>" />
Owner Email Address<br/>
<input name="dealer_owner_email" type="text" class="form_field" id="dealer_owner_email" value="<?php if(isset($_POST['dealer_owner_email'])) { echo stripslashes(sanitize_text_field($_POST['dealer_owner_email']));}?>" />
Owner Phone Number<br/>
<input name="dealer_owner_phone" type="text" class="form_field" id="dealer_owner_phone" value="<?php if(isset($_POST['dealer_owner_phone'])) { echo stripslashes(sanitize_text_field($_POST['dealer_owner_phone']));}?>" />
</div>
</div>
<!-- Dealer Owner -->

<!-- Owner -->
<div id="contact_owner" style="display:none;">
<h4>Firearm Owner Information</h4>
<div class="form_section">
Owner First Name *<br/>
<input name="owner_first_name" type="text" class="form_field" id="owner_first_name" value="<?php if(isset($_POST['owner_first_name'])) { echo stripslashes(sanitize_text_field($_POST['owner_first_name']));}?>" />
Owner Last Name *<br/>
<input name="owner_last_name" type="text" class="form_field" id="owner_last_name" value="<?php if(isset($_POST['owner_last_name'])) { echo stripslashes(sanitize_text_field($_POST['owner_last_name']));}?>" />
Owner Street Address (No PO Boxes)*<br/>
<input name="owner_address" type="text" class="form_field" id="owner_address" value="<?php if(isset($_POST['owner_address'])) { echo stripslashes(sanitize_text_field($_POST['owner_address']));}?>" />
Owner City *<br/>
<input name="owner_city" type="text" class="form_field" id="owner_city" value="<?php if(isset($_POST['owner_city'])) { echo stripslashes(sanitize_text_field($_POST['owner_city']));}?>" />
Owner State *<br/>
<?php $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HA'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota', 'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');?>
<select name="owner_state" class="form_dropdown">
<option value="">-</option>
<?php 
foreach($states as $key => $value) { 
	echo "<option value=\"$key\""; 
	if($_POST['owner_state'] == $key){ 
		echo 'selected';
	} 
	echo ">$value</option>"; 
} 
?>
</select>
Owner Zip Code *<br/>
<input name="owner_zip" type="text" class="form_field" id="owner_zip" value="<?php if(isset($_POST['owner_zip'])) { echo stripslashes(sanitize_text_field($_POST['owner_zip']));}?>" />
Owner Email Address *<br/>
<input name="owner_email" type="text" class="form_field" id="owner_email" value="<?php if(isset($_POST['owner_email'])) { echo stripslashes(sanitize_text_field($_POST['owner_email']));}?>" />
Owner Phone Number *<br/>
<input name="owner_phone" type="text" class="form_field" id="owner_phone" value="<?php if(isset($_POST['owner_phone'])) { echo stripslashes(sanitize_text_field($_POST['owner_phone']));}?>" />
</div>
</div>
<!-- Owner -->

<h4>Communication Preferences</h4>
<p class="form_reminder" style="display:block;">Would you like to receive email from Mossberg about new products, sales, special offers, news and events? * <a href="<?php echo get_bloginfo('url');?>/privacy-policy" target="_blank">Privacy Policy</a><br/>
<input type="radio" name="subscribe" value="Yes" <?php if($_POST['subscribe']=='Yes') { echo "checked=\"checked\"";}?> id="subscribe_yes" /> Yes <input type="radio" name="subscribe" value="No" <?php if($_POST['subscribe']=='No') { echo "checked=\"checked\"";}?> id="subscribe_no" /> No
</p>

<p class="form_reminder" style="display:block;"><input name="info_check" type="checkbox" value="Y" /> Check this box to confirm you have reviewed the request for accuracy.<br/>Once submitted you will need to contact customer service to make additions/edits.</p>

<input name="submit" type="submit" class="form_button" id="submit" value="SUBMIT REQUEST" onclick="processing()"/>
<div class="form_processing" id="processing" style="display:none;"><img src="<?php bloginfo('stylesheet_directory');?>/template/icons/icon-submitting.gif"/> Processing... Please be patient while your request is submitted.</div>
</form>

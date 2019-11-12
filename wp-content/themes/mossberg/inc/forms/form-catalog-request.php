<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data" name="catalog_request" id="catalog_request" class="form_body">
<h5>Contact/Shipping Information</h5>
<input name="email" type="text" class="form_field" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" />
<input name="firstname" type="text" class="form_field" id="firstname" placeholder="First Name" value="<?php if(isset($_POST['firstname'])) { echo sanitize_text_field($_POST['firstname']);}?>" />
<input name="lastname" type="text" class="form_field" id="lastname" placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) { echo sanitize_text_field($_POST['lastname']);}?>" />
<input name="address" type="text" class="form_field" id="address" placeholder="Address" value="<?php if(isset($_POST['address'])) { echo sanitize_text_field($_POST['address']);}?>" />
<input name="city" type="text" class="form_field" id="city" placeholder="City" value="<?php if(isset($_POST['city'])) { echo sanitize_text_field($_POST['city']);}?>" />
<?php 
$states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HA'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota', 'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');
?>
<select name="state" class="form_dropdown" id="state">
<option value="">State</option>
<?php 
foreach($states as $key => $value) { 
	echo "<option value=\"$key\""; 
	if(isset($_POST['state']) && $_POST['state'] == $key){ 
		echo "selected=\"selected\"";
	} 
	echo ">$value</option>"; 
} 
?>
</select>
<input name="zip" type="text" class="form_field" id="zip" placeholder="Zip" value="<?php if(isset($_POST['zip'])) { echo sanitize_text_field($_POST['zip']);}?>" />
<h5>I am interested in:</h5>
<p>
<input name="i_am_interested_in_1" type="checkbox" value="Deer Hunting" <?php if(isset($_POST['i_am_interested_in_1'])) { echo "checked=\"checked\"";}?>/> Deer Hunting<br/>
<input name="i_am_interested_in_2" type="checkbox" value="Waterfowl Hunting" <?php if(isset($_POST['i_am_interested_in_2'])) { echo "checked=\"checked\"";}?>/> Waterfowl Hunting<br/>
<input name="i_am_interested_in_3" type="checkbox" value="Turkey Hunting" <?php if(isset($_POST['i_am_interested_in_3'])) { echo "checked=\"checked\"";}?>/> Turkey Hunting<br/>
<input name="i_am_interested_in_4" type="checkbox" value="Tactical Firearms" <?php if(isset($_POST['i_am_interested_in_4'])) { echo "checked=\"checked\"";}?>/> Tactical Firearms<br/>
<input name="i_am_interested_in_5" type="checkbox" value="Home Security" <?php if(isset($_POST['i_am_interested_in_5'])) { echo "checked=\"checked\"";}?>/> Home Security<br/>
<input name="i_am_interested_in_6" type="checkbox" value="Law Enforcement/Military" <?php if(isset($_POST['i_am_interested_in_6'])) { echo "checked=\"checked\"";}?>/> Law Enforcement/Military<br/>
<input name="i_am_interested_in_7" type="checkbox" value="Sport Shooting" <?php if(isset($_POST['i_am_interested_in_7'])) { echo "checked=\"checked\"";}?>/> Sport Shooting<br/>
<input name="i_am_interested_in_8" type="checkbox" value="Shotguns" <?php if(isset($_POST['i_am_interested_in_8'])) { echo "checked=\"checked\"";}?>/> Shotguns<br/>
<input name="i_am_interested_in_9" type="checkbox" value="Rifles" <?php if(isset($_POST['i_am_interested_in_9'])) { echo "checked=\"checked\"";}?>/> Rifles<br/>
<input name="i_am_interested_in_10" type="checkbox" value="Handguns" <?php if(isset($_POST['i_am_interested_in_10'])) { echo "checked=\"checked\"";}?>/> Handguns
</p>

<div class="g-recaptcha" data-sitekey="6Ld2amUUAAAAAAtxOK3O30YbSLu8E2uLvJMCKaws"></div>
<p>&nbsp;</p>
<p>By submitting your email address, you agree to receive emails from Mossberg about new products, sales, special offers, news and events. Read our <a href="<?php echo get_bloginfo('url');?>/privacy-policy" target="_blank">Privacy Policy</a> to learn more.</p>
<input name="submit" type="submit" class="form_button" id="submit" value="REQUEST CATALOG &raquo;" onclick="form_action()" />
</form>

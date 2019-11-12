<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="post" enctype="multipart/form-data" name="trophy_upload" id="trophy_upload" class="form_body">
<h5>Contact Info</h5>
<input name="first_name" type="text" class="form_field" id="first_name" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) { echo sanitize_text_field($_POST['first_name']);}?>" />
<input name="last_name" type="text" class="form_field" id="last_name" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) { echo sanitize_text_field($_POST['last_name']);}?>" />
<input name="email" type="text" class="form_field" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" />
<input name="address" type="text" class="form_field" id="address" placeholder="Address" value="<?php if(isset($_POST['address'])) { echo sanitize_text_field($_POST['address']);}?>" />
<input name="city" type="text" class="form_field" id="city" placeholder="City" value="<?php if(isset($_POST['city'])) { echo sanitize_text_field($_POST['city']);}?>" />
<?php 
$states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HA'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota', 'OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming');
?>
<select name="state" class="form_dropdown">
<option value="">State</option>
<?php 
foreach($states as $key => $value) { 
	echo "<option value=\"$key\""; 
	if($_POST['state'] == $key){ 
		echo 'selected';
	} 
	echo ">$value</option>"; 
} 
?>
</select>
<input name="zip" type="text" class="form_field_small" id="zip" placeholder="Zip" value="<?php if(isset($_POST['zip'])) { echo sanitize_text_field($_POST['zip']);}?>" />
<h5>Photo Details</h5>
<input name="model" type="text" class="form_field" id="model" placeholder="Mossberg Product(s) Used" value="<?php if(isset($_POST['model'])) { echo sanitize_text_field($_POST['model']);}?>" />
<input name="species" type="text" class="form_field" id="species" placeholder="Species" value="<?php if(isset($_POST['species'])) { echo sanitize_text_field($_POST['species']);}?>" />
<input name="location" type="text" class="form_field" id="location" placeholder="Location" value="<?php if(isset($_POST['location'])) { echo sanitize_text_field($_POST['location']);}?>" />
<select name="trophy_month" class="form_dropdown">
<option value="">Month</option>
<option value="1" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '1') { echo "selected"; }?>>01</option>
<option value="2" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '2') { echo "selected"; }?>>02</option>
<option value="3" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '3') { echo "selected"; }?>>03</option>
<option value="4" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '4') { echo "selected"; }?>>04</option>
<option value="5" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '5') { echo "selected"; }?>>05</option>
<option value="6" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '6') { echo "selected"; }?>>06</option>
<option value="7" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '7') { echo "selected"; }?>>07</option>
<option value="8" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '8') { echo "selected"; }?>>08</option>
<option value="9" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '9') { echo "selected"; }?>>09</option>
<option value="10" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '10') { echo "selected"; }?>>10</option>
<option value="11" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '11') { echo "selected"; }?>>11</option>
<option value="12" <?php if(isset($_POST['trophy_month']) && $_POST['trophy_month'] == '12') { echo "selected"; }?>>12</option>
</select> 
<select name="trophy_year" class="form_dropdown">
<option value="">Year</option>
<?php
$end_year = date('Y');
$start_year = $end_year - 10;
foreach (range($start_year, $end_year) as $year) {
    echo "<option value=\"$year\"";
	if(isset($_POST['trophy_year']) && $_POST['trophy_year'] == $year) { 
		echo "selected"; 
	}
	echo ">$year</option>";
}
?>
</select>
<textarea name="story" class="form_textarea" id="story" placeholder="Your Story (optional)"><?php if(isset($_POST['story'])) { echo sanitize_text_field($_POST['story']);}?></textarea>
<h5>Upload Photo</h5>
<select name="room" class="form_dropdown">
<option value="">Select a Trophy Album</option>
<option value="deer-camp" <?php if(isset($_POST['room']) && $_POST['room'] == 'deer-camp') { echo "selected"; }?>>Deer Camp</option>
<option value="duck-camp" <?php if(isset($_POST['room']) && $_POST['room'] == 'duck-camp') { echo "selected"; }?>>Duck Camp</option>
<option value="turkey-camp" <?php if(isset($_POST['room']) && $_POST['room'] == 'turkey-camp') { echo "selected"; }?>>Turkey Camp</option>
<option value="dog-camp" <?php if(isset($_POST['room']) && $_POST['room'] == 'dog-camp') { echo "selected"; }?>>Hunting Dogs</option>
<option value="my-mossberg" <?php if(isset($_POST['room']) && $_POST['room'] == 'my-mossberg') { echo "selected"; }?>>My Mossberg (Other Game / Mossberg Pride)</option>
</select>
<div class="trophy_upload_field"><input name="upload" type="file" class="form_upload"/></div>
<h5> I am interested in:</h5>
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
<h4>Communication Preferences</h4>
<p class="form_reminder" style="display:block;">Would you like to receive email from Mossberg about new products, sales, and special offers? * <a href="<?php echo get_bloginfo('url');?>/privacy-policy" target="_blank">Privacy Policy</a><br/>
<input type="radio" name="subscribe" value="Yes" <?php if($_POST['subscribe']=='Yes') { echo "checked=\"checked\"";}?> id="subscribe_yes" /> Yes <input type="radio" name="subscribe" value="No" <?php if($_POST['subscribe']=='No') { echo "checked=\"checked\"";}?> id="subscribe_no" /> No
</p>
<p>
<input name="agree" type="checkbox" value="Y" <?php if(isset($_POST['agree'])) { echo "checked=\"checked\"";}?>/> <em>I have read and agree to the <a href="<?php bloginfo('home');?>/terms-of-use" target="_blank">Terms of Use</a></em>
</p>
<input name="submit" type="submit" class="form_button" id="submit" value="SUBMIT PHOTO" />
</form>

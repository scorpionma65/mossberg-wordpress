<script>
function form_action() {
	var current_action = document.getElementById('blaze_submission').action;
	var email = document.getElementById('email').value;
	var new_action = current_action+'?email='+encodeURIComponent(email);
	document.getElementById('blaze_submission').action = new_action;
}
</script>
<h3>STEP 1: To redeem online, begin by completing the form below.</h3>
<form action="<?php bloginfo('home');?>/blazeoffer/" method="post" enctype="multipart/form-data" name="blaze_submission" id="blaze_submission" class="form_body">
<h5>Select a Blaze Magazine type:</h5>
<select name="select_a_blaze_magazine_type" class="form_dropdown">
<option value="">-</option>
<option value="Two (2) 10-Round Magazines" <?php if(isset($_POST['select_a_blaze_magazine_type']) && $_POST['select_a_blaze_magazine_type'] == 'Two (2) 10-Round Magazines') { echo "selected"; }?>>Two (2) 10-Round Magazines</option>
<option value="Two (2) 25-Round Magazines" <?php if(isset($_POST['select_a_blaze_magazine_type']) && $_POST['select_a_blaze_magazine_type'] == 'Two (2) 25-Round Magazines') { echo "selected"; }?>>Two (2) 25-Round Magazines</option>
</select>
<h5>Contact Information</h5>
<input name="firstname" type="text" class="form_field" id="firstname" placeholder="First Name" value="<?php if(isset($_POST['firstname'])) { echo sanitize_text_field($_POST['firstname']);}?>" />
<input name="lastname" type="text" class="form_field" id="lastname" placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) { echo sanitize_text_field($_POST['lastname']);}?>" />
<input name="email" type="text" class="form_field" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" />
<input name="address" type="text" class="form_field" id="address" placeholder="Address" value="<?php if(isset($_POST['address'])) { echo sanitize_text_field($_POST['address']);}?>" />
<input name="city" type="text" class="form_field" id="city" placeholder="City" value="<?php if(isset($_POST['city'])) { echo sanitize_text_field($_POST['city']);}?>" />
<input name="state" type="text" class="form_field" id="state" placeholder="State" value="<?php if(isset($_POST['state'])) { echo sanitize_text_field($_POST['state']);}?>" />
<input name="zip" type="text" class="form_field" id="zip" placeholder="Zip" value="<?php if(isset($_POST['zip'])) { echo sanitize_text_field($_POST['zip']);}?>" />
<h5>May we add you to our email list?</h5>
<p><input name="may_we_add_you_to_our_email_list_" type="radio" value="Yes" checked="checked" /> Yes | <input name="may_we_add_you_to_our_email_list_" type="radio" value="No" /> No</p>
<h5> I am interested in:</h5>
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

<input name="submit" type="submit" class="form_button" id="submit" value="CONTINUE &raquo;" onclick="form_action()" />
</form>

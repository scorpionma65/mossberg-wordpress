<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data" name="community_promo" id="community_promo" class="form_body">
<input name="email" type="text" class="form_field" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" />
<strong>What best describes you?</strong>
<p>
<select name="hs_persona" class="form_dropdown">
<option value="">-</option>
<option value="persona_6">Hunter</option>
<option value="persona_7">Tactical/Home Defense</option>
<option value="persona_8">Sport Shooter</option>
<option value="persona_9">LE/Military</option>
</select>
</p>
<strong>I am interested in:</strong>
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
<p class="tab_form_notes">By submitting your email address, you agree to receive emails from Mossberg about new products, sales, special offers, news and events. Read our <a href="http://www.mossberg.com/privacy-policy" target="_blank">Privacy Policy</a> to learn more.</p>
<input name="submit" type="submit" class="form_button" id="submit" value="SIGN UP"/>
</form>

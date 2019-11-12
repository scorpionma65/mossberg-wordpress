<script>
function check_notes() {
	if(jQuery('#cart_stock').is(':checked')) {
		jQuery('#recoil_note').show();
		} else {
		jQuery('#recoil_note').hide();
	}
}
</script>
<form action="<?php echo $url;?>" method="post" name="flex_cart">
<table class="flex_cart_select">
<?php
// Forend
if($forend) {
	echo "<tr>
	<td><input name=\"cart_forend\" id=\"cart_forend\" type=\"checkbox\" value=\"".$forend['sku']."\" checked=\"checked\" /></td>
	<td>".$forend['name']."</td>
	</tr>";
}
if($stock) {
	echo "<tr>
	<td><input name=\"cart_stock\" id=\"cart_stock\" type=\"checkbox\" value=\"".$stock['sku']."\" checked=\"checked\" onclick=\"check_notes()\"/></td>
	<td>".$stock['name']." w/ 1.25\" FLEX Recoil Pad</td>
	</tr>";
}
if($recoil) {
	$recoil_checked = NULL;
	if($recoil['sku'] != '95211') {
		$recoil_checked = "checked=\"checked\"";
	}		
	echo "<tr>
	<td><input name=\"cart_recoil\" id=\"cart_recoil\" type=\"checkbox\" value=\"".$recoil['sku']."\" $recoil_checked onclick=\"check_notes()\"/></td>
	<td>".$recoil['name']."<div class=\"flex_cart_select_note\" id=\"recoil_note\">Note: The selected stock includes a 1.25\" Recoil Pad.</div></td>
	</tr>";
}
if($barrel) {
	echo "<tr>
	<td><input name=\"cart_barrel\" id=\"cart_barrel\" type=\"checkbox\" value=\"".$barrel['sku']."\" checked=\"checked\" /></td>
	<td>".$barrel['name']."</td>
	</tr>";
}
if($adapter) {
	echo "<tr>
	<td><input name=\"cart_adapter\" id=\"cart_adapter\" type=\"checkbox\" value=\"$adapter\" checked=\"checked\" /></td>
	<td>$adapter_name<div class=\"flex_cart_select_note\" id=\"recoil_note\">Note: 500, 590 and Maverick 88 firearms require a FLEX Adapter to use FLEX parts.</div></td>
	</tr>";
}
?>
</table>
<div class="flex_cart_login" <?php if(isset($_POST['submit_cart_register'])) { echo "style=\"display:none;\"";}?>>
<input name="username" type="text" placeholder="Username" value="<?php if(isset($_POST['username'])) { echo sanitize_text_field($_POST['username']);}?>" class="form_field"/>
<input name="password" type="password" placeholder="Password" value="<?php if(isset($_POST['password'])) { echo sanitize_text_field($_POST['password']);}?>" class="form_field"/>
<input name="submit_cart_login" type="submit" value="Add to Cart" class="form_button" onclick="ga('send', 'event', 'FLEX Cart', 'Click', '<?php echo $model_slug;?>');\" />
</div>
<div class="flex_cart_register" <?php if(isset($_POST['submit_cart_register'])) { echo "style=\"display:block;\"";}?>>
<input name="first_name" type="text" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) { echo sanitize_text_field($_POST['first_name']);}?>" class="form_field"/>
<input name="last_name" type="text" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) { echo sanitize_text_field($_POST['last_name']);}?>" class="form_field"/>
<input name="email" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" class="form_field"/>
<input name="password_one" type="password" placeholder="Password" value="<?php if(isset($_POST['password_one'])) { echo sanitize_text_field($_POST['password_one']);}?>" class="form_field"/>
<input name="password_two" type="password" placeholder="Confirm Password" value="<?php if(isset($_POST['password_two'])) { echo sanitize_text_field($_POST['password_two']);}?>" class="form_field"/>
<input name="submit_cart_register" type="submit" value="Register &amp; Add to Cart" class="form_button" onclick="ga('send', 'event', 'FLEX Cart', 'Click', '<?php echo $model_slug;?>');\" />
</div>
<input name="sku_list" id="sku_list" type="hidden" value="<?php echo $sku_list;?>" />
</form>
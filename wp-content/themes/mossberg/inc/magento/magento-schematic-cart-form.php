<form action="<?php echo get_bloginfo('home');?>/schematic?<?php echo sanitize_text_field($_SERVER['QUERY_STRING']);?>#cart" method="post" name="schematic_cart">
<div class="schematic_cart_login" <?php if(isset($_POST['submit_cart_register'])) { echo "style=\"display:none;\"";}?>>
<input name="username" type="text" placeholder="Username" value="<?php if(isset($_POST['username'])) { echo sanitize_text_field($_POST['username']);}?>" class="form_field"/>
<input name="password" type="password" placeholder="Password" value="<?php if(isset($_POST['password'])) { echo sanitize_text_field($_POST['password']);}?>" class="form_field"/>
<input name="submit_cart_login" type="submit" value="Add to Cart" class="form_button" />
</div>
<div class="schematic_cart_register" <?php if(isset($_POST['submit_cart_register'])) { echo "style=\"display:block;\"";}?>>
<input name="first_name" type="text" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) { echo sanitize_text_field($_POST['first_name']);}?>" class="form_field"/>
<input name="last_name" type="text" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) { echo sanitize_text_field($_POST['last_name']);}?>" class="form_field"/>
<input name="email" type="text" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" class="form_field"/>
<input name="password_one" type="password" placeholder="Password" value="<?php if(isset($_POST['password_one'])) { echo sanitize_text_field($_POST['password_one']);}?>" class="form_field"/>
<input name="password_two" type="password" placeholder="Confirm Password" value="<?php if(isset($_POST['password_two'])) { echo sanitize_text_field($_POST['password_two']);}?>" class="form_field"/>
<input name="submit_cart_register" type="submit" value="Register &amp; Add to Cart" class="form_button" />
</div>
<?php 
// SKU List
$active = array();
foreach($shop_skus as $key=>$value) {
	$name = 'sku'.$key;
	$cookie_check = $_COOKIE[$name];
	if($cookie_check) {
		$active[] = $key;
	}
}
$sku_list = implode(",", $active);
echo "<input name=\"sku_list\" id=\"sku_list\" type=\"hidden\" value=\"$sku_list\" />";
?>
</form>
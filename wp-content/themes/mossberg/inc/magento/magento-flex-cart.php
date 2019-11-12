<?php
// Message
$message = "<p>Review selections and enter your Username/Password to add to cart.<br/>Don't have an account? <a href=\"javascript:void(0);\" onclick=\"switch_form();\">Register Now &raquo;</a></p>";
$show = TRUE;

// Token
$token = FALSE;

// Skus
$skus = array();
if(isset($_POST['cart_forend'])) {
	$skus[] = sanitize_text_field($_POST['cart_forend']);
}
if(isset($_POST['cart_stock'])) {
	$skus[] = sanitize_text_field($_POST['cart_stock']);
}
if(isset($_POST['cart_recoil'])) {
	$skus[] = sanitize_text_field($_POST['cart_recoil']);
}
if(isset($_POST['cart_barrel'])) {
	$skus[] = sanitize_text_field($_POST['cart_barrel']);
}
if(isset($_POST['cart_adapter'])) {
	$skus[] = sanitize_text_field($_POST['cart_adapter']);
}

// Register
if(isset($_POST['submit_cart_register'])) {
		
	// Check
	if(!empty($_POST['first_name'])) {
		$first_name = sanitize_text_field($_POST['first_name']);
		} else {
		$first_name = FALSE;
		$message .= "<p>Please Enter your First Name</p>";
	}
	if(!empty($_POST['last_name'])) {
		$last_name = sanitize_text_field($_POST['last_name']);
		} else {
		$last_name = FALSE;
		$message .= "<p>Please Enter your Last Name</p>";
	}
	if(!empty($_POST['email'])) {
		$email = sanitize_text_field($_POST['email']);
		} else {
		$email = FALSE;
		$message .= "<p>Please Enter your Email Address</p>";
	}
	if(!empty($_POST['password_one'])) {
		$password_one = sanitize_text_field($_POST['password_one']);
		} else {
		$password_one = FALSE;
		$message .= "<p>Please Enter a Password</p>";
	}		
	if(!empty($_POST['password_two'])) {
		$password_two = sanitize_text_field($_POST['password_two']);
		} else {
		$password_two = FALSE;
		$message .= "<p>Please Confirm the Password</p>";
	}
	if($password_one && $password_two && $password_one == $password_two) {
		$password = $password_one;
		} else {
		$password = FALSE;
		$message .= "<p>Passwords do not match. Please try again.</p>";
	}
		
	if($first_name && $last_name && $email && $password) {
				
		// Register 
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');
		$userData = array("customer"=>array("email"=>$email,"firstname"=>$first_name,"lastname"=>$last_name),"password"=>$password);		
		$ch = curl_init($api_base."/store/index.php/rest/V1/customers");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))));
		$result = curl_exec($ch);
		curl_close($ch);
		
		// Token
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');
		$userData = array('username' => $email, 'password' => $password);
		$ch = curl_init($api_base."/store/index.php/rest/V1/integration/customer/token");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))));
		$result = curl_exec($ch);
		curl_close($ch);
		if($result && strpos($result,'message') === FALSE) {
			$token = json_decode($result);
			$success = 'R';
			} else {
			$token = FALSE;
		}
	}
}

// Login
if(isset($_POST['submit_cart_login'])) {
	//echo "<p>1. Submitted</p>";

	//Check
	if(!empty($_POST['username'])) {
		$username = sanitize_text_field($_POST['username']);
		} else {
		$username = FALSE;
		$message .= "<p>Please Enter your Username</p>";
	}
	if(!empty($_POST['password'])) {
		$password = sanitize_text_field($_POST['password']);
		} else {
		$password = FALSE;
		$message .= "<p>Please Enter your Password</p>";
	}
	if($username && $password) {
		//echo "<p>2. AUTH: $username / $password</p>";
		// Token
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');
		$userData = array('username' => $username, 'password' => $password);
		$ch = curl_init($api_base."/store/index.php/rest/V1/integration/customer/token");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))));
		$result = curl_exec($ch);
		curl_close($ch);
		if($result && strpos($result,'message') === FALSE) {
			$token = json_decode($result);
			$success = 'L';
			} else {
			$token = FALSE;
			$message .= '<p>We could not authenticate your Username/Password. Please try again.<br/>If you need password help, <a href="'.get_bloginfo('url').'"/store/customer/account/forgotpassword/" target="_blank">Click Here</a>';
			$show = TRUE;
		}
	}
}

// Cart
if($token) {
	//echo "<p>3. TOKEN: $token</p>";
	// Get Customer
	$method = 'GET';
	$url = $api_base."/store/index.php/rest/V1/customers/me"; 
	$content_array = NULL;
	$content_json = NULL;
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_HTTPHEADER => [
			'Authorization: Bearer ' . $token
		]
	]);
	$result = curl_exec($curl);
	curl_close($curl);
	$customer = json_decode($result);
	$customer_id = $customer->id;
	//echo "<p>4. CUST ID: $customer_id</p>";
	
	// Get Cart
	$method = 'GET';
	$url = $api_base."/store/index.php/rest/V1/carts/mine"; 
	$content_array = NULL;
	$content_json = NULL;
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_HTTPHEADER => [
			'Authorization: Bearer ' . $token,
			'Content-Type: application/json',
		]
	]);
	$result = curl_exec($curl);
	curl_close($curl);
	$cart = json_decode($result);
	$cart_id = $cart->id;
	//echo "<p>4a. CART ID: $cart_id</p>";
	
	// New Cart
	if(!$cart_id) {
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');
		$method = 'POST';
		$url = $api_base."/store/index.php/rest/V1/customers/$customer_id/carts"; 
		$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);
		$content_json = NULL;
		// Request
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_POST => '1',
			CURLOPT_POSTFIELDS => $content_json,
			CURLOPT_HTTPHEADER => [
				'Authorization: OAuth ' . http_build_query($data, '', ','),
				'Content-Type: application/json',
				'Content-Length: ' . strlen($content_json)
			]
		]);
		// Response
		$result = curl_exec($curl);
		curl_close($curl);
		$cart_id = json_decode($result);
		//echo "<p>4b. CART ID: $cart_id</p>";
	}
	
	// Add Items
	$items = array();
	foreach($skus as $key => $sku) {
		//echo "<p>5. SKU: $sku</p>";
		include(TEMPLATEPATH.'/inc/magento/magento-api-signature.php');
		$method = 'POST';
		$url = $api_base."/store/index.php/rest/V1/carts/$cart_id/items"; 
		$data['oauth_signature'] = sign($method, $url, $data, $consumerSecret, $accessTokenSecret);
		$content_array = array('cartItem'=>array('sku'=>$sku,'qty'=>'1','quoteId'=>$cart_id));
		$content_json = json_encode($content_array);
		// Request
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_POST => '1',
			CURLOPT_POSTFIELDS => $content_json,
			CURLOPT_HTTPHEADER => [
				'Authorization: OAuth ' . http_build_query($data, '', ','),
				'Content-Type: application/json',
				'Content-Length: ' . strlen($content_json)
			]
		]);
		// Response
		$result = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($result);
		$item = $response->sku;
		//echo "<p>6. ITEM: $item</p>";
		if($item) {
			//$message .= "<p>$item added successfully to cart.</p>";
			$items[] = $item;
			} else {
			$message .= "<p>SKU $sku could not be added to cart. This item is out of stock.</p>";
		}				
	}
	if($items) {
		switch($success) {
			case 'R':
			$message .= "<h3>Account Created and Item(s) Added. <a href=\"".get_bloginfo('url')."/store/customer/account/login/\" target=\"_parent\">Log In to View Cart &raquo;</a></h3>";
			break;
			case 'L':
			$message .= "<h3>Item(s) Added. <a href=\"".get_bloginfo('url')."/store/customer/account/login/\" target=\"_parent\">Log In to View Cart &raquo;</a></h3>";
			break;
		}
		$show = FALSE;
	}	
}
if($message) {
	echo $message;
}
if($show) {
	include(TEMPLATEPATH.'/inc/magento/magento-flex-cart-form.php');
}
?>
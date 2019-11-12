<!DOCTYPE html>
<html>
<head>
<style>
body { margin:0px; padding:0px; }
.model_buy_button { display:block; width:170px; height:50px; margin:0px; padding:0px; color:#182F63; float:left; }
.model_buy_button:link, .model_buy_button:visited { opacity:0.9; text-decoration:none; }
.model_buy_button:hover, .model_buy_button:active { opacity:1.0; text-decoration:none; }
</style>
</head>
<body>
<?php
error_reporting(0);
@ini_set('display_errors', 0);
// Buy NFDN
$product_upc = htmlspecialchars(trim($_GET['id']));
$product_msrp = (int)htmlspecialchars(trim($_GET['msrp']));
if($product_upc) {
	$product_buy_nfdn = "http://www.nfdnetwork.com/mossberg/catalog_detail.php?upc=$product_upc";
	$check_buy_nfdn = file_get_contents($product_buy_nfdn);
	if(strpos($check_buy_nfdn, '<div class="no_content">Coming Soon</div>') === FALSE){ 
		echo "<a href=\"$product_buy_nfdn\" target=\"_blank\" class=\"model_buy_button\" onclick=\"ga('send', 'event', 'Dealer Referral', 'Click', '$product_buy_nfdn', '$product_msrp');\" id=\"dealer_referral_nfdn\"><img src=\"https://www.mossberg.com/wp-content/themes/mossberg/template/buttons/button-buy-nfdn.png\"/></a>";
	}
}
?>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-40222409-1', 'auto');
ga('send', 'pageview');
</script>
<!-- Google Analytics -->
<!-- MSRP -->
<script>var msrp = <?php echo $product_msrp;?></script>
<!-- MSRP -->
<!-- HubSpot -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/479666.js"></script>
<!-- Hubspot -->
</body>
</html>
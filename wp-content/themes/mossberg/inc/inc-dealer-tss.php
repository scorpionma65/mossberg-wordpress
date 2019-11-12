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
// Buy TSS
$product_upc = htmlspecialchars(trim($_GET['id']));
$product_msrp = (int)htmlspecialchars(trim($_GET['msrp']));
if($product_upc) {
	$product_buy_tss = "http://www.theshootingstore.com/product.php?id=3555&upc=$product_upc";
	$check_buy_tss = file_get_contents($product_buy_tss);
	if(strpos($check_buy_tss, 'Product Not Found') === FALSE){ 
		echo "<a href=\"$product_buy_tss\" target=\"_blank\" class=\"model_buy_button\" onclick=\"ga('send', 'event', 'Dealer Referral', 'Click', '$product_buy_tss', '$product_msrp');\" id=\"dealer_referral_tss\"><img src=\"https://www.mossberg.com/wp-content/themes/mossberg/template/buttons/button-buy-tss.png\"/></a>";
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
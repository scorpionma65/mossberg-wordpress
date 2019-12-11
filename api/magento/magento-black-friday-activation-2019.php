<?php 
ini_set('max_execution_time', 1000);
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php include('../mysql/inc-mysql-connect-magento.php');?>
<?php
// Timezone
date_default_timezone_set('America/New_York');
$today = date('Ymd');
echo "<h3>$today</h3>";

// Categories
$category_base = '491';
$cat_batches = array(
	'20191124'=>array('492','493','495'),
	'20191125'=>array('496','497','498','499','500'),
	'20191126'=>array('501','502','503','504','505'),
	'20191127'=>array('506','507','508','509'),
	'20191128'=>array('510','511','512','513','514','515','516'),
	'20191129'=>array('517','518','519','520','521')
);

// Sale Pricing
$count = 0;
$sku_batches = array(
'20191124'=>array(
	'90119'=>'80',
	'11091OBFO'=>'80',
	'90140'=>'80',
	'90135'=>'80',
	'90021'=>'80',
	'90130'=>'80',
	'90122'=>'80',
	'90123'=>'80',
	'11091BUC'=>'80',
	'11091ODG'=>'80',
	'90015'=>'80',
	'90016'=>'80',
	'90018'=>'80',
	'90017'=>'80',
	'92156'=>'80',
	'92056'=>'80',
	'92049'=>'80',
	'90120'=>'80',
	'90121'=>'80',
	'92256'=>'80',
	'17241'=>'80',
	'90136'=>'80',
	'90061'=>'80',
	'17240OB'=>'80',
	'10301MT'=>'80',
	'90058'=>'80',
	'92010'=>'80',
	'92062'=>'80',
	'90060'=>'80',
	'90059'=>'80',
	'90064'=>'80',
	'90063'=>'80',
	'17369MT'=>'80',
	'95355'=>'80',
	'17366OB'=>'80',
	'91304'=>'80',
	'91303'=>'80',
	'91306'=>'80',
	'91305'=>'80',
	'91301'=>'80',
	'17243OB'=>'80',
	'102975OB'=>'80',
	'90831'=>'80',
	'92830'=>'80',
	'90806'=>'80',
	'90820'=>'80',
	'90835'=>'80',
	'90800'=>'80',
	'92802'=>'80',
	'90805'=>'80',
	'90807'=>'80',
	'16970YET'=>'80',
	'16970BL'=>'80',
	'93021'=>'80',
	'93035'=>'80',
	'93030'=>'80',
	'93010'=>'80',
	'93025'=>'80',
	'16975OBFO'=>'80',
	'16910OBFO'=>'80',
	'16822OB'=>'80',
	'90920'=>'80',
	'90913'=>'80',
	'90910'=>'80',
	'90912'=>'80',
	'90335'=>'80',
	'91335'=>'80',
	'93356'=>'80',
	'91356'=>'80',
	'92356'=>'80',
	'90048'=>'80',
	'91330'=>'80',
	'91048'=>'80',
	'103718MT'=>'80',
	'14757P'=>'80',
	'19226MT'=>'80',
	'3912'=>'80',
	'18915P'=>'80',
	'102061MT'=>'80',
	'102661MT'=>'80',
	'91302'=>'80',
	'102051MT'=>'80',
	'90808'=>'80',
	'90911'=>'80',
	'10003'=>'80',
	'93017'=>'80',
	'6702P'=>'80',
	'90055'=>'80',
	'90804'=>'80',
	'12775'=>'80',
	'93020'=>'80',
	'11091INF'=>'40',
	'17241INF'=>'40',
	'90936'=>'40',
	'101782MX5'=>'40',
	'90931'=>'40',
	'90938'=>'40',
	'16835MX4'=>'40',
	'16836INF'=>'40',
	'91310'=>'40',
	'19389INF'=>'40',
	'91300'=>'40',
	'17369MX4'=>'40',
	'93026'=>'40'
),
'20191125'=>array(
	'104237'=>'90',
	'104235'=>'90',
	'104236'=>'90',
	'104234'=>'90',
	'17030'=>'90',
	'17031'=>'90',
	'12153'=>'90',
	'95131'=>'90',
	'96202'=>'90',
	'103747'=>'80',
	'19990'=>'80',
	'102831'=>'80',
	'100480'=>'80',
	'100478'=>'80',
	'95300'=>'80',
	'95207'=>'80',
	'96201'=>'80',
	'96200'=>'80',
	'96203'=>'80',
	'18667'=>'80',
	'96206'=>'80',
	'96205'=>'80',
	'96207'=>'80',
	'96204'=>'70',
	'101071'=>'70',
	'101862'=>'70',
	'17604'=>'70',
	'100163'=>'70',
	'100472'=>'60',
	'100473'=>'50',
	'102936'=>'50'
),
'20191126'=>array(
	'16759'=>'90',
	'19764'=>'90',
	'19764BR'=>'90',
	'6495'=>'90',
	'101268'=>'90',
	'101504'=>'90',
	'101265BUC'=>'90',
	'102761'=>'90',
	'102371'=>'90',
	'102370'=>'90',
	'102644'=>'90',
	'102643'=>'90',
	'101265'=>'90',
	'101266'=>'90',
	'101501'=>'90',
	'102963'=>'90',
	'101502'=>'90',
	'16080'=>'90',
	'2090'=>'90',
	'16776'=>'80',
	'102358'=>'80',
	'95059'=>'80',
	'95025'=>'80',
	'95010'=>'80',
	'95000'=>'80',
	'95005'=>'80',
	'16325'=>'80',
	'95030'=>'80',
	'14672'=>'80',
	'95035'=>'80',
	'13608WS'=>'80',
	'13612WS'=>'80',
	'14480WS'=>'80',
	'17223'=>'80',
	'19002'=>'80',
	'12354bl'=>'80',
	'95051'=>'80',
	'16773'=>'80',
	'90565'=>'80',
	'95031'=>'80',
	'17946BL'=>'80',
	'13483WS'=>'80',
	'16936WS'=>'80',
	'16771WS'=>'80',
	'96023'=>'60',
	'95228'=>'60',
	'95221'=>'50',
	'95222'=>'50',
	'95219'=>'50',
	'96024'=>'50',
	'96025'=>'50',
	'96026'=>'50',
	'96027'=>'50',
	'96022'=>'50',
	'95223'=>'50',
	'95226'=>'50',
	'95227'=>'50',
	'95224'=>'50',
	'95216'=>'50',
	'95213'=>'50',
	'95217'=>'50',
	'95214'=>'50',
	'17827'=>'50',
	'95211'=>'50',
	'95212'=>'50',
	'95210'=>'50'
),
'20191127'=>array(
	'95033'=>'80',
	'95034'=>'80',
	'95036'=>'80',
	'95037'=>'80',
	'95135'=>'80',
	'95136'=>'80',
	'95137'=>'80',
	'95138'=>'80',
	'95139'=>'80',
	'95140'=>'80',
	'95346'=>'80',
	'95347'=>'80',
	'95415'=>'80',
	'95416'=>'80',
	'95702'=>'80',
	'95712'=>'80',
	'95713'=>'80',
	'95725'=>'80',
	'95803'=>'80',
	'95887'=>'80',
	'19841'=>'60',
	'19584'=>'50',
	'100008'=>'50',
	'100932'=>'50',
	'19944DH'=>'50'
),
'20191128'=>array(
	'99528'=>'80',
	'99529'=>'80',
	'99530'=>'80',
	'99531'=>'80',
	'99532'=>'80',
	'99533'=>'80',
	'99534'=>'80',
	'99535'=>'80',
	'99536'=>'80',
	'99537'=>'80',
	'99370'=>'80',
	'99371'=>'80',
	'99372'=>'80',
	'99373'=>'80',
	'99374'=>'80',
	'99375'=>'80',
	'99376'=>'80',
	'99377'=>'80',
	'97217'=>'80',
	'99254'=>'80',
	'99441'=>'80',
	'99442'=>'80',
	'97206'=>'80',
	'97196'=>'70',
	'99583'=>'70',
	'97239'=>'70',
	'97240'=>'70',
	'97241'=>'70',
	'97242'=>'70',
	'97243'=>'70',
	'97234'=>'70',
	'97235'=>'70',
	'97236'=>'70',
	'97237'=>'70',
	'97238'=>'70',
	'97229'=>'70',
	'97230'=>'70',
	'97231'=>'70',
	'97232'=>'70',
	'97233'=>'70',
	'99471'=>'70',
	'99338'=>'70',
	'99461'=>'70',
	'99462'=>'70',
	'99463'=>'70',
	'99464'=>'70',
	'99465'=>'70',
	'99494'=>'70',
	'99495'=>'70',
	'99496'=>'70',
	'99497'=>'70',
	'99498'=>'70',
	'99489'=>'70',
	'99490'=>'70',
	'99491'=>'70',
	'99492'=>'70',
	'99493'=>'70',
	'97223'=>'70',
	'97224'=>'70',
	'97225'=>'70',
	'97226'=>'70',
	'97227'=>'70',
	'97219'=>'70',
	'97220'=>'70',
	'97221'=>'70',
	'97222'=>'70',
	'97110'=>'60',
	'97115'=>'60',
	'97116'=>'60',
	'97121'=>'60',
	'97122'=>'60',
	'97127'=>'60',
	'97128'=>'60',
	'97143'=>'60',
	'97145'=>'60',
	'97149'=>'60',
	'97150'=>'60',
	'97151'=>'60',
	'97155'=>'60',
	'97156'=>'60',
	'97158'=>'60',
	'97162'=>'60',
	'99476'=>'60',
	'99477'=>'60',
	'97103'=>'60',
	'99341'=>'60',
	'99466'=>'60',
	'99468'=>'60',
	'99469'=>'60',
	'99470'=>'60',
	'97076'=>'60',
	'97077'=>'60',
	'97078'=>'60',
	'97079'=>'60',
	'97080'=>'60',
	'97081'=>'60',
	'97082'=>'60',
	'97083'=>'60',
	'97084'=>'60',
	'97085'=>'60',
	'99290'=>'60',
	'99351'=>'60',
	'99921'=>'50',
	'99922'=>'50',
	'99927'=>'50',
	'99928'=>'50',
	'99929'=>'50',
	'99932'=>'50',
	'97058'=>'50',
	'97059'=>'50',
	'97060'=>'50',
	'97123'=>'50',
	'97124'=>'50',
	'97125'=>'50',
	'97126'=>'50',
	'97105'=>'50',
	'97106'=>'50',
	'97092'=>'45',
	'97117'=>'45',
	'97118'=>'45',
	'97119'=>'45',
	'97120'=>'45',
	'97171'=>'45',
	'99472'=>'45',
	'99473'=>'45',
	'99474'=>'45',
	'99942'=>'45',
	'99944'=>'45',
	'99447'=>'45',
	'99448'=>'45',
	'99946'=>'45',
	'99264'=>'40',
	'97172'=>'40',
	'97167'=>'40'
),
'20191129'=>array(
	'93551'=>'80',
	'93550'=>'80',
	'102971'=>'80',
	'95558'=>'80',
	'99247'=>'70',
	'99256'=>'70',
	'101283'=>'70',
	'99248'=>'70',
	'105271'=>'70',
	'101284'=>'50'
)
);

// Categories
$categories = $cat_batches[$today];
if($categories) {
	echo "<h3>Categories: ".count($categories)."</h3>";
	$catcount = 0;
	foreach($categories as $category_id) {
		if($catcount == 0) {
			$subcategory_base = $category_id;
		}
		// Category Base
		$query = "SELECT m_catalog_category_entity.path FROM m_catalog_category_entity WHERE m_catalog_category_entity.row_id='$category_id'";
		$result = @mysql_query($query);
		$row = @mysql_fetch_array($result, MYSQL_NUM);
		$path = $row[0];
		if(strpos($path,$category_base) === FALSE) {
			$path_active = str_replace('/'.$subcategory_base,'/'.$category_base.'/'.$subcategory_base,$path);
			$query_base = "UPDATE m_catalog_category_entity SET path='$path_active' WHERE row_id='$category_id'";
			$result_base = @mysql_query($query_base);
		}
		// Activate Category
		$query_cat = "UPDATE m_catalog_category_entity_int SET value='1' WHERE attribute_id='43' AND row_id='$category_id'";
		$result_cat = @mysql_query($query_cat);
		echo "<p>ACTIVATE: $category_id</p>";
		$catcount++;
	}
}
echo mysql_error();

// Pricing
$skus = $sku_batches[$today];
if($skus) {
	echo "<h3>SKUs: ".count($skus)."</h3>";
	foreach($skus as $sku=>$discount) {
		if(strpos($sku,'CFG')===FALSE) {
			$count++;
			$query = "SELECT m_catalog_product_entity_decimal.value, m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
			WHERE m_catalog_product_entity.sku='$sku'
			AND m_catalog_product_entity.row_id=m_catalog_product_entity_decimal.row_id 
			AND m_catalog_product_entity_decimal.attribute_id='74'";
			$result = @mysql_query($query);
			$row = @mysql_fetch_array($result, MYSQL_NUM);
			$price = $row[0];
			$row_id = $row[1];
			$rate = $discount / 100;
			$special_price = number_format($price * $rate, 2);
			echo "<p>$sku // $row_id // $price >> $special_price</p>";
			// Set Special Price
			$query_c = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
			WHERE row_id='$row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
			$result_c = @mysql_query($query_c);
			if(@mysql_num_rows($result_c) == 1) {
				$query_u = "UPDATE m_catalog_product_entity_decimal SET value='$special_price' WHERE row_id='$row_id' AND attribute_id='75'";
				$result_u = @mysql_query($query_u);
				echo "<p>UPDATED: $sku | $row_id | \$$price | \$$special_price</p>";
				} else {
				if(@mysql_num_rows($result_c) == 0) {
					$query_i = "INSERT INTO m_catalog_product_entity_decimal (value, row_id, attribute_id) VALUES ('$special_price', '$row_id', '75')";
					$result_i = @mysql_query($query_i);
					echo "<p>ADDED: $sku | $row_id | \$$price | \$$special_price</p>";
				}
			}
		}
	}
}
echo mysql_error();
echo $count;

// End
if($today == '20191202') {
	// Skus
	foreach($sku_batches as $key => $sku_batch) {
		foreach($sku_batch as $sku => $discount) {			
			// Delete Special Price
			$query = "SELECT m_catalog_product_entity.row_id FROM m_catalog_product_entity WHERE m_catalog_product_entity.sku='$sku'";
			$result = @mysql_query($query);
			$row = @mysql_fetch_array($result, MYSQL_NUM);
			$row_id = $row[0];
			$query_d = "DELETE FROM m_catalog_product_entity_decimal WHERE row_id='$row_id' AND attribute_id='75'";
			$result_d = @mysql_query($query_d);
			echo "<p>ENDED: $sku</p>";
		}
		echo mysql_error();
	}
	// Categories
	foreach($cat_batches as $key => $cat_batch) {
		foreach($cat_batch as $key => $category_id) {			
			// Category Base
			$query = "SELECT m_catalog_category_entity.path FROM m_catalog_category_entity WHERE m_catalog_category_entity.row_id='$category_id'";
			$result = @mysql_query($query);
			$row = @mysql_fetch_array($result, MYSQL_NUM);
			$path = $row[0];
			if(strpos($path,$category_base) !== FALSE) {
				$path_inactive = str_replace('/'.$category_base, '',$path);
				$query_dbase = "UPDATE m_catalog_category_entity SET path='$path_inactive' WHERE row_id='$category_id'";
				$result_dbase = @mysql_query($query_dbase);
			}
			// Deactivate Category			
			$query_dcat = "UPDATE m_catalog_category_entity_int SET value='0' WHERE attribute_id='43' AND row_id='$category_id'";
			$result_dcat = @mysql_query($query_dcat);
			echo "<p>DEACTIVATE: $category_id</p>";
		}
		echo mysql_error();
	}
}

// Reindex
include('/data/mossberg/public_html/store/reindex.php'); 
?>

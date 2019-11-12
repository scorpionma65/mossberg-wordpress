<?php
// IP Protect
include(TEMPLATEPATH.'/inc/inc-ip-protect.php');
?>
<?php
/*
Template Name: Data
*/
ini_set('max_execution_time', 1000); 
?>
<?php get_header(); ?>
<div class="content_container">
<div class="content">
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');?>
<?php //include(TEMPLATEPATH.'/inc/inc-mysql-connect-magento.php');?>
<div class="content_twelve content_full">
<div class="container_text">
<?php
// Update Firearms Specs
$query = "SELECT * FROM data_firearms_new ORDER BY id ASC";
$result = @mysql_query($query);
while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
	$id = $row['data_id'];
	$sku = $row['sku'];
	$title = $row['name'];
	$gauge = $row['gauge'];
	$choke = $row['choke'];
	$caliber = $row['caliber'];
	$twist = $row['twist'];
	$capacity = $row['capacity'];
	$chamber = $row['chamber'];
	$lop = $row['lop'];
	$lop_type = $row['lop_type'];
	$sight_type = $row['sight'];
	$scope_type = $row['scope'];
	$barrel_length = $row['barrel_length'];	
	$barrel_type = $row['barrel_type'];
	$barrel_finish = $row['barrel_finish'];
	$stock_finish = $row['stock_finish'];
	$length = $row['length'];
	$weight = $row['weight'];
	$upc = $row['upc'];
	// UPC 
	if($upc && strlen($upc) == 11) {
		$upc = '0'.$upc;
	}
	// Product
	$update = FALSE;
	$id = wc_get_product_id_by_sku($sku);
	$post = array('ID' => $id, 'post_title'=>$title);
	$update = wp_update_post($post);
	if($update) {
		echo "<h3>$id // $title</h3>";
	}
	// Specs
	$specs = array(
	'_sku'=>$sku,
	'wpcf-gauge'=>$gauge,
	'wpcf-choke'=>$choke,
	'wpcf-caliber'=>$caliber,
	'wpcf-twist'=>$twist,
	'wpcf-capacity'=>$capacity,
	'wpcf-chamber'=>$chamber,
	'wpcf-lop'=>$lop,
	'wpcf-lop-type'=>$lop_type,
	'wpcf-sight-type'=>$sight_type,
	'wpcf-scope-type'=>$scope_type,
	'wpcf-barrel-length'=>$barrel_length,
	'wpcf-barrel-type'=>$barrel_type,
	'wpcf-barrel-finish'=>$barrel_finish,
	'wpcf-stock-finish'=>$stock_finish,
	'wpcf-length'=>$length,	
	'wpcf-weight'=>$weight,
	'wpcf-upc'=>$upc);
	
	foreach($specs as $key=>$value) {
		echo "<p>$key // $value</p>";
		update_post_meta($id, $key, $value);
	}
}

//// Magento Category Add
//$skus = array(
//'16776'=>'459',
//'95059'=>'459',
//'103749'=>'459',
//'95025'=>'459',
//'95010'=>'459',
//'95000'=>'459',
//'95005'=>'459',
//'16325'=>'459',
//'95030'=>'459',
//'14672'=>'459',
//'95035'=>'459',
//'13608WS'=>'459',
//'13612WS'=>'459',
//'14480WS'=>'459',
//'17223'=>'459',
//'19002'=>'459',
//'12354bl'=>'459',
//'95051'=>'459',
//'16773'=>'459',
//'90565'=>'459',
//'95031'=>'459',
//'17946BL'=>'459',
//'13483WS'=>'459',
//'19697'=>'459',
//'103746'=>'454',
//'102831'=>'454',
//'100478'=>'454',
//'17030'=>'454',
//'17031'=>'454',
//'12153'=>'454',
//'95131'=>'454',
//'17241'=>'448',
//'90136'=>'448',
//'90061'=>'448',
//'17240OB'=>'448',
//'90035'=>'448',
//'10301MT'=>'448',
//'90058'=>'448',
//'92010'=>'448',
//'92062'=>'448',
//'90060'=>'448',
//'90059'=>'448',
//'90064'=>'448',
//'90063'=>'448',
//'17369MT'=>'448',
//'95355'=>'448',
//'17366OB'=>'448',
//'91304'=>'448',
//'91303'=>'448',
//'91306'=>'448',
//'91305'=>'448',
//'91301'=>'448',
//'17243OB'=>'448',
//'102975OB'=>'448',
//'90831'=>'448',
//'92830'=>'448',
//'90806'=>'448',
//'90820'=>'448',
//'90835'=>'448',
//'90800'=>'448',
//'92802'=>'448',
//'90805'=>'448',
//'12105OBFOP'=>'448',
//'90807'=>'448',
//'16970YET'=>'448',
//'16970BL'=>'448',
//'93021'=>'448',
//'93035'=>'448',
//'93030'=>'448',
//'93010'=>'448',
//'93025'=>'448',
//'16975OBFO'=>'448',
//'16910OBFO'=>'448',
//'16822OB'=>'448',
//'90920'=>'448',
//'90913'=>'448',
//'90910'=>'448',
//'90912'=>'448',
//'90335'=>'448',
//'91335'=>'448',
//'93356'=>'448',
//'91356'=>'448',
//'92356'=>'448',
//'90048'=>'448',
//'91330'=>'448',
//'91048'=>'448');
//foreach($skus as $sku => $category_id) {
//	$query = "SELECT entity_id FROM m_catalog_product_entity WHERE sku='$sku' AND created_in='1'";
//	$result = @mysql_query($query);
//	$row = @mysql_fetch_array($result, MYSQL_NUM);
//	$entity_id = $row[0];
//	echo "$sku	$entity_id	$category_id<br/>";
//}

// Firearm Applications
//$applications = array(
//'security-shotguns'=>array('31027','31022','31048','50206','50205','85322','75780','75462','31046','31023','85223','85370','85360','50299','50645','52133','59817','50424','50778','50670'),
//'field-shotguns'=>array('75794','85213','75792','85001','75419','75417','75414','75412','75457','75772','75771','75445','32200','31010','85127','85122','85120','85110','45000','59810','59821','50126','56420','50120','56436','50136','50104','75789'),
//'turkey-shotguns-application'=>array('63527','62233','45212','52280','53265','54339','45239','85222','85270','81045','82540','75790'),
//'upland-shotguns'=>array('75794','85213','75792','85001','75419','75417','75414','75412','75457','75772','75771','85127','85123','85122','85120','85110','50126','50120','50136','50104','85139','75789'),
//'waterfowl-shotguns'=>array('63527','81023','81000','85212','85123','85122','63521','55128','85141','82042'),
//'slug-shotguns'=>array('31044','31017','85232','54233','54232'),
//'combo-shotguns'=>array('75441','75442','85325','85238','45310','59814','54243','54264','54169','54282','62437','52282','54183','53270','45209','45208','62419'),
//'flex-shotguns'=>array('54320','51672','50673','50124','55114','55117','55131','50121'),
//'military-le-shotguns'=>array('51689','51681','51683','51671','51773','51664','51771','53693','50771','59815','51668','51663','51660','50776','50774','50777'),
//'youth-shotguns'=>array('75769','75793','28027','28011','54160','50362','75770','32202','50485','50358','57120','57110','54250','54157','54210','59822','54188','54132','52132','50112','54218','54215','50355','50497'),
//'big-game-rifles'=>array('28009','28010','28007','28008','28006','28028','28005','28026','28000','27987','27982','27985','27983','27986','27984','27909','27929','27908','27907','27906','27904','27900','27894','27890','27882','27876','27861','27849','27835','27943','27942','27941','27940','27939','27936','27935','27934','27933','27932','27930','27928','27905','27902','27895','27892','27884','27877','27864','27851','27838','27901','27891','27883','27863','27931','27903','27893','27885','27866','27910'),
//'long-range-precision-rifles'=>array('27961','27962','28018','28016','28017','27784','27698','27697','27696'),
//'modern-sporting-rifles'=>array('65081','65035','65080','65074','65075'),
//'predator-varmint-rifles'=>array('27971','27972','27973','27974','27975','27785','27873','27874','27875','27967','27968','27969','27970','27729','27720','27724'),
//'security-rifles'=>array('27965','27966','27976','27977','27978','27979','27980','27981','27778','27798','27794','27742','27738','27716','27709','27699','27698','27746','27925','27924','27923','27793'),
//'youth-rifles'=>array('28027','28011','27867','27853','27840','27865','27852','27839','27862','27850','27837','27871')
//);
//foreach($applications as $key=>$value) {
//	$category = get_term_by('slug', $key, 'product_cat');
//	$category_id = array($category->term_id);	
//	echo "<h4>$key ($category_id)</h4>";
//	foreach($value as $sku) {
//		$query = "SELECT post_id FROM wp_postmeta WHERE meta_value='$sku' AND meta_key='_sku'";
//		$result = @mysql_query($query);
//		$row = @mysql_fetch_array($result,MYSQL_NUM);
//		$post_id = $row[0];
//		echo $sku." ($post_id)</br>";
//		wp_set_post_terms($post_id, $category_id, 'product_cat', true);
//	}
//}



// Match Products
//$query = "SELECT m_catalog_product_entity_varchar.value, m_catalog_product_entity.sku, m_catalog_product_entity.entity_id 
//FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
//WHERE m_catalog_product_entity_varchar.attribute_id='70' AND m_catalog_product_entity_varchar.row_id=m_catalog_product_entity.row_id";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$title = $row[0];
//	$sku = $row[1];
//	$entity = $row[2];
//	// Check
//	$query_c = "SELECT id FROM data_products WHERE sku='$sku'";
//	$result_c = @mysql_query($query_c);
//	if(@mysql_num_rows($result_c) == 0) {
//		echo "<p>$sku // $title</p>";
//	}
//}
//echo mysql_error();


//// Refresh Attributes
//$query = "SELECT m_eav_attribute.attribute_id, m_eav_attribute.frontend_label FROM m_eav_attribute  
//WHERE m_eav_attribute.entity_type_id='4' AND m_eav_attribute.attribute_id IN ('175','194','203','180','176','90','196','177','178','195','174','181','198','179','197') ORDER BY frontend_label ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$attribute_id = $row[0];
//	$attribute_name = $row[1];
//	echo "<p>$attribute_id // $attribute_name</p>";
//}
//echo "--------------------------------------------------";
//// Product Data
//$query = "SELECT * FROM data_products";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$id = $row['id'];
//	$sku = $row['sku'];
//	$title = $row['title'];
//	$a_barrel_finish = $row['a_barrel_finish'];
//	$a_barrel_length = $row['a_barrel_length'];
//	$a_caliber = $row['a_caliber'];
//	$a_case_size = $row['a_case_size'];
//	$a_choke_size = $row['a_choke_size'];
//	$a_color = $row['a_color'];
//	$a_gauge = $row['a_gauge'];
//	$a_heat_shield_finish = $row['a_heat_shield_finish'];
//	$a_magazine_action = $row['a_magazine_action'];
//	$a_model = $row['a_model'];
//	$a_rail_finish = $row['a_rail_finish'];
//	$a_size = $row['a_size'];
//	$a_stock_finish = $row['a_stock_finish'];
//	$a_stock_size = $row['a_stock_size'];
//	$a_type = $row['a_type'];
//	$c_parts = $row['c_parts'];
//	$c_by_model = $row['c_by_model'];
//	$c_500 = $row['c_500'];
//	$c_590 = $row['c_590'];
//	$c_535 = $row['c_535'];
//	$c_835 = $row['c_835'];
//	$c_930 = $row['c_930'];
//	$c_935 = $row['c_935'];
//	$c_silver_ii = $row['c_silver_ii'];
//	$c_maverick = $row['c_maverick'];
//	$c_patriot = $row['c_patriot'];
//	$c_mvp = $row['c_mvp'];
//	$c_blaze = $row['c_blaze'];
//	$c_mmr = $row['c_mmr'];
//	$c_464 = $row['c_464'];
//	$c_715t_715p = $row['c_715t_715p'];
//	$c_702 = $row['c_702'];
//	$c_flex = $row['c_flex'];
//	$c_802_817_801 = $row['c_802_817_801'];
//	$c_remington_870 = $row['c_remington_870'];
//	$c_590m = $row['c_590m'];
//	$c_590a1 = $row['c_590a1'];
//	
//	// Mage ID
//	$query_m = "SELECT row_id, entity_id FROM m_catalog_product_entity WHERE sku='$sku'";
//	$result_m = @mysql_query($query_m);
//	$row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC);
//	$row_id = $row_m['row_id'];
//	$entity_id = $row_m['entity_id'];
//	echo "<p>$id // $entity_id // $sku // $title<br/>ATTR: ";
//	
//	// Product Attributes Varchar
//	$query_av = "SELECT m_eav_attribute.frontend_label, m_catalog_product_entity_varchar.value FROM m_eav_attribute, m_catalog_product_entity_varchar  
//	WHERE m_catalog_product_entity_varchar.attribute_id=m_eav_attribute.attribute_id 
//	AND m_catalog_product_entity_varchar.attribute_id IN ('175','194','203','180','176','90','196','177','178','195','174','181','198','179','197')  
//	AND m_catalog_product_entity_varchar.row_id='$row_id'";
//	$result_av = @mysql_query($query_av);
//	while($row_av = @mysql_fetch_array($result_av, MYSQL_NUM)){
//		$attribute_av = $row_av['0'];
//		$attribute_av_value = $row_av['1'];
//		echo "<br/>$attribute_av // $attribute_av_value";
//		if($attribute_av_value != '') {
//			foreach(explode(',',$attribute_av_value) as $key => $value) {
//				$query_avo = "SELECT m_eav_attribute_option_value.value FROM  m_eav_attribute_option_value WHERE option_id='$value' AND store_id='0'";
//				$result_avo = @mysql_query($query_avo);
//				$row_avo = @mysql_fetch_array($result_avo, MYSQL_NUM);
//				$attribute_av_option = $row_avo[0];
//				echo " // $attribute_av_option";
//			}
//		}
//	}	
//	// Product Attributes Int
//	$query_ai = "SELECT m_eav_attribute.frontend_label, m_catalog_product_entity_int.value FROM m_eav_attribute, m_catalog_product_entity_int  
//	WHERE m_catalog_product_entity_int.attribute_id=m_eav_attribute.attribute_id 
//	AND m_catalog_product_entity_int.attribute_id IN ('175','194','203','180','176','90','196','177','178','195','174','181','198','179','197')  
//	AND m_catalog_product_entity_int.row_id='$row_id'";
//	$result_ai = @mysql_query($query_ai);
//	while($row_ai = @mysql_fetch_array($result_ai, MYSQL_NUM)){
//		$attribute_ai = $row_ai['0'];
//		$attribute_ai_value = $row_ai['1'];
//		echo "<br/>$attribute_ai // $attribute_ai_value";
//		if($attribute_ai_value != '') {
//			foreach(explode(',',$attribute_ai_value) as $key => $value) {
//				$query_aio = "SELECT m_eav_attribute_option_value.value FROM  m_eav_attribute_option_value WHERE option_id='$value' AND store_id='0'";
//				$result_aio = @mysql_query($query_aio);
//				$row_aio = @mysql_fetch_array($result_aio, MYSQL_NUM);
//				$attribute_ai_option = $row_aio[0];
//				echo " // $attribute_ai_option";
//			}
//		}
//	}
//	
//	// Clear Varchar Attributes
//	$query_avd = "DELETE FROM m_catalog_product_entity_varchar 
//	WHERE m_catalog_product_entity_varchar.row_id='$row_id' 
//	AND m_catalog_product_entity_varchar.attribute_id IN ('175','194','203','180','176','90','196','177','178','195','174','181','198','179','197')";
//	$result_avd = @mysql_query($query_avd);
//	$deleted = @mysql_affected_rows($result_avd);
//	if($deleted > 0) {
//		echo "DELETED: $deleted";
//	}
//	// Clear Int Attributes
//	$query_aid = "DELETE FROM m_catalog_product_entity_int 
//	WHERE m_catalog_product_entity_int.row_id='$row_id' 
//	AND m_catalog_product_entity_int.attribute_id IN ('175','194','203','180','176','90','196','177','178','195','174','181','198','179','197')";
//	$result_aid = @mysql_query($query_aid);
//	$deleted = @mysql_affected_rows($result_aid);
//	if($deleted > 0) {
//		echo "DELETED: $deleted";
//	}
//
//	// Update Attributes
//	$attributes = array(
//	'175'=>$a_barrel_finish,
//	'194'=>str_replace('"','&quot;',$a_barrel_length),
//	'203'=>$a_caliber,
//	'180'=>$a_case_size,
//	'176'=>$a_choke_size,
//	'90'=>$a_color,
//	'196'=>$a_gauge,
//	'177'=>$a_heat_shield_finish,
//	'178'=>$a_magazine_action,
//	'195'=>$a_model,
//	'174'=>$a_rail_finish,
//	'181'=>$a_size,
//	'198'=>$a_stock_finish,
//	'179'=>$a_stock_size,
//	'197'=>$a_type);
//	foreach($attributes as $key=>$value) {	
//		if($value != '') {
//			$type = FALSE;
//			switch($key) {
//				case '175':			
//				$type = 'int';
//				break;
//				case '194':			
//				$type = 'int';
//				break;
//				case '203':			
//				$type = 'var';
//				break;
//				case '180':			
//				$type = 'int';
//				break;
//				case '176':			
//				$type = 'int';
//				break;
//				case '90':			
//				$type = 'int';
//				break;
//				case '196':			
//				$type = 'int';
//				break;
//				case '177':			
//				$type = 'int';
//				break;
//				case '178':			
//				$type = 'int';
//				break;
//				case '195':			
//				$type = 'var';
//				break;
//				case '174':			
//				$type = 'int';
//				break;
//				case '181':			
//				$type = 'int';
//				break;
//				case '198':			
//				$type = 'int';
//				break;
//				case '179':			
//				$type = 'int';
//				break;
//				case '197':			
//				$type = 'int';
//				break;
//			}
//			// Update Int
//			if($type == 'int') {
//				$query_aiu = "SELECT m_eav_attribute_option_value.option_id FROM m_eav_attribute_option_value WHERE value='$value' AND store_id='0'";
//				$result_aiu = @mysql_query($query_aiu);
//				$row_aiu = @mysql_fetch_array($result_aiu, MYSQL_NUM);
//				$attribute_aiu_option = $row_aiu[0];
//								
//				echo "ADDED: ";
//				$query_aia = "INSERT INTO m_catalog_product_entity_int (attribute_id, store_id, row_id, value) VALUES ('$key', '0', '$row_id', '$attribute_aiu_option')";
//				$result_aia = @mysql_query($query_aia);
//				echo mysql_error();
//				echo "$value ($attribute_aiu_option) // ";
//			}
//			// Update Varchar
//			if($type == 'var') {
//				$csv = NULL;
//				foreach(explode(',',$value) as $v_key => $v_value) {
//					$query_avu = "SELECT m_eav_attribute_option_value.option_id FROM m_eav_attribute_option_value WHERE value='$v_value' AND store_id='0'";
//					$result_avu = @mysql_query($query_avu);
//					$row_avu = @mysql_fetch_array($result_avu, MYSQL_NUM);
//					$attribute_avu_option = $row_avu[0];
//					$csv .= $attribute_avu_option.',';
//				}
//				$csv_option = substr($csv,0,-1);
//				echo "ADDED: ";
//				$query_ava = "INSERT INTO m_catalog_product_entity_varchar (attribute_id, store_id, row_id, value) VALUES ('$key', '0', '$row_id', '$csv_option')";
//				$result_ava = @mysql_query($query_ava);
//				echo mysql_error();
//				echo "$value ($csv_option) // ";
//			}
//		}
//	}
//	echo "</p>";
//	
//}
//
//
//// Refresh Categories
//$query = "SELECT m_catalog_category_entity.row_id, m_catalog_category_entity_varchar.value FROM m_catalog_category_entity, m_catalog_category_entity_varchar 
//WHERE m_catalog_category_entity_varchar.row_id=m_catalog_category_entity.row_id AND m_catalog_category_entity_varchar.attribute_id='42' AND m_catalog_category_entity.parent_id IN ('3','4','5','311','330')";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$category_id = $row[0];
//	$category_name = $row[1];
//	echo "<p>$category_id // $category_name</p>";
//}
//echo "--------------------------------------------------";
//// Product Data
//$query = "SELECT * FROM data_products";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$id = $row['id'];
//	$sku = $row['sku'];
//	$title = $row['title'];
//	$a_barrel_finish = $row['a_barrel_finish'];
//	$a_barrel_length = $row['a_barrel_length'];
//	$a_caliber = $row['a_caliber'];
//	$a_case_size = $row['a_case_size'];
//	$a_choke_size = $row['a_choke_size'];
//	$a_color = $row['a_color'];
//	$a_gauge = $row['a_gauge'];
//	$a_heat_shield_finish = $row['a_heat_shield_finish'];
//	$a_magazine_action = $row['a_magazine_action'];
//	$a_model = $row['a_model'];
//	$a_rail_finish = $row['a_rail_finish'];
//	$a_size = $row['a_size'];
//	$a_stock_finish = $row['a_stock_finish'];
//	$a_stock_size = $row['a_stock_size'];
//	$a_type = $row['a_type'];
//	$c_parts = $row['c_parts'];
//	$c_by_model = $row['c_by_model'];
//	$c_500 = $row['c_500'];
//	$c_590 = $row['c_590'];
//	$c_535 = $row['c_535'];
//	$c_835 = $row['c_835'];
//	$c_930 = $row['c_930'];
//	$c_935 = $row['c_935'];
//	$c_silver_ii = $row['c_silver_ii'];
//	$c_maverick = $row['c_maverick'];
//	$c_patriot = $row['c_patriot'];
//	$c_mvp = $row['c_mvp'];
//	$c_blaze = $row['c_blaze'];
//	$c_mmr = $row['c_mmr'];
//	$c_464 = $row['c_464'];
//	$c_715t_715p = $row['c_715t_715p'];
//	$c_702 = $row['c_702'];
//	$c_flex = $row['c_flex'];
//	$c_802_817_801 = $row['c_802_817_801'];
//	$c_remington_870 = $row['c_remington_870'];
//	$c_590m = $row['c_590m'];
//	$c_590a1 = $row['c_590a1'];
//	
//	// Mage ID
//	$query_m = "SELECT row_id, entity_id FROM m_catalog_product_entity WHERE sku='$sku'";
//	$result_m = @mysql_query($query_m);
//	$row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC);
//	$row_id = $row_m['row_id'];
//	$entity_id = $row_m['entity_id'];
//	echo "<p>$id // $mage_id // $sku // $title<br/>CAT: ";
//	
//	// Product Categories
//	$query_c = "SELECT m_catalog_category_entity_varchar.value FROM m_catalog_category_entity_varchar, m_catalog_category_product 
//	WHERE m_catalog_category_entity_varchar.row_id=m_catalog_category_product.category_id 
//	AND m_catalog_category_entity_varchar.attribute_id='42'  
//	AND m_catalog_category_product.category_id IN ('312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','334','423','424') 
//	AND m_catalog_category_product.product_id='$entity_id'";
//	$result_c = @mysql_query($query_c);
//	while($row_c = @mysql_fetch_array($result_c, MYSQL_NUM)){
//		$category = $row_c['0'];
//		echo "$category // ";
//	}
//	
//	// Clear Categories
//	$query_c = "DELETE m_catalog_category_product FROM m_catalog_category_product, m_catalog_category_entity_varchar 
//	WHERE m_catalog_category_entity_varchar.row_id=m_catalog_category_product.category_id 
//	AND m_catalog_category_entity_varchar.attribute_id='42'  
//	AND m_catalog_category_product.category_id IN ('312','313','314','315','316','317','318','319','320','321','322','323','324','325','326','327','328','334','423','424') 
//	AND m_catalog_category_product.product_id='$entity_id'";
//	$result_c = @mysql_query($query_c);
//	$deleted = @mysql_affected_rows($result_c);
//	if($deleted > 0) {
//		echo "DELETED: $deleted";
//	}
//
//	// Update Categories
//	$categories = array(
//	'312'=>$c_500,
//	'313'=>$c_590,
//	'314'=>$c_535,
//	'315'=>$c_835,
//	'316'=>$c_930,
//	'317'=>$c_935,
//	'318'=>$c_silver_ii,
//	'319'=>$c_maverick,
//	'320'=>$c_patriot,
//	'321'=>$c_mvp,
//	'322'=>$c_blaze,
//	'323'=>$c_mmr,
//	'324'=>$c_464,
//	'325'=>$c_715t_715p,
//	'326'=>$c_702,
//	'327'=>$c_flex,
//	'328'=>$c_802_817_801,
//	'334'=>$c_remington_870,
//	'423'=>$c_590m,
//	'424'=>$c_590a1);
//	foreach($categories as $key=>$value) {	
//		if($value == 'X') {
//			echo "ADDED: ";
//			$query_a = "INSERT INTO m_catalog_category_product (category_id, product_id, position) VALUES ('$key', '$entity_id' ,'1')";
//			$result_a = @mysql_query($query_a);
//			echo "$value // ";
//		}
//	}
//	echo "</p>";
//	
//}
//echo mysql_error();

//	
//	// Check Description
//	$query_d = "SELECT value_id FROM m_catalog_product_entity_text WHERE attribute_id='72' AND row_id='$row_id'";
//	$result_d = @mysql_query($query_d);
//	if(@mysql_num_rows($result_d) == 0 && $description!='') {
//		$query_i = "INSERT INTO m_catalog_product_entity_text (attribute_id, store_id, row_id, value) VALUES ('72', '0', '$row_id', '$description')";
//		$result_i = @mysql_query($query_i);
//		echo "<p>ADDED: $sku / $description</p>";
//		} else {
//		$row_d = @mysql_fetch_array($result_d, MYSQL_NUM);
//		$value_id = $row_d[0];
//		$query_u = "UPDATE m_catalog_product_entity_text SET value='$description' WHERE value_id='$value_id' AND attribute_id='72'";
//		$result_u = @mysql_query($query_u);
//		echo "<p>UPDATED: $sku / $value_id / $description</p>";
//	}
//}

//// High Res Image Titles
//$args = array('post_type'=>'product','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc','post_status' => array('publish','draft'));
//query_posts($args);
//while(have_posts()):the_post();
//	$product_id = get_the_ID();
//	$product_title = $post->post_title;
//	$product_sku = get_post_meta(get_the_ID(), '_sku', true);
//	$highres_slug = $product_sku.'-media';
//	$highres = get_page_by_path($highres_slug);
//	$highres_id = 'X';
//	$highres_title = 'X';
//	$wpid = 'X';
//	if($highres) {
//		$highres_id = $highres->ID;
//		//$highres_title = $product_title.' - #'.$product_sku;
//		//$wpid = wp_update_post(array('ID'=>$highres_id, 'post_title'=>$highres_title));
//		$highres_categories = array('151');
//		wp_set_post_terms($highres_id, $highres_categories, 'media_category', false);
//	}
//	echo "<p>$product_id / $product_sku / $highres_slug / $highres_title / $highres_id / $wpid</p>";
//	
//endwhile;

//// Dealer CRM ID
//$query = "SELECT id, name, street, city, state, zip, phone, crm_account_id, crm_row_id FROM data_dealers_crm ORDER BY name ASC";
//$result = @mysql_query($query);
//echo "<table style=\"width:100%;\">
//<tr>
//<td>Dealer</td>
//<td>Street</td>
//<td>City</td>
//<td>State</td>
//<td>Zip</td>
//<td>Phone</td>
//<td>Account</td>
//<td>Row</td>
//<td>Match</td>
//</tr>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$dealer_id = $row[0];
//	$dealer_name = ucwords(strtolower(trim($row[1])));
//	$dealer_street = ucwords(strtolower(trim($row[2]))).' ';
//	$dealer_city = ucwords(strtolower(trim($row[3])));
//	$dealer_state = strtoupper(trim($row[4]));
//	$dealer_zip = trim($row[5]);
//	$dealer_phone = preg_replace("/[^0-9]/", "", trim($row[6]));
//	$dealer_account = $row[7];
//	$dealer_row = $row[8];
//		
//	// Zip
//	if($dealer_zip != '' && strlen($dealer_zip) < 5) {
//		$dealer_zip = '0'.$dealer_zip;
//	}
//	// Phone
//	if(strpos($dealer_phone, '1') === 0) {
//		$dealer_phone = substr($dealer_phone, 1);
//	}
//	if(strlen($dealer_phone) == 10) {
//		$phone1 = substr($dealer_phone,0,3);
//		$phone2 = substr($dealer_phone,3,3);
//		$phone3 = substr($dealer_phone,6,4);
//		$dealer_phone = "($phone1) $phone2-$phone3";
//	}
//	
//	// Street
//	$abbr = array(
//	'Ave'=>'Avenue',
//	'Ave.'=>'Avenue',
//	'St'=>'Street',
//	'St.'=>'Street',
//	'Rd'=>'Road',
//	'Rd.'=>'Road',
//	'Ln'=>'Lane',
//	'Ln.'=>'Lane',
//	'Hwy'=>'Highway',
//	'Hwy.'=>'Highway',
//	'Pkwy'=>'Parkway',
//	'Pkwy.'=>'Parkway',
//	'Blvd'=>'Boulevard',
//	'Blvd.'=>'Boulevard',
//	'Dr'=>'Drive',
//	'Dr.'=>'Drive',
//	'Tpk'=>'Turnpike',
//	'Tpk.'=>'Turnpike',
//	'Tpke'=>'Turnpike',
//	'Tpke.'=>'Turnpike',
//	'Rt'=>'Route',
//	'Rt.'=>'Route',
//	'Rte'=>'Route',
//	'Rte.'=>'Route',
//	'Terr'=>'Terrace',
//	'Terr.'=>'Terrace',
//	'Pl'=>'Place',
//	'Pl.'=>'Place',
//	'Cswy'=>'Causeway',
//	'Cswy.'=>'Causeway',	
//	'Ave,'=>'Avenue',
//	'Ave.,'=>'Avenue',
//	'St,'=>'Street',
//	'St.,'=>'Street',
//	'Rd,'=>'Road',
//	'Rd.,'=>'Road',
//	'Ln,'=>'Lane',
//	'Ln.,'=>'Lane',
//	'Hwy,'=>'Highway',
//	'Hwy.,'=>'Highway',
//	'Pkwy,'=>'Parkway',
//	'Pkwy.,'=>'Parkway',
//	'Blvd,'=>'Boulevard',
//	'Blvd.,'=>'Boulevard',
//	'Dr,'=>'Drive',
//	'Dr.,'=>'Drive',
//	'Tpk,'=>'Turnpike',
//	'Tpk.,'=>'Turnpike',
//	'Tpke,'=>'Turnpike',
//	'Tpke.,'=>'Turnpike',
//	'Rt,'=>'Route',
//	'Rt.,'=>'Route',
//	'Rte,'=>'Route',
//	'Rte.,'=>'Route',
//	'Terr,'=>'Terrace',
//	'Terr.,'=>'Terrace',
//	'Pl,'=>'Place',
//	'Pl.,'=>'Place',
//	'Cswy,'=>'Causeway',
//	'Cswy.,'=>'Causeway');
//	foreach($abbr as $key => $value) {
//		if(strpos($dealer_street, ' '.$key.' ') !== FALSE) {
//			$dealer_street = str_replace(' '.$key.' ', ' '.$value.' ', $dealer_street);
//		}
//	}
//	
//	
//	$dealer_match = NULL;
//	$query_m = "SELECT id, street, city, state FROM data_dealers_merge 
//	WHERE (street!='' AND street='$dealer_street') AND (city!='' AND city='$dealer_city') AND (state!='' AND state='$dealer_state')";
//	$result_m = @mysql_query($query_m);
//	if(@mysql_num_rows($result_m) > 0) {
//		$row_m = @mysql_fetch_array($result_m, MYSQL_NUM);
//		$dealer_match_id = $row_m['0'];
//		$dealer_match_street = $row_m['1'];
//		$dealer_match_city = $row_m['2'];
//		$dealer_match_state = $row_m['3'];
//		
//		// Update
//		$query_u = "UPDATE data_dealers_merge SET crm_account_id='$dealer_account', crm_row_id='$dealer_row' WHERE id='$dealer_match_id'";
//		$result_u = @mysql_query($query_u);
//		
//	}
//	
//	// Display
//	echo "<tr>
//	<td>$dealer_name</td>
//	<td>$dealer_street</td>
//	<td>$dealer_city</td>
//	<td>$dealer_state</td>
//	<td>$dealer_zip</td>
//	<td>$dealer_phone</td>
//	<td>$dealer_account</td>
//	<td>$dealer_row</td>
//	<td>$dealer_match_id // $dealer_match_street $dealer_match $dealer_match_state</td>
//	</tr>";
//}
//echo "</table>";


//// Merge Dealers
//$query = "SELECT dealer_id, dealer_name, dealer_street, dealer_city, dealer_state, dealer_zip, dealer_phone, dealer_website, dealer_email, dealer_type FROM data_dealers ORDER BY dealer_name ASC";
//$result = @mysql_query($query);
//echo "<table style=\"width:100%;\">
//<tr>
//<td>Dealer</td>
//<td>Street</td>
//<td>City</td>
//<td>State</td>
//<td>Zip</td>
//<td>Phone</td>
//<td>Website</td>
//<td>Email</td>
//<td>Type</td>
//<td>Match</td>
//</tr>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$dealer_id = $row[0];
//	$dealer_name = $row[1];
//	$dealer_street = $row[2];
//	$dealer_city = $row[3];
//	$dealer_state = $row[4];
//	$dealer_zip = $row[5];
//	$dealer_phone = $row[6];
//	$dealer_website = $row[7];
//	$dealer_email = $row[8];
//	$dealer_type = $row[9];
//	
//	$dealer_match = NULL;
//	if($dealer_type == 'W') {
//		$query_m = "SELECT * FROM data_dealers WHERE dealer_id!='$dealer_id' AND dealer_type!='$dealer_type' 
//		AND (dealer_phone!='' AND dealer_phone='$dealer_phone' OR dealer_street!='' AND dealer_street='$dealer_street')";
//		$result_m = @mysql_query($query_m);
//		if(@mysql_num_rows($result_m) > 0) {
//			$dealer_match = @mysql_num_rows($result_m);
//			$row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC);
//			$dealer_match_id = $row_m['dealer_id'];
//			if($dealer_phone == '') {
//				$dealer_phone = $row_m['dealer_phone'];
//			}
//			if($dealer_website == '') {
//				$dealer_website = $row_m['dealer_website'];
//			}
//			
//			if($dealer_email == '') {
//				$dealer_email = $row_m['dealer_email'];
//			}
//			$dealer_type = 'M';	
//			
//			// Update
//			$query_u = "UPDATE data_dealers SET dealer_phone='$dealer_phone', dealer_website='$dealer_website', dealer_email='$dealer_email', dealer_type='$dealer_type' WHERE dealer_id='$dealer_id'";
//			$result_u = @mysql_query($query_u);
//			
//			// Delete 
//			$query_d = "DELETE FROM data_dealers WHERE dealer_id='$dealer_match_id'";
//			$result_d = @mysql_query($query_d);
//		}
//	}
//	
//	// Display
//	echo "<tr>
//	<td>$dealer_name</td>
//	<td>$dealer_street</td>
//	<td>$dealer_city</td>
//	<td>$dealer_state</td>
//	<td>$dealer_zip</td>
//	<td>$dealer_phone</td>
//	<td>$dealer_website</td>
//	<td>$dealer_email</td>
//	<td>$dealer_type</td>
//	<td>$dealer_match</td>
//	</tr>";
//}
//echo "</table>";

// SKU Descriptions
//$query = "SELECT data_products.sku, data_products.description, m_catalog_product_entity.row_id FROM data_products, m_catalog_product_entity  
//WHERE m_catalog_product_entity.sku=data_products.sku";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$sku = $row[0];
//	$description = $row[1];
//	$row_id = $row[2];
//	
//	// Check Description
//	$query_d = "SELECT value_id FROM m_catalog_product_entity_text WHERE attribute_id='72' AND row_id='$row_id'";
//	$result_d = @mysql_query($query_d);
//	if(@mysql_num_rows($result_d) == 0 && $description!='') {
//		$query_i = "INSERT INTO m_catalog_product_entity_text (attribute_id, store_id, row_id, value) VALUES ('72', '0', '$row_id', '$description')";
//		$result_i = @mysql_query($query_i);
//		echo "<p>ADDED: $sku / $description</p>";
//		} else {
//		$row_d = @mysql_fetch_array($result_d, MYSQL_NUM);
//		$value_id = $row_d[0];
//		$query_u = "UPDATE m_catalog_product_entity_text SET value='$description' WHERE value_id='$value_id' AND attribute_id='72'";
//		$result_u = @mysql_query($query_u);
//		echo "<p>UPDATED: $sku / $value_id / $description</p>";
//	}
//}
//// Sale Pricing
//$count = 0;
//$skus = array('102061MT','17241','3912','103718MT','3905MT','102661MT','14757P','6702P','102051MT','17369MT');
//echo count($skus)."<br/>";
//$skip = array();
//echo count($skip)."<br/>";
//foreach($skus as $key=>$sku) {
//	if(!in_array($sku, $skip) && strpos($sku,'CFG')===FALSE) {
//		$count++;
//		$query = "SELECT m_catalog_product_entity_decimal.value, m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity, m_catalog_product_entity_decimal 
//		WHERE m_catalog_product_entity.sku='$sku'
//		AND m_catalog_product_entity.row_id=m_catalog_product_entity_decimal.row_id 
//		AND m_catalog_product_entity_decimal.attribute_id='74'";
//		$result = @mysql_query($query);
//		$row = @mysql_fetch_array($result, MYSQL_NUM);
//		$price = $row[0];
//		$row_id = $row[1];
//		$special_price = number_format($price * 0.70, 2);
//		//echo "<p>$sku // $row_id // $price >> $special_price</p>";
//		// Set Special Price
//		$query_c = "SELECT m_catalog_product_entity_decimal.row_id FROM m_catalog_product_entity_decimal 
//		WHERE row_id='$row_id' AND m_catalog_product_entity_decimal.attribute_id='75'";
//		$result_c = @mysql_query($query_c);
//		if(@mysql_num_rows($result_c) == 1) {
//			$query_u = "UPDATE m_catalog_product_entity_decimal SET value='$special_price' WHERE row_id='$row_id' AND attribute_id='75'";
//			$result_u = @mysql_query($query_u);
//			echo "<p>UPDATED: $sku | $row_id | \$$price | \$$special_price</p>";
//			} else {
//			if(@mysql_num_rows($result_c) == 0) {
//				$query_i = "INSERT INTO m_catalog_product_entity_decimal (value, row_id, attribute_id) VALUES ('$special_price', '$row_id', '75')";
//				$result_i = @mysql_query($query_i);
//				echo "<p>ADDED: $sku | $row_id | \$$price | \$$special_price</p>";
//			}
//		}
//		// Delete Special Price
//		//$query_d = "DELETE FROM m_catalog_product_entity_decimal WHERE row_id='$row_id' AND attribute_id='75'";
//		//$result_d = @mysql_query($query_d);
//	}
//}
//echo $count;
//// URL Key Check
//$query = "SELECT m_catalog_product_entity.row_id, m_catalog_product_entity.sku, m_catalog_product_entity_varchar.value, m_catalog_product_entity_int.value 
//FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_product_entity_int 
//WHERE m_catalog_product_entity.row_id=m_catalog_product_entity_varchar.row_id AND m_catalog_product_entity_varchar.attribute_id='70' 
//AND m_catalog_product_entity.row_id=m_catalog_product_entity_int.row_id AND m_catalog_product_entity_int.attribute_id='94' 
//ORDER BY m_catalog_product_entity.sku ASC";
//$result = @mysql_query($query);
//$count_404 = 0;
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$row_id = $row[0];
//	$sku = $row[1];
//	$name = $row[2];
//	$status = $row[3];
//	$url_key = sanitize_title($name).'-'.strtolower($sku);
//	if($name != '.' && $status == '1') {
//		$url = "http://stage00.mossberg.com/store/{$url_key}.html";
//		$ch = curl_init($url);
//		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
//		$response = curl_exec($ch);
//		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//		echo "<p>$status_code // $row_id // $sku // $url // $status</p>";
//		if($status_code == '404') {
//			$count_404++;
//		}
//		curl_close($handle);
//	}
//}
//echo "<h1>ERRORS: $count_404</h1>";
//// Activate/Deactivate Firearms
//
//$skus = array('50109','50429','54047','58244','50638','50639','50647','50648','52145','37071','37072','37073','37075','37076','38230','38232','38191','63102','68224','85331','81046','54330','54334','51665','50208','65082','28025','28034','28035','28040','28041','28013','28014','28019','28043','28044','28045','28046','28050','28052','28053','28054','28055','28056','28057','28058','28059','28060','28061','28062','28063','28064','28065','28066','28067','28068','28069','28070','28071','28072','28073','28074');
//
//foreach($skus as $sku) {
//
//	$query = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//
//	$result = @mysql_query($query);
//
//	$row = @mysql_fetch_array($result, MYSQL_NUM);
//
//	$wpid = $row[0];
//
//	$post = array('ID'=>$wpid, 'post_status'=>'publish', 'post_type'=>'product');
//
//	$post_id = wp_update_post($post);
//
//	echo "<p>$wpid - $post_id</p>";
//
//}
//// URL SKU Redirect
//$query = "SELECT m_catalog_product_entity.row_id, m_catalog_product_entity.sku, m_catalog_product_entity_varchar.value 
//FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
//WHERE m_catalog_product_entity.row_id=m_catalog_product_entity_varchar.row_id AND m_catalog_product_entity_varchar.attribute_id='70' 
//ORDER BY m_catalog_product_entity.sku ASC";
//$result = @mysql_query($query);
//$skus = array();
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$row_id = $row[0];
//	$sku = $row[1];
//	$name = $row[2];
//	if(!in_array($sku, $skus)) {
//		if($name != '.') {
//			$url_key = sanitize_title($name).'-'.strtolower($sku);
//			$sku_url = '/store/'.$sku.'.html';
//			$sef_url = '/store/'.$url_key.'.html';
//			echo "Redirect 301 $sku_url $sef_url <br/>";
//		}
//		$skus[] = $sku;
//	}
//}
//// Store Default Sync
//
//// Text
//$query = "SELECT m_catalog_product_entity_text.value_id, m_catalog_product_entity_text.attribute_id, m_catalog_product_entity_text.row_id, m_catalog_product_entity_text.value 
//FROM m_catalog_product_entity_text 
//WHERE m_catalog_product_entity_text.store_id='1' ORDER BY m_catalog_product_entity_text.attribute_id ASC";
//$result = @mysql_query($query);
//echo "<h1>TEXT ".mysql_num_rows($result)."------------------------------</h1>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)){
//	$value_id = $row[0];
//	$attribute_id = $row[1];
//	$row_id = $row[2];
//	$value = $row[3];
//	if($attribute_id = '72') {
//		$value = strip_tags($value, '<p><a><em><ul><li><br>');
//	}	
//	// Match
//	$query_m = "SELECT m_catalog_product_entity_text.value_id 
//	FROM m_catalog_product_entity_text 
//	WHERE m_catalog_product_entity_text.store_id='0' AND m_catalog_product_entity_text.attribute_id='$attribute_id' AND m_catalog_product_entity_text.row_id='$row_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)){
//		$match_value_id = $row_m[0];
//		// Replace
//		$query_u = "UPDATE m_catalog_product_entity_text SET m_catalog_product_entity_text.value='$value' WHERE m_catalog_product_entity_text.value_id='$match_value_id'";
//		$result_u = @mysql_query($query_u);		
//		echo "<p>$value_id [$match_value_id] / $attribute_id / $row_id / $value</p>";
//	}
//}
//// Varchar
//$query = "SELECT m_catalog_product_entity_varchar.value_id, m_catalog_product_entity_varchar.attribute_id, m_catalog_product_entity_varchar.row_id, m_catalog_product_entity_varchar.value 
//FROM m_catalog_product_entity_varchar 
//WHERE m_catalog_product_entity_varchar.store_id='1' ORDER BY m_catalog_product_entity_varchar.attribute_id ASC";
//$result = @mysql_query($query);
//echo "<h1>VARCHAR ".mysql_num_rows($result)."------------------------------</h1>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)){
//	$value_id = $row[0];
//	$attribute_id = $row[1];
//	$row_id = $row[2];
//	$value = $row[3];
//	// Match
//	$query_m = "SELECT m_catalog_product_entity_varchar.value_id 
//	FROM m_catalog_product_entity_varchar 
//	WHERE m_catalog_product_entity_varchar.store_id='0' AND m_catalog_product_entity_varchar.attribute_id='$attribute_id' AND m_catalog_product_entity_varchar.row_id='$row_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)){
//		$match_value_id = $row_m[0];
//		// Replace
//		$query_u = "UPDATE m_catalog_product_entity_varchar SET m_catalog_product_entity_varchar.value='$value' WHERE m_catalog_product_entity_varchar.value_id='$match_value_id'";
//		$result_u = @mysql_query($query_u);		
//		echo "<p>$value_id [$match_value_id] / $attribute_id / $row_id / $value</p>";
//	}
//}
//// Int
//$query = "SELECT m_catalog_product_entity_int.value_id, m_catalog_product_entity_int.attribute_id, m_catalog_product_entity_int.row_id, m_catalog_product_entity_int.value 
//FROM m_catalog_product_entity_int 
//WHERE m_catalog_product_entity_int.store_id='1' ORDER BY m_catalog_product_entity_int.attribute_id ASC";
//$result = @mysql_query($query);
//echo "<h1>INT ".mysql_num_rows($result)."------------------------------</h1>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)){
//	$value_id = $row[0];
//	$attribute_id = $row[1];
//	$row_id = $row[2];
//	$value = $row[3];
//	// Match
//	$query_m = "SELECT m_catalog_product_entity_int.value_id 
//	FROM m_catalog_product_entity_int 
//	WHERE m_catalog_product_entity_int.store_id='0' AND m_catalog_product_entity_int.attribute_id='$attribute_id' AND m_catalog_product_entity_int.row_id='$row_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)){
//		$match_value_id = $row_m[0];
//		// Replace
//		$query_u = "UPDATE m_catalog_product_entity_int SET m_catalog_product_entity_int.value='$value' WHERE m_catalog_product_entity_int.value_id='$match_value_id'";
//		$result_u = @mysql_query($query_u);		
//		echo "<p>$value_id [$match_value_id] / $attribute_id / $row_id / $value</p>";
//	}
//}
//// Decimal
//$query = "SELECT m_catalog_product_entity_decimal.value_id, m_catalog_product_entity_decimal.attribute_id, m_catalog_product_entity_decimal.row_id, m_catalog_product_entity_decimal.value 
//FROM m_catalog_product_entity_decimal 
//WHERE m_catalog_product_entity_decimal.store_id='1' ORDER BY m_catalog_product_entity_decimal.attribute_id ASC";
//$result = @mysql_query($query);
//echo "<h1>DECIMAL ".mysql_num_rows($result)."------------------------------</h1>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)){
//	$value_id = $row[0];
//	$attribute_id = $row[1];
//	$row_id = $row[2];
//	$value = $row[3];
//	// Match
//	$query_m = "SELECT m_catalog_product_entity_decimal.value_id 
//	FROM m_catalog_product_entity_decimal 
//	WHERE m_catalog_product_entity_decimal.store_id='0' AND m_catalog_product_entity_decimal.attribute_id='$attribute_id' AND m_catalog_product_entity_decimal.row_id='$row_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)){
//		$match_value_id = $row_m[0];
//		// Replace
//		$query_u = "UPDATE m_catalog_product_entity_decimal SET m_catalog_product_entity_decimal.value='$value' WHERE m_catalog_product_entity_decimal.value_id='$match_value_id'";
//		$result_u = @mysql_query($query_u);		
//		echo "<p>$value_id [$match_value_id] / $attribute_id / $row_id / $value</p>";
//	}
//}
//// Datetime
//$query = "SELECT m_catalog_product_entity_datetime.value_id, m_catalog_product_entity_datetime.attribute_id, m_catalog_product_entity_datetime.row_id, m_catalog_product_entity_datetime.value 
//FROM m_catalog_product_entity_datetime 
//WHERE m_catalog_product_entity_datetime.store_id='1' ORDER BY m_catalog_product_entity_datetime.attribute_id ASC";
//$result = @mysql_query($query);
//echo "<h1>DATETIME ".mysql_num_rows($result)."------------------------------</h1>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)){
//	$value_id = $row[0];
//	$attribute_id = $row[1];
//	$row_id = $row[2];
//	$value = $row[3];
//	// Match
//	$query_m = "SELECT m_catalog_product_entity_datetime.value_id 
//	FROM m_catalog_product_entity_datetime 
//	WHERE m_catalog_product_entity_datetime.store_id='0' AND m_catalog_product_entity_datetime.attribute_id='$attribute_id' AND m_catalog_product_entity_datetime.row_id='$row_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)){
//		$match_value_id = $row_m[0];
//		// Replace
//		$query_u = "UPDATE m_catalog_product_entity_datetime SET m_catalog_product_entity_datetime.value='$value' WHERE m_catalog_product_entity_datetime.value_id='$match_value_id'";
//		$result_u = @mysql_query($query_u);		
//		echo "<p>$value_id [$match_value_id] / $attribute_id / $row_id / $value</p>";
//	}
//}
//
//// Clear Default Store View
//
//// Text
//$query_t = "DELETE FROM m_catalog_product_entity_text WHERE store_id='1'";
//$result_t = @mysql_query($query_t);
//// Varchar
//$query_v = "DELETE FROM m_catalog_product_entity_varchar WHERE store_id='1'";
//$result_v = @mysql_query($query_v);
//// Int
//$query_i = "DELETE FROM m_catalog_product_entity_int WHERE store_id='1'";
//$result_i = @mysql_query($query_i);
//// Decimal
//$query_d = "DELETE FROM m_catalog_product_entity_decimal WHERE store_id='1'";
//$result_d = @mysql_query($query_d);
//// Datetime
//$query_h = "DELETE FROM m_catalog_product_entity_datetime WHERE store_id='1'";
//$result_h = @mysql_query($query_h);
//
//// URL Key Update
//$query = "SELECT m_catalog_product_entity.row_id, m_catalog_product_entity.sku, m_catalog_product_entity_varchar.value 
//FROM m_catalog_product_entity, m_catalog_product_entity_varchar 
//WHERE m_catalog_product_entity.row_id=m_catalog_product_entity_varchar.row_id AND m_catalog_product_entity_varchar.attribute_id='70' 
//ORDER BY m_catalog_product_entity.sku ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$row_id = $row[0];
//	$sku = $row[1];
//	$name = $row[2];
//	$url_key = sanitize_title($name).'-'.strtolower($sku);
//	//$url_key = strtolower($sku);
//	if($name != '.') {
//		echo "<p>$row_id / $sku / $name / $url_key</p>";
//		$query_m = "SELECT value_id, value FROM m_catalog_product_entity_varchar WHERE row_id='$row_id' AND attribute_id='117'";
//		$result_m = @mysql_query($query_m);
//		if(@mysql_num_rows($result_m) > 0) {
//			while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)) {
//				$value_id = $row_m[0];
//				$query_u = "UPDATE m_catalog_product_entity_varchar SET value='$url_key' WHERE value_id='$value_id'";
//				$result_u = @mysql_query($query_u);		
//			}
//		}
//	}
//}
//
//// Clear Product URL Rewrites
//$query = "DELETE FROM m_url_rewrite WHERE entity_type='product'";
//$result = @mysql_query($query);
//// Databox Daily Sales
//$begin = new DateTime('2016-10-01');
//$end   = new DateTime('now');
//
//for($i = $begin; $i <= $end; $i->modify('+1 day')){
//    $start_day = $i->format("Y-m-d");
//	$end_day = date("Y-m-d",strtotime($start_day . '+1 days'));
//	
//	$query = "SELECT 
//	SUM(subtotal) AS subtotal, 
//	SUM(shipping_amount) AS shipping, 
//	SUM(tax_amount) AS tax, 
//	SUM(grand_total) AS total, 
//	COUNT(entity_id) AS orders 
//	FROM m_sales_order 
//	WHERE (created_at BETWEEN '$start_day' AND '$end_day') AND status!='canceled' AND status!='pending' AND status!='repair'";
//	$result = @mysql_query($query);
//	$row = @mysql_fetch_array($result, MYSQL_NUM);
//	$subtotal = round($row[0],0);
//	$shipping = round($row[1],0);
//	$tax = round($row[2],0);
//	$total = round($row[3],0);
//	$orders = $row[4];
//	
//	$query_i = "INSERT INTO databox_sales_daily (subtotal, shipping, tax, total, orders, date) VALUES ('$subtotal', '$shipping', '$tax', '$total', '$orders', '$start_day')";
//	$result_i = @mysql_query($query_i);
//	echo "<p>$start_day - $subtotal / $shipping / $tax / $total / $orders</p>";
//}
//// New Product Add
//$query = "SELECT * FROM data_firearms_new ORDER BY name";
//$result = @mysql_query($query);
//echo "<table style=\"font-size:8px;\">
//<tr style=\"background:#EEE;\";>
//<td>id</td>
//<td>wpid</td>
//<td>sku</td>
//<td>name</td>
//<td>gauge</td>
//<td>choke</td>
//<td>caliber</td>
//<td>twist</td>
//<td>capacity</td>
//<td>chamber</td>
//<td>lop</td>
//<td>lop_type</td>
//<td>sight</td>
//<td>scope</td>
//<td>barrel_length</td>
//<td>barrel_type</td>
//<td>barrel_finish</td>
//<td>stock_finish</td>
//<td>length</td>
//<td>weight</td>
//<td>msrp</td>
//<td>upc</td>
//<td>slug</td>
//</tr>";
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$id = $row['id'];
//	$sku = $row['sku'];
//	$name = $row['name'];
//	$type = $row['type'];
//	$series = $row['series'];
//	$subseries = $row['subseries'];
//	$activity = $row['activity'];
//	$gauge = $row['gauge'];
//	$choke = $row['choke'];
//	$caliber = $row['caliber'];
//	$twist = $row['twist'];
//	$capacity = $row['capacity'];
//	$chamber = $row['chamber'];
//	$lop = $row['lop'];
//	$lop_type = $row['lop_type'];
//	$sight = $row['sight'];
//	$scope = $row['scope'];
//	$barrel_length = $row['barrel_length'];
//	$barrel_type = $row['barrel_type'];
//	$barrel_finish = $row['barrel_finish'];
//	$stock_finish = $row['stock_finish'];	
//	$length = $row['length'];
//	$weight = $row['weight'];
//	$msrp = $row['msrp'];
//	$upc = $row['upc'];
//	$slug = $row['guid'];
//	$categories = $row['categories'];
//	$terms = explode('##', $categories);
//	$image = get_bloginfo('url')."/wp-content/uploads/2018/01/{$sku}-catalog.jpg";
//	$image_id = get_attachment_id_from_url($image);
//	
//	// Check Update
//	$query_c = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//	$result_c = @mysql_query($query_c);
//	if(@mysql_num_rows($result_c) > 0) {
//		$row_c = @mysql_fetch_array($result_c, MYSQL_NUM);
//		$wpid = $row_c[0];
//		echo "<p>$sku // Update $wpid</p>";
//		
//		// Update Product
//		$post = array('ID'=>$wpid, 'post_title'=>$name, 'post_status'=>'publish', 'post_author'=>1, 'post_name'=>$slug);
//		wp_update_post($post);
//
//		// Add Meta
//		update_post_meta($wpid, 'wpcf-gauge', $gauge);
//		update_post_meta($wpid, 'wpcf-choke', $choke);
//		update_post_meta($wpid, 'wpcf-caliber', $caliber);
//		update_post_meta($wpid, 'wpcf-twist', $twist);	
//		update_post_meta($wpid, 'wpcf-capacity', $capacity);
//		update_post_meta($wpid, 'wpcf-chamber', $chamber);
//		update_post_meta($wpid, 'wpcf-lop', $lop);
//		update_post_meta($wpid, 'wpcf-lop-type', $lop_type);
//		update_post_meta($wpid, 'wpcf-sight-type', $sight);
//		update_post_meta($wpid, 'wpcf-scope-type', $scope);	
//		update_post_meta($wpid, 'wpcf-barrel-length', $barrel_length);
//		update_post_meta($wpid, 'wpcf-barrel-type', $barrel_type);
//		update_post_meta($wpid, 'wpcf-barrel-finish', $barrel_finish);
//		update_post_meta($wpid, 'wpcf-stock', $stock_finish);
//		update_post_meta($wpid, 'wpcf-length', $length);
//		update_post_meta($wpid, 'wpcf-weight', $weight);
//		update_post_meta($wpid, 'wpcf-upc', $upc);
//		update_post_meta($wpid, '_sku', $sku);
//		update_post_meta($wpid, '_price', $msrp);
//		update_post_meta($wpid, '_regular_price', $msrp);
//		update_post_meta($wpid, '_thumbnail_id', $image_id);
//		wp_set_object_terms($wpid, $terms, 'product_cat', true);
//		
//		} else {
//		echo "<p>$sku // Add</p>";
//			
//		// Add Product
//		$post = array('post_title'=>$name, 'post_status'=>'publish', 'post_author'=>1, 'post_type'=>'product', 'post_name'=>$slug);
//		$wpid = wp_insert_post($post);
//		// Add Meta
//		add_post_meta($wpid, 'wpcf-gauge', $gauge);
//		add_post_meta($wpid, 'wpcf-choke', $choke);
//		add_post_meta($wpid, 'wpcf-caliber', $caliber);
//		add_post_meta($wpid, 'wpcf-twist', $twist);	
//		add_post_meta($wpid, 'wpcf-capacity', $capacity);
//		add_post_meta($wpid, 'wpcf-chamber', $chamber);
//		add_post_meta($wpid, 'wpcf-lop', $lop);
//		add_post_meta($wpid, 'wpcf-lop-type', $lop_type);
//		add_post_meta($wpid, 'wpcf-sight-type', $sight);
//		add_post_meta($wpid, 'wpcf-scope-type', $scope);	
//		add_post_meta($wpid, 'wpcf-barrel-length', $barrel_length);
//		add_post_meta($wpid, 'wpcf-barrel-type', $barrel_type);
//		add_post_meta($wpid, 'wpcf-barrel-finish', $barrel_finish);
//		add_post_meta($wpid, 'wpcf-stock', $stock_finish);
//		add_post_meta($wpid, 'wpcf-length', $length);
//		add_post_meta($wpid, 'wpcf-weight', $weight);
//		add_post_meta($wpid, 'wpcf-upc', $upc);
//		add_post_meta($wpid, '_sku', $sku);
//		add_post_meta($wpid, '_price', $msrp);
//		add_post_meta($wpid, '_regular_price', $msrp);
//		add_post_meta($wpid, '_thumbnail_id', $image_id);
//		wp_set_object_terms($wpid, $terms, 'product_cat', true);
//	}
//	
//	echo "<tr>
//	<td>$id</td>
//	<td>$wpid</td>
//	<td>$sku</td>
//	<td>$name</td>
//	<td>$gauge</td>
//	<td>$choke</td>
//	<td>$caliber</td>
//	<td>$twist</td>
//	<td>$capacity</td>
//	<td>$chamber</td>
//	<td>$lop</td>
//	<td>$lop_type</td>
//	<td>$sight</td>
//	<td>$scope</td>
//	<td>$barrel_length</td>
//	<td>$barrel_type</td>
//	<td>$barrel_finish</td>
//	<td>$stock_finish</td>
//	<td>$length</td>
//	<td>$weight</td>
//	<td>$msrp</td>
//	<td>$upc</td>
//	<td>$slug</td>
//	</tr>";
//}
//echo "</table>";
//// New Product Categories
//$args = array('post_type'=>'product','product_cat'=>'new','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc','post_status' => array('publish'));
//query_posts($args);
//while(have_posts()):the_post();
//	$product_id = get_the_ID();
//	$product_title = get_the_title();
//	$product_sku = get_post_meta($product_id, '_sku', true);
//	$categories = wp_get_post_terms($product_id, 'product_cat');
//	$terms = array();
//	foreach($categories as $term) {
//		$terms[] = $term->slug;
//	}
//	$term_list = implode('##', $terms);
//	
//	$query_u = "UPDATE data_firearms_new SET categories='$term_list' WHERE sku='$product_sku'";
//	$result_u = @mysql_query($query_u);
//	
//	echo "<p>$product_id / $product_sku / $product_title / $term_list</p>";
//endwhile;
//// New Product Update
//$query = "SELECT * FROM data_firearms_new ORDER BY name";
//$result = @mysql_query($query);
//echo "<table style=\"font-size:8px;\">
//<tr style=\"background:#EEE;\";>
//<td>id</td>
//<td>wpid</td>
//<td>sku</td>
//<td>name</td>
//<td>gauge</td>
//<td>choke</td>
//<td>caliber</td>
//<td>twist</td>
//<td>capacity</td>
//<td>chamber</td>
//<td>lop</td>
//<td>lop_type</td>
//<td>sight</td>
//<td>scope</td>
//<td>barrel_length</td>
//<td>barrel_type</td>
//<td>barrel_finish</td>
//<td>stock_finish</td>
//<td>length</td>
//<td>weight</td>
//<td>msrp</td>
//<td>upc</td>
//<td>slug</td>
//</tr>";
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$id = $row['id'];
//	$sku = $row['sku'];
//	$name = $row['name'];
//	$type = $row['type'];
//	$series = $row['series'];
//	$subseries = $row['subseries'];
//	$activity = $row['activity'];
//	$gauge = $row['gauge'];
//	$choke = $row['choke'];
//	$caliber = $row['caliber'];
//	$twist = $row['twist'];
//	$capacity = $row['capacity'];
//	$chamber = $row['chamber'];
//	$lop = $row['lop'];
//	$lop_type = $row['lop_type'];
//	$sight = $row['sight'];
//	$scope = $row['scope'];
//	$barrel_length = $row['barrel_length'];
//	$barrel_type = $row['barrel_type'];
//	$barrel_finish = $row['barrel_finish'];
//	$stock_finish = $row['stock_finish'];	
//	$length = $row['length'];
//	$weight = $row['weight'];
//	$msrp = $row['msrp'];
//	$upc = $row['upc'];
//	$slug = $row['guid'];
//	
//	// Image
//	$image_new = "http://stage00.mossberg.com/wp-content/uploads/2018/01/{$sku}-catalog.jpg";
//	$image_id = get_attachment_id_from_url($image_new);
//	
//	// WPID
//	$query_w = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//	$result_w = @mysql_query($query_w);
//	$row_w = @mysql_fetch_array($result_w, MYSQL_NUM);
//	$wpid = $row_w[0];
//	
//	// Update Meta
//	update_post_meta($wpid, 'wpcf-gauge', $gauge);
//	update_post_meta($wpid, 'wpcf-choke', $choke);
//	update_post_meta($wpid, 'wpcf-caliber', $caliber);
//	update_post_meta($wpid, 'wpcf-twist', $twist);	
//	update_post_meta($wpid, 'wpcf-capacity', $capacity);
//	update_post_meta($wpid, 'wpcf-chamber', $chamber);
//	update_post_meta($wpid, 'wpcf-lop', $lop);
//	update_post_meta($wpid, 'wpcf-lop-type', $lop_type);
//	update_post_meta($wpid, 'wpcf-sight-type', $sight);
//	update_post_meta($wpid, 'wpcf-scope-type', $scope);	
//	update_post_meta($wpid, 'wpcf-barrel-length', $barrel_length);
//	update_post_meta($wpid, 'wpcf-barrel-type', $barrel_type);
//	update_post_meta($wpid, 'wpcf-barrel-finish', $barrel_finish);
//	update_post_meta($wpid, 'wpcf-stock', $stock_finish);
//	update_post_meta($wpid, 'wpcf-length', $length);
//	update_post_meta($wpid, 'wpcf-weight', $weight);
//	update_post_meta($wpid, 'wpcf-upc', $upc);
//	update_post_meta($wpid, '_price', $msrp);
//	update_post_meta($wpid, '_thumbnail_id', $image_id);
//	
//	// Update Product
//	$post = array('ID'=>$wpid,'post_title'=>$name,'post_name'=>$slug);
//	wp_update_post($post);
//		
//	echo "<tr>
//	<td>$id</td>
//	<td>$wpid</td>
//	<td>$sku</td>
//	<td>$name</td>
//	<td>$gauge</td>
//	<td>$choke</td>
//	<td>$caliber</td>
//	<td>$twist</td>
//	<td>$capacity</td>
//	<td>$chamber</td>
//	<td>$lop</td>
//	<td>$lop_type</td>
//	<td>$sight</td>
//	<td>$scope</td>
//	<td>$barrel_length</td>
//	<td>$barrel_type</td>
//	<td>$barrel_finish</td>
//	<td>$stock_finish</td>
//	<td>$length</td>
//	<td>$weight</td>
//	<td>$msrp</td>
//	<td>$upc</td>
//	<td>$slug</td>
//	</tr>";
//}
//echo "</table>";
// New Product MSRP
//$args = array('post_type'=>'product','product_cat'=>'new','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc','post_status' => array('publish', 'draft'));
//query_posts($args);
//while(have_posts()):the_post();
//	$product_id = get_the_ID();
//	$product_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
//	$product_sku = get_post_meta(get_the_ID(), '_sku', true);
//	$product_upc = get_post_meta(get_the_ID(), 'wpcf-upc', true);
//	$product_price = get_post_meta(get_the_ID(), '_price', true);
//	$product_regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
//	$product_image_new = "http://stage00.mossberg.com/wp-content/uploads/2018/01/{$product_sku}-catalog.jpg";
//	$product_image_new_id = get_attachment_id_from_url($product_image_new);
//	
////	// Get UPC
////	$query_u = "SELECT firearm_upc FROM data_firearms WHERE firearm_sku='$product_sku'";
////	$result_u = @mysql_query($query_u);
////	$row_u = @mysql_fetch_array($result_u, MYSQL_NUM);
////	$product_upc = $row_u[0];	
////	// Update UPC
////	//add_post_meta($product_id, 'wpcf-upc', $product_upc);			
//	
//	echo "<p>$product_id / $product_sku / $product_upc / $product_price / $product_regular_price / $product_image</p>";
//	
//endwhile;
	
//// MSRP Update
//$query = "SELECT * FROM data_firearms";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$id = $row['firearm_id'];
//	$sku = $row['firearm_sku'];
//	$type = ucwords(strtolower($row['firearm_type']));
//	$family = ucwords(strtolower($row['firearm_family']));
//	$subcat = ucwords(strtolower($row['firearm_subcat']));
//	$optic = $row['firearm_optic'];
//	$description = ucwords(strtolower($row['firearm_description']));
//	$capacity = ucwords(strtolower($row['firearm_capacity']));
//	$ammo = ucwords(strtolower($row['firearm_ammo']));
//	$barrel = ucwords(strtolower($row['firearm_barrel']));
//	$choke = ucwords(strtolower($row['firearm_choke']));
//	$barrel_finish = ucwords(strtolower($row['firearm_barrel_finish']));
//	$stock_finish = ucwords(strtolower($row['firearm_stock_finish']));
//	$msrp = $row['firearm_msrp'];
//	$upc = $row['firearm_upc'];
//	$delete = $row['firearm_delete'];
//	$new = $row['firearm_new'];
//	$title = "$type $family $subcat";
	
	// Delete
//	if($delete == 'Y') {
//		$query_d = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//		$result_d = @mysql_query($query_d);
//		$row_d = @mysql_fetch_array($result_d, MYSQL_ASSOC);
//		$delete_id = $row_d['post_id'];
//		$delete_post = array('ID'=>$delete_id, 'post_status'=>'publish');
//		$delete = wp_update_post($delete_post);
//		echo "<p>DELETE $sku / ID: $delete_id / {$delete}</p>";
//		} else {
//		// New
//		if($new == 'Y') {		
//			$query_n = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//			$result_n = @mysql_query($query_n);
//			$row_n = @mysql_fetch_array($result_n, MYSQL_ASSOC);
//			$add_id = $row_n['post_id'];
//			if(@mysql_num_rows($result_n) == 0) {		
//				$post = array('post_title'=>$title, 'post_status'=>'draft', 'post_author'=>1, 'post_type'=>'product');
//				$add_id = wp_insert_post($post);
//				var_dump( $result );
//				if($add_id) {
//					add_post_meta($add_id, 'wpcf-capacity', $capacity);
//					add_post_meta($add_id, 'wpcf-gauge', $ammo);
//					add_post_meta($add_id, 'wpcf-length', $barrel);
//					add_post_meta($add_id, 'wpcf-choke', $choke);
//					add_post_meta($add_id, 'wpcf-barrel-finish', $barrel_finish);
//					add_post_meta($add_id, 'wpcf-stock', $stock_finish);
//					add_post_meta($add_id, '_regular_price', $msrp);
//					add_post_meta($add_id, '_price', $msrp);
//					add_post_meta($add_id, '_sku', $sku);
// 					wp_set_object_terms($add_id, 'new', 'product_cat', true);
//				}
//				echo "<p>ADD $sku / ($add_id}";
//				} else {
//				wp_set_object_terms($add_id, 'new', 'product_cat', true);
//				echo "<p>ADDED $sku / ($add_id}";
//			}
//			} else {
//			// Update
//			$query_u = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value='$sku'";
//			$result_u = @mysql_query($query_u);
//			$row_u = @mysql_fetch_array($result_u, MYSQL_ASSOC);
//			$update_id = $row_u['post_id'];
//			$update_msrp = number_format(get_post_meta($update_id, '_price', true),0);
//			$update = update_post_meta($update_id, '_price', $msrp);
//			$update = update_post_meta($update_id, '_regular_price', $msrp);
//			echo "<p>UPDATE $sku / ID: $update_id / MSRP: $update_msrp | $msrp / {$update}</p>";
//		}
//	}	
//}
//// Dealers
//$args = array('category_name'=>'intl-distributors','posts_per_page'=>'-1','orderby'=>'post_title','order'=>'asc');
//query_posts($args);
//$count = 0;
//echo "<table>";
//while(have_posts()):the_post();
//	$post_id = get_the_ID();
//	$post_title = $post->post_title;
//	$post_content = strip_tags($post->post_content);
//	$post_slug = $post->post_name;
//	$post_status = $post->post_status;
//	$post_address = get_post_meta(get_the_ID(), 'Location Address', true);
//	$post_latitude = get_post_meta(get_the_ID(), 'Location Latitude', true);
//	$post_longitude = get_post_meta(get_the_ID(), 'Location Longitude', true);
//	$post_state = get_post_meta(get_the_ID(), 'Location State', true);
//	echo "<tr>
//	<td>$post_id</td>
//	<td>$post_title</td>
//	<td>$post_content</td>
//	<td>$post_address</td>
//	<td>$post_state</td>
//	<td>$post_latitude</td>
//	<td>$post_longitude</td>
//	<td>$post_status</td>
//	</tr>";
//	$count++;
//endwhile;
//echo "</table>$count";
// Image Refresh
//$args = array('post_type'=>'flex-configurations','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc');
//query_posts($args);
//$count = 0;
//echo "<table>";
//while(have_posts()):the_post();
//	$part_id = get_the_ID();
//	$part_title = get_the_title();
//	$part_slug = $post->post_name;
//	$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
//	$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
//	$part_sku = get_post_meta(get_the_ID(), 'wpcf-flex-ecomm-sku', true);
//	if(!$part_standard && strpos($part_slug,'barrel') !== FALSE) {
//		$part_image_slug = strtolower('flex-configurator-barrel-'.$part_sku);
//		
//		$args = array('name'=>$part_image_slug, 'post_type'=>'attachment');
//		$images = get_posts($args);
//		if($images) {
//			$image_id = $images[0]->ID;
//			$image_url = $images[0]->guid;
//		}
//		$featured_image = add_post_meta($part_id, '_thumbnail_id', $image_id);
//
//
//		echo "<tr>
//		<td>$part_id</td>
//		<td>$part_title</td>
//		<td>$part_slug</td>
//		<td>$part_image_slug</td>
//		<td>$image_id</td>
//		<t>$featured_image</td>
//		</tr>";
//	}
//	$count++;
//endwhile;
//echo "TOTAL: $count";
//echo "</table>";
// FLEX Barrel Categories
//// Models
//$twelve_gauge = array(744,745,746,843,749,750,751,752,755,756,757,839,760,761,766,829,768,769,771,840,844,773,774,787,838,775,776,777,779,780,781,834,789,810,812,814,837);
//$twenty_gauge = array(747,748,842,753,754,758,759,762,772,841,778,782,783,811);
//
//$args = array('post_type'=>'flex-configurations','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc',
//'tax_query'=>array(
//	array(
//	'taxonomy'=>'flex-part-types',
//	'field'=>'slug',
//	'terms'=>'flex-barrel'))
//);
//query_posts($args);
//while(have_posts()):the_post();
//	$part_id = get_the_ID();
//	$part_title = get_the_title();
//	$part_slug = $post->post_name;
//	$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
//	$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
//	
//	if(!$part_standard) {
//		$gauge = FALSE;
//		$capacity = FALSE;
//		// Gauge
//		if(strpos($part_slug,'12-gauge') !== FALSE) {
//			$gauge = '12';
//		}
//		if(strpos($part_slug,'20-gauge') !== FALSE) {
//			$gauge = '20';
//		}
//		// Capacity
//		if(strpos($part_slug,'6-shot') !== FALSE) {
//			$capacity = '6';
//		}
//		if(strpos($part_slug,'7-shot') !== FALSE) {
//			$capacity = '7';
//		}
//		if(strpos($part_slug,'8-shot') !== FALSE) {
//			$capacity = '9';
//		}
//		if(strpos($part_slug,'9-shot') !== FALSE) {
//			$capacity = '9';
//		}
//		
//		if($gauge == 12 && $capacity == 6) {
//			$updates = wp_set_post_terms($part_id, $twelve_gauge, 'flex-model', TRUE );
//			echo "<p>$part_title  [$gauge] [$capacity]</p>";
//		}
//		if($gauge == 20 && $capacity == 6) {
//			$updates = wp_set_post_terms($part_id, $twenty_gauge, 'flex-model', TRUE );
//			echo "<p>$part_title  [$gauge] [$capacity]</p>";
//		}		
//	}
//endwhile;
//// FLEX Models Gauge List
//
//$twelve = array();
//$twenty = array();
//
//$args = array('taxonomy'=>'flex-model','hide_empty'=>false);
//$terms = get_terms($args);
//foreach($terms as $term) {
//	$model_id = $term->term_id;
//	$model_title = $term->name;
//	$model_slug = $term->slug;
//	$model_description = strip_tags($term->description);
//	
//	$gauge = FALSE;
//	$capacity = FALSE;
//	
//	// Gauge
//	if(strpos($model_description,'12 Gauge') !== FALSE) {
//		$gauge = '12';
//	}
//	if(strpos($model_description,'20 Gauge') !== FALSE) {
//		$gauge = '20';
//	}
//	// Capacity
//	if(strpos($model_description,'6 Shot') !== FALSE) {
//		$capacity = '6';
//	}
//	if(strpos($model_description,'7 Shot') !== FALSE) {
//		$capacity = '7';
//	}
//	if(strpos($model_description,'8 Shot') !== FALSE) {
//		$capacity = '9';
//	}
//	if(strpos($model_description,'9 Shot') !== FALSE) {
//		$capacity = '9';
//	}
//	
//	if($gauge == 12 && $capacity == 6) {
//		$twelve[] = $model_id;
//		echo "<p>$model_title | $model_description [$gauge] [$capacity]</p>";
//	}
//	if($gauge == 20 && $capacity == 6) {
//		$twenty[] = $model_id;
//		echo "<p>$model_title | $model_description [$gauge] [$capacity]</p>";
//	}
//}
//$twelve_ids = implode(',',$twelve);
//$twenty_ids = implode(',',$twenty);
//
//echo "<p>$twelve_ids</p><p>$twenty_ids</p>";
// FLEX Part Categories
//// Models
//
//	$args = array('post_type'=>'flex-configurations','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc');
//	query_posts($args);
//	while(have_posts()):the_post();
//		$part_id = get_the_ID();
//		$part_title = get_the_title();
//		$part_slug = $post->post_name;
//		$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
//		$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
//		
//		if(!$part_standard) {
//			$terms = array(723,724,725,726,727,744,745,746,747,748,749,750,751,752,753,754,755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,774,775,776,777,778,779,780,781,782,783,784,785,786,787,788,789,800,801,802,803,804,805,806,807,808,809,810,811,812,813,814,829,830,831,832,833,834,835,837,838,839,840,841,842,843,844);
//			$updates = wp_set_post_terms($part_id, $terms, 'flex-model', FALSE );
//			echo "<p>CHANGE / $part_title / $part_standard</p>";
//			} else {
//			echo "<p>NO CHANGE / $part_title / $part_standard</p>";
//		}
//	endwhile;
		
// FLEX Part Images
//// Models
//$args = array('taxonomy'=>'flex-model','hide_empty'=>false);
//$terms = get_terms($args);
//foreach($terms as $term) {
//	$model_slug = $term->slug;
//	if(strpos($model_slug, '500') !== FALSE) {
//		echo "<p>$model_slug</p>";
//		$args = array('post_type'=>'flex-configurations','numberposts'=>'-1','orderby'=>'post_title','order'=>'asc',
//		'tax_query'=>array(
//			array(
//			'taxonomy'=>'flex-model',
//			'field'=>'slug',
//			'terms'=>$model_slug))
//		);
//		query_posts($args);
//		while(have_posts()):the_post();
//			$part_id = get_the_ID();
//			$part_title = get_the_title();
//			$part_slug = $post->post_name;
//			$part_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()),'full');
//			$part_standard = get_post_meta(get_the_ID(), 'wpcf-flex-standard-equipment', true);
//			if($part_standard) {
//				if(strpos($part_slug,'receiver') !== FALSE) {
//					$image_slug = "flex-{$part_standard}-receiver";
//				}
//				if(strpos($part_slug,'stock') !== FALSE) {
//					$image_slug = "flex-{$part_standard}-stock";
//				}
//				if(strpos($part_slug,'forend') !== FALSE) {
//					$image_slug = "flex-{$part_standard}-forend";
//				}
//				if(strpos($part_slug,'barrel') !== FALSE) {
//					$image_slug = "flex-{$part_standard}-barrel";
//				}		
//				echo "<p>$part_title</p>";
//			
//				$args = array('name'=>$image_slug, 'post_type'=>'attachment');
//				$images = get_posts($args);
//				if($images) {
//					$image_id = $images[0]->ID;
//					$image_url = $images[0]->guid;
//				}
//				if(strpos($part_slug, '500-tactical') !== FALSE) {
//					//echo "<p><img src=\"$image_url\"/></p>";
//					$featured_image = update_post_meta($part_id, '_thumbnail_id', $image_id);
//					if($featured_image) {
//						echo "<p>$part_title / $image_url</p>";
//						} else {
//						echo "<p>$part_title / NO</p>";
//					}
//				}
//			}
//		endwhile;
//	}
//}
	
	
	
	
//// FLEX Models
//// 500
//$models_500 = array(
//'50424??500 ATI Tactical'=>'12 Gauge / 6 Shot / Flat Dark Earth',
//'52282??500 Combo Field/Deer'=>'12 Gauge / 6 Shot / MO Break-Up Country / Synthetic',
//'54234??500 Combo Field/Deer'=>'12 Gauge / 6 Shot / Blued / Wood',
//'54183??500 Combo Field/Deer'=>'20 Gauge / 6 Shot / MO Break-Up Country / Synthetic',
//'54264??500 Combo Field/Deer'=>'20 Gauge / 6 Shot / Blued / Wood',
//'54169??500 Combo Field/Security'=>'12 Gauge / 6 Shot / Blued / Wood',
//'53270??500 Combo Turkey/Deer'=>'12 Gauge / 6 Shot / MO Break-Up Country / Synthetic',
//'50120??500 Hunting All Purpose Field'=>'12 Gauge / 6 Shot / Blued / Wood',
//'56420??500 Hunting All Purpose Field'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'50136??500 Hunting All Purpose Field'=>'20 Gauge / 6 Shot / Blued / Wood',
//'56436??500 Hunting All Purpose Field'=>'20 Gauge / 6 Shot / Matte Blued / Synthetic',
//'50126??500 Hunting All Purpose Field – Classic'=>'12 Gauge / 6 Shot / High Polish Blue / Walnut',
//'54232??500 Slugster'=>'12 Gauge / 6 Shot / Blued / Wood (Dual Comb)',
//'54244??500 Slugster'=>'12 Gauge / 6 Shot / Blued / Wood',
//'54233??500 Slugster'=>'20 Gauge / 6 Shot / Blued / Wood (Dual Comb)',
//'54314??500 Slugster'=>'20 Gauge / 6 Shot / MO Break-Up Country / Wood (Dual Comb)',
//'50273??500 Tactical – 6 Shot'=>'12 Gauge / 6 Shot / Marinecote / Synthetic',
//'50411??500 Tactical – 6 Shot'=>'12 Gauge / 6 Shot / Blued / Synthetic',
//'50452??500 Tactical – 6 Shot'=>'20 Gauge / 6 Shot / Blued / Synthetic',
//'50567??500 Tactical – 8 Shot'=>'12 Gauge / 8 Shot / Matte Blued / Synthetic',
//'50577??500 Tactical – 8 Shot'=>'12 Gauge / 8 Shot / Blued / Synthetic',
//'54300??500 Tactical – 8 Shot'=>'20 Gauge / 8 Shot / Matte Blued / Synthetic',
//'50420??500 Tactical – Adjustable Stock'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'54301??500 Tactical – Adjustable Stock'=>'20 Gauge / 8 Shot / Matte Blued / Synthetic',
//'51523??500 Tactical – SPX'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'52133??500 Tactical – Thunder Ranch'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'50589??500 Tactical – Tri-rail Forend'=>'12 Gauge / 8 Shot / Matte Blued / Synthetic',
//'52280??500 Turkey'=>'12 Gauge / 6 Shot / MO Obsession / Synthetic',
//'54339??500 Turkey'=>'20 Gauge / 6 Shot / MO Obsession / Synthetic',
//'55215??500 Turkey – LPA Adjustable Trigger'=>'12 Gauge / 6 Shot / MO Obsession / Synthetic',
//'55128??500 Waterfowl'=>'12 Gauge / 6 Shot / MO Shadow Grass Blades / Synthetic');
//// FLEX 500
//$models_flex500 = array(
//'50121??FLEX 500 All-Purpose'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'50125??FLEX 500 All-Purpose'=>'12 Gauge / 6 Shot / Marinecote / Synthetic',
//'55131??FLEX 500 Combo Deer/Security'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic',
//'54320??FLEX 500 Combo Field/Security'=>'20 Gauge / 6 Shot / Matte Blued / Synthetic',
//'55114??FLEX 500 Combo Turkey/Security'=>'12 Gauge / 6 Shot / OD Green / Synthetic',
//'55117??FLEX 500 Combo Waterfowl/Security'=>'12 Gauge / 6 Shot / Tan / Synthetic',
//'50124??FLEX 500 Hunting'=>'12 Gauge / 6 Shot / Tan / Synthetic',
//'54316??FLEX 500 Hunting'=>'20 Gauge / 6 Shot / Matte Blued / Synthetic',
//'54319??FLEX 500 Hunting'=>'20 Gauge / 6 Shot / OD Green / Synthetic');
//// 590
//$models_590 = array(
//'50645??590 9-Shot Heat-Shield'=>'12 Gauge / 9 Shot / Blued / Synthetic',
//'50778??590 7-Shot'=>'12 Gauge / 7 Shot / Matte Blued / Synthetic',
//'50670??590 9-Shot Tri-Rail'=>'12 Gauge / 9 Shot / Matte Blued / Synthetic',
//'50299??590 Mariner'=>'12 Gauge / 6 Shot / Marinecote / Synthetic');
//// 590
//$models_flex590 = array(
//'51672??FLEX 590 Tactical'=>'12 Gauge / 6 Shot / Matte Blued / Synthetic');
//// 590A1
//$models_590a1 = array(
//'50776??590A1 – 7 Shot'=>'12 Gauge / 7 Shot / Parkerized / Synthetic',
//'50774??590A1 – 7 Shot – Ghost Ring'=>'12 Gauge / 7 Shot / Parkerized / Synthetic',
//'50775??590A1 – 7 Shot – Ghost Ring'=>'12 Gauge / 7 Shot / Kryptek Typhon Camo / Synthetic',
//'50777??590A1 – 7 Shot – Mariner'=>'12 Gauge / 7 Shot / Marinecote / Synthetic',
//'51660??590A1 – 9 Shot'=>'12 Gauge / 9 Shot / Parkerized / Synthetic',
//'53693??590A1 – 9 Shot – Tactical Tri-Rail Adjustable'=>'12 Gauge / 9 Shot / Parkerized / Synthetic',
//'50676??590A1 – 9 Shot – U.S. Service Model with Tactical Scabbard'=>'12 Gauge / 9 Shot / Parkerized / Synthetic',
//'51771??590A1 – 9 Shot – XS Ghost Ring Sights +4Stock'=>'12 Gauge / 9 Shot / Parkerized / Synthetic',
//'50771??590A1 – 9 Shot SPX'=>'12 Gauge / 9 Shot / Parkerized / Synthetic',
//'51773??590A1 – 9-Shot Magpul Series'=>'12 Gauge / 9 Shot / Parkerized / Magpul SGA MOE');
//// Maverick 88
//$models_maverick = array(
//'31010??Maverick 88 – All-Purpose'=>'12 Gauge / 6 Shot / Blued / Synthetic',
//'32200??Maverick 88 – All-Purpose'=>'20 Gauge / 6 Shot / Blued / Synthetic',
//'31023??Maverick 88 – Security'=>'12 Gauge / 6 Shot / Blued / Synthetic',
//'31046??Maverick 88 – Security'=>'12 Gauge / 8 Shot / Blued / Synthetic',
//'31017??Maverick 88 – Slug'=>'12 Gauge / 6 Shot / Blued / Synthetic');
//
//foreach($models_maverick as $key => $value) {
//	$split = explode('??',$key);
//	$sku = $split[0];
//	$title = $split[1];
//	$term = wp_insert_term($title, 'flex-model', array('description'=>$value,'slug'=>'flex-config-'.$sku,'parent'=> '727'));
//	echo "<p>$sku | $title | $value</p>";
//}
//// Magento Order Status Fix
//$query = "SELECT entity_id, status FROM m_sales_order ORDER BY entity_id DESC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$entity_id = $row[0];
//	$status = $row[1];
//	$queryu = "UPDATE m_sales_order_grid SET status='$status' WHERE entity_id='$entity_id'";
//	$resultu = @mysql_query($queryu);
//	if(@mysql_num_rows($resultu) == 1) {
//		echo "<p>$entity_id | $status</p>";
//		} else {
//		echo "<p>NO $entity_id | $status</p>";
//		echo @mysql_error();
//	}
//}
//// Parts Import
//$query = "SELECT * FROM data_schematics ORDER BY part_id ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$part_id = $row['part_id'];
//	$part_model = $row['part_model'];
//	$part_number = $row['part_number'];
//	$part_sku = $row['part_sku'];
//	$part_name = ucwords(strtolower($row['part_name']));
//	$part_qty = $row['part_qty'];
//	$part_restriction = ucfirst(strtolower($row['part_restriction']));
//	$part_note = $row['part_note'];
//	$part_inset = $row['part_inset'];
//	
//	// Model ID
//	$model = get_term_by('slug', $part_model, 'schematic-model');
//	if($model) {
//		$model_id = $model->term_id;
//	
//		// Restricted
//		$part_restricted = NULL;
//		if($part_restriction != '') {
//			$part_restricted = '1';
//		}
//		
//		// Create post object
//		$my_post = array(
//			'post_title'    => wp_strip_all_tags($part_name),
//			'post_status'   => 'publish',
//			'post_author'   => 1,
//			'post_category' => array($model_id),
//			'post_type' => 'schematic',
//			'meta_input' => array('wpcf-part-restriction'=>$part_restriction,'wpcf-part-restricted' => $part_restricted,'wpcf-part-sku' => $part_sku,'wpcf-part-quantity' => $part_qty,'wpcf-part-diagram-number' => $part_number)
//		);
//		 
//		// Insert the post into the database
//		//wp_insert_post( $my_post );
//	
//		
//		echo "<p>$part_id / $part_model ($model_id) / $part_number / $part_sku / $part_name / $part_qty / $part_restriction / $part_note / $part_inset</p>";
//	}
//}
//echo mysql_error();
//// Price Round Up
//$query = "SELECT meta_id, meta_value FROM wp_postmeta WHERE meta_key='_price'";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result,MYSQL_ASSOC)) {
//	$meta_id = $row['meta_id'];
//	$meta_value = $row['meta_value'];
//	$price = explode('.',$meta_value);
//	$cents = $price[1];
//	$new_price = ceil($meta_value);
//	if($cents && $cents != '0' && $cents != '00' && $cents != NULL) {
//		$query_m = "UPDATE wp_postmeta SET meta_value='$new_price' WHERE meta_id='$meta_id'";
//		$result_m = @mysql_query($query_m);
//		echo "<p>PRICE: $meta_id | $meta_value | $new_price</p>";
//	}
//}
//$queryr = "SELECT meta_id, meta_value FROM wp_postmeta WHERE meta_key='_regular_price'";
//$resultr = @mysql_query($queryr);
//while($rowr = @mysql_fetch_array($resultr,MYSQL_ASSOC)) {
//	$meta_id = $rowr['meta_id'];
//	$meta_value = $rowr['meta_value'];
//	$price = explode('.',$meta_value);
//	$cents = $price[1];
//	$new_price = ceil($meta_value);
//	if($cents && $cents != '0' && $cents != '00' && $cents != NULL) {
//		$query_m = "UPDATE wp_postmeta SET meta_value='$new_price' WHERE meta_id='$meta_id'";
//		$result_m = @mysql_query($query_m);
//		echo "<p>REGULAR PRICE: $meta_id | $meta_value | $new_price</p>";
//	}
//}
//// New SKUs
//$query = "SELECT * FROM data_new";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result,MYSQL_ASSOC)) {
//	$sku = $row['sku'];
//	$price = $row['price'];
//	$caliber = $row['caliber'];
//	$gauge = $row['gauge'];
//	$title = $row['name'];
//	$capacity = $row['capacity'];
//	$barrel_type = $row['barrel_type'];
//	$barrel_length = $row['barrel_length'];
//	$sight_type = $row['sight_type'];
//	$scope_type = $row['scope_type'];
//	$choke = $row['choke'];
//	$twist = $row['twist'];
//	$lop_type = $row['lop_type'];
//	$lop = $row['lop'];
//	$barrel_finish = $row['barrel_finish'];
//	$stock = $row['stock'];
//	$weight = $row['weight'];
//	$length = $row['length'];
//	$shell_size = $row['shell_size'];
//	$upc = $row['upc'];
//	
//	// Specs
//	$specs = array('_price'=>$price,
//	'_regular_price'=>$price,
//	'_sku'=>$sku,
//	'_visibility'=>'visible',
//	'_stock_status'=>'instock',
//	'wpcf-caliber'=>$caliber,
//	'wpcf-gauge'=>$gauge,
//	'wpcf-capacity'=>$capacity,
//	'wpcf-barrel-type'=>$barrel_type,
//	'wpcf-barrel-length'=>$barrel_length,
//	'wpcf-sight-type'=>$sight_type,
//	'wpcf-scope-type'=>$scope_type,
//	'wpcf-choke'=>$choke,
//	'wpcf-twist'=>$twist,
//	'wpcf-lop-type'=>$lop_type,
//	'wpcf-lop'=>$lop,
//	'wpcf-barrel-finish'=>$barrel_finish,
//	'wpcf-weight'=>$weight,
//	'wpcf-length'=>$length,
//	'wpcf-shell-size'=>$shell_size,
//	'wpcf-upc'=>$upc,
//	'wpcf-gog-active'=>'Y',
//	'wpcf-nfdn-active'=>'Y',
//	'wpcf-tss-active'=>'Y');
//	
//	$post_slug = sanitize_title($title).'-'.$sku;
//	$post_url =  'http://www.mossberg.com/product/'.$post_slug.'/';
//	$post_status = 'publish';
//	
//	$post = array(
//	'post_name'      => $post_slug,
//	'post_title'     => $title,
//	'post_status'    => $post_status,
//	'post_type'      => 'product',
//	'post_author'    => '1',
//	'ping_status'    => 'closed',
//	'post_parent'    => '0',
//	'menu_order'     => '0',
//	'post_date'      => '2017-01-17 10:00:00',
//	'post_date_gmt'  => '2017-01-17 10:00:00',
//	'comment_status' => 'closed');
//	
//	$post_id = wp_insert_post($post, $wp_error);
//	if($post_id) {
//		// Custom Fields
//		foreach($specs as $key => $value) {
//			if($value != NULL) {
//				if(!add_post_meta($post_id, $key, $value, true ) ) { 
//					update_post_meta ($post_id, $key, $value);
//				}
//			}
//		}
//		echo "<p>$sku / $title / $post_id</p>";
//	}
//}
//// MSRP Update
//$query = "SELECT post_id, meta_value FROM wp_postmeta WHERE meta_key='_sku' ORDER BY post_id ASC";
//$result = @mysql_query($query);
//$count = 0;
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$post_id = $row[0];
//	$sku = $row[1];
//	$query_m = "SELECT meta_id, meta_value FROM wp_postmeta WHERE meta_key='_price' AND post_id='$post_id'";
//	$result_m = @mysql_query($query_m);
//	$row_m = @mysql_fetch_array($result_m, MYSQL_NUM);
//	$meta_id = $row_m[0];
//	$msrp_old = $row_m[1];
//	
//	$query_d = "SELECT msrp_price FROM data_msrp WHERE msrp_sku='$sku'";
//	$result_d = @mysql_query($query_d);
//	$row_d = @mysql_fetch_array($result_d, MYSQL_NUM);
//	$msrp_new = $row_d[0];
//	if($msrp_new != '') {
//		$query_u = "UPDATE wp_postmeta SET meta_value='$msrp_new' WHERE meta_id='$meta_id'";
//		$result_u = @mysql_query($query_u);
//		echo "<p>$sku / $msrp_old > $msrp_new / $meta_id / $post_id</p>";
//		$count++;
//	}
//	
//	
//}
//echo $count;
// Ecomm 301
//$query = "SELECT url_id, url_new, url_old FROM redirects ORDER BY url_old ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$url_id = $row[0];
//	$url_new = $row[1];
//	$url_old = $row[2];
//	
//	$path_x = explode('store.mossberg.com',$url_old);
//	$path = substr(end($path_x),1);
//	
//	echo "Redirect 301 /$path $url_new<br/>";
//}
	
//// Magento Redirects
//$query = "SELECT url_id, url_new, url_old FROM redirects ORDER BY url_old ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$url_id = $row[0];
//	$url_new = $row[1];
//	$url_old = $row[2];
//
//	$path_x = explode('store.mossberg.com',$url_old);
//	$path = substr(end($path_x),1);
//	$part_x = explode('/',$path);
//	$part_type = $part_x[0];
//	$part_id = $part_x[1];
//	$part_name = $part_x[2];
//	
//	if($part_type == 'product') {
//		$sku_x = explode('/',$url_new);
//		$sku = end($sku_x);
//		if($sku) {
//		
//			echo "<p>$url_old | $sku | ";
//			
//			$query_m = "SELECT 
//			DISTINCT(m_catalog_product_entity.entity_id), m_catalog_product_entity.sku AS sku, 
//			(SELECT m_catalog_product_entity_varchar.`value` FROM m_catalog_product_entity_varchar WHERE m_catalog_product_entity_varchar.attribute_id = '117' AND m_catalog_product_entity_varchar.entity_id = m_catalog_product_entity.entity_id) AS url_key 
//			FROM m_catalog_product_entity, m_catalog_product_entity_varchar, m_catalog_category_product 
//			WHERE m_catalog_product_entity.sku='$sku' 
//			AND m_catalog_category_product.product_id = m_catalog_product_entity.entity_id 
//			AND m_catalog_product_entity_varchar.entity_id = m_catalog_product_entity.entity_id";
//			$result_m = @mysql_query($query_m);
//			while($row_m = @mysql_fetch_array($result_m, MYSQL_ASSOC)) {
//				$url_key = $row_m['url_key'];
//				$link = "http://www.mossberg.com/store/{$url_key}.html";
//				echo $link;
//			}	
//			echo "</p>";
//			$query_u = "UPDATE redirects SET url_new='$link' WHERE url_id='$url_id'";
//			$result_u = @mysql_query($query_u);
//		}
//	}
//}
//echo mysql_error();	
//// Ignify Redirects
//$query = "SELECT url_id, url_new, url_old FROM redirects ORDER BY url_old ASC";
//$result = @mysql_query($query);
//$used = array();
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$url_id = $row[0];
//	$url_new = $row[1];
//	$url_old = $row[2];
//	
//	$path_x = explode('store.mossberg.com',$url_old);
//	$path = substr(end($path_x),1);
//	$part_x = explode('/',$path);
//	$part_type = $part_x[0];
//	$part_id = $part_x[1];
//	$part_name = $part_x[2];
//	
//	if(!in_array($url_old,$used)) {
//	
//		switch($part_type) {
//			case 'pages':
//			$url_redirect = "http://www.mossberg.com/$part_name";
//			break;
//			
//			case 'category':
//			$url_redirect = "http://www.mossberg.com/$part_name";
//			break;
//			
//			case 'product':
//			$query_i = "SELECT sku_mage FROM redirects_sku WHERE sku_ignify='$part_id'";
//			$result_i = @mysql_query($query_i);
//			$row_i = @mysql_fetch_array($result_i,MYSQL_NUM);
//			$sku = $row_i[0];
//			$url_redirect = "http://www.mossberg.com/$sku";
//			break;
//		}
//		$used[] = $url_old;
//		
//		$query_u = "UPDATE redirects SET url_new='$url_redirect' WHERE url_id='$url_id'";
//		$result_u = @mysql_query($query_u);
//	}
//}
//// UPC Update
//$upcs = array("41010"=>"015813410106","41020"=>"015813410205","41026"=>"015813410267","43000"=>"015813430005","43027"=>"015813430272","50104"=>"015813501040","50112"=>"015813501125","50120"=>"015813501200","50126"=>"015813501262","50136"=>"015813501361","50145"=>"015813501453","50273"=>"015813502733","50359"=>"015813503594","50363"=>"015813503631","50411"=>"015813504119","50420"=>"015813504201","50440"=>"015813504409","50450"=>"015813504508","50452"=>"015813504522","50455"=>"015813504553","50460"=>"015813504607","50567"=>"015813505673","50577"=>"015813505772","50579"=>"015813505796","50580"=>"015813505802","50589"=>"015813505895","51340"=>"015813513401","51523"=>"015813515238","52132"=>"015813521321","52133"=>"015813521338","52280"=>"015813522809","52282"=>"015813522823","52340"=>"015813523400","53265"=>"015813532655","53270"=>"015813532709","54125"=>"015813541251","54132"=>"015813541329","54147"=>"015813541473","54157"=>"015813541572","54169"=>"015813541695","54183"=>"015813541831","54188"=>"015813541886","54210"=>"015813542104","54215"=>"015813542159","54218"=>"015813542180","54232"=>"015813542326","54233"=>"015813542333","54243"=>"015813542432","54244"=>"015813542449","54250"=>"015813542500","54256"=>"015813542562","54264"=>"015813542647","54282"=>"015813542821","54300"=>"015813543002","54301"=>"015813543019","54303"=>"015813543033","54314"=>"015813543149","54339"=>"015813543392","54566"=>"015813545662","55115"=>"015813551151","55128"=>"015813551281","55215"=>"015813552158","55244"=>"015813552448","56420"=>"015813564205","56436"=>"015813564366","57340"=>"015813573405","57341"=>"015813573412","58253"=>"015813582537","50121"=>"015813501217","50124"=>"015813501248","50125"=>"015813501255","50673"=>"015813506731","51674"=>"015813516747","54316"=>"015813543163","54317"=>"015813543170","54318"=>"015813543187","54319"=>"015813543194","55114"=>"015813551144","55117"=>"015813551175","55121"=>"015813551212","55122"=>"015813551229","55129"=>"015813551298","55131"=>"015813551311","59810"=>"015813598101","59813"=>"015813598132","59814"=>"015813598149","59817"=>"015813598170","59818"=>"015813598187","59819"=>"015813598194","59821"=>"015813598217","59822"=>"015813598224","59823"=>"015813598231","59824"=>"015813598248","59826"=>"015813598262","59820"=>"015813598200","57110"=>"015813571104","57120"=>"015813571203","50355"=>"015813503556","50358"=>"015813503587","50485"=>"015813504850","50494"=>"015813504942","50496"=>"015813504966","50497"=>"015813504973","45000"=>"015813450003","45120"=>"015813451208","45207"=>"015813452076","45208"=>"015813452083","45209"=>"015813452090","45212"=>"015813452120","45236"=>"015813452366","45239"=>"015813452397","45242"=>"015813452427","45310"=>"015813453103","45602"=>"015813456029","50299"=>"015813502993","50645"=>"015813506458","50670"=>"015813506700","50778"=>"015813507783","51672"=>"015813516723","59816"=>"015813598163","50774"=>"015813507745","50775"=>"015813507752","50776"=>"015813507769","50777"=>"015813507776","51660"=>"015813516600","51663"=>"015813516631","51668"=>"015813516686","51771"=>"015813517713","53693"=>"015813536936","50771"=>"015813507714","59815"=>"015813598156","37000"=>"884110370006","37001"=>"884110370013","37002"=>"884110370020","37010"=>"884110370105","37035"=>"884110370358","37044"=>"884110370440","37088"=>"884110370884","37150"=>"884110371508","37064"=>"884110370648","37065"=>"884110370655","37235"=>"884110372352","37251"=>"884110372512","37201"=>"884110372017","37205"=>"884110372055","37207"=>"884110372079","37209"=>"884110372093","37217"=>"884110372178","37223"=>"884110372239","37231"=>"884110372314","37232"=>"884110372321","37233"=>"884110372338","37234"=>"884110372345","38227"=>"884110382276","38216"=>"884110382160","38218"=>"884110382184","38219"=>"884110382191","38220"=>"884110382207","38224"=>"884110382245","38225"=>"884110382252","38226"=>"884110382269","38178"=>"884110381781","38179"=>"884110381798","38180"=>"884110381804","38182"=>"884110381828","38183"=>"884110381835","62233"=>"015813622332","62238"=>"015813622387","62419"=>"015813624190","62420"=>"015813624206","62421"=>"015813624213","62437"=>"015813624374","63419"=>"015813634199","63521"=>"015813635219","66720"=>"015813667203","85110"=>"015813851107","85118"=>"015813851183","85119"=>"015813851190","85120"=>"015813851206","85122"=>"015813851220","85123"=>"015813851237","85125"=>"015813851251","85128"=>"015813851282","85133"=>"015813851336","85139"=>"015813851398","85141"=>"015813851411","85212"=>"015813852128","85222"=>"015813852227","85223"=>"015813852234","85232"=>"015813852326","85234"=>"015813852340","85238"=>"015813852388","85270"=>"015813852708","85320"=>"015813853200","85325"=>"015813853255","85330"=>"015813853309","85336"=>"015813853361","85360"=>"015813853606","85370"=>"015813853705","85373"=>"015813853736","81000"=>"015813810005","81023"=>"015813810234","81045"=>"015813810456","81235"=>"015813812351","82042"=>"015813820424","82214"=>"015813822145","82540"=>"015813825405","37312"=>"015813373128","37313"=>"015813373135","37314"=>"015813373142","37315"=>"015813373159","37316"=>"015813373166","37317"=>"015813373173","37318"=>"015813373180","37319"=>"015813373197","37246"=>"015813372466","37253"=>"015813372534","37254"=>"015813372541","37255"=>"015813372558","75462"=>"049533754622","31010"=>"049533310101","31017"=>"049533310170","31023"=>"049533310231","31044"=>"049533310446","31046"=>"049533310460","32200"=>"049533322005","32202"=>"049533322029","75445"=>"049533754455","65074"=>"015813650748","65075"=>"015813650755","65076"=>"015813650762","27696"=>"015813276962","27697"=>"015813276979","27698"=>"015813276986","27699"=>"015813276993","27700"=>"015813277006","27709"=>"015813277099","27710"=>"015813277105","27711"=>"015813277112","27712"=>"015813277129","27714"=>"015813277143","27715"=>"015813277150","27716"=>"015813277167","27717"=>"015813277174","27719"=>"015813277198","27720"=>"015813277204","27721"=>"015813277211","27722"=>"015813277228","27723"=>"015813277235","27724"=>"015813277242","27725"=>"015813277259","27726"=>"015813277266","27727"=>"015813277273","27729"=>"015813277297","27730"=>"015813277303","27731"=>"015813277310","27732"=>"015813277327","27733"=>"015813277334","27734"=>"015813277341","27735"=>"015813277358","27736"=>"015813277365","27737"=>"015813277372","27738"=>"015813277389","27739"=>"015813277396","27742"=>"015813277426","27755"=>"015813277556","27756"=>"015813277563","27761"=>"015813277617","27773"=>"015813277730","27775"=>"015813277754","27776"=>"015813277761","27777"=>"015813277778","27778"=>"015813277785","27793"=>"015813277938","27794"=>"015813277945","27798"=>"015813277983","27743"=>"015813277433","27744"=>"015813277440","27745"=>"015813277457","27746"=>"015813277464","27747"=>"015813277471","27748"=>"015813277488","27749"=>"015813277495","27750"=>"015813277501","27751"=>"015813277518","27752"=>"015813277525","27753"=>"015813277532","27760"=>"015813277600","27835"=>"015813278355","27837"=>"015813278379","27838"=>"015813278386","27839"=>"015813278393","27840"=>"015813278409","27841"=>"015813278416","27842"=>"015813278423","27843"=>"015813278430","27849"=>"015813278492","27850"=>"015813278508","27851"=>"015813278515","27852"=>"015813278522","27853"=>"015813278539","27861"=>"015813278614","27862"=>"015813278621","27863"=>"015813278638","27864"=>"015813278645","27865"=>"015813278652","27866"=>"015813278669","27867"=>"015813278676","27871"=>"015813278713","27876"=>"015813278768","27877"=>"015813278775","27882"=>"015813278829","27883"=>"015813278836","27884"=>"015813278843","27885"=>"015813278850","27890"=>"015813278904","27891"=>"015813278911","27892"=>"015813278928","27893"=>"015813278935","27894"=>"015813278942","27895"=>"015813278959","27900"=>"015813279000","27901"=>"015813279017","27902"=>"015813279024","27903"=>"015813279031","27904"=>"015813279048","27905"=>"015813279055","27906"=>"015813279062","27907"=>"015813279079","27908"=>"015813279086","27910"=>"015813279109","27911"=>"015813279116","27912"=>"015813279123","27913"=>"015813279130","27914"=>"015813279147","27923"=>"015813279239","27924"=>"015813279246","27925"=>"015813279253","27926"=>"015813279260","27927"=>"015813279277","27928"=>"015813279284","27929"=>"015813279291","27930"=>"015813279307","27931"=>"015813279314","27932"=>"015813279321","27933"=>"015813279338","27934"=>"015813279345","27935"=>"015813279352","27936"=>"015813279369","27939"=>"015813279390","27940"=>"015813279406","27941"=>"015813279413","27942"=>"015813279420","27943"=>"015813279437","27947"=>"015813279475","27948"=>"015813279482","27949"=>"015813279499","27950"=>"015813279505","27951"=>"015813279512","75770"=>"884110757708","75771"=>"884110757715","75772"=>"884110757722","75778"=>"884110757784","75780"=>"884110757807","75786"=>"884110757869","75789"=>"884110757890","75790"=>"884110757906","75412"=>"884110754127","75414"=>"884110754141","75417"=>"884110754172","75419"=>"884110754196","75441"=>"884110754417","75442"=>"884110754424","75444"=>"884110754448","75451"=>"884110754516","75452"=>"884110754523","75457"=>"884110754578");
//
//$missing = array();
//
//foreach($upcs as $sku => $upc) {
//	$query = "SELECT post_id FROM wp_postmeta WHERE meta_value='$sku' AND meta_key='_sku'";
//	$result = @mysql_query($query);
//	$row = @mysql_fetch_array($result,MYSQL_NUM);
//	$post_id = $row[0];
//	
//	$queryp = "SELECT meta_id FROM wp_postmeta WHERE post_id='$post_id' AND meta_key='wpcf-upc'";
//	$resultp = @mysql_query($queryp);
//	$rowp = @mysql_fetch_array($resultp,MYSQL_NUM);
//	$meta_id = $rowp[0];
//	
//	if(!$meta_id) {
//		echo "<p>$sku - $post_id - $meta_id</p>";
//		$missing[$post_id] = $upc;
//		//add_post_meta($post_id, 'wpcf-upc', $upc, true);
//	}
//}
//echo mysql_error();

//// CRM Dealer Import
//
//// Clear Dealers
//$args = array('category_name'=>'us-dealers','posts_per_page'=>10000);
//query_posts($args);
//$count = 0;
//while(have_posts()):the_post();
//	$location_id = $post->ID;
//	$location_title = $post->post_title;
//	wp_delete_post($location_id, TRUE);
//	echo "<p>$location_id - $location_title";
//	$count++;
//endwhile;
//echo "<p>TOTAL: $count</p>";
//wp_reset_query();
//
//
//// Add Dealers
//$query = "SELECT dealer_id, dealer_name, dealer_street, dealer_city, dealer_state, dealer_zip, dealer_phone, dealer_website FROM data_dealers";
//$result = @mysql_query($query);
//$count = 1;
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$id = $row[0];
//	$name = ucwords(strtolower($row[1]));
//	$street = ucwords(strtolower($row[2]));
//	$city = ucwords(strtolower($row[3]));
//	$state = strtoupper($row[4]);
//	$zip = trim($row[5]);
//	$phone = preg_replace("/[^0-9,.]/", "", trim($row[6]));
//	$website = strtolower($row[7]);
//	if(strlen($zip) < 5) {
//		$zip = '0'.$zip;
//	}
//	if(strlen($phone) == 10) {
//		$phone1 = substr($phone,0,3);
//		$phone2 = substr($phone,3,3);
//		$phone3 = substr($phone,6,4);
//		$phone = "($phone1) $phone2-$phone3";
//	}
//	//	 Street
//	$abbr = array(
//	'Ave'=>'Avenue',
//	'Ave.'=>'Avenue',
//	'St'=>'Street',
//	'St.'=>'Street',
//	'Rd'=>'Road',
//	'Rd.'=>'Road',
//	'Ln'=>'Lane',
//	'Ln.'=>'Lane',
//	'Hwy'=>'Highway',
//	'Hwy.'=>'Highway',
//	'Pkwy'=>'Parkway',
//	'Pkwy.'=>'Parkway',
//	'Blvd'=>'Boulevard',
//	'Blvd.'=>'Boulevard',
//	'Dr'=>'Drive',
//	'Dr.'=>'Drive',
//	'Tpk'=>'Turnpike',
//	'Tpk.'=>'Turnpike',
//	'Tpke'=>'Turnpike',
//	'Tpke.'=>'Turnpike',
//	'Rt'=>'Route',
//	'Rt.'=>'Route',
//	'Rte'=>'Route',
//	'Rte.'=>'Route',
//	'Terr'=>'Terrace',
//	'Terr.'=>'Terrace',
//	'Pl'=>'Place',
//	'Pl.'=>'Place',
//	'Cswy'=>'Causeway',
//	'Cswy.'=>'Causeway',	
//	'Ave,'=>'Avenue',
//	'Ave.,'=>'Avenue',
//	'St,'=>'Street',
//	'St.,'=>'Street',
//	'Rd,'=>'Road',
//	'Rd.,'=>'Road',
//	'Ln,'=>'Lane',
//	'Ln.,'=>'Lane',
//	'Hwy,'=>'Highway',
//	'Hwy.,'=>'Highway',
//	'Pkwy,'=>'Parkway',
//	'Pkwy.,'=>'Parkway',
//	'Blvd,'=>'Boulevard',
//	'Blvd.,'=>'Boulevard',
//	'Dr,'=>'Drive',
//	'Dr.,'=>'Drive',
//	'Tpk,'=>'Turnpike',
//	'Tpk.,'=>'Turnpike',
//	'Tpke,'=>'Turnpike',
//	'Tpke.,'=>'Turnpike',
//	'Rt,'=>'Route',
//	'Rt.,'=>'Route',
//	'Rte,'=>'Route',
//	'Rte.,'=>'Route',
//	'Terr,'=>'Terrace',
//	'Terr.,'=>'Terrace',
//	'Pl,'=>'Place',
//	'Pl.,'=>'Place',
//	'Cswy,'=>'Causeway',
//	'Cswy.,'=>'Causeway');
//	foreach($abbr as $key => $value) {
//		if(strpos($street, ' '.$key.' ') !== FALSE) {
//			$street = str_replace(' '.$key.' ', ' '.$value.' ', $street);
//		}
//	}	
//	
//	$info = "$street
//	$city, $state $zip";
//	if($website) {
//	$info .="
//	$website";
//	}
//	if($phone) {
//		$info .="
//		$phone";
//	}
//	$address = "$street $city $state $zip";
//	
//	
//	if($state) {
//		$categories = array('132','133');
//		echo "<p>$count<br/>$info<br/>$address</p>";
//		$post = array('post_content'=>$info, 'post_title'=>$name, 'post_status'=>'publish', 'post_type'=>'post', 'post_category'=>$categories);  
//		$post_id = wp_insert_post($post);
//		add_post_meta($post_id, 'Location Address', $address, true);
//		add_post_meta($post_id, 'Location State', $state, true);
//		$count++;
//	}
//}


//// Law Enforcement Re-Cat
//$le_skus = explode(',','27709,27716,27731,27738,27739,27742,27743,27744,27745,27746,27747,27748,27750,27751,27752,27753,27755,27756,50418,27760,50426,27761,50427,50273,50278,50299,50403,50411,50420,50421,50440,50575,50569,50577,50571,50579,50598,50580,50664,50589,50669,50599,50600,50645,50646,50660,51410,50663,51417,50665,50668,51668,50673,51773,50772,51273,51411,51415,51517,51518,51520,51523,51660,51663,51670,51672,51673,51674,51771,52682,53690,53693,54125,54129,85223,85320,85330,85336,85360,85370,27696,27697,27698,27699,27773,27775,27776,27777,27778,27779,59815,59816,59817,59818,59819,27923,27924,27925,85319,85374');
//foreach($le_skus as $key=>$sku) {
//	$query = "SELECT post_id FROM wp_postmeta WHERE meta_key='_sku' AND meta_value=$sku LIMIT 1";
//	$result = @mysql_query($query);
//	$row = @mysql_fetch_array($result,MYSQL_NUM);
//	$id = $row[0];
//	echo "<p>$sku / $id</p>";
//	// Categories
//	wp_set_object_terms($id, 'law-enforcement', 'product_cat', true);
//}
//// Update Catalog
//$query = "SELECT * FROM data_catalog ORDER BY data_id ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$sku = $row['sku'];
//	$title = $row['title'];
//	$stock = $row['stock'];
//
//	$post_slug = sanitize_title($title).'-'.$sku;
//	$post = get_page_by_path($post_slug,OBJECT,'product');
//	$post_id = $post->ID;
//	
//	// Custom Fields
//	if(!add_post_meta($post_id, 'wpcf-stock', $stock, true ) ) { 
//		update_post_meta ($post_id, 'wpcf-stock', $stock);
//	}
//	echo "<p>$sku / $title / $post_id</p>";
//}
//// Product Images
//$args = array('post_type'=>'product','status'=>'publish','orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
//query_posts($args);
//while(have_posts()):the_post();
//	$product_id = get_the_ID();
//	$product_sku = get_post_meta($product_id, '_sku', true);
//	$image_slug = $product_sku.'-catalog';
//	$image = get_page_by_path($image_slug,OBJECT,'post');
//	if($image) {
//		$image_id = $image->ID;
//		$photo_src = $image->guid;
//		echo "<p>$product_id / $image_id<br/><img src=\"$photo_src\"/></p>";
//		set_post_thumbnail($product_id, $image_id);		
//	}
//		
//endwhile;
//// Update Catalog
//$query = "SELECT * FROM data_catalog ORDER BY data_id ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$data_id = $row['data_id'];
//	$wp_id = $row['wp_id'];	
//	$sku = $row['sku'];
//	$url = $row['url'];
//	$title = $row['title'];
//	$price = $row['price'];
//	$caliber = $row['caliber'];
//	$gauge = $row['gauge'];
//	$capacity = $row['capacity'];
//	$chamber = $row['chamber'];
//	$barrel_type = $row['barrel-type'];
//	$barrel_length = $row['barrel-length'];
//	$sight_type = $row['sight-type'];
//	$scope_type = $row['scope-type'];
//	$choke = $row['choke'];
//	$twist = $row['twist'];
//	$lop_type = $row['lop-type'];
//	$lop = $row['lop'];
//	$barrel_finish = $row['barrel-finish'];
//	$stock = $row['stock'];
//	$weight = $row['weight'];
//	$length = $row['length'];
//	$upc = $row['upc'];
//	$image_link = $row['image_link'];
//	$hunting = $row['hunting'];
//	$tactical = $row['tactical'];
//	$turkey = $row['turkey'];
//	$waterfowl = $row['waterfowl'];
//	$slug = $row['slug'];
//	$youth = $row['youth'];
//	$rifles = $row['rifles'];
//	$shotguns = $row['shotguns'];
//	$pistols = $row['pistols'];
//	$centerfire = $row['centerfire'];
//	$rimfire = $row['rimfire'];
//	$bolt_action = $row['bolt-action'];
//	$lever_action = $row['lever-action'];
//	$pump_action = $row['pump-action'];
//	$break_action = $row['break-action'];
//	$autoloading = $row['autoloading'];
//	$series_mossberg_patriot = $row['mossberg-patriot'];
//	$series_mvp_series = $row['mvp-series'];
//	$series_464_lever_action_rimfire = $row['464-lever-action-rimfire-rifles'];
//	$series_464_lever_action_centerfire = $row['464-lever-action-centerfire-rifles'];
//	$series_464_spx_lever_action_rimfire = $row['464-spx-lever-action-rimfire-rifles'];
//	$series_464_spx_lever_action_centerfire = $row['464-spx-lever-action-centerfire-rifles'];
//	$series_blaze_autoloading_rimfire = $row['blaze-autoloading-rimfire-rifles'];
//	$series_blaze_47_autoloading_rimfire = $row['blaze-47-autoloading-rimfire-rifles'];
//	$series_mmr_hunter_semi_automatic_rifles = $row['mmr-hunter-semi-automatic-rifles'];
//	$series_mmr_carbine_rifles = $row['mmr-carbine-rifles'];
//	$series_mmr_tactical_semi_automatic_rifles = $row['mmr-tactical-semi-automatic-rifles'];
//	$series_mossberg_international_flex_22 = $row['flex-22-autoloading-rifles'];
//	$series_mossberg_international_702_plinkster = $row['702-plinkster-autoloading-rifles'];
//	$series_mossberg_international_715t = $row['715t-autoloading-rimfire-rifles'];
//	$series_mossberg_international_801_half_pint = $row['801-half-pint-rifles'];
//	$series_mossberg_international_802_plinkster = $row['802-plinkster-rifles'];
//	$series_mossberg_international_817 = $row['817-rifles'];
//	$series_500 = $row['500'];
//	$series_590_tactical = $row['590-tactical'];
//	$series_590a1_tactical = $row['590a1-tactical'];
//	$series_youth_500_505_510_mini = $row['youth-500-505-510'];
//	$series_835_ulti_mag = $row['835-ulti-mag'];
//	$series_535_ats = $row['535-ats'];
//	$series_maverick_88 = $row['maverick-88'];
//	$series_930_sporting = $row['930-sporting'];
//	$series_930 = $row['930'];
//	$series_935_magnum = $row['935-magnum'];
//	$series_mossberg_international_sa_20 = $row['sa-20'];
//	$series_mossberg_international_silver_reserve_ii_over_under = $row['silver-reserve-ii-over-under'];
//	$series_mossberg_international_silver_reserve_ii_side_by_side = $row['silver-reserve-ii-side-by-side'];
//	$series_maverick_over_under = $row['maverick-over-under'];
//	$series_mossberg_international_715p = $row['715p-autoloading-rimfire-rifles'];
//	$series = $row['series'];
//	$flex_system = $row['flex-system'];
//	$left_handed_l_series = $row['left-handed-l-series'];
//	$dc_pro_series_autoloading_shotguns = $row['dc-pro-series-autoloading-shotguns'];
//	$duck_commander_series = $row['duck-commander-series'];
//	$laserlyte_center_mass_laser = $row['laserlyte-center-mass-laser'];
//	$magpul_series = $row['magpul-series'];
//	$marble_arms_bullseye_sights = $row['marble-arms-bullseye-sights'];
//	$thunder_ranch_series = $row['thunder-ranch-series'];
//	$xs_series = $row['xs-sights'];
//	$turkey2 = $row['turkey2'];
//	$waterfowl2 = $row['waterfowl2'];
//	$slug2 = $row['slug2'];
//	$active = $row['active'];
//	$new = $row['new'];
//	$redirect = $row['redirect'];
//	// Data
//	if($turkey2) {
//		$turkey = $turkey2;
//	}
//	if($waterfowl2) {
//		$waterfowl = $waterfowl2;
//	}
//	if($slug2) {
//		$slug = $slug2;
//	}
//	$post_slug = sanitize_title($title).'-'.$sku;
//	$post_url =  'http://www.mossberg.com/product/'.$post_slug.'/';
//	if($active == 'Y') {
//		$post_status = 'publish';
//		} else {
//		$post_status = 'draft';
//	}
//	
//	// Specs
//	$specs = array('_price'=>$price,
//	'_regular_price'=>$price,
//	'_sku'=>$sku,
//	'_visibility'=>'visible',
//	'_stock_status'=>'instock',
//	'wpcf-caliber'=>$caliber,
//	'wpcf-gauge'=>$gauge,
//	'wpcf-capacity'=>$capacity,
//	'wpcf-chamber'=>$chamber,
//	'wpcf-barrel-type'=>$barrel_type,
//	'wpcf-barrel-length'=>$barrel_length,
//	'wpcf-sight-type'=>$sight_type,
//	'wpcf-scope-type'=>$scope_type,
//	'wpcf-choke'=>$choke,
//	'wpcf-twist'=>$twist,
//	'wpcf-lop-type'=>$lop_type,
//	'wpcf-lop'=>$lop,
//	'wpcf-barrel-finish'=>$barrel_finish,
//	'wpcf-weight'=>$weight,
//	'wpcf-length'=>$length,
//	'wpcf-shell-size'=>$shell_size,
//	'wpcf-sku-redirect'=>$redirect);
//	
//	
//	// Categories
//	$categories = array('hunting'=>$hunting,
//	'tactical'=>$tactical,
//	'turkey'=>$turkey,
//	'waterfowl'=>$waterfowl,
//	'slug'=>$slug,
//	'youth'=>$youth,
//	'rifles'=>$rifles,
//	'shotguns'=>$shotguns,
//	'pistols'=>$pistols,
//	'centerfire'=>$centerfire,
//	'rimfire'=>$rimfire,
//	'bolt-action'=>$bolt_action,
//	'lever-action'=>$lever_action,
//	'pump-action'=>$pump_action,
//	'break-action'=>$break_action,
//	'autoloading'=>$autoloading,
//	'mossberg-patriot'=>$series_mossberg_patriot,
//	'mvp-series'=>$series_mvp_series,
//	'464-lever-action-rimfire-rifles'=>$series_464_lever_action_rimfire,
//	'464-lever-action-centerfire-rifles'=>$series_464_lever_action_centerfire,
//	'464-spx-lever-action-rimfire-rifles'=>$series_464_spx_lever_action_rimfire,
//	'464-spx-lever-action-centerfire-rifles'=>$series_464_spx_lever_action_centerfire,
//	'blaze-autoloading-rimfire-rifles'=>$series_blaze_autoloading_rimfire,
//	'blaze-47-autoloading-rimfire-rifles'=>$series_blaze_47_autoloading_rimfire,
//	'mmr-hunter-semi-automatic-rifles'=>$series_mmr_hunter_semi_automatic_rifles,
//	'mmr-carbine-rifles'=>$series_mmr_carbine_rifles,
//	'mmr-tactical-semi-automatic-rifles'=>$series_mmr_tactical_semi_automatic_rifles,
//	'flex-22-autoloading-rifles'=>$series_mossberg_international_flex_22,
//	'702-plinkster-autoloading-rifles'=>$series_mossberg_international_702_plinkster,
//	'715t-autoloading-rimfire-rifles'=>$series_mossberg_international_715t,
//	'801-half-pint-rifles'=>$series_mossberg_international_801_half_pint,
//	'802-plinkster-rifles'=>$series_mossberg_international_802_plinkster,
//	'817-rifles'=>$series_mossberg_international_817,
//	'500'=>$series_500,
//	'590-tactical'=>$series_590_tactical,
//	'590a1-tactical'=>$series_590a1_tactical,
//	'youth-500-505-510'=>$series_youth_500_505_510_mini,
//	'835-ulti-mag'=>$series_835_ulti_mag,
//	'535-ats'=>$series_535_ats,
//	'maverick-88'=>$series_maverick_88,
//	'930-sporting'=>$series_930_sporting,
//	'930'=>$series_930,
//	'935-magnum'=>$series_935_magnum,
//	'sa-20'=>$series_mossberg_international_sa_20,
//	'silver-reserve-ii-over-under'=>$series_mossberg_international_silver_reserve_ii_over_under,
//	'silver-reserve-ii-side-by-side'=>$series_mossberg_international_silver_reserve_ii_side_by_side,
//	'maverick-over-under'=>$series_maverick_over_under,
//	'715p-autoloading-rimfire-rifles'=>$series_mossberg_international_715p,
//	'series'=>$series,
//	'flex-system'=>$flex_system,
//	'left-handed-l-series'=>$left_handed_l_series,
//	'dc-pro-series-autoloading-shotguns'=>$dc_pro_series_autoloading_shotguns,
//	'duck-commander-series'=>$duck_commander_series,
//	'laserlyte-center-mass-laser'=>$laserlyte_center_mass_laser,
//	'magpul-series'=>$magpul_series,
//	'marble-arms-bullseye-sights'=>$marble_arms_bullseye_sights,
//	'thunder-ranch-series'=>$thunder_ranch_series,
//	'xs-sights'=>$xs_series,
//	'new-2016'=>$new);
//	
//	// Categories
//	$post_categories = array();
//	foreach($categories as $key => $value) {
//		if($value == 'Y') {
//			$term = get_term_by('slug', $key, 'product_cat');
//			if($term) {
//				$post_categories[] = $term->term_id;
//			}
//		}
//	}
//	
//	// Add
//	$post_id = NULL;
//	if(!$wp_id) { 
//		$post = array(
//		'post_name'      => $post_slug,
//		'post_title'     => $title,
//		'post_status'    => $post_status,
//		'post_type'      => 'product',
//		'post_author'    => '1',
//		'ping_status'    => 'closed',
//		'post_parent'    => '0',
//		'menu_order'     => '0',
//		'post_date'      => '2015-01-11 15:20:00',
//		'post_date_gmt'  => '2015-01-11 15:20:00',
//		'comment_status' => 'closed'
//		); 
//		} else {
//		$post = array(
//		'ID'     		 => $wp_id,
//		'post_name'      => $post_slug,
//		'post_title'     => $title,
//		'post_status'    => $post_status,
//		'post_type'      => 'product',
//		'post_author'    => '1',
//		'ping_status'    => 'closed',
//		'post_parent'    => '0',
//		'menu_order'     => '0',
//		'comment_status' => 'closed'
//		); 
//	}
//	$post_id = wp_insert_post($post, $wp_error);
//	if($post_id) {
//		
//		// Categories
//		wp_set_object_terms($post_id, $post_categories, 'product_cat', false);
//		
//		// Custom Fields
//		foreach($specs as $key => $value) {
//			if($value != NULL) {
//				if(!add_post_meta($post_id, $key, $value, true ) ) { 
//					update_post_meta ($post_id, $key, $value);
//				}
//			}
//		}
//		echo "<p>$sku / $title / $post_id</p>";
//	}
//}

//// Format Dealers
//$query = "SELECT dealer_id, dealer_name, dealer_street, dealer_city, dealer_state, dealer_zip, dealer_phone, dealer_website, dealer_email, dealer_type FROM data_dealers ORDER BY dealer_id ASC";
//$result = @mysql_query($query);
//echo "<table style=\"width:100%;\">
//<tr>
//<td>Dealer</td>
//<td>Street</td>
//<td>City</td>
//<td>State</td>
//<td>Zip</td>
//<td>Phone</td>
//<td>Website</td>
//<td>Email</td>
//<td>Type</td>
//</tr>";
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$dealer_id = $row[0];
//	$dealer_name = ucwords(strtolower(trim($row[1])));
//	$dealer_street = ucwords(strtolower(trim($row[2]))).' ';
//	$dealer_city = ucwords(strtolower(trim($row[3])));
//	$dealer_state = strtoupper(trim($row[4]));
//	$dealer_zip = trim($row[5]);
//	$dealer_phone = preg_replace("/[^0-9]/", "", trim($row[6]));
//	$dealer_website = strtolower(trim($row[7]));
//	$dealer_email = strtolower(trim($row[8]));
//	$dealer_type = trim($row[9]);
//	if(strlen($dealer_zip) < 5) {
//		$dealer_zip = '0'.$dealer_zip;
//	}
//	// Phone
//	if(strpos($dealer_phone, '1') === 0) {
//		$dealer_phone = substr($dealer_phone, 1);
//	}
//	if(strlen($dealer_phone) == 10) {
//		$phone1 = substr($dealer_phone,0,3);
//		$phone2 = substr($dealer_phone,3,3);
//		$phone3 = substr($dealer_phone,6,4);
//		$dealer_phone = "($phone1) $phone2-$phone3";
//	}
//	// Website
//	$dealer_website = str_replace('https://','',$dealer_website);
//	$dealer_website = str_replace('http://','',$dealer_website);
//	$dealer_website = str_replace('www.','',$dealer_website);
//	$dealer_website_x = explode('/',$dealer_website);
//	$dealer_website = $dealer_website_x[0];
//	
//	// Street
//	$abbr = array(
//	'Ave'=>'Avenue',
//	'Ave.'=>'Avenue',
//	'St'=>'Street',
//	'St.'=>'Street',
//	'Rd'=>'Road',
//	'Rd.'=>'Road',
//	'Ln'=>'Lane',
//	'Ln.'=>'Lane',
//	'Hwy'=>'Highway',
//	'Hwy.'=>'Highway',
//	'Pkwy'=>'Parkway',
//	'Pkwy.'=>'Parkway',
//	'Blvd'=>'Boulevard',
//	'Blvd.'=>'Boulevard',
//	'Dr'=>'Drive',
//	'Dr.'=>'Drive',
//	'Tpk'=>'Turnpike',
//	'Tpk.'=>'Turnpike',
//	'Tpke'=>'Turnpike',
//	'Tpke.'=>'Turnpike',
//	'Rt'=>'Route',
//	'Rt.'=>'Route',
//	'Rte'=>'Route',
//	'Rte.'=>'Route',
//	'Terr'=>'Terrace',
//	'Terr.'=>'Terrace',
//	'Pl'=>'Place',
//	'Pl.'=>'Place',
//	'Cswy'=>'Causeway',
//	'Cswy.'=>'Causeway',	
//	'Ave,'=>'Avenue',
//	'Ave.,'=>'Avenue',
//	'St,'=>'Street',
//	'St.,'=>'Street',
//	'Rd,'=>'Road',
//	'Rd.,'=>'Road',
//	'Ln,'=>'Lane',
//	'Ln.,'=>'Lane',
//	'Hwy,'=>'Highway',
//	'Hwy.,'=>'Highway',
//	'Pkwy,'=>'Parkway',
//	'Pkwy.,'=>'Parkway',
//	'Blvd,'=>'Boulevard',
//	'Blvd.,'=>'Boulevard',
//	'Dr,'=>'Drive',
//	'Dr.,'=>'Drive',
//	'Tpk,'=>'Turnpike',
//	'Tpk.,'=>'Turnpike',
//	'Tpke,'=>'Turnpike',
//	'Tpke.,'=>'Turnpike',
//	'Rt,'=>'Route',
//	'Rt.,'=>'Route',
//	'Rte,'=>'Route',
//	'Rte.,'=>'Route',
//	'Terr,'=>'Terrace',
//	'Terr.,'=>'Terrace',
//	'Pl,'=>'Place',
//	'Pl.,'=>'Place',
//	'Cswy,'=>'Causeway',
//	'Cswy.,'=>'Causeway');
//	foreach($abbr as $key => $value) {
//		if(strpos($dealer_street, ' '.$key.' ') !== FALSE) {
//			$dealer_street = str_replace(' '.$key.' ', ' '.$value.' ', $dealer_street);
//		}
//	}
//	
//	// Display
//	echo "<tr>
//	<td>$dealer_name</td>
//	<td>$dealer_street</td>
//	<td>$dealer_city</td>
//	<td>$dealer_state</td>
//	<td>$dealer_zip</td>
//	<td>$dealer_phone</td>
//	<td>$dealer_website</td>
//	<td>$dealer_email</td>
//	<td>$dealer_type</td>
//	</tr>";
//	
//	$dealer_name = mysql_real_escape_string($dealer_name);
//	$dealer_street = mysql_real_escape_string($dealer_street);
//	$dealer_city = mysql_real_escape_string($dealer_city);
//	$dealer_state = mysql_real_escape_string($dealer_state);
//	$dealer_zip = mysql_real_escape_string($dealer_zip);
//	$dealer_phone = mysql_real_escape_string($dealer_phone);
//	$dealer_website = mysql_real_escape_string($dealer_website);
//	$dealer_email = mysql_real_escape_string($dealer_email);
//	$dealer_type = mysql_real_escape_string($dealer_type);
//	
//	// Update
//	$query_u = "UPDATE data_dealers SET 
//	dealer_name='$dealer_name', 
//	dealer_street='$dealer_street', 
//	dealer_city='$dealer_city', 
//	dealer_state='$dealer_state', 
//	dealer_zip='$dealer_zip', 
//	dealer_phone='$dealer_phone', 
//	dealer_website='$dealer_website', 
//	dealer_email='$dealer_email', 
//	dealer_type='$dealer_type' 
//	WHERE dealer_id='$dealer_id'";
//	$result_u = @mysql_query($query_u);	
//	
//	echo mysql_error();
//}
//echo "</table>";

// Match Dealers
//$args = array('category_name'=>'us-dealers','posts_per_page'=>4000);
//$paged_query = query_posts($args);
//$count = 1;
//while(have_posts()):the_post();
//
//	$location_id = $post->ID;
//	$location_title = $post->post_title;
//	$location_content = wpautop($post->post_content);
//	$location_address = get_post_meta($post->ID, 'Location Address', true);
//	$location_state = get_post_meta($post->ID, 'Location State', true);
//	$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
//	$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
//	echo "<p>$location_id / $location_title / $location_latitude / $location_longitude</p>";
//	$query_d = "SELECT data_id FROM data_dealers_update WHERE live_lat='$location_latitude' AND live_lon='$location_longitude'";
//	$result_d = @mysql_query($query_d);
//	while($row_d = @mysql_fetch_array($result_d,MYSQL_NUM)) {
//		$data_id = $row_d[0];
//		$query_du = "UPDATE data_dealers_update SET wp_id='$location_id' WHERE data_id='$data_id'";
//		$result_du = @mysql_query($query_du);
//	}	
//	$count++;
//endwhile;
// Add Dealers
//$query = "SELECT live_title, live_info, live_address, state, live_lat, live_lon, type FROM data_dealers_update ORDER BY live_title ASC";
//$result = @mysql_query($query);
//$count = 1;
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$title = $row[0];
//	$info = $row[1];
//	$address = $row[2];
//	$state = strtoupper($row[3]);
//	$lat = $row[4];
//	$lon = $row[5];
//	$type = $row[6];
//	$categories = array('132','133');
//	if($type == 'TC') {
//		$categories = array('132','133','292');
//	}
//	if($count > 2123) {
//		echo "<p>$title / $address / $state / $lat / $lon / $type</p>";
//		$post = array('post_content'=>$info, 'post_title'=>$title, 'post_status'=>'publish', 'post_type'=>'post', 'post_category'=>$categories);  
//		$post_id = wp_insert_post($post);
//		add_post_meta($post_id, 'Location Latitude', $lat, true);
//		add_post_meta($post_id, 'Location Longitude', $lon, true);
//		add_post_meta($post_id, 'Location Address', $address, true);
//		add_post_meta($post_id, 'Location State', $state, true);
//	}
//	$count++;
//}
// Remove Dealers
//$args = array('category_name'=>'us-dealers','posts_per_page'=>4000);
//$paged_query = query_posts($args);
//$count = 1;
//while(have_posts()):the_post();
//	$location_id = $post->ID;
//	$location_title = $post->post_title;
//	$location_content = wpautop($post->post_content);
//	$location_address = get_post_meta($post->ID, 'Location Address', true);
//	$location_state = get_post_meta($post->ID, 'Location State', true);
//	$location_latitude = get_post_meta($post->ID, 'Location Latitude', true);
//	$location_longitude = get_post_meta($post->ID, 'Location Longitude', true);
//	wp_delete_post( $location_id, true ); 
//	echo "<p>$location_id / $location_title / $count</p>";
//	$count++;
//endwhile;
// Duplicates
//$query = "SELECT data_id, title, live_lat FROM data_dealers_update group by live_lat having count(*) >= 2 ORDER BY live_lat ASC";
//
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	echo "<p>$row[0] $row[1] $row[2]</p>";
//}
// Dealers
//$query = "SELECT data_id, title, street, street2, city, state, zip, phone, website, email, type FROM data_dealers_update ORDER BY data_id ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$dealer_id = $row[0];
//	$dealer_name = ucwords(strtolower(trim($row[1])));
//	$dealer_street1 = ucwords(strtolower(trim($row[2])));
//	$dealer_street2 = ucwords(strtolower(trim($row[3])));
//	$dealer_city = ucwords(strtolower(trim($row[4])));
//	$dealer_state = strtoupper(trim($row[5]));
//	$dealer_zip = trim($row[6]);
//	$dealer_phone = preg_replace("/[^0-9,.]/", "", trim($row[7]));
//	$dealer_website = strtolower(trim($row[8]));
//	$dealer_email = strtolower(trim($row[9]));
//	$dealer_type = trim($row[10]);
//	if($dealer_street2) {
//		$dealer_street = $dealer_street1.' '.$dealer_street2;
//		} else {
//		$dealer_street = $dealer_street1;
//	}
////	 Formatted
//$dealer_info = "$dealer_street
//$dealer_city, $dealer_state $dealer_zip";
//if($dealer_phone) {
//$dealer_info.="
//$dealer_phone";
//}
//if($dealer_website) {
//$dealer_info.="
//$dealer_website";
//}
//if($dealer_email) {
//$dealer_info.="
//$dealer_email";
//}
//	$dealer_address = "$dealer_street $dealer_city $dealer_state $dealer_zip";
	
//	 Geocode
	//$gapi_key = 'AIzaSyAmmJ4SrkrScT5-ZKiewvrN7cmVhDVpAcQ';
//	$base_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=";
//	$address = $dealer_address;
//	$sensor = "&sensor=false";
//	$key = "&key=$gapi_key";
//	$request_url = $base_url.urlencode($address).$sensor.$key;
//	sleep(1);
//	$xml = simplexml_load_file($request_url);	
//	$status = $xml->status;
//	if($status == 'OK') {
//		$latitude = $xml->xpath('result/geometry/location/lat');
//		$location_latitude = (string)$latitude[0];
//		$longitude = $xml->xpath('result/geometry/location/lng'); 
//		$location_longitude = (string)$longitude[0];
//		
//		$query_l = "UPDATE data_dealers_update SET live_lat='$location_latitude', live_lon='$location_longitude' WHERE data_id=$dealer_id";
//		$result_l = @mysql_query($query_l);
//		echo "<p>$dealer_id | $dealer_address | $location_latitude | $location_longitude</p>";
//	}
	
	// Update
//	if($dealer_name == "Cabelas") {
//		$dealer_name = "Cabela's";
//	}
//	$dealer_title = mysql_real_escape_string($dealer_name);
//	$dealer_info = mysql_real_escape_string($dealer_info);
//	$dealer_address = mysql_real_escape_string($dealer_address);
//	echo "<p>$dealer_info</p><p>$dealer_address</p><p>-----------------------------------------------------</p>";
//	
//	$query_i = "UPDATE data_dealers_update SET live_title='$dealer_title', live_info='$dealer_info', live_address='$dealer_address' WHERE data_id=$dealer_id";
//	$result_i = @mysql_query($query_i);	
//	
//	echo mysql_error();
//}
// Catalog Images
//$query = "SELECT wp_posts.ID, wp_postmeta.meta_value FROM wp_posts, wp_postmeta WHERE wp_posts.post_type='product' AND wp_posts.ID=wp_postmeta.post_id AND wp_postmeta.meta_key='_sku'";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_NUM)) {
//	$product_id = $row[0];
//	$product_sku = $row[1];
//	
//	// Thumbnail
//	$product_match = $product_sku.'-catalog';
//	$query_p = "SELECT ID FROM wp_posts WHERE post_type='attachment' AND post_name='$product_match' LIMIT 1";
//	$result_p = @mysql_query($query_p);
//	$row_p = @mysql_fetch_array($result_p, MYSQL_ASSOC);
//	$thumbnail_id = $row_p['ID'];
//	
//	// Meta
//	$query_m = "SELECT meta_id FROM wp_postmeta WHERE post_id='$product_id' AND meta_key='_thumbnail_id'";
//	$result_m = @mysql_query($query_m);
//	while($row_m = @mysql_fetch_array($result_m, MYSQL_NUM)) {
//		$meta_id = $row_m[0];
//	}
//	
//	// Update
//	$query_u = "UPDATE wp_postmeta SET meta_value='$thumbnail_id' WHERE meta_id='$meta_id'";
//	$result_u = @mysql_query($query_u); 
//	
//	echo "<p>$product_id | $product_sku | $thumbnail_id | $meta_id</p>";
//}
//echo mysql_error();
// Product Images
//$args = array('post_type'=>'product','orderby'=>array('title'=>'ASC', 'meta_value'=>'ASC'),'meta_key'=>'_sku','order'=>'ASC');
//query_posts($args);
//while(have_posts()):the_post();
//	$product_id = get_the_ID();
//	$product_sku = get_post_meta($product_id, '_sku', true);
//	$product_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'full');
//	$product_image = $product_image_src[0];
//	echo "<p>$product_id | $product_sku | <a href=\"$product_image\" target=\"_blank\">$product_image</a></p>";
//	
//	//Get the file
//	$content = file_get_contents($product_image);
//	//Store in the filesystem.
//	$fp = fopen("/var/www/html/catalog/$product_sku-catalog.jpg", "w");
//	fwrite($fp, $content);
//	fclose($fp);
//	
//endwhile;
//// Media
//$query = "SELECT * FROM wp_posts WHERE post_type='attachment' AND post_name LIKE '%-media' ORDER BY post_name ASC";
//$result = @mysql_query($query);
//while($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
//	$media_id = $row['ID'];
//	$media_title = $row['post_title'];
//	$media_explode = explode('-',$media_title);
//	$media_sku = $media_explode[0];
//	// Product
//	$product_match = '%-'.$media_sku;
//	$query_p = "SELECT * FROM wp_posts WHERE post_type='product' AND post_name LIKE '$product_match' LIMIT 1";
//	$result_p = @mysql_query($query_p);
//	$row_p = @mysql_fetch_array($result_p, MYSQL_ASSOC);
//	$product_id = $row_p['ID'];
//	$product_title = $row_p['post_title'];
//	// Title	
//	$media_title = $product_title.' #'.$media_sku;
//	$media_categories = array();
//	// Categories
//	$terms = get_the_terms( $product_id, 'product_cat' );
//	foreach ($terms as $term) {
//		$category_id = $term->term_id;
//		$category_name = str_replace('  ', ' ', (preg_replace('/[^A-Za-z0-9]/', ' ', str_replace('&reg;', '', str_replace('&trade;', '', $term->name)))));
//		$media_categories[] = $category_name;
//	}
//	
//		
//	// Media Cat IDs
//	$media_kit_id = 156;
//	$firearms_id = 151;
//	$pistols = 243;
//	$rifles = 241;
//	$shotguns = 242;
//	
//	// Add Categories
//	$add_categories = array($media_kit_id,$firearms_id);
//	if(in_array('Rifles',$media_categories)) {
//		$add_categories[] = $rifles;
//	}
//	if(in_array('Shotguns',$media_categories)) {
//		$add_categories[] = $shotguns;
//	}
//	if(in_array('Pistols',$media_categories)) {
//		$add_categories[] = $pistols;
//	}
//	$term_taxonomy_ids = wp_set_object_terms($media_id, $add_categories, 'media_category');	
//	$add_categories = implode(', ',$add_categories);
//	
//	// Update
//	$media_categories = implode(', ',$media_categories);
//	$query_u = "UPDATE wp_posts SET post_title='$media_title', post_content='$media_categories' WHERE ID='$media_id'";
//	$result_u = @mysql_query($query_u);
//		
//	echo "<p>$media_sku / $media_title<br/>$add_categories</p>";
//}
?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>

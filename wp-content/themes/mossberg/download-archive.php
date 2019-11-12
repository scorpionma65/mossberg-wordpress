<?php
// Connect
//require_once('');

// Create Zip
function create_zip($files = array(), $zip_file_name, $destination, $overwrite) {
	
	$filepath = "";
	if(file_exists($destination) && !$overwrite) { 
		return true; 
		} else {
		$valid_files = array();
		if(is_array($files)) {
			foreach($files as $file) {
				if(file_exists($filepath.$file)) {
					$valid_files[] = $file;
				}
			}
		}
	
		if(count($valid_files)) {
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			foreach($valid_files as $file) {			
				$file_name = end(explode('/',$file));			
				$zip->addFile($filepath.$file,$zip_file_name.'/'.$file_name);
			}		
			$zip->close();
			return file_exists($destination);
			} else {
			return false;
		}	
	}
}
?>

<?php
// Category Zip
if(!empty($_GET['id'])) {
	$category_id = mysql_real_escape_string($_GET['id']);
	$query = "SELECT name, slug FROM wp_terms WHERE term_id='$category_id'";
	$result = @mysql_query($query);
	$row = @mysql_fetch_array($result,MYSQL_NUM);
    $category_name = $row[0]; 
    $category_slug = $row[1];
	$site_domain = "http://" . $_SERVER['SERVER_NAME'];
	$site_public_path = "/var/www/html";
	// Files
	$files = array();
	$query_f = "SELECT wp_posts.guid FROM wp_posts, wp_term_relationships WHERE wp_term_relationships.object_id=wp_posts.ID AND wp_term_relationships.term_taxonomy_id='$category_id' AND wp_posts.post_type='attachment'";
	$result_f = @mysql_query($query_f);
	while($row_f = @mysql_fetch_array($result_f,MYSQL_NUM)) {
		$filepath = str_replace($site_domain,$site_public_path,$row_f[0]);
		$files[] = $filepath;
	}
}
// Zip
$zip_name = $category_slug.'.zip';
$zip_location = $site_public_path.'/media/'.$zip_name;
if(create_zip($files, $zip_name, $zip_location, false)) {
	header("Location: ".$site_domain."/media/".$zip_name);
}
?>
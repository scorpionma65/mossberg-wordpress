<?php
/*
Template Name: Download
*/
?>
<?php get_header(); ?>
<?php include(TEMPLATEPATH.'/inc/inc-mysql-connect.php');?>
<?php
// Download
if(!empty($_GET['id'])) {
	$id = sanitize_text_field($_GET['id']); 
	if(is_numeric($id)) {
		$match = 'ID';
		} else {
		$match = 'post_name';
	}	
	$query = "SELECT post_title, guid, post_mime_type FROM wp_posts WHERE $match = '$id'";
	$result = @mysql_query($query);
	$row = @mysql_fetch_array($result,MYSQL_NUM);
    $download_name = $row[0]; 
    $download_file = $row[1];
    $download_mime = $row[2];
	
	$download_name = end(explode('/',$download_file));
	header("Content-Description: File Transfer");
    header("Content-type:".$download_mime);
    header("Content-Disposition: attachment; filename=".$download_name);
	header("Content-Transfer-Encoding: binary");
	header("Expires: 0");
	header("Cache-Control: must-revalidate");
	header("Pragma: public");
	header("Content-Length: ".filesize($download_file));
	ob_clean();
	flush();
	readfile($download_file);
	exit;
}
?>
<?php get_footer(); ?>
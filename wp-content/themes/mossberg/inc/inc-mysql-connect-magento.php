<?php
// Config Connection
$db_user = 'admin';
$db_password = 'MyiRu@pure';
$db_host = 'DBMM';
$db_name =  'mossberg_mag00';

// MySQL Connect
$db_connect = mysql_connect($db_host, $db_user, $db_password) or die(mysql_error());
@mysql_select_db($db_name) or die(mysql_error());
?>
<?php
	$URL 				= "http://localhost/clipdig/";
	$TIMEZONE		= "Asia/Jakarta";

	$DB_SERVER		= "localhost";
	$DB_USER			= "clipdig";
	$DB_PASSWORD	= "clipdig";
	$DB_NAME			= "clipdig";
	$list_table		= "Tables_in_".$DB_NAME;

	define("__DB_NAME__", $DB_NAME);

	mysql_connect($DB_SERVER,$DB_USER,$DB_PASSWORD)  or die(mysql_error());
	mysql_select_db($DB_NAME) or die  (mysql_error());
?>

<?php
$NAME 			= Settings("Name");
$Version 		= Settings("Version");
$Description 	= Settings("Description");
$DefaultSearch = Settings("DefaultSearch");
$DataPerPage 	= Settings("DataPerPage");
$TimeOut			= Settings("TimeOut");


$NO0 				= 0;
$NO1 				= 1;
$NOW 				= date("Y-m-d H:i:s");
$TODAY 			= date("Y-m-d");


date_default_timezone_set($TIMEZONE);
session_start();
ob_start();

$_SESSION['timeout'] = time() + $TimeOut;
?>

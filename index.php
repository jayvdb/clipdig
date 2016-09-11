<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");
include ("form/header.php");

if(!empty($_GET['m'])){
	$m = $_GET['m'];
	switch($m){
		case "Dashboard":
			$view = "form/dashboard.php";
			break;
		case "Scrap":
			$view = "form/scrap.php";
			break;
		case "Chart":
			$view = "form/chart.php";
			break;
		case "Category":
			$view = "form/category.php";
			break;
		case "Setting":
			$view = "form/setting.php";
			break;
		case "Login":
			$view = "form/login.php";
			break;
		case "Logout":
			$view = "form/logout.php";
			break;
		default:
			$view = "form/404.php";
			break;
	}

include $view;
}
else{
	header("location:?m=Dashboard");
}

include("form/footer.php");

?>

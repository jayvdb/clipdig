<?php
	include("simple_html_dom.php");
	$menu = $_GET['m'];
	$lowmenu = ifset('l');

	if(empty($lowmenu)){
		header("location:?m=Scrap&l=Data");
	}
?>

<!-- ADD -->
	<?php
	if(isset($_GET['l'])){
		if($lowmenu=="AddBySite"){
			include ("scrap-addbysite.php");
		}
		elseif($lowmenu=="Data"){
			include ("scrap-data.php");
		}
		elseif($lowmenu=="DataCount"){
			include ("scrap-data-count.php");
		}
		elseif($lowmenu=="View"){
			include ("scrap-view.php");
		}
		elseif($lowmenu=="Chart"){
			include ("scrap-chart.php");
		}
		elseif($lowmenu=="Pivot"){
			include ("scrap-pivot.php");
		}
	}
	?>


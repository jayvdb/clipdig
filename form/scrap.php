<?php
	include("simple_html_dom.php");
	$menu = $_GET['m'];
	$lowmenu = ifset('l');
	
	if(empty($lowmenu)){
		header("location:?m=Scrap&l=Data");
	}
?>

<div class="col-lg-12">
	<div class="well-sm well-me">
	<div class="navbar">
		<div class="btn-group">
			<a class="btn btn-default btn-sm <?php if($lowmenu=="AddBySite"){echo "active";} ?>" href="?m=<?php echo $menu;?>&l=AddBySite" ><i class="fa fa-globe"></i> Add by Site</a>
			<a class="btn btn-default btn-sm <?php if($lowmenu=="Data"){echo "active";} ?>" href="?m=<?php echo $menu;?>&l=Data"><i class="fa fa-table"></i> Data</a>
			<a class="btn btn-default btn-sm <?php if($lowmenu=="DataCount"){echo "active";} ?>" href="?m=<?php echo $menu;?>&l=DataCount"><i class="fa fa-table"></i> Count Data</a>
			<a class="btn btn-default btn-sm <?php if($lowmenu=="Chart"){echo "active";} ?>" href="?m=<?php echo $menu;?>&l=Chart"><i class="fa fa-pie-chart"></i> Chart</a>
			<a class="btn btn-default btn-sm <?php if($lowmenu=="Pivot"){echo "active";} ?>" href="?m=<?php echo $menu;?>&l=Pivot"><i class="fa fa-table"></i> Pivot</a>
		</div>
	</div>
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
			include ("Pivot.php");
		}
	}
	?>

</div>


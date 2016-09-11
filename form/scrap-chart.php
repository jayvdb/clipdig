<?php include ('scrap-menu.php'); ?>


<div class="col-lg-12">
<div class="well-sm well-me">
	<div id="chart" ></div>
</div>
</div>
<?php
	include('scrap-where.php');

	$ShowMedia = explode(",",ShowMedia());

if(!empty($_GET['tgl1']) AND !empty ($_GET['tgl2'])){
	$q = "SELECT DISTINCT `waktu` as `waktu` FROM `data` $WHERE ORDER BY `waktu` DESC ";
}
else{
	$q = "SELECT DISTINCT YEAR(waktu) as `waktu` FROM `data` $WHERE ORDER BY `waktu` DESC ";
}

//chart ------------------------------
	$chart_data="";
	$key="";
	$label="";
	$chart = "
	<script>
	$(window).load(function() {
	Morris.Bar({
			element: 'chart',
			data: [";

	$qry=mysql_query($q)or die(mysql_error());
	while ($b=mysql_fetch_array($qry)){
		$chart_data .= '{y:\''.$b['waktu'].'\',';
		$count_data="";
		foreach($ShowMedia as $data){
			$count_data.= '\''.Balikin($data).'\':'.getCount($data,$WHERE,$b['waktu']).",";
		}
		$chart_data .= substr($count_data,0,strlen($count_data)-1);
		$chart_data .='},';
	}
	$chart .= substr($chart_data,0,strlen($chart_data)-1);
	$chart .="],xkey: 'y',ykeys: [";
		foreach($ShowMedia as $data){
			$key.= '\''.strtolower(Balikin($data)).'\',';
		}
		$chart .= substr($key,0,strlen($key)-1);

	$chart.="],labels: [";
		foreach($ShowMedia as $data){
			$label.= '\''.strtoupper(Balikin($data)).'\',';
		}
		$chart .= substr($label,0,strlen($label)-1);
	$chart .="],
			hideHover: 'auto',
			resize: true
			});
			});
			</script>";
	echo $chart;
?>
<script src="<?php echo $URL ?>static/js/morris/raphael.min.js"></script>
<script src="<?php echo $URL ?>static/js/morris/morris.min.js"></script>
<?php include ('scrap-footer.php'); ?>

<?php 
		$media=ifset('me');$page=ifset('p');$search=ifset('se');$tgl1=ifset('tgl1');$tgl2=ifset('tgl2');$status=ifset('st');$searched=ifset('searched');$tags=ifset('tags');$city=ifset('city');
	
	if(empty($media)){header("location:?m=Scrap&l=Chart&st=all&searched=&tags=&city=&p=&tgl1=&tgl2=&me=all");}
	elseif(empty($page)){$page=1;}

	CreateMenuStatus();
	CreateMenuSearched();
	
	echo '<table class="table"><tr><td>';
	CreateSearchDate();		
	echo'</td></tr></table>';
?>
</div><!-- well well-sm -->
<div class="col-lg-2"></div>
<div class="col-lg-12">
<div class="well-sm well-me">
	<div id="chart" ></div>
<?php
	$WHERE="WHERE";
	$NAME_FILE="CHART by | ";
	
	if(!empty($tgl1) AND !empty($tgl2)){
		$WHERE .=" (`waktu` BETWEEN '$tgl1' and '$tgl2') AND ";
		$NAME_FILE.="Time($tgl1|$tgl2) ";
	}
	else{
		$WHERE .="";
		$NAME_FILE.="Time(byYear) ";
	}
	
	if(isset($status)){
		if($status!="all" AND $status!=""){
			$WHERE .=" `status`='$status' AND ";
			
			if($status==0){$status = 'Dowloaded_Header';}
			elseif($status==1){$status='Not_Checked';}
			elseif($status==2){$status='Positive';}
			elseif($status==3){$status='Negative';}
			elseif($status==4){$status='Deleted';}
			
			$NAME_FILE.="Status($status) ";
		}
		else{
			$WHERE .="";
			$NAME_FILE.="Status(ALL) ";
		}
	}
	if(!empty($searched)){
		if($searched!="all"){
			$WHERE .=" `search` LIKE '%$searched%' AND ";
			$NAME_FILE.="Searched($searched) ";
		}
		else{
			$WHERE .="";
			$NAME_FILE.="Searched(ALL) ";
		}
	}
	if(!empty($tags)){
		if($tags!="all"){
			$WHERE .=" `tags` LIKE '%$tags%' AND ";
			$NAME_FILE.="Tags($tags) ";
		}
		else{
			$WHERE .="";
			$NAME_FILE.="Tags(ALL) ";
		}
	}
	if(!empty($city)){
		if($city!="all"){
			$WHERE .=" `city` LIKE '%$city%' AND ";
			$NAME_FILE.="City($city) ";
		}
		else{
			$WHERE .="";
			$NAME_FILE.="City(ALL) ";
		}
	}			

	$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
	$NAME_FILE = substr($NAME_FILE,0,(strlen($NAME_FILE)-1));
	$ShowMedia = explode(",",ShowMedia());
			
if(!empty($_GET['tgl1']) AND !empty ($_GET['tgl2'])){
	$q = "SELECT DISTINCT `waktu` as `waktu` FROM `data` $WHERE  ORDER BY `waktu` DESC ";
}
else{
	$q = "SELECT DISTINCT YEAR(waktu) as `waktu` FROM `data` $WHERE ORDER BY `waktu` DESC ";
}
	//echo "<textarea cols='200' rows='2'>".$q."</textarea>";
	
	
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
			$count_data.= $data.':'.getCount($data,$WHERE,$b['waktu']).",";
		}
		$chart_data .= substr($count_data,0,strlen($count_data)-1);
		$chart_data .='},';
	}
	$chart .= substr($chart_data,0,strlen($chart_data)-1);
	$chart .="],xkey: 'y',ykeys: [";
		foreach($ShowMedia as $data){
			$key.= '\''.strtolower($data).'\',';
		}
		$chart .= substr($key,0,strlen($key)-1);
	
	$chart.="],labels: [";
		foreach($ShowMedia as $data){
			$label.= '\''.strtoupper($data).'\',';
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
<?php echo '<b>'.$NAME_FILE.'</b>'; ?>

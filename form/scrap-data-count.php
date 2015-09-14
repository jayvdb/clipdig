<?php include('scrap-menu.php');?>

<div class="col-lg-12">
<div class="well-sm well-me">
<div class="table-responsive">
<table class="table table-hover  table-striped get" id="tocsv" >
	<thead>
	<tr>
		<th width="150px">Publish</th>
		<?php
			$ShowMedia = explode(",",ShowMedia());
			foreach($ShowMedia as $b){
				echo "<th>".Balikin($b)."</th>";
			}
		?>
	</tr>
	</thead>
	<tbody>
<?php
			$WHERE="WHERE";
			$NAME_FILE="COUNT_DATA_by_";
			
			if(!empty($tgl1) AND !empty($tgl2)){
				$WHERE .=" (`waktu` BETWEEN '$tgl1' and '$tgl2') AND ";
				$NAME_FILE.="Time($tgl1|$tgl2)_";
			}
			else{
				$WHERE .="";
				$NAME_FILE.="Time(byYear)_";
			}
			
			if(isset($status)){
				if($status!="all" AND $status!=""){
					$WHERE .=" `status`='$status' AND ";
					
					if($status==0){$status = 'Dowloaded_Header';}
					elseif($status==1){$status='Not_Checked';}
					elseif($status==2){$status='Positive';}
					elseif($status==3){$status='Negative';}
					elseif($status==4){$status='Deleted';}
					
					$NAME_FILE.="Status($status)_";
				}
				else{
					$WHERE .="";
					$NAME_FILE.="Status(ALL)_";
				}
			}
			if(!empty($searched)){
				if($searched!="all"){
					$WHERE .=" `search` LIKE '%$searched%' AND ";
					$NAME_FILE.="Searched(".str_replace(" ","_",$searched).")_";
				}
				else{
					$WHERE .="";
					$NAME_FILE.="Searched(ALL)_";
				}
			}
			if(!empty($wilayah)){
				$pjg = strlen($wilayah);
				if($pjg<=2){
					$WHERE .=" `wilayah` LIKE '$wilayah%' AND length (`wilayah`) <=5 AND ";
				}else{
					$WHERE .=" `wilayah` LIKE '%$wilayah%' AND length (`wilayah`) <=5 AND ";
				}
			}
			
			//category  ------------------------
			if(!empty($category)){
				$WHERE_="";
				$category_ = explode(";",$category);
				$count_category = count($category_);
				for($i=1;$i<$count_category;$i++){
					$category__=explode(":",$category_[$i]);
					$category_name = $category__[0];
					$category_data = $category__[1];
					
					if($category_data!="all"){
						$WHERE_ .=" `$category_name` LIKE '%$category_data%' AND ";
					}
				}
				$WHERE .=$WHERE_;
			}
			//category  ------------------------

			$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
			$NAME_FILE = substr($NAME_FILE,0,(strlen($NAME_FILE)-1));





//$csv_output="";			
if(!empty($_GET['tgl1']) AND !empty ($_GET['tgl2'])){
	$q = "SELECT DISTINCT `waktu` as `waktu` FROM `data` $WHERE  ORDER BY `waktu` DESC ";
}
else{
	$q = "SELECT DISTINCT YEAR(waktu) as `waktu` FROM `data` $WHERE ORDER BY `waktu` DESC ";
}

$qry=mysql_query($q)or die(mysql_error());
while ($b=mysql_fetch_array($qry)){
	$NO0++;
	echo '
	<tr>
		<!-- <td align="right" >'.$NO0.'.</td> -->
		<td align="center" >'.$b['waktu'].'</td>';
		//$csv_output .=$b['waktu'].",";
	foreach($ShowMedia as $data){
		echo '<td align="center">'.getCount($data,$WHERE,$b['waktu']).'</td>';
	}
	echo '</tr>';
}
?>
</tbody>
</table>
<small><?php echo "Save with name: ".$NAME_FILE.".csv"; ?></small>
</div>

<form name="export" action="<?php echo $URL."form/getcsv.php";?>" method="post">
    <button class="btn-primary btn-xs" id="getcsv" type="submit" ><i class="fa fa-download"></i> Get CSV</button>
    <input type="hidden" value="<?php echo $NAME_FILE;?>" name="csv_name">
    <input type="hidden" value="" name="csv_text" id="csv_text">
</form>
</div>
</div>
<?php include('scrap-footer.php');?>

<?php
	$media=ifset('me');
	$page=ifset('p');
	$search=ifset('se');
	$tgl1=ifset('tgl1');
	$tgl2=ifset('tgl2');
	$status=ifset('st');
	$searched=ifset('searched');
	$wilayah=ifset('wilayah');
	
	
	//category
	$category = ifset('category');
	
	if(empty($media)){header("location:?m=Scrap&l=Data&me=all&st=all&searched=&p=&se=&tgl1=&tgl2=wilayah=");}
	elseif(empty($page)){$page=1;}
	
	CreateMenuMedia();
	CreateMenuStatus();
	echo CreateWilayah($wilayah);
	CreateMenuSearched();
	CreateMenuCategory();
	echo '
		<table class="table">
			<tr>
				<td>';CreateSearch();echo'</td>
				<td>';CreateSearchDate();echo'</td>
			</tr>
		</table>';
?>
</div><!-- well well-sm -->
<div class="well-sm well-me"><?php CreatePagination($DataPerPage,$media,$search,$tgl1,$tgl2,$status,$searched,$category);?>
<div class="table-responsive">
	<table class="table  table-hover table-striped" >
		<thead>
		<tr>
			<!-- <th width="50px"></th> -->
			<th width="50px">No.</th>
			<th width="100px">Publish</th>
			<th >Media</th>
			<th align="left">News Title</th>
			<th>Status</th>
		</tr>
		</thead>
		<tbody>
		<?php
			
			$WHERE="WHERE";
			if(!empty($media)){
				if($media!="all"){$WHERE .=" `media`='$media' AND ";}
				else{$WHERE .="";}
			}
			if(!empty($search)){
				$WHERE .=" (`judul` LIKE '%$search%' OR `waktu` LIKE '%$search%' OR `penulis` LIKE '%$search%'  ) AND ";
			}
			if(!empty($tgl1) AND !empty($tgl2)){
				$WHERE .=" (`waktu` BETWEEN '$tgl1' and '$tgl2') AND ";
			}
			else{$WHERE .="";}
			
			if(isset($status)){
				if($status!="all" AND $status!=""){$WHERE .=" `status`='$status' AND ";}
				else{$WHERE .="";}
			}
			if(!empty($searched)){
				if($searched!="all"){$WHERE .=" `search` LIKE '%$searched%' AND ";}
				else{$WHERE .="";}
			}
			if(!empty($wilayah)){
				$WHERE .=" `wilayah` LIKE '%$wilayah%' AND length (`wilayah`) <=5 AND ";
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
			if(!empty($page)){$p=$page;}else{$p=0;} //page
			$NO=($p-1)*$DataPerPage;
			$LIMIT = "LIMIT ".$NO.",".$DataPerPage;
			$q="SELECT * FROM `data` ".$WHERE."  ORDER BY `waktu` DESC ".$LIMIT;
			$qry=mysql_query($q) or die(mysql_error());
			
				
			while($data=mysql_fetch_array($qry)){
				$NO++;
				if(!isset($data['photo'])){$photo="img/default.png";}
				else{$photo=Balikin($data['photo']);}
				echo '
				<tr>
					<!-- <td><a href="?m='.$_GET['m'].'&l=View&op=edit&kode='.$data['kode'].'"><small class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</small></a></td> -->
					<td align="right">'.$NO.'.</td>
					<td align="center" ><a href="?m='.ifset('m').'&l='.ifset('l').'&me='.$media.'&st='.$status.'&searched='.$searched.'&tgl1='.$data['waktu'].'&tgl2='.$data['waktu'].'"">'.$data['waktu'].'</a></td>
					<td align="center"><a href="?m='.ifset('m').'&l='.ifset('l').'&me='.$data['media'].'&st='.$status.'&searched='.$searched.'&tgl1='.$tgl1.'&tgl2='.$tgl2.'">'.$data['media'].'</a></td>
					<td><a class="linkthumb" target="_blank" href="?m='.$_GET['m'].'&l=View&op=edit&kode='.$data['kode'].'"  >'.html_entity_decode(Balikin($data['judul'])).'<img  class="thumbnail" src="'.$photo.'" style="margin-top:5px;"></a></td>
					<td width="10px" align="center">';
					if($data['status']==4){echo '<span class="text-danger"><i class="fa fa-trash"></i> </span>';}
				echo'</td>
				</tr>
				';
			}
					
		?>
		</tbody>
	</table>
</div>
	<?php //echo "<textarea cols='200' rows='2' class='form-control'>".$q."</textarea>"; ?>
</div>
<!--
///category
-->
<script>
	locations = $(location).attr('href');
	locations = locations.split('?');
	locations = locations[0];
	<?php
	    if(!empty($category)){
				$category_ = explode(";",$category);
				$count_category = count($category_);
				for($i=1;$i<$count_category;$i++){
					$category__=explode(":",$category_[$i]);
					$category_name = $category__[0];
					$category_data = $category__[1];
					
					print("$(\"div.category select[name='".$category_name."'] \").val('".$category_data."');\n ");
				}
			}
		
		if(ifset('l') == "Data"){
			print('url="?m='.ifset('m').'&l='.ifset('l').'&me='.ifset('me').'&st='.ifset('st').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2').'";');
			print("wilayah='".ifset('wilayah')."';");
			print('if(wilayah!=""){
						wilayah_ = wilayah.split(".");
						$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb&kode=\'+wilayah_[0]);
						$(\'#kabkot\').load(\'action.php\',\'op=get_kabkot_cmb&data=\'+wilayah_[0]+\'&kode=\'+wilayah);
					}else{
						$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb\');
					}');
			print('$(\'#prov\').change(function() { 
					window.location.href=url+"&wilayah="+$(this).val();
				});
				$(\'#kabkot\').change(function() {
					window.location.href=url+"&wilayah="+$(this).val();
				});');
		}
		
		
			
	?>
		
	
	
</script>
	
 

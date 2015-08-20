<?php include ('scrap-menu.php'); ?>
<div class="col-lg-12">
<div class="well-sm well-me"><?php CreatePagination($DataPerPage,$media,$search,$tgl1,$tgl2,$status,$searched,$category,$wilayah);?>
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
			include('scrap-where.php');
					
			while($data=mysql_fetch_array($qry)){
				$NO++;
				if(!isset($data['photo'])){$photo="img/default.png";}
				else{$photo="";
					//Balikin($data['photo']);
					}
				echo '
				<tr>
					<!-- <td><a href="?m='.$_GET['m'].'&l=View&op=edit&kode='.$data['kode'].'"><small class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</small></a></td> -->
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
</div>
</div>
<?php include ('scrap-footer.php'); ?>

</div>
<script type="text/javascript">
$(function(){
		var input = $("#input")
		$("#output").pivotUI(input, 
		{ 
			rows: ["color"], 
			cols: ["shape"] 
		});
 });
</script>

<div class="row">
	<div class="col-lg-12">
	<div class="well-sm well-me">
	<div class="table-responsive">
		<div id="output"></div>
	</div>
	</div>
	</div>
</div>

		
		<?php
			$gui = '<table border="1" cellpadding="3" cellspacing="0" style="font-size:10pt; display:none;" class="table table-bordered table-striped" id="input">
		<thead><tr>
			<th>No</th>
			<th>Kode Berita</th>
			<th>Provinsi</th>
			<th>Kota/Kabupaten</th>
			<th>Media</th>
			<th>Judul Berita</th>
			<th>Tanggal</th>
			<th>URL Berita</th>
			<th>URL Gambar</th>
			<th>Berita</th>';
		
		$c="";
		foreach(list_category("") as $cat){
			$category = $cat[0];
			$category = str_replace("category_","",$category);
			$category = str_replace("-"," ",$category);
			$category = ucwords($category);
			
			
			$c .='<th>'.$category.'</th>';
		}
		
		
			
			$gui .=$c;
			$gui .='<th>Waktu diambil</th>
			
		</tr></thead>
		';	
$q = mysql_query("select * from `data` order by `media` asc")or die(mysql_error());
$t="<tbody>";
while($d=mysql_fetch_array($q)){
	$wilayah = $d['wilayah'];
	if(strlen($wilayah)>0 and strlen($wilayah)<=2 ){
		$provinsi = get_name_wilayah($wilayah);
		$kotkab ="";
					
	}
	elseif(strlen($wilayah)>3){
		$wilayah = explode(".",$wilayah);
		$provinsi = get_name_wilayah($wilayah[0]);
		$kotkab = get_name_wilayah($wilayah[0].".".$wilayah[1]);
	}
	else{
		$provinsi ="";
		$kotkab="";
	}
	
	
	$t .='<tr>
		<td align="right">'.$NO1++.'.</td>
		<td>'.$d['kode'].'</td>
		<td>'.$provinsi.'</td>
		<td>'.$kotkab.'</td>
		<td>'.Balikin($d['media']).'</td>
		<td>'.Balikin($d['judul']).'</td>
		<td>'.Balikin($d['waktu']).'</td>
		<td><a href="'.Balikin($d['link']).'" target="_blank">'.Balikin($d['link']).'</a></td>
		<td>'.Balikin($d['photo']).'</td>
		<td>'.Balikin($d['artikel']).'</td>';
		
		$e = "";
		foreach(list_category("") as $cat){
			$e .="<td>".get_data_category($d['kode'],$cat[0])."</td>";
		}
		$t .=$e;
		
	$t .='<td>'.$d['created'].'</td>
	</tr>';
}
		
		
		
$gui .=$t;		

$gui .='</tbody></table>';

echo $gui;
		
		
		?>

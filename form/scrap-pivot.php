<script>
	<?php
	
		$name = array('Kode','Provinsi','Kota/Kabupaten','Media','Tanggal');
		foreach(list_category("") as $cat){
			$category = $cat[0];
			$category = str_replace("category_","",$category);
			$category = str_replace("-"," ",$category);
			$category = ucwords($category);
			array_push($name,$category);
		}
		//array_push($name,'Waktu diambil');
		
		$data = array();
		//$q = mysql_query("select * from `data` where `status`!='4' limit 10 ")or die(mysql_error());
		$q = mysql_query("select * from `data` where `status`!='4'")or die(mysql_error());

		while($d=mysql_fetch_array($q)){
			$wilayah = $d['wilayah'];
			$lng = strlen($wilayah);
			if($lng==2){
				$provinsi 	= get_name_wilayah($wilayah);
				$kotkab 	="";
			}
			elseif($lng>2 and $lng<=5){
				$wilayah 	= explode(".",$wilayah);
				$provinsi 	= get_name_wilayah($wilayah[0]);
				$kotkab 	= get_name_wilayah($wilayah[0].".".$wilayah[1]);
			}
			else{
				$provinsi 	="";
				$kotkab		="";
			}
			
			$kode 	= $d['kode'];
			$media 	= Balikin($d['media']);
			//$judul 	= Balikin($d['judul']);
			$tanggal= Balikin($d['waktu']);
			//$url	= Balikin($d['link']);
			//$gambar	= Balikin($d['photo']);
			//$diambil= Balikin($d['created']);
			
			//$datas = array($kode,$provinsi,$kotkab,$media,$judul,$tanggal,$url,$gambar);
			$datas = array($kode,$provinsi,$kotkab,$media,$tanggal);
			foreach(list_category("") as $cat){
				$cats = get_data_category($kode,$cat[0]);
				array_push($datas,$cats);
			}
			//array_push($datas,$diambil);
			
			array_push($data,$datas);	
		}		
		
		$gui = '
			$(function(){
			
			var derivers = 	$.pivotUtilities.derivers;
			var renderers = $.extend(
	                            $.pivotUtilities.renderers, 
	                            $.pivotUtilities.c3_renderers
                           );
			var input = [
				';
				$dataset="";
				foreach($data as $data_){
					$dataset .= '{';
					$dataset_="";
					for($i=0;$i<count($name);$i++){
						$dataset_ .='"'.$name[$i].'":"'.$data_[$i].'",';
					}
					$dataset_ = substr($dataset_,0,-1);
					$dataset .=$dataset_;
					$dataset .='},';
				}
				$dataset = substr($dataset,0,-1);
				$gui .= $dataset;
		$gui .='];
			$("#output").pivotUI(input,{
				renderers: renderers,
				
				rows: ["Provinsi"], 
				rendererName: "Area Chart"
			});
			
		});
			';

	print($gui);
		
		
		?>


</script>
	<div class="col-lg-12">
	<div class="col-lg-12 well-me">
	<div class="table-responsive">
		<div id="output"></div>
	</div>
	</div>
	</div>
	
		

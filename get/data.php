<?php
include ("../static/inc/con.php");
include ("../static/inc/function.php");

		$name = array('Kode','Provinsi','Kota/Kabupaten','Media','Judul Berita','Tanggal','URL Berita','Gambar');
		foreach(list_category("all") as $cat){
			$category = $cat[0];
			$category = str_replace("category_","",$category);
			$category = str_replace("-"," ",$category);
			$category = ucwords($category);
			array_push($name,$category);
		}
		array_push($name,'Waktu diambil');

		$data = array();
		$q = mysql_query("select * from `data` limit 3 ")or die(mysql_error());

		while($d=mysql_fetch_array($q)){
			$wilayah = $d['wilayah'];
			if(strlen($wilayah)>0 and strlen($wilayah)<=2 ){
				$provinsi 	= get_name_wilayah($wilayah);
				$kotkab 	="";
			}
			elseif(strlen($wilayah)>3){
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
			$judul 	= Balikin($d['judul']);
			$tanggal= Balikin($d['waktu']);
			$url	= Balikin($d['link']);
			$gambar	= Balikin($d['photo']);
			$diambil= Balikin($d['created']);

			$datas = array($kode,$provinsi,$kotkab,$media,$judul,$tanggal,$url,$gambar);
			foreach(list_category("all") as $cat){
				$cats = get_data_category($kode,$cat[0]);
				array_push($datas,$cats);
			}
			array_push($datas,$diambil);

			array_push($data,$datas);
		}

		$datajson = array();

		foreach($data as $data_){
			$a=array();
			for($i=0;$i<count($name);$i++){


				array_push($a,array($name[$i]=>$data_[$i]));
			}

			array_push($datajson,$a);
		}


	echo json_encode($datajson);


		?>




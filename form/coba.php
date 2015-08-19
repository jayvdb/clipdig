<?php

//coba coba buat table seperti yang mas fery kasih
include ("../static/inc/con.php");
include ("../static/inc/function.php");
include ("../static/inc/conf.php");
//header("Content-type: text/csv");
//header("Content-Disposition: attachment; filename=file.csv");
//header("Pragma: no-cache");
//header("Expires: 0");


$gui = 'Kode Berita,Provinsi,Kota/Kabupaten,Media,Judul Berita,Tanggal,URL Berita,URL Gambar';
		
		$c="";
		foreach(list_category("all") as $cat){
			$category = $cat[0];
			$category = str_replace("category_","",$category);
			$category = str_replace("-"," ",$category);
			$category = ucwords($category);
			
			
			$c .=','.$category;
		}
		
		
			
			$gui .=$c;
			$gui .=',Waktu diambil';
				
$q = mysql_query("select * from `data` order by `media` asc")or die(mysql_error());
$t="";
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
	
	
	$t .='"'.$d['kode'].'","'.$provinsi.'","'.$kotkab.'","'.Balikin($d['media']).'","'.Balikin($d['judul']).'","'.Balikin($d['waktu']).'","'.Balikin($d['link']).'","'.Balikin($d['photo']).'"';
		
		$e = "";
		foreach(list_category("all") as $cat){
			$e .=',"'.get_data_category($d['kode'],$cat[0]).'"';
		}
		$t .=$e;
		
	$t .=',"'.$d['created'].'"';
}
		
		
		
$gui .=$t;		


echo $gui;


?>

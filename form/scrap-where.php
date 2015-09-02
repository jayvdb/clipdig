<?php

	$WHERE="WHERE";
	$NAME_FILE=ifset('l')."_";
	if(!empty($media)){
		if($media!="all"){$WHERE .=" `media`='$media' AND ";}
		else{$WHERE .="";}
	}
	if(!empty($search)){
		$WHERE .=" (`judul` LIKE '%$search%' OR `waktu` LIKE '%$search%' OR `penulis` LIKE '%$search%' or `kode`='$search') AND ";
	}
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
			$NAME_FILE.="Wilayah(".get_name_wilayah($wilayah).")_";
		}
		elseif($pjg>=2 AND $pjg<=5 ){
			$WHERE .=" `wilayah` LIKE '%$wilayah%' AND length (`wilayah`) <=5 AND ";
			$NAME_FILE.="Wilayah(".get_name_wilayah($wilayah).")_";
		}
		else{
			$WHERE="";
			$NAME_FILE .="Wilayah(ALL)_";
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
			
			$NAME_FILE_="";
			if($category_data!="all"){
				$WHERE_ .=" `$category_name` LIKE '%$category_data%' AND ";
				$NAME_FILE_ .=$category_name."_(".$category_data.")_";
				$NAME_FILE .=str_replace('category_','',$NAME_FILE_);
			}
		}
		$WHERE .=$WHERE_;
	}
	//category  ------------------------

	$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
	if(ifset('l')=='Data'){
		if(!empty($page)){$p=$page;}else{$p=0;} //page
		$NO=($p-1)*$DataPerPage;
		$LIMIT = "LIMIT ".$NO.",".$DataPerPage;
	}
	else{
		$LIMIT="";
	}
	$q="SELECT * FROM `data` ".$WHERE."  ORDER BY `waktu` DESC ".$LIMIT;
	$qry=mysql_query($q) or die(mysql_error());
	
	
	//$NAME_FILE=date('Y-m-d')."_".ifset('l')."_Media(".$media.")_";
?>

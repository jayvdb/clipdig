<?php
	if(isset($_GET['kode'])){
		$target = Balikin(get_data('kode',$kode,'link'));
	}
	elseif(isset($_GET['ids'])){
		$target = Balikin(get_data('ids',$ids,'link'));
	}
	$html = file_get_html($target);	
// ---------------------------------------------------- //
// CHANGE THIS
// ---------------------------------------------------- //
//	example
// http://subdomain.domain.com/article/title.html
//
	$split_1 = explode("/",$target); //	split link by `/` (slash) 
	//$split_2 = explode(".",$split_1[2]); // split by `.` (dot) from $split_1 array 2nd
	$category = $split_1[3];
		
				
	//article-detail
	if(	$category == "hukum" OR
			$category == "aktual" OR 
			$category == "nasional" OR 
			$category == "ekonomi" OR 
			$category == "megapolitan" OR
			$category == "aktualitas" OR
			$category == "figur" OR
			$category == "anak" OR
			$category == "kesra" OR
			$category == "investasi-portofolio" OR
			$category == "hukum-kriminalitas" OR
			$category == "bank-dan-pembiayaan" OR
			$category == "kesehatan" OR
			$category == "olahraga" OR
			$category == "hiburan" OR
			$category == "budaya" OR
			$category == "lainnya" OR
			$category == "gadget" OR
			$category == "digital-life" OR
			$category == "internasional" OR
			$category == "dunia" OR
			$category == "asia" OR
			$category == "italia" OR
			$category == "amerika" OR
			$category == "indonesia" OR
			$category == "afrika" OR
			$category == "gaya-hidup" OR
			$category == "food-travel" OR
			$category == "destinasi" OR
			$category == "film" OR
			$category == "iptek" OR
			$category == "f1" OR
			$category == "mobil" OR
			$category == "otomotif" OR
			$category == "cinta" OR
			$category == "interior" OR
			$category == "emiten" OR
			$category == "forum-bisnis" OR
			$category == "pasar-modal" OR
			$category == "hunian"
	){ 
		foreach($html->find('div[class=content-left]') as $artikel){
			foreach($artikel->find('div[class=right w300 over-hidden ml10 mb10]') as $l){
				$photo = $l->first_child()->first_child()->src;
			}
			foreach($artikel->find('div[class=f14 c6 bodyp]') as $l){
					$artikels = $l->plaintext;
			}
			foreach($artikel->find('p[class=mt10 c6]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif(	$category == "video" ){
		foreach($html->find('div[class=w620 aleft mt10]') as $artikel){
			$photo = "";
			foreach($artikel->find('div[class=f14 c6 bodyp]') as $l){
					$artikels = $l->plaintext;
			}
			foreach($artikel->find('div.mt10') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

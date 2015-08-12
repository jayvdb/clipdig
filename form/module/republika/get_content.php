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
	$split_2 = explode(".",$split_1[2]); // split by `.` (dot)  from $split_1 array 2nd
	$category = $split_2[0];
	$category2 = $split_1[4];
	$category3 = $split_1[5];
		
				
	if($category == "nasional" OR
		$category == "internasional" OR
		$category == "khazanah" OR
		$category == "bola" OR
		$category == "gayahidup" OR
		$category == "senggang" OR
		$category == "trendtek" OR
		$category == "en" OR
		
		$category2 == "humaira" OR
		$category2 == "regional" OR
		$category2 == "pendidikan" OR
		$category2 == "kolom" OR
		$category2 == "ekonomi" OR
		$category2 == "internasional" OR
		$category2 == "jurnalisme-warga" OR
		$category2 == "rol-to-campus" OR
		$category2 == "menuju-jakarta-1" OR
		$category2 == "olahraga" OR
		$category2 == "otomotif" OR
		
		$category3 == "nusantara" 
	
	){
		foreach($html->find('div[class=content-detail-center]') as $list){
			foreach($list->find('div[class=img-detailberita] img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('div[class=txt-detailberita]') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div[class=red]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}
	elseif($category2 == "pemilu" AND $category3=="foto-pemilu"){
		foreach($html->find('div.set-conten-left') as $list){
			foreach($list->find('li img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('div.teaser') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div.red') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}
	elseif($category2 == "pemilu"){
		foreach($html->find('div.set-conten-left') as $list){
			foreach($list->find('div.img-detail img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('div.teaser-detail') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div.red') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}
	elseif($category2 == "inpicture"){
		foreach($html->find('div[id=conten-inpicture]') as $list){
			foreach($list->find('div.big-image img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('div[class=teaser-pic]') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div[class=red]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}
	elseif($category2=="koran"){
		foreach($html->find('div[class=left-detail]') as $list){			
			foreach($list->find('img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('div[class=txt-detail]') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div[class=red]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
		
	}
	elseif($category=="video"){
		foreach($html->find('div[class=left-wrapper2]') as $list){
			$photo = "-";
			foreach($list->find('div[class=teaser-lw]') as $l){
				$artikel = $l->innertext;
			}
			foreach($list->find('div[class=red]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
		
	}
?>

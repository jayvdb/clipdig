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
		
				
	if($category  == "news"	OR
      $category  == "bisnis" OR	
      $category  == "otomotif" OR
      $category  == "ramadan" OR
      $category  == "lifestyle" OR
      $category  == "bola" OR
      $category  == "showbiz" OR
      $category  == "citizen6" OR
      $category  == "tv" OR
      $category  == "health" 	
	){ 
		foreach($html->find('article[class=hentry main]') as $artikel){
			foreach($artikel->find('a[class=gallery-item] img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div[class=text-detail]') as $l){
				$artikels = $l->innertext;
			}
			foreach($artikel->find('span[itemprop=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif($category  == "photo"){ 
		foreach($html->find('article[class=hentry main]') as $artikel){
			foreach($artikel->find('img.big') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div[class=gallery-images]') as $l){
				$artikels = $l->innertext;
			}
			foreach($artikel->find('span[itemprop=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

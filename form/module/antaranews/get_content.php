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
	$category1 = $split_1[3];
		
				
	//article-detail
	if(	$category == "www" OR
			$category == "otomotif"
	){ 
		foreach($html->find('div.bjbrt') as $artikel){
			foreach($artikel->find('div#image_news img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div#content_news') as $l){
					$artikels = $l->plaintext;
			}
			foreach($artikel->find('span[itemprop=author]') as $l){
				$penulis = $l->plaintext;
			}
			foreach($artikel->find('span[itemprop=editor]') as $l){
				$penulis .= $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif(	$category == "ramadhan"
	){
		foreach($html->find('div.box_left') as $artikel){
			foreach($artikel->find('div.dtbground div img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div.dtcontent') as $l){
					$artikels = $l->plaintext;
			}
			foreach($artikel->find('span[itemprop=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

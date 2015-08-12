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
	$category1 = $split_1[2];
	$category1 = $split_1[3];
		
	//article-detail
	if( $category1 ="www.pikiran-rakyat.com"
	
	){ 
		foreach($html->find('div.node-article') as $artikel){
			foreach($artikel->find('div.field-name-field-image img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div.content') as $l){
				$artikels = $l->innertext;
			}
			
				$penulis = "-";
			
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

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
	$category1 = $split_1[2];


	//article-detail
	if( $category1 == "sp.beritasatu.com" ){
		foreach($html->find('div[id=contentwrapper]') as $artikel){
			foreach($artikel->find('img[class=firstimage]') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('p') as $l){
					$artikels .= $l->innertext;
			}
			$penulis = "-";

			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif( $category == "video" ){
		foreach($html->find('div[class=w620 aleft mt10]') as $artikel){
			$photo = "";
			foreach($artikel->find('div[class=f14 c6 bodyp]') as $l){
					$artikels = $l->innertext;
			}
			foreach($artikel->find('div.mt10') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

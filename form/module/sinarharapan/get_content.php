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
// example
// http://subdomain.domain.com/article/title.html
//
	$split_1 = explode("/",$target); // split link by `/` (slash)
	$split_2 = explode(".",$split_1[2]); // split by `.` (dot) from $split_1 array 2nd
	$category = $split_2[0];

	//article-detail
	if( $category == "www"	){
		foreach($html->find('article') as $artikel){
			foreach($artikel->find('div.entry-content img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div.entry-content') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('span[class=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

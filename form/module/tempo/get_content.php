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
	$split_1 = explode("/",$target); // split link by `/` (slash)
	$split_2 = explode(".",$split_1[2]); // split by `.` (dot) from $split_1 array 2nd
	$category = $split_2[0];
	$category2 = $split_1[2];

	if($category=="www"){
		foreach($html->find('div.artikel') as $list){
			foreach($list->find('div.single-img img') as $l){
				$photo = $l->src;
			}
			foreach($list->find('p') as $l){
				$artikel ="";
				$artikel .= $l->plaintext;
			}
			foreach($list->find('p strong') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}


?>

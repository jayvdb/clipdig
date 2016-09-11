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
	$split_2 = explode(".",$split_1[2]); // split by `.` (dot) from $split_1 array 2nd
	$category = $split_2[0];

	//nasional, regional, bisniskeuangan, megapolitan dll
	if($category == "www"
	){
		foreach($html->find('div[class=read clearfix]') as $list){
			foreach($list->find('div[class=thumb]') as $el){
				$photo = $el->children(0)->src;

			}
			foreach($list->find('div[class=col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right]') as $el){
				$artikel = $el->plaintext;
			}
			foreach($list->find('div[class=title col-xs-12] h1 a') as $el){
				$penulis = $el->plaintext;
			}
			save_data($kode,$photo,$artikel,$penulis);
		}
	}
?>

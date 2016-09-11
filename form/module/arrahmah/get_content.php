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
	//$split_2 = explode(".",$split_1[2]); // split by `.` (dot) from $split_1 array 2nd
	$category = $split_1[3];
	$category1 = $split_1[2];


	//article-detail
	if( $category1 == "www.arrahmah.com" ){
		foreach($html->find('article.article') as $artikel){
			foreach($artikel->find('div.media a img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div.article-body') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('span.byline') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
?>

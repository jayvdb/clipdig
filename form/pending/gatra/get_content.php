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
	if( $category == "politik-1" OR
			$category == "hukum-1" OR
			$category == "dpd-ri-update-1" OR
			$category == "nusantara-1"
	){
		foreach($html->find('div[class=item-page]') as $list){
			foreach($list->find('img[class=caption]') as $ph){
				$photo = "http://img.cdn.gatra.net".$ph->src;
			}
			foreach($list->find('div.articleContent') as $ar){
				$artikel = $ar->plaintext;
			}
			foreach($list->find('div[class=articleContent] p strong') as $pe){
				$penulis = $pe->plaintext;
			}
			//save_data($kode,$photo,$artikel,$penulis);
			echo $kode.'<br>'.$photo.'<br>'.$artikel.'<br>'.$penulis;
		}
	}
	else{
		echo "---------------";
	}
?>

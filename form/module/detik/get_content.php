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

	//article-detail
	if( $category == "news"	){
		foreach($html->find('div[class=detail_content]') as $artikel){
			foreach($artikel->find('div.pic_artikel img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div[class=detail_text]') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif( $category == "health" OR
				$category == "sport" OR
				$category == "finance" OR
				$category == "hot" OR
				$category == "inet" OR
				$category == "food" OR
				$category == "wolipop" OR
				$category == "oto"
	){
		foreach($html->find('div[class=content_detail]') as $artikel){
			foreach($artikel->find('div[class=pic_artikel] img') as $l){
				$photo = $l->src;
			}
			foreach($artikel->find('div[class=text_detail]') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);

		}
	}
	elseif( $category == "majalah" ){
		foreach($html->find('div[class=kiri]') as $artikel){
			foreach($artikel->find('div[class=imgcenter]') as $l){
				$photo = $l->first_child(0)->src;
			}
			foreach($artikel->find('div[class=pd20]') as $l){
				$artikels = $l->plaintext;
			}
			$penulis = "";
			save_data($kode,$photo,$artikels,$penulis);

		}
	}
	elseif( $category == "travel" ){
		foreach($html->find('div[class=content_detail]') as $artikel){
			foreach($artikel->find('div[class=relative]') as $l){
				$photo = $l->first_child(0)->src;
			}
			foreach($artikel->find('div[class=text_detail]') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->first_child(0)->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);

		}
	}
	elseif( $category == "suarapembaca" ){
		foreach($html->find('div[class=content_detail]') as $artikel){
			foreach($artikel->find('div[class=pic_artikel_3]') as $l){
				$photo = $l->first_child(0)->src;
			}
			foreach($artikel->find('div[class=text_detail]') as $l){
				$artikels = $l->plaintext;
			}
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->first_child(0)->plaintext;
			}
			save_data($kode,$photo,$artikels,$penulis);

		}
	}
?>

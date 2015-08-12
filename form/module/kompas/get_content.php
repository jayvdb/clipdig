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
			
	//nasional, regional, bisniskeuangan, megapolitan dll
	if($category == "nasional" OR 
		$category == "regional" OR 
		$category == "bisniskeuangan" OR 
		$category == "megapolitan" OR
		$category == "bola" OR
		$category == "travel" OR
		$category == "internasional" OR
		$category == "edukasi" OR
		$category == "olahraga" OR
		$category == "sains" 
	){
				
		foreach($html->find('div[class=photo]') as $el){
			$photo = $el->children(0)->src;
			
		}
		foreach($html->find('div[class=span6 nml]') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=kcm-read-copy mb2]') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//otomotif
	elseif($category == "otomotif" ){
		foreach($html->find('div[class=photo]') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div[class=div-read]') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=penulis-editor]') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//properti
	elseif($category == "properti"){
		foreach($html->find('div[class=tab_1]') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div[class=isi_berita pt_5]') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=left pt_5 c_abu01_kompas2011 font12]') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//entertainment
	elseif($category == "entertainment"){
		foreach($html->find('div.photo') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div.kcm-read-text') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=kcm-read-copy mt1]') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//female
	elseif($category == "female"){
		foreach($html->find('div.photo') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div.kcm-read-text') as $el){
			$artikel = $el->innertext;
			
		}
		foreach($html->find('table.grey') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//female
	elseif($category == "biz"){
		foreach($html->find('div.photo') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div.kcm-read-content-text') as $el){
			$artikel = $el->innertext;
			
		}
		$penulis="-";
		save_data($kode,$photo,$artikel,$penulis);
	}
	//foto
	elseif($category == "foto"){
		foreach($html->find('li[class=slide-0 activeslide]') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div[class=isi_artikel]') as $el){
			foreach($el->find('p') as $art){
				$artikel = $art->innertext;
			}
		}
		foreach($html->find('div[class=editor_artikel left]') as $el){
			$penulis = $el->children(0)->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//tekno
	elseif($category == "tekno"){
		foreach($html->find('div[class=photo]') as $el){
			$photo = $el->children(0)->src;
		}
		foreach($html->find('div[class=isi_artikel]') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=editor_artikel left]') as $el){
			$penulis = $el->children(0)->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//health
	elseif($category == "health"){
		foreach($html->find('div[class=photo] img') as $el){
			$photo = $el->src;
		}
		foreach($html->find('div[class=kcm-read-text]') as $el){
			$artikel = $el->innertext;
		}
		foreach($html->find('div[class=kcm-read-copy mt1]') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
	//print
	elseif($category == "print"){
		foreach($html->find('img.article-image') as $el){
			$photo = $el->src;
		}
		foreach($html->find('article.pr') as $el){
			$text = $el->find('p');
			$artikel .= $text->innertext;
		}
		foreach($html->find('p.credit') as $el){
			$penulis = $el->plaintext;
		}
		save_data($kode,$photo,$artikel,$penulis);
	}
?>

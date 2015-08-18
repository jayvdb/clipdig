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
		
			
	//CATEGORY
	if($category == "nasional" OR 
		$category == "politik" OR 
		$category == "dunia" OR 
		$category == "bisnis" OR 
		$category == "metro" OR 
		$category == "otomotif" OR 
		$category == "fokus" OR 
		$category == "teknologi" OR
		$category == "bisnis" OR
		$category == "bola" OR
		$category == "sport" OR
		$category == "sorot" OR
		$category == "bola" OR
		$category == "life" OR
		$category == "log"
	){
			
		//ARTICLE CONTAINER
		foreach($html->find('article') as $artikel){ 
			
			//photo
			foreach($artikel->find('div[class=thumbcontainer]') as $l){
				$photo = $l->first_child(0)->src;
			}
			//article
			foreach($artikel->find('div[id=article-content]') as $l){
				$artikels = $l->plaintext;
			}
			//writer
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->plaintext;
			}
			
			//SAVE ACTION
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	
	elseif($category == "foto"){
		
		//ARTICLE CONTAINER
		foreach($html->find('section[class=portlet fotogallery-display]') as $artikel){
			
			//photo
			foreach($artikel->find('div[class=main thumbcontainer]') as $l){
				$photo = $l->children(3)->src;
			}
			//article
			foreach($artikel->find('div[class=summary]') as $l){
				$artikels = $l->plaintext;
			}
			//writer
			foreach($artikel->find('div[class=foto-desc]') as $l){
				$penulis = $l->children(0)->plaintext;
				//echo $penulis.'';
			}
			
			//SAVE ACTION
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	
	elseif($category == "video"){
		
		//ARTICLE CONTAINER
		foreach($html->find('section[class=portlet main-videoplayer]') as $artikel){
			//video
			foreach($artikel->find('object[id=livestreaming]') as $l){
				$photo = $l->data;
			}
			//article
			foreach($artikel->find('article[class=videodesc article]') as $l){
				$artikels = $l->children(2)->plaintext;
			}
			//writer
			$penulis = "-";
			
			//SAVE ACTION
			save_data($kode,$photo,$artikels,$penulis);
		}
	}
	elseif($category == "analisis"){
		
		//ARTICLE CONTAINER
		foreach($html->find('div[class=grid colA]') as $artikel){
			
			//video
			foreach($artikel->find('div[class=pic]') as $l){
				$photo = $l->children(0)->src;
			}
			//article
			foreach($artikel->find('div[class=content]') as $l){
				$artikels = $l->plaintext;
			}
			//writer
			foreach($artikel->find('div[class=author]') as $l){
				$penulis = $l->plaintext;
			}
			
			//SAVE ACTION
			save_data($kode,$photo,$artikels,$penulis);
			
		}
	}
?>

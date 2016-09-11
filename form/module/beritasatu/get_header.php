<?php
	$media = "beritasatu"; //CHANGE THIS
	
	
	$search_link ="";$link ="";$title ="";$time="";
	for($i=$start;$i<=$to;$i++){
		$search_link .= '||'.'http://www.beritasatu.com/pencarian/?page='.$i.'&type=artikel&keyword='.$search__; //CHANG THIS
	} 
	$pecah_search_link = explode("||",substr($search_link,2,strlen($search_link)));
	
	for($j=0;$j<count($pecah_search_link);$j++){
		$target = $pecah_search_link[$j];
		$html = file_get_html($target);
		
		echo '<br><br><b>'.$start++.'. <a href="'.$target.'" target="_blank" >'.$target.'</a></b><hr><br>';
		
		//CHANGE FROM THIS --------------------------------
		foreach($html->find('div[class=prl10 mt10]') as $list){ 
			foreach($list->find('div a u') as $li){ // find link
				$link_ = $li->parent()->href;
				$link[$j] .='||'.$link_;
			}
			foreach($list->find('div a u') as $ti){ // find title
				$title_ = $ti->plaintext;
				$title[$j] .='||'.$title_;
			}
			foreach($list->find('div a u') as $tim){ //find time
				$time_ = $tim->parent()->parent()->children(1)->plaintext;
				$time_ =explode(",",$time_);		
				$time_ =explode(" ",end($time_));
				$time_ = $time_[3]."-".$time_[2]."-".$time_[1];  
			
				$time[$j] .='||'.$time_;
			}
		}
		//CHANGE END THIS --------------------------------
		
		$array_link = explode("||",substr($link[$j],2,strlen($link[$j])));
		$array_title = explode("||",substr($title[$j],2,strlen($title[$j])));
		$array_time = explode("||",substr($time[$j],2,strlen($time[$j])));
		$banyak = count($array_link);
		
		for($k=0;$k<$banyak;$k++){
			$data_link = $array_link[$k];
			$data_title = $array_title[$k];
			$data_time = $array_time[$k];
			$data_kode = md5($data_link);
			$data_search = $search;
			$data_media = $media;
	
			$no=$k+1;
			echo '<br>'.$no.'. <a href="?m=Scrap&l=View&op=edit&kode='.$data_kode.'">'.$data_title.'</a>';
			
			//CHECK AND SAVE ACTION
			if(Settings('GetContentFirst')=="1"){
				save_header($data_kode,$data_search,$data_link,$data_media,$data_time,$data_title,$NOW);
				save_all_data($data_kode);
			}
			else{
				save_header($data_kode,$data_search,$data_link,$data_media,$data_time,$data_title,$NOW);
			}
		}

	}
?>

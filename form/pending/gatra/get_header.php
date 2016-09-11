<?php
	$media = "gatra"; //CHANGE THIS


	$search_link ="";$link ="";$title ="";$time="";
	for($i=$start;$i<=$to;$i++){
		$page = ($i-1)*10;
		$search_link .= '||'.'http://www.gatra.com/component/search/?searchword='.rawurlencode($search).'&ordering=newest&searchphrase=any&limit=10&areas[0]=content&start='.$page; //CHANG THIS
	}
	$pecah_search_link = explode("||",substr($search_link,2,strlen($search_link)));

	for($j=0;$j<count($pecah_search_link);$j++){
		$target = $pecah_search_link[$j];
		$html = file_get_html($target);

		echo '<br><br><b>'.$start++.'. <a href="'.$target.'" target="_blank" >'.$target.'</a></b><hr><br>';

		//CHANGE FROM THIS --------------------------------
		foreach($html->find('dl.search-results') as $list){
			foreach($list->find('dt.result-title a') as $li){ // find link

				$link_ = "http://www.gatra.com".$li->href;
				$link[$j] .='||'.$link_;
			}
			foreach($list->find('dt.result-title a') as $ti){ // find title
				$title_ = rawurlencode($ti->plaintext);
				$title_ = str_replace("%09","",$title_);
				$title_ = str_replace("%80","",$title_);
				$title_ = str_replace("%8F","",$title_);
				$title_ = str_replace("%E2","",$title_);
				$title_ = rawurldecode($title_);

				$title[$j] .='||'.$title_;
			}
			foreach($list->find('dd.result-created') as $tim){ //find time
				$time_ = $tim->plaintext;
				$time_ = explode(" ",$time_);
				$time_ = $time_[5]."-".$time_[4]."-".$time_[3];
				$time_ = rawurlencode($time_);
				$time_ = str_replace("%09","",$time_);


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
			echo '<br>'.$no.'. <a href="?m=Crawling&l=View&op=edit&kode='.$data_kode.'">'.$data_title.'</a>';

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

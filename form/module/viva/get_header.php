<?php
	$media = "viva"; //CHANGE THIS


	$search_link ="";$link ="";$title ="";$time="";
	for($i=$start;$i<=$to;$i++){
		$search_link .='||'.'http://search.viva.co.id/search?q='.$search__.'&n=20&p='.($i-1).'&t=json&p='.$i; //CHANGE THIS
	}
	$pecah_search_link = explode("||",substr($search_link,2,strlen($search_link)));

	for($j=0;$j<count($pecah_search_link);$j++){
		$target = $pecah_search_link[$j];
		$html = file_get_html($target);

		echo '<br><br><b>'.$start++.'. <a href="'.$target.'" target="_blank" >'.$target.'</a></b><hr><br>';

		//CHANGE FROM THIS --------------------------------
		foreach($html->find('ul.indexlist') as $list){
			foreach($list->find('li') as $li){ // find link
				$link_ = $li->children(0)->href;
				$link[$j] .='||'.$link_;
			}
			foreach($list->find('div.title') as $ti){ // find title
				$title_ = $ti->plaintext;
				$title[$j] .='||'.$title_;
			}
			foreach($list->find('div.upperdeck') as $tim){ //find time
				$time_ = $tim->plaintext;

				//edit for get right time to yyyy-mm-dd
				//example text `BOLA Selasa, 16 Juni 2015 18:42`

				$time_ =explode(",",$time_);		//split by comma (,)
				$time_ =explode(" ",end($time_)); // split again by space ( )
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
			echo '<br>'.$no.'. <a href="?m=Scrap&l=View&op=edit&kode='.$data_kode.'">'.$data_title.'</a>'; // menampilkan di halaman

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

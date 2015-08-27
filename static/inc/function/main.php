<?php
function save_header($kode,$search,$link,$media,$time,$judul,$created){
	$qry = mysql_query("select count(`kode`) as `ada` from `data` where `kode`='$kode' limit 1")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	$ada = $data['ada'];
	
	if($ada==0){
		save1($kode,$search,$link,$media,$time,$judul,$created);
	}else{
		update_search($kode,$search);
	}
}
function save1($kode,$search,$link,$media,$time,$judul,$created){
	$search = UbahSimbol($search);
	$judul = UbahSimbol($judul);
	$link = UbahSimbol($link);
	$time = UbahBulan($time);
	
	$save = mysql_query("insert into `data` (`kode`,`search`,`link`,`media`,`judul`,`waktu`,`created`) values ('$kode','$search','$link','$media','$judul','$time','$created')  ")or die(mysql_error());
	if($save){echo ' <span class="label label-success">saved</span>';}else{echo ' <span class="label label-danger">not saved !!</span> ';}
}
function get_data($from,$str,$field){
	$qry = mysql_query("SELECT * FROM `data` WHERE `$from`='$str' ") or die(mysql_error());
	$data = mysql_fetch_array($qry);
		if($field == 'ids')
			return $data['ids'];
		elseif($field == 'kode')
			return $data['kode'];
		elseif($field == 'media')
			return $data['media'];
		elseif($field == 'judul')
			return $data['judul'];
		elseif($field == 'waktu')
			return $data['waktu'];
		elseif($field == 'photo')
			return $data['photo'];
		elseif($field == 'artikel')
			return $data['artikel'];
		elseif($field == 'penulis')
			return $data['penulis'];
		elseif($field == 'link')
			return $data['link'];
		elseif($field == 'status')
			return $data['status'];
		elseif($field == 'search')
			return $data['search'];
		elseif($field == 'city')
			return $data['city'];
		elseif($field == 'tags')
			return $data['tags'];
		elseif($field == 'created')
			return $data['created'];
}
function get_data_category($kode,$category_name){
	$qry = mysql_query("SELECT * FROM `data` WHERE `kode`='$kode' ") or die(mysql_error());
	$data = mysql_fetch_array($qry);
	
	return $data[$category_name];
}
function min_max($type,$str){
	$qry = mysql_query("SELECT max($str) as `max`, min($str) as `min` from `data`")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	if($type=="min"){
		return $data['min'];
	}
	else{
		return $data['max'];
	}
}

function update_search($kode,$search){
	$last_search = get_data('kode',$kode,'search');
	$pos = strpos($last_search, $search);
	if ($pos === false) {
		$new_search = $last_search.",".$search;
		mysql_query("UPDATE `data` SET `search`='$new_search' WHERE `kode`='$kode'");
	} 	
}

function go_to($str,$kode){
	$qry2 = mysql_query("SELECT  max(`ids`) as `max`, min(`ids`) as `min` FROM `data`")or die(mysql_error());
	$data2 = mysql_fetch_array($qry2);
	$max=$data2['max'];
	$min=$data2['min'];
	
	if($str=="next"){
		$ids = get_data('kode',$kode,'ids');
		if($ids==$max){
			$go_to=get_data('ids',$min,'kode');	
		}else{
			$go_to=get_data('ids',$ids+1,'kode');
		}		
	}
	elseif($str=="prev"){
		$ids = get_data('kode',$kode,'ids');
		if($ids==$min){
			$go_to=get_data('ids',$max,'kode');
		}else{
			$go_to=get_data('ids',$ids-1,'kode');	
		}
	}
	return $go_to;
}
function View(){
	if(isset($_GET['kode'])){
		$qry = "SELECT * FROM `data` WHERE `kode`='".$_GET['kode']."'";
	}
	elseif(isset($_GET['ids'])){
		$qry = "SELECT * FROM `data` WHERE `ids`='".$_GET['ids']."'";
	}
	$result = mysql_query($qry)or die(mysql_error());
	$data = mysql_fetch_array($result);
	echo '
	<div class="row">
	<form method="POST" action="?m='.ifset('m').'&l='.ifset('l').'&a='.ifset('a').'&kode='.$data['kode'].'">
		<div class="col-lg-8">
		   <h3>'.html_entity_decode(Balikin($data['judul']), ENT_NOQUOTES, 'UTF-8').'</h3>
		   <small>'.strtoupper(Balikin($data['media'])).' | '.Balikin($data['waktu']).' | '.Balikin($data['penulis']).'</small>
			<small><a class="" target="_blank" href="'.Balikin($data['link']).'" title="Visit Link">Visit link</a></small>
			
			<div class="pull-right">
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('prev',$data['kode']).'" class="btn btn-sm btn-default" title="Previous"><i class="fa fa-arrow-left"></i> </a>
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('next',$data['kode']).'" class="btn btn-sm btn-default" tilte="Next"><i class="fa fa-arrow-right"></i> </a>
			</div>
			
			 <br><br>
			<textarea name="artikel" class="form-control" rows="15">'.html_entity_decode(Balikin($data['artikel'])).'</textarea>
			'.get_update_by($data['kode']).'
		
		</div>
		
		<!-- sidebar --------------------------------------------------------------------------------------------- -->
		<div class="col-lg-2 sidebar">';
		echo CreateMenuCategoryView($data['kode']);
		echo'
		</div>
		<div class="col-lg-2 sidebar">
			<img class="thumbnail center" src="'.Balikin($data['photo']).'" style="width:180px; margin:0 auto 0 auto;">
		
		
			<label>Status :</label>
			<select name="status" class="form-control">
				<option value="1"';if($data['status']==1){echo 'selected="selected"';} echo'>Not Checked</option>
				<option value="2"';if($data['status']==2){echo 'selected="selected"';} echo'>Positive</option>
				<option value="3"';if($data['status']==3){echo 'selected="selected"';} echo'>Negative</option>
				<option value="4"';if($data['status']==4){echo 'selected="selected"';} echo'>Delete</option>
			</select>';
			echo CreateWilayah($data['wilayah']);
			
			echo'<br>
			<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> Save</button>
			<!-- <a href="?m='.ifset('m').'&l='.ifset('l').'&op=reload&kode='.ifset('kode').'"><button type="button" class="btn btn-primary" name="reload"><i class="fa fa-refresh"></i> Reload</button></a> -->
			
		</div>
	</form>
	</div>';	
	//set_automatic_category(ifset('kode'),Balikin($data['artikel']));
	//set_semi_automatic_category(ifset('kode'),Balikin($data['artikel']));
	//set_wilayah(ifset('kode'),Balikin($data['artikel']));
	
}

function save_data($kode,$photo,$artikel,$penulis){
	$artikel = UbahSimbol($artikel);
	$penulis = UbahSimbol($penulis);
	//$city = SetCity(strtolower($artikel));
	//$tags = SetTags(strtolower($artikel));
	
	set_automatic_category($kode,$artikel);
	set_semi_automatic_category($kode,$artikel);
	set_wilayah($kode,$artikel);


	//DOWNLOAD IMAGE
	if(Settings('GetPhoto')=="1"){
		$pos = strpos($photo,"https");
		
		if($pos == false){
			$type = explode(".",$photo);
			$type = end($type);
			$type = explode("?",$type);
			$type = $type[0];
			$photos = "img/photo/".$kode.".".$type;
			
			//Get the file
			$content = file_get_contents($photo);
			//Store in the filesystem.
			$fp = fopen($photos, "w");
			fwrite($fp, $content);
			fclose($fp);
		}	
	}
	else{
		$photos=$photo;
	}
	
	//$qry ="UPDATE `data` SET  `photo`='$photos', `penulis`='$penulis', `artikel`='$artikel' , `city`='$city', `tags`='$tags', `status`='1' WHERE `kode`='$kode'";
	$qry ="UPDATE `data` SET  `photo`='$photos', `penulis`='$penulis', `artikel`='$artikel' , `status`='1' WHERE `kode`='$kode'";
	$save = mysql_query($qry) OR DIE (mysql_error());
	
	if($save){echo ' <span class="label label-info">saved</span>';}else{echo ' <span class="label label-danger">not saved !!</span> ';}
	
}

function save_data_from_newsd($search,$kode,$media,$title,$date,$news,$writer,$url,$image,$created_time){
	$search 	= UbahSimbol($search);
	$media  	= UbahSimbol($media);
	$title  	= UbahSimbol($title);
	$news		= UbahSimbol($news);
	$url 		= UbahSimbol($url);
	$image 	= UbahSimbol($image);
	
	$check = mysql_query("select * from `data` where `kode`='$kode'")or die(mysql_error());
	$count = mysql_num_rows($check);
	if(empty($count)){
		$save_data_from_newsd = mysql_query("
		                        insert into `data`
		                        (`search`,`kode`,`media`,`judul`,`waktu`,`artikel`,`penulis`,`link`,`photo`,`created`)
		                        values
		                        ('$search','$kode','$media','$title','$date','$news','$writer','$url','$image','$created_time')
										")or die(mysql_error());
										
		if($save_data_from_newsd){
		 	set_automatic_category($kode,$news);
			set_semi_automatic_category($kode,$news);
			set_wilayah($kode,$news);
		}
	
	}else{
		update_search($kode,$search);
		set_wilayah($kode,$news);
	}
									
		
}

function save_all_data($kode){
	$media 	= get_data('kode',$kode,'media');
	$status 	= get_data('kode',$kode,'status');
	$target 	= Balikin(get_data('kode',$kode,'link'));
	
	if($status==0){
		include ("form/module/".$media."/get_content.php");
	}
}

function update_data($kode,$artikel,$status,$wilayah){
	$kode 		= UbahSimbol($kode);
	$artikel	= UbahSimbol($artikel);
	
	
	$qry 		= mysql_query("UPDATE `data` SET `artikel`='$artikel', `status`='$status' ,`wilayah`='$wilayah' WHERE `kode`='$kode'")or die(mysql_error());
	if($qry){
		send_notif("Data has been saved");
	}
}
function getCount($media,$WHERE,$waktu){
	if(!empty($WHERE)){
		$WHERE=$WHERE." AND";
	}else{
		$WHERE="WHERE ";
	}
	$q = mysql_query("SELECT count(*) as `count`  FROM `data` $WHERE `waktu` LIKE '$waktu%' AND `media`='$media';")or die(mysql_error());
	$d = mysql_fetch_array($q);
	
	return $d['count'];
}
function update_by($kode,$user_id){
	$NOW = date("Y-m-d H:i:s");
	$qry = mysql_query("UPDATE `data` SET `update`='$NOW', `update_by`='$user_id'  WHERE `kode`='$kode'")or die(mysql_error());
	if($qry){
		return 1;
	}
}
function get_update_by($kode){
	$q = mysql_query("select `update`,`update_by` from `data` where `kode`='$kode'")or die(mysql_error());
	$d = mysql_fetch_array($q);
	
	
	if($d['update_by']>0){
		$qq = mysql_query("select `user_real_name` from `user` where `user_id`='".$d['update_by']."' ")or die(mysql_error());
		$dd = mysql_fetch_array($qq);
		
		return '<small>terakhir diubah oleh:<b> '.$dd['user_real_name'].'</b> pada: <b>'.$d['update'].'</b></small>';
	}
	
}











?>

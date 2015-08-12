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
		<div class="col-lg-10">
		   <h3>'.html_entity_decode(Balikin($data['judul']), ENT_NOQUOTES, 'UTF-8').'</h3>
		   <small>'.strtoupper(Balikin($data['media'])).' | '.Balikin($data['waktu']).' | '.Balikin($data['penulis']).'</small>
			<small><a class="" target="_blank" href="'.Balikin($data['link']).'" title="Visit Link">Visit link</a></small>
			
			<div class="pull-right">
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('prev',$data['kode']).'" class="btn btn-sm btn-default" title="Previous"><i class="fa fa-arrow-left"></i> </a>
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('next',$data['kode']).'" class="btn btn-sm btn-default" tilte="Next"><i class="fa fa-arrow-right"></i> </a>
			</div>
			
			 <br><br>
			<textarea name="artikel" class="form-control" rows="15">'.html_entity_decode(Balikin($data['artikel'])).'</textarea>
		
		</div>
		
		<!-- sidebar --------------------------------------------------------------------------------------------- -->
		<div class="col-lg-2 sidebar">
			<img class="thumbnail center" src="'.Balikin($data['photo']).'" style="width:180px; margin:0 auto 0 auto;">
		
		
			<label>Status :</label>
			<select name="status" class="form-control">
				<option value="1"';if($data['status']==1){echo 'selected="selected"';} echo'>Not Checked</option>
				<option value="2"';if($data['status']==2){echo 'selected="selected"';} echo'>Positive</option>
				<option value="3"';if($data['status']==3){echo 'selected="selected"';} echo'>Negative</option>
				<option value="4"';if($data['status']==4){echo 'selected="selected"';} echo'>Delete</option>
			</select>';
			
			echo CreateMenuCategoryView($data['kode']);
			
			echo'<br>
			<button type="submit" class="btn btn-me" name="simpan"><i class="fa fa-save"></i> Save</button>
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op=reload&kode='.ifset('kode').'"><button type="button" class="btn btn-me" name="reload"><i class="fa fa-refresh"></i> Reload</button></a>
			
			
		
		</div>
	</form>
	</div>';	
	set_automatic_category(ifset('kode'),Balikin($data['artikel']));
	set_semi_automatic_category(ifset('kode'),Balikin($data['artikel']));
	
}

function save_data($kode,$photo,$artikel,$penulis){
	$artikel = UbahSimbol($artikel);
	$penulis = UbahSimbol($penulis);
	//$city = SetCity(strtolower($artikel));
	//$tags = SetTags(strtolower($artikel));
	
	set_automatic_category($kode,$artikel);
	set_semi_automatic_category($kode,$artikel);


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
		}
	
	}else{
		update_search($kode,$search);
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

function update_data($kode,$artikel,$status){
	$kode 	= UbahSimbol($kode);
	$artikel	= UbahSimbol($artikel);
	
	$qry 		= mysql_query("UPDATE `data` SET `artikel`='$artikel', `status`='$status' WHERE `kode`='$kode'")or die(mysql_error());
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


function ShowMedia(){
	$x = mysql_query("SELECT DISTINCT `media` FROM `data` ORDER BY `media` ASC")or die(mysql_error());
	$media="";
	while($xx = mysql_fetch_array($x)){
		$media .= ",".$xx['media'];
	}	
	$ShowMedia = substr($media,1,strlen($media));
	return $ShowMedia;
}
function ShowStatus(){
	$x = mysql_query("SELECT DISTINCT `status` FROM `data` ORDER BY `status` ")or die(mysql_error());
	$status="";
	while($xx = mysql_fetch_array($x)){
		$status .= ",".$xx['status'];
	}	
	$ShowStatus = substr($status,1,strlen($status));
	return $ShowStatus;
}
function ShowSearch(){
	$x = mysql_query("SELECT DISTINCT `search` FROM `data` ORDER BY `search` ")or die(mysql_error());
	$search="";
	while($xx = mysql_fetch_array($x)){
		$search .= ",".$xx['search'];
	}	
	$ShowSearch = substr($search,1,strlen($search));
	$ShowSearch = explode(',', $ShowSearch);
	asort($ShowSearch);
	$ShowSearch = implode(',',array_unique($ShowSearch));

	return $ShowSearch;
}
function ShowTags(){
	$x = mysql_query("SELECT * FROM `tags` ORDER BY `tags` ")or die(mysql_error());
	$tags="";
	while($xx = mysql_fetch_array($x)){
		$tags .= ",".$xx['tags'];
	}	
	$ShowTags = substr($tags,1,strlen($tags));
	return $ShowTags;
}
function ShowCity(){
	$x = mysql_query("SELECT * FROM `city` ORDER BY `city` ")or die(mysql_error());
	$city="";
	while($xx = mysql_fetch_array($x)){
		$city .= ",".$xx['city'];
	}	
	$ShowCity = substr($city,1,strlen($city));
	return $ShowCity;
}


//alter table `data`
function alter_data($str){
	$fields = mysql_list_fields(__DB_NAME__, 'data');
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++) {$field_array[] = mysql_field_name($fields, $i);}
	
	if (!in_array($str, $field_array)){
		$qry = mysql_query("ALTER TABLE `data` ADD `$str` VARCHAR(100) NOT NULL AFTER `search`;")or die(mysql_error());
		if($qry){
			return 1;
		}
		else{
			return 0;
		}
	}
}


//category
function set_automatic_category($kode,$str){
	$str = strtolower(UbahXXX(Balikin($str)));
	$x=0;
	
	$qry_automatic = mysql_query("select `category_name` from `category` where `automatic`='1'")or die(mysql_error());
	while ($data_automatic=mysql_fetch_array($qry_automatic)){
		$x++;
		$push[$x]="";
		$push="";
		
		$qry_category_list = mysql_query("SELECT * FROM `".$data_automatic['category_name']."`")or die(mysql_error());
		while($data_category_list=mysql_fetch_array($qry_category_list)){
			
			$category = strtolower($data_category_list['data']);
			$pos = strpos($str," ".$category." ");
			if ($pos == true) {
				$push .=",".$category;
			}
			
		}
		//update category_* in data
		$push=substr($push,1,strlen($push));
		$update = mysql_query("update `data` set `".$data_automatic['category_name']."`='".$push."' where `kode`='$kode'")or die(mysql_error());
	}
	
	
}
function set_semi_automatic_category($kode,$str){
	$str = strtolower(UbahXXX(Balikin($str)));
	$x=0;
	
	$qry_semi_automatic = mysql_query("select `category_name` from `category` where `automatic`='2'")or die(mysql_error());
	while ($data_semi_automatic=mysql_fetch_array($qry_semi_automatic)){
		$x++;
		$push[$x]="";
		$push="";
		
		$qry_category_list = mysql_query("SELECT * FROM `".$data_semi_automatic['category_name']."`")or die(mysql_error());
		while($data_category_list=mysql_fetch_array($qry_category_list)){
			$category = strtolower($data_category_list['data']);
			
				$pos = strpos($str," ".$category." ");
				if ($pos == true) {
					$push .=",".$category;
				}
			
			
		}
		//update category_* in data
		if(!empty($push)){
			$push=substr($push,1,strlen($push));
		}
		else{
			$push ="lain-lain";
		}
		
		$update = mysql_query("update `data` set `".$data_semi_automatic['category_name']."`='".$push."' where `kode`='$kode'")or die(mysql_error());
	}
	
	
}
function list_category($str){
	if($str!="all"){
		$where = "WHERE `automatic`='$str'";}
	else{
		$where ="";}
	
	$array= array();
	$qry = mysql_query("select * from `category` $where ") or die(mysql_error());
	
	while($data=mysql_fetch_row($qry)){
		array_push($array,array($data[0],$data[1]));
	}
	return $array;
	
}
function add_category($str,$automatic){
	$str = str_replace(" ","-",$str);
	$qry = mysql_query("SHOW TABLES LIKE 'category_".$str."' ;") or die(mysql_error());
	$ada = mysql_num_rows($qry);
	if($ada>0){
		return 0;
	}
	else{
		$qry = mysql_query("CREATE TABLE `category_".$str."` (`id` int(11) PRIMARY KEY AUTO_INCREMENT,`data` VARCHAR(50));") or die(mysql_error());
		$qry2 = mysql_query("insert into `category` values('category_".$str."','".$automatic."')") or die(mysql_error());
		
		
		if($qry){
			alter_data("category_".$str);
			return 1;
		}
		else{
			return 2;
		}
	}
	//0 in use
	//1 success
	//2 failed
	
}
function delete_category($category_name){
	$delete_1 = mysql_query("ALTER TABLE `data` DROP `$category_name`")or die(mysql_error());
	$delete_2 = mysql_query("DROP TABLE IF EXISTS `$category_name`")or die(mysql_error());
	$delete_3 = mysql_query("DELETE FROM `category` WHERE `category_name`='$category_name' ")or die(mysql_error());
	if($delete_1 || $delete_2 || $delete_3){
		send_notif("Delete category succefully");
	}
}

function show_category_data($str){
	$array = array();
	$qry=mysql_query("select * from `$str` order by `data` asc" ) or die(mysql_error());
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['id'],$data['data']));
	}
	return $array;
}
function save_category_data($category,$data){
	$ck_ 	= mysql_query("select `data` from `$category` where `data`='$data'")or die(mysql_error());
	$ck 	= mysql_num_rows($ck_);
	if($ck>0){
		return 0;
	}
	else{
		$qry = mysql_query("insert into `$category` (`data`) values('$data')")or die(mysql_error());
		if($qry){
			return 1;
		}
		else{
			return 2;
		}
	}
	//0 in use
	//1 success
	//2 failed

}
function delete_category_data($category,$id){
	$qry = mysql_query("delete from `$category` where `id`='$id'")or die(mysql_error());
	if($qry){
		send_notif("Success");
	}
	else{
		send_notif("failed");
	}
}
function update_category_data($category,$id,$data){
	$qry = mysql_query("update `$category` set `data`='$data' where `id`='$id'")or die(mysql_error());
	if($qry){
		return 1;
	}
	else{
		return 0;
	}
	//0 failed
	//1 success
}

// category on view
function update_category_from_view($kode,$category_name,$category_data){
	$qry = mysql_query("update `data` set `$category_name`='$category_data' where `kode`='$kode'")or die(mysql_error());
	if($qry){
		return 1;
	}
	else{
		return 0;
	}
	
}









?>

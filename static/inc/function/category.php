<?php

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
		$qry = mysql_query("ALTER TABLE `data` ADD `$str` VARCHAR(100) NOT NULL AFTER `wilayah`;")or die(mysql_error());
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
			//$push=substr($push,1,strlen($push));
			$push=explode(",",$push);
			$push=end($push);
		}
		else{
			$push ="lain-lain";
		}

		$update = mysql_query("update `data` set `".$data_semi_automatic['category_name']."`='".$push."' where `kode`='$kode'")or die(mysql_error());
	}


}
function list_category($where){
	//if($str!="all"){
		//$where = "WHERE `automatic`='$str'";}
	//else{
		//$where ="";}

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




//wilayah

function set_wilayah($kode,$str){
	$str = strtolower(UbahXXX(Balikin($str)));
	$x=0;
	$a="";

	$qry_wilayah = mysql_query("SELECT * FROM `data_wilayah` WHERE LENGTH(`kode`)<=5 ORDER BY `nama` ASC;") or die(mysql_error());


	while($data=mysql_fetch_array($qry_wilayah)){
		$nama = strtolower(UbahXXX($data['nama']));
		$nama = str_replace("adm","",$nama);
		$nama = str_replace("kab","",$nama);
		$nama = str_replace("kota","",$nama);
		$nama = UbahXXX(UbahXXX($nama));
		$nama = " ".$nama." ";

		$pos = strrpos($str,$nama);
		if($pos==true){
			$a .=','.$data['kode'];
		}
	}
	$a = explode(",",$a);
	$a = end($a);

	$update = mysql_query("update `data` set `wilayah`='".$a."' where `kode`='$kode'")or die(mysql_error());
}
function get_name_wilayah($kode){
	$q = mysql_query("select `nama` from `data_wilayah` where `kode`='$kode'")or die(mysql_error());
	$d = mysql_fetch_array($q);
	return $d['nama'];
}
?>

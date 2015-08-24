<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");

$q = mysql_query("select `kode`,`category_partai-pengusung`	from `data` where `category_partai-pengusung`!='' ")or die(mysql_error());
while($d=mysql_fetch_array($q)){
	$partai = $d['category_partai-pengusung'];
	$partai = explode(',',$partai);
	$partai = end($partai);
	
	$a = mysql_query("update `data` set `category_partai-pengusung`='$partai' where `kode`='".$d['kode']."'")or die(mysql_error());
	if($a){
		echo $d['kode']." berhasil".PHP_EOL;
	}
	else{
		echo $d['kode']." Gagal".PHP_EOL;
	}
}
?>

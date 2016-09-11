<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");


$op = ifset('op');
$kode = ifset('kode');
if($op=="get_prov_cmb"){
	echo '<option value="">All</option>';
	foreach(get_prov() as $prov){

		echo '<option value="'.$prov[0].'"';
			if($kode == $prov[0])
				echo "selected";

		echo '> '.$prov[1].'</option>' ;
	}
}
elseif($op=="get_kabkot_cmb"){
	$kode_prov=ifset('data');
	echo '<option value="'.$kode_prov.'">All</option>';
	foreach(get_kabkot($kode_prov) as $kabkot){
		echo '<option value="'.$kabkot[0].'"';
			if($kode == $kabkot[0])
				echo "selected";

		echo' > '.$kabkot[1].'</option>' ;
	}
}
elseif($op=="get_wilayah"){
	$kode = ifset('kode');
	$q = mysql_query("select `wilayah` from `data` where `kode`='$kode'")or die(mysql_error());
	echo $data['wilayah'];
}

?>

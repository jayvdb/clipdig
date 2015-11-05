<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");
//include ("form/simple_html_dom.php");


//$target 	= "http://www.kpud-baliprov.go.id/?pg=beritadetail&id=483";
//$html 		= file_get_html($target);

	//foreach($html->find('table#results span.style24  b') as $a){
		//$a= UbahXXX(UbahXXX(UbahBulan($a->plaintext)));
		////echo $a.PHP_EOL;
		//print_r(explode(' ',$a));
	//}
	
	
$q = mysql_query("select `nama`  from `data_wilayah` where length(`kode`)>'5' and length(`kode`)<='8' order by `nama` asc") or die(mysql_error());
while($d=mysql_fetch_array($q)){
	echo $d['nama'].",";
}


?>

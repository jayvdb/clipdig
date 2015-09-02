<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");
include ("form/simple_html_dom.php");


$target 	= "http://www.kpud-baliprov.go.id/?pg=beritadetail&id=483";
$html 		= file_get_html($target);

	foreach($html->find('table#results span.style24  b') as $a){
		$a= UbahXXX(UbahXXX(UbahBulan($a->plaintext)));
		//echo $a.PHP_EOL;
		print_r(explode(' ',$a));
	}


?>

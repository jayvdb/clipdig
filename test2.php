<?php 
function UbahXXX($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'\''",
						"'%'",
						"'@'",
						"'_'",
						"'1=1'",
						"'/'",
						"'!'",
						"'<'",
						"'>'",
						"'\('",
						"'\)'",
						"';'",
						"'-'",
						"'_'",
						"'\['",
						"'\]'",
						"'\.'",
						"':'",
						"'  '",
						"'\,'"
					);

	$replace = array (" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						""
					);

	$str = preg_replace($search,$replace,$str);
	return $str;
	
}
function set_automatic_category($str,$search){
	$search=UbahXXX(strtolower($search));
	$str=strtolower($str);
	$split_search = explode(" ",$search);
	$split_str = explode(" ",$str);
	
	$point=0;
	
	foreach($split_search as $data){
		$pos = strpos($str,$data);
		if($pos!==false){
			$point +=1;
		}
		//if(in_array($data,$split_search)){
			//$point +=1;
		//}
	}
	echo $point;
	
}

$str = "Sementara, pasangan Zumi Zola dan Fachrori Umar juga mendapat dukungan dari 4 parpol, yakni PAN, PKB, Nasdem, Hanura dan PBB, yang memiliki 18 kursi atau 21 persen dari jumlah kursi di DPRD Provinsi Jambi.

Komisioner KPU Provinsi Jambi, M Sanusi mengatakan, berdasarkan verifikasi administrasi, kedua pasangan balongub dan balonwagub yang mendaftar memenuhi syarat menjadi peserta Pilgub Jambi Desember nanti.

Menurut peraturan KPU, bakal calon kepala daerah yang berhak mengikuti pilkada serentak harus mendapat dukungan beberapa partai politik yang memiliki sedikitnya 20 kursi di DPRD.

Pelaksanaan pendaftaran balongub dan balonwagub Jambi di KPU Provinsi Jambi, Senin (27/7) berlangsung tertib. Kendati kedua pasang
";
$search="memiliki akal";




set_automatic_category($str,$search);


?> 

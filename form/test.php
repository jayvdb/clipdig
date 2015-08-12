<?php
include("../static/inc/con.php");
include("../static/inc/function.php");
include("simple_html_dom.php");


function find_excluded_url($match_url){
	$excludeList= array('ad.beritasatumedia.com','www.semuabisajadiinvestor.com','www.investor.co.id','/login.php','http://id.beritasatu.com/pages/investordailyku','twitter.com','www.facebook.com','t.co','&amp','&','play.google.com','plus.google.com','www.youtube.com','www.fb.com','v3.mercusuar.info','itunes.apple.com');
	$matches = 0;
	foreach($excludeList as $excluded)
	{
		if(strpos($match_url, $excluded) !== FALSE){
			return "1"; return false ;
		}else{
			return "0";return false;
		}
        //else return FALSE;
	}
}
function geta($target,$base){
	$html = file_get_html($target);
	update_link($target);
	echo "<br>target = ".$target."<br>";
	foreach($html->find('a') as $data){
		$link = $data->href;
		$link = real_url($link);
		
		if(count(explode("/",$link))>3){
			if(find_excluded_url($link)=="0"){
				$pos = strpos($link,"http");
				if($pos===false){
					$pos = strpos($link,"HTTP");
					if($pos===false){
						$link = $base.$link;
					}
				}
				save_link($link);
			}
		}
	}
}
function cek_link($id){
	$qry = mysql_query("SELECT count(*) as `ada` FROM `test` WHERE `id`='$id'")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	if($data['ada']>0)
		return true;
	else return false;
}
function save_link($link){
	$id = md5($link);
	//$link = UbahSimbol($link);
	$link = $link;

	if(cek_link($id)==false){
		$qry = mysql_query("insert into `test` (`id`,`link`,`status`) values ('$id','$link','0') ;")or die(mysql_error());
		if($qry){
			echo "Saved = ".$link."<br>";
		}
	}
}
function update_link($link){
	$id = md5($link);
	mysql_query("UPDATE `test` set `status`='1' WHERE id='$id'");
}

function get($link,$base){
	$qrya = mysql_query("select * from `test` where status='0'")or die(mysql_error());
	$ada = mysql_num_rows($qrya);
	
	if($ada>0){
		$qry = mysql_query("select `link` from `test` where status='0' limit 0,5")or die(mysql_error());
		while($data=mysql_fetch_array($qry)){
			//$link = Balikin($data['link']);
			$link = $data['link'];
			geta($link,$base);
		}
	}else{
		geta($link,$base);
	}
}
$base = "http://www.beritasatu.com";
$link = "http://www.beritasatu.com";
get($link,$base);

?>

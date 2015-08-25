<?php
include ("../static/inc/con.php");
include ("../static/inc/function.php");
include ("../static/inc/conf.php");
include ("simple_html_dom.php");


$target 	= "http://202.146.128.250:8222/search.php?search=pilkada&date=2015-08-24";
$html 		= file_get_html($target);

$kode			="";
$media			="";
$title			="";
$date 			="";
$news_content 	="";
$writer			="";
$image 			="";
$url 			="";

//foreach($html->find('body') as $body){
	foreach($html->find('div[itemprop=count_data]') as $a){
		$count = $a->plaintext;
	}
	
	foreach($html->find('div[itemprop=news_data]') as $news_data){
		$kode .="||".$news_data->id;
		
		foreach($news_data->find('div[itemprop=title]') as $b){
			$title .="||".$b->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=date]') as $c){
			$date .="||".$c->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=news_content]') as $d){
			$news_content .="||".$d->plaintext;
		}	
		
		foreach($news_data->find('div[itemprop=writer]') as $e){
			$writer .="||".$e->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=image]') as $f){
			$image .="||".$f->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=url]') as $g){
			$url .="||".$g->plaintext;
		}
		
		foreach($news_data->find('div[itemprop=media]') as $h){
			$media .="||".$h->plaintext;
		}
		
	}
	
//}
	$array_kode = explode("||",substr($kode,2,strlen($kode)));	
	$array_title = explode("||",substr($title,2,strlen($title)));	
	$array_date = explode("||",substr($date,2,strlen($date)));	
	$array_news_content = explode("||",substr($news_content,2,strlen($news_content)));	
	$array_writer = explode("||",substr($writer,2,strlen($writer)));	
	$array_url = explode("||",substr($url,2,strlen($url)));
	$array_media = explode("||",substr($media,2,strlen($media)));
	$array_image = explode("||",substr($image,2,strlen($image)));

   for($i=0;$i<$count;$i++){
		$kode_ = $array_kode[$i];
		$media_ = $array_media[$i];
		$title_ = $array_title[$i];
		$date_ = $array_date[$i];
		$news_ = html_entity_decode($array_news_content[$i]);
		$writer_ = $array_writer[$i];
		$url_ = $array_url[$i];
		$image_ = $array_image[$i];
		
		
		echo "Kode:".$kode_.PHP_EOL;
		echo "media:".$media_.PHP_EOL;
		echo "title:".$title_.PHP_EOL;
		echo "date:".$date_.PHP_EOL;
		echo "news content:".$news_.PHP_EOL;
		echo "writer:".$writer_.PHP_EOL;
		echo "url:".$url_.PHP_EOL;
		echo "image:".$image_.PHP_EOL;
		echo "time:".$NOW.PHP_EOL;
		echo "-------------------------------------------------------------------------------------------------------".PHP_EOL;
		
		save_data_from_newsd($DefaultSearch,$kode_,$media_,$title_,$date_,$news_,$writer_,$url_,$image_,$NOW);
	}
   
    //echo $DefaultSearch.PHP_EOL;
   //print_r($array_kode);


?>

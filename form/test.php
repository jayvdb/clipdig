<?php
include ("../static/inc/con.php");
include ("../static/inc/function.php");
include ("../static/inc/conf.php");
include ("simple_html_dom.php");


$target 	= "http://202.146.128.250:8222/search.php?search=pilkada";
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
		$kode = $news_data->id;
		
		foreach($news_data->find('div[itemprop=title]') as $b){
			$title = $b->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=date]') as $c){
			$date = $c->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=news_content]') as $d){
			$news = $d->plaintext;
		}	
		
		foreach($news_data->find('div[itemprop=writer]') as $e){
			$writer = $e->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=image]') as $f){
			$image = $f->plaintext;
		}
	
		foreach($news_data->find('div[itemprop=url]') as $g){
			$url = $g->plaintext;
		}
		
		foreach($news_data->find('div[itemprop=media]') as $h){
			$media = $h->plaintext;
		}
		
		
		
		echo "Kode:".$kode.PHP_EOL;
		echo "media:".$media.PHP_EOL;
		echo "title:".$title.PHP_EOL;
		echo "date:".$date.PHP_EOL;
		echo "news content:".$news.PHP_EOL;
		echo "writer:".$writer.PHP_EOL;
		echo "url:".$url.PHP_EOL;
		echo "image:".$image.PHP_EOL;
		echo "time:".$NOW.PHP_EOL;
		echo "-------------------------------------------------------------------------------------------------------".PHP_EOL;
		save_data_from_newsd($DefaultSearch,$kode,$media,$title,$date,$news,$writer,$url,$image,$NOW);
		
		
		
	}
	
//}
?>

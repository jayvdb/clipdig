<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/conf.php");


$target = "http://202.146.128.250:8222/xml.php?search=$DefaultSearch&limit=100";


	$xml = simplexml_load_file($target);

	foreach($xml->item as $item){
		$kode =  $item->kode;
		$media =  $item->media;
		$title =  $item->title;
		$date =  $item->date;
		$link =  $item->link;
		$image =  $item->image;
		$writer =  $item->writer;
		$content =  $item->content;
		
		//echo "Kode:".$kode.PHP_EOL;
		//echo "media:".$media.PHP_EOL;
		//echo "title:".$title.PHP_EOL;
		//echo "date:".$date.PHP_EOL;
		//echo "writer:".$writer.PHP_EOL;
		//echo "url:".$link.PHP_EOL;
		//echo "image:".$image.PHP_EOL;
		//echo "content:".$content.PHP_EOL;
		//echo $NOW."-------------------------------------------------------------------------------------------------------".PHP_EOL;
		save_data_from_newsd($DefaultSearch,$kode,$media,$title,$date,$content,$writer,$link,$image,$NOW);
		
		
	}
	

?>

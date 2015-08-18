<?php
//API

include ("../static/inc/con.php");
include ("../static/inc/function.php"); 

	$mode=ifset('mode');
	$search=ifset('search');
	$start_date=ifset('start_date');
	$end_date=ifset('end_date');
	$status=ifset('status');
	$searched=ifset('searched');
	$tags=ifset('tags');
	$city=ifset('city');
	$ShowMedia = explode(",",ShowMedia());


	$WHERE="WHERE";
	
	// search 
	if(!empty($search)){
		$WHERE .=" (`judul` LIKE '%$search%' OR `waktu` LIKE '%$search%' OR `penulis` LIKE '%$search%' ) AND ";
	}
	
	//date
	if(!empty($start_date) AND !empty($end_date)){
		$WHERE .=" (`waktu` BETWEEN '$start_date' and '$end_date') AND ";
	}
	else{$WHERE .="";}
	
	//status
	if(isset($status)){
		if($status!="all" AND $status!=""){$WHERE .=" `status`='$status' AND ";}
		else{$WHERE .="";}
	}
	
	//searched
	if(!empty($searched)){
		if($searched!="all"){$WHERE .=" `search` LIKE '%$searched%' AND ";}
		else{$WHERE .="";}
	}
	
	////tags
	//if(!empty($tags)){
		//if($tags!="all"){$WHERE .=" `tags` LIKE '%$tags%' AND ";}
		//else{$WHERE .="";}
	//}
	
	////city
	//if(!empty($city)){
		//if($city!="all"){$WHERE .=" `city` LIKE '%$city%' AND ";}
		//else{$WHERE .="";}
	//}			

	$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
	$qry_time = mysql_query("SELECT DISTINCT `waktu` as `waktu` FROM `data` $WHERE  ORDER BY `waktu` DESC ")or die(mysql_error());
	
if($mode=="json"){ /// JSON MODE
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; charset=UTF-8');
	
	$json = '{';
	while($data=mysql_fetch_array($qry_time)){
		$time = $data['waktu'];
		$count ="";
		foreach($ShowMedia as $media){
			$count .= ',"'.$media.'":"'.getCount($media,$WHERE,$data['waktu']).'"';
		}
		
		if($json!="{"){$json .= ",";}
		$json .='"output":{"date":"'.$time.'",';
		$json .='"data":{';
					$json .=substr($count,1,strlen($count));
		$json .='}}';
	}
	$json .= '}';
	echo $json;
}
elseif($mode=="xml"){  /// XML MODE
	$xml = new SimpleXMLElement('<xml/>');
	while($data=mysql_fetch_array($qry_time)){
		$track = $xml->addChild('data');
		$track->addChild('date', $data['waktu']);
			foreach($ShowMedia as $media){
				$track->addChild($media, getCount($media,$WHERE,$data['waktu']));
			}
	}
	Header('Content-type: text/xml');
	print($xml->asXML());
}
else{
	echo "
	<html><head><title>Help API</title>
	<style>
	table tr:nth-child(even){background:#FFFFCE;}
	table tr:nth-child(odd){background:#E0F8FF;}
	table td:nth-child(odd){width:150px;}
	pre{color:#030371;}
	small{color:#FF0000;}
	</style>
	</head><body>
	<h2>You can get data with command</h2>
	<pre>".$URL."get/?mode=&search=&searched=&tags=&city=&start_date=&end_date=</pre>
	<table border='1' cellspacing='0' cellpadding='3'>
		<tr>
			<th><b>Command</b></th>
			<th><b>Description</b></th>
		</tr>
		<tr>
			<td><b>?mode =</b></td>
			<td>json / xml</td>
		</tr>
		<tr>
			<td><b>&search =</b></td>
			<td>you can type any word you are looking to get the data<br>
				<i>Example:</i><br>
				<pre>&search=jakarta+selatan</pre>
				<small>leave blank if you do not want to retrieve data based on 'Search'</small>
			</td>
		</tr>
		<tr>
			<td><b>&search =</b></td>
			<td>you can type the 'searched' words that exist in the database to get the data<br>
				<i>Example:</i><br>
				<pre>&searched=jakarta+selatan</pre>
				<small>leave blank if you do not want to retrieve data based on 'Searched'</small>
			</td>
		</tr>
		<tr>
			<td><b>&tags =</b></td>
			<td>you can type the 'tags' words that exist in the database to get the data<br>
				<i>Example:</i><br>
				<pre>&tags=ahok</pre>
				<small>leave blank if you do not want to retrieve data based on 'Tags'</small>
			</td>
		</tr>
		<tr>
			<td><b>&city =</b></td>
			<td>you can type the 'city' name that exist in the database to get the data<br>
				<i>Example:</i><br>
				<pre>&city=bogor</pre>
				<small>leave blank if you do not want to retrieve data based on 'City'</small>
			</td>
		</tr>
		<tr>
			<td><b>&start_date =</b></td>
			<td>type the `start date` to get data between two dates<br>
				<i>Example:</i><br>
				<pre>&start_date=2015-01-01</pre>
				<small>leave blank if you want to get all dates</small>
			</td>
		</tr>
		<tr>
			<td><b>&end_date =</b></td>
			<td>type the `end date` to get data between two dates<br>
				<i>Example:</i><br>
				<pre>&end_date=2015-12-31</pre>
				<small>leave blank if you want to get all dates</small>
			</td>
		</tr>
	
	</table>
	
	
	</body></html>
	";
}
?>


<?php
	$media		=ifset('me');
	$page		=ifset('p');
	$search		= ifset('se');
	$tgl1		=ifset('tgl1');
	$tgl2		=ifset('tgl2');
	$status		= ifset('st');
	$searched	=ifset('searched');
	$wilayah	=ifset('wilayah');
	$category	=ifset('category');

	if(empty($media)){header("location:?m=Scrap&l=".ifset('l')."&me=all&st=all&searched=&p=&se=&tgl1=&tgl2=&wilayah=");}
	elseif(empty($page)){$page=1;}

	echo '
	<div class="col-lg-12">
	<div class="col-lg-12 well-me">
	<div class="col-lg-6">';
	if(ifset('l')=="Data"){
			CreateMenuMedia();
		}
		CreateMenuStatus();
		CreateMenuSearched();
	echo CreateWilayah($wilayah);

		CreateSearch();
		CreateSearchDate();
	echo'</div>
	<div class="col-lg-6">';
	CreateMenuCategory();

	echo'</div></div></div>';










?>

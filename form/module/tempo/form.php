<?php
	$header = "tempo.co";
	$note		= "Foot note";

echo '
<div class="row">
<div class="well-sm well-me">
<form method="POST" action="?m='.$_GET['m'].'&l='.$_GET['l'].'&me='.$_GET['me'].'">
	<h3>'.$header.'</h3>
	<table border=0 cellspacing=0 cellpadding=5>
		<tr><th><label>Search</label></th><th><label >Start Page</label></th><th><label >End Page</label></th><th></th></tr>
		<tr>
			<td><input name="search" class="form-control" type="text" placeholder="Search" value="';if(isset($_POST['search'])){echo $_POST['search'];}else{echo $DefaultSearch;} echo'" ></td>
			<td><input name="start" class="form-control" type="number" placeholder="Start Page" value="';if(isset($_POST['start'])){echo $_POST['start'];}else{echo '1';} echo'"></td>
			<td><input name="to" class="form-control" type="number" placeholder="End Page" value="';if(isset($_POST['to'])){echo $_POST['to'];}else{echo '1';} echo'"></td>
			<td><button type="submit" class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Search</button></td>
		</tr>
	</table>
	<small class="text-danger">'.$note.'</small>
</form>';

if(isset($_POST['search']) AND isset($_POST['start']) AND isset($_POST['to']) ){
	$search = strtolower(htmlspecialchars($_POST['search'])); //search
	$start = $_POST['start']; //Start Page
	$to = $_POST['to']; //End Page

	$search_ = str_replace(' ','-',$search);
	$search__ = str_replace(' ','+',$search);

	include ("get_header.php");
}

echo '</div></div>';
?>

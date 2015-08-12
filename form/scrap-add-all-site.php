<?php
	include("simple_html_dom.php");
	$header 	= "add by all site";
	$note		= "Foot note";

echo '
<form method="POST" action="?m='.$_GET['m'].'">
	<h3>'.$header.'</h3>
	<div class="input-group">
		<input name="search" class="form-control" type="text" placeholder="Search" value="';if(isset($_POST['search'])){echo $_POST['search'];}else{echo $DefaultSearch;} echo'" >
		<div class="input-group-btn">
			<button type="submit" class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Search</button>
		</div>
		
	</div>
		
		<input name="start" type="hidden"  value="1">
		<input name="to" type="hidden"  value="1">
		<small class="text-danger">'.$note.'</small><br>
		
	
</form>';

if(isset($_POST['search']) AND isset($_POST['start']) AND isset($_POST['to']) ){

	$module = scandir('form/module/');
	for($i=0;$i<count($module);$i++){
		if($i>=2){
			$search = strtolower(htmlspecialchars($_POST['search'])); //search
			$start = $_POST['start']; //Start Page
			$to = $_POST['to']; //End Page
			
			$search_ = str_replace(' ','-',$search);
			$search__ = str_replace(' ','+',$search);
			
			
			echo "<h2>".ucfirst($module[$i])."</h2>";
			include ("form/module/".$module[$i]."/get_header.php");
		}
	}
}

?>

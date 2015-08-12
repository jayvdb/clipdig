<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $Description; ?>">
	<meta name="author" content="winardiaris">
	<meta name="version" content="<?php echo $Version; ?>">

	<title><?php echo Settings('Name')." | "; if(isset($_GET['m'])){echo $_GET['m'];} echo " "; if(isset($_GET['l'])){echo $_GET['l'];} echo" "; if(isset($_GET['a'])){echo $_GET['a'];} ?></title>
	<link rel="shortcut icon" href="img/logo.ico" />
	<link href="<?php echo $URL ?>static/css/custom.css" rel="stylesheet">
	<link href="<?php echo $URL ?>static/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $URL ?>static/css/morris.css" rel="stylesheet">
	<link href="<?php echo $URL ?>static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $URL ?>static/css/datepicker3.css" rel="stylesheet">
	
	<script src="<?php echo $URL ?>static/js/jquery.js"></script>
	<script src="<?php echo $URL ?>static/js/custom.js"></script>
	<script src="<?php echo $URL ?>static/js/bootstrap.min.js"></script>
	<script src="<?php echo $URL ?>static/js/bootstrap-datepicker.js"></script>
	
    

   
</head>
<body <?php if($_GET['m']=="Login"){echo 'class="page-login"';}?>>
	<?php 
		if(isset($_GET['m'])){
			$m = $_GET['m'];
			if($m == "Login" OR $m == "Logout"){
				
			}
			else{
				echo '<div id="wrapper"><!-- /#wrapper --><div id="page-wrapper">';
				include ("navigasi.php");
			}
		}
		
       $_SESSION['in'] = microtime(true);
	?>

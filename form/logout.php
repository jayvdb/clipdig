<?php
// setHistory($_SESSION['user_id'],$LOCATION,"Logout Success",$NOW);
	session_destroy();
	header("location:?m=Login");
?>

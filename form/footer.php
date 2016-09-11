<?php
	if(isset($_GET['m'])){
		$m = $_GET['m'];
		if($m == "Login" OR $m == "Logout"){

		}
		else{
			echo'</div></div><!-- /#wrapper -->';
		}
	}
	$_SESSION['out'] = microtime(true);
	$time=$_SESSION['out']-$_SESSION['in'];
?>
<div class="footer" >
	<?php echo "show in $time seconds"; ?>
	<div class="pull-right"><i class="fa fa-linux"></i> 2015</div>
</div>
</body>
</html>
<?php mysql_close(); ?>

<?php
 require_once ("static/inc/checklogin.php");
?>
<nav class="navbar navbar-me navbar-fixed-top " role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="<?php echo $URL; ?>?m=Dashboard"><?php echo Settings('Name'); ?></a>
		</div>
		<div class="collapse navbar-collapse pull-right" id="menu" >
		<ul class="nav navbar-nav  ">
			<li  class="" ><a class="<?php if($_GET['m']=="Dashboard"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li  class="" ><a class="<?php if($_GET['m']=="Scrap"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Scrap"><i class="fa fa-download"></i> Scrap</a></li>
			<li  class="" ><a class="<?php if($_GET['m']=="Category"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Category"><i class="fa fa-table"></i> Category</a></li>
	<?php if($_SESSION['group_id']==1){ ?>
			<li  class="" ><a class="<?php if($_GET['m']=="Setting"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Setting"><i class="fa fa-gear"></i> Setting</a></li>
	<?php }?>		
			<li  class="" ><a class="exit" href="?m=Logout"><i class="fa fa-sign-out"></i> Logout</a></li>
		</ul>
		</div>
	</nav>

<div class="loading">
	<div><h3><i class="fa fa-circle-o-notch fa-spin"> </i></h3></div>
</div>	
	

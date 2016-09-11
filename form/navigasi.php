<?php
 require_once ("static/inc/checklogin.php");
?>

     <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $URL; ?>?m=Dashboard"><?php echo Settings('Name'); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
                <li class="" ><a class="<?php if($_GET['m']=="Dashboard"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="" >
                    <a class="dropdown-toggle <?php if($_GET['m']=="Scrap"){echo "selected";}?>" href="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-download"></i> Scrap <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                       <!-- <li><a href="?m=Scrap&l=AddBySite" ><i class="fa fa-globe"></i> Add by Site</a></li> -->
                       <li><a href="?m=Scrap&l=Data" ><i class="fa fa-table"></i> Data</a></li>
                       <li><a href="?m=Scrap&l=DataCount" ><i class="fa fa-table"></i> Data Count</a></li>
                       <li><a href="?m=Scrap&l=Chart" ><i class="fa fa-bar-chart"></i> Simple Chart</a></li>
                       <li><a href="?m=Scrap&l=Pivot" ><i class="fa fa-table"></i> Pivot Table</a></li>
                    </ul>
                </li>
                <li class="" ><a class="<?php if($_GET['m']=="Category"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Category"><i class="fa fa-table"></i> Category</a></li>
    <?php if($_SESSION['group_id']==1){ ?>
                <li class="" ><a class="<?php if($_GET['m']=="Setting"){echo "selected";}?>" href="<?php echo $URL; ?>?m=Setting"><i class="fa fa-gear"></i> Setting</a></li>
    <?php }?>
                <li class="" ><a class="exit" href="?m=Logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>


<!--
        <div id="navbarCollapse" class="collapse navbar-collapse">

        </div>
-->
    </nav>

<div class="loading">
    <div><h3><i class="fa fa-circle-o-notch fa-spin"> </i></h3></div>
</div>


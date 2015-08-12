<?php CreateMenuModule(); ?>


</div><!-- well well-sm -->
<div class="col-lg-12">
	<?php
	if(!empty($_GET['me'])){
	$module = scandir('form/module/');
	$menu = $_GET['me'];
	
	for($i=0;$i<count($module);$i++){
		if($i>=2){
			if($menu==$module[$i]){
				$view = "module/".$module[$i]."/form.php";
			}
		}
	}
	include $view;
	}
?>
</div>


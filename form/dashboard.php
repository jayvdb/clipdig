<div class="col-lg-12 row">
	<div class="col-lg-12">
	<div class="well-sm well-me">
		<h2>Dashboard</h2>
		<?php echo "<b>Welcome: </b>".$_SESSION['user_real_name'];
		echo "<br>";
		?>
	</div>
	</div>
</div>





<div class="col-lg-12 row">
	<div class="col-lg-12">
		<div class="well-sm well-me"><textarea><?php $aa=" aaa"; echo strlen($aa); ?></textarea></div>
	</div>
</div>


<script>
$(document).ready(function() {
	$('#prov').load('action.php','op=get_prov_cmb');
	$('#prov').change(function() { 
		$('#kabkot').load('action.php','op=get_kabkot_cmb&data='+$(this).val());
	});
	$('#kabkot').change(function() {
		$('#kode').val($(this).val());
	});
});
</script>


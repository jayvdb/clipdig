<?php
	//echo "<div class='col-lg-12'><div class='col-lg-12 well-me'><small>query</small><br><textarea cols='150' rows='2'>".$q."</textarea></div></div><br> ";
?>
<script>
	locations = $(location).attr('href');
	locations = locations.split('?');
	locations = locations[0];
	<?php
	    if(!empty($category)){
				$category_ = explode(";",$category);
				$count_category = count($category_);
				for($i=1;$i<$count_category;$i++){
					$category__=explode(":",$category_[$i]);
					$category_name = $category__[0];
					$category_data = $category__[1];

					print("$(\"div.category select[name='".$category_name."'] \").val('".$category_data."');\n ");
				}
			}

		if(ifset('l') == "Data" OR ifset('l') == "DataCount" OR ifset('l') == "Chart"){
			print('url="?m='.ifset('m').'&l='.ifset('l').'&me='.ifset('me').'&st='.ifset('st').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2').'";');
			print("wilayah='".ifset('wilayah')."';");
			print('if(wilayah!=""){
						wilayah_ = wilayah.split(".");
						$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb&kode=\'+wilayah_[0]);
						$(\'#kabkot\').load(\'action.php\',\'op=get_kabkot_cmb&data=\'+wilayah_[0]+\'&kode=\'+wilayah);
					}else{
						$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb\');
					}');
			print('$(\'#prov\').change(function() {
					window.location.href=url+"&wilayah="+$(this).val();
				});
				$(\'#kabkot\').change(function() {
					window.location.href=url+"&wilayah="+$(this).val();
				});');
		}
	?>
</script>



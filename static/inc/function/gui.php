<?php
function CreateMenuMedia(){
	$name ="Media :"	;
	$url = '?m='.ifset('m').'&l='.ifset('l').'&st='.ifset('st').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2');
	$menu = '<div class="menu-cmb">'.$name.'<select name="me" class="" onchange="window.location.href=$(this).val();"><option value="'.$url.'&me=all">All</option>';
		$ShowMedia = explode(",",ShowMedia());
		foreach($ShowMedia as $me){
			$menu.= '<option value="'.$url.'&me='.$me.'"  ';
				if($me==ifset('me')){
					$menu .= 'selected="selected"';
				}
			$menu .='>'.ucfirst($me).'</option>';
		}
	$menu .='</select></div>';
	echo $menu;
}
function CreateMenuStatus(){
	$name ="Status :"	;
	$url = '?m='.ifset('m').'&l='.ifset('l').'&me='.ifset('me').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2');
	$menu = '<div class="menu-cmb">'.$name.'<select name="st" class="" onchange="window.location.href=$(this).val();"><option value="'.$url.'&st=">All</option>';
		$ShowStatus = explode(",",ShowStatus());
		foreach($ShowStatus as $st){
			$menu.= '<option value="'.$url.'&st='.$st.'" ';
				if($st==ifset('st')){
					$menu .= 'selected="selected"';
				}
			$menu .='>'; 
				if($st==0){$menu .= 'Dowloaded Header';}
				elseif($st==1){$menu.='Not Checked';}
				elseif($st==2){$menu.='Positive';}
				elseif($st==3){$menu.='Negative';}
				elseif($st==4){$menu .='Deleted';}
			
			$menu .='</option>';
		}
	$menu .='</select></div>';
	echo $menu;
}
function CreateMenuSearched(){
	$name ="Searched :"	;
	$url = '?m='.ifset('m').'&l='.ifset('l').'&me='.ifset('me').'&st='.ifset('st').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2');
	$menu = '<div class="menu-cmb">'.$name.'<select name="searched" class="" onchange="window.location.href=$(this).val();"><option value="'.$url.'&searched=">All</option>';
		$ShowSearch = explode(",",ShowSearch());
		foreach($ShowSearch as $searched){
			$menu.= '<option value="'.$url.'&searched='.$searched.'" ';
				if($searched==ifset('searched')){
					$menu .= 'selected="selected"';
				}
			$menu .='>'.ucfirst($searched).'</option>';
		}
	$menu .='</select></div>';
	echo $menu;
}

function CreateMenuModule(){
	$module = scandir('form/module/');
	
	$show ='<div class="navbar naikin30 Module" >Medias: <div class="btn-group">';
	
	for($i=0;$i<count($module);$i++){
		if($i>=2){
			$notuse = strpos($module[$i],".html");
			if($notuse === false){
				$menu=ifset('me');
				$show .='<a class="btn btn-default btn-xs '; 
				if($menu==$module[$i]){ $show.='active';} 
				$show .='" href="?m='.ifset('m').'&l='.ifset('l').'&st='.ifset('st').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl1='.ifset('tgl1');
				$show .='&me='.$module[$i].'" >'.ucfirst($module[$i]).'</a>';
			}
		}
	}
	$show .='</div></div>';
	echo $show;
}

function CreateMenuCategory(){
	foreach (list_category("all") as $list){
		$category_names = $list[0];
		$category_type = $list[1];
		
		$category_name = explode("_",$category_names);
		$category_name = str_replace("-"," ",$category_name);
		$category_name = ucwords($category_name[1]);
		
		$gui = '<div class="menu-cmb category">'.$category_name.'<select name="'.$category_names.'" class="" >';
		
		$gui_a='<option value="all">All</option>';
		foreach(show_category_data($list[0]) as $list_a){
			$gui_a .= '<option value="'.$list_a[1].'">'.ucwords($list_a[1]).'</option>';
		}
		$gui .= $gui_a;
		$gui .= '</select></div>';
		
		echo $gui;
	}
}
function CreateMenuCategoryView($kode){
	//automatic
	foreach (list_category("1") as $list_automatic){
		$category_names_automatic = $list_automatic[0];
		$category_type_automatic = $list_automatic[1]; //auto or manual
		$gui_automatic = "";
		
		$category_name_automatic = explode("_",$category_names_automatic);
		$category_name_automatic = str_replace("-"," ",$category_name_automatic);
		$category_name_automatic = ucwords($category_name_automatic[1]);
		
		if($category_names_automatic == 'category_tags'){
			$gui_automatic_a	= '<div class="category-view"><label>'.$category_name_automatic.'</label><br>';
			$gui_automatic_a 	.= '<small>'.get_data_category($kode,$category_names_automatic).'</small>';
			$gui_automatic_a 	.= '</div>';
			$gui_automatic 	.= $gui_automatic_a;
		}
		else{
			$gui_automatic_b = '<div class="menu-cmb-view category-view"><label>'.$category_name_automatic.'</label><select name="'.$category_names_automatic.'" class="form-control" >';
		
			$gui_b='<option value="all">All</option>';
			foreach(show_category_data($list_automatic[0]) as $list_b){
				$gui_b .= '<option value="'.$list_b[1].'"';
				
					//ambil data terakhir dari category_*
					$val = get_data_category($kode,$category_names_automatic);
					$val = explode(',',$val);
					$val = end($val);
				
					if($val==$list_b[1]){
						$gui_b .= ' selected="selected" ';
					}
				
				$gui_b .= '>'.ucwords($list_b[1]).'</option>';
			}
			$gui_automatic_b .= $gui_b;
			$gui_automatic_b .= '</select></div>';
			$gui_automatic .= $gui_automatic_b;
		}
		

		echo $gui_automatic;
	}
	
	//manual
	foreach (list_category("0") as $list_manual){
		$category_names_manual = $list_manual[0];
		$category_type_manual = $list_manual[1];
		$gui_manual="";
		
		$category_name_manual = explode("_",$category_names_manual);
		$category_name_manual = str_replace("-"," ",$category_name_manual);
		$category_name_manual = ucwords($category_name_manual[1]);
		
		$gui_manual .='<div class="category-view checkbox" data="'.$category_names_manual.'"><b>'.$category_name_manual.'</b><br>';
		
		$gui_a ="";
		foreach(show_category_data($list_manual[0]) as $list_a){
			//ambil data terakhir dari category_*
			$val = get_data_category($kode,$category_names_manual);
			$val = explode(',',$val);
			$val_count = count($val);
			
			$gui_a .='<label class="checkbox"><input  type="checkbox" name="'.$list_a[0].'" value="'.$list_a[1].'"';
			for($i=0;$i<$val_count;$i++){
				if($val[$i]==$list_a[1]){
					$gui_a .=' checked="" ';
				}
			}
			
			$gui_a .= '>'.ucwords($list_a[1]).'</label>';
			
		}
		$gui_manual .= $gui_a;
		$gui_manual .='</div>';
			
		echo $gui_manual;
	}
	//semi
	foreach (list_category("2") as $list_manual){
		$category_names_manual = $list_manual[0];
		$category_type_manual = $list_manual[1];
		$gui_manual="";
		
		$category_name_manual = explode("_",$category_names_manual);
		$category_name_manual = str_replace("-"," ",$category_name_manual);
		$category_name_manual = ucwords($category_name_manual[1]);
		
		$gui_manual .='<div class="category-view checkbox" data="'.$category_names_manual.'"><b>'.$category_name_manual.'</b>';
		
		$gui_a ="";
		foreach(show_category_data($list_manual[0]) as $list_a){
			//ambil data terakhir dari category_*
			$val = get_data_category($kode,$category_names_manual);
			$val = explode(',',$val);
			$val_count = count($val);
			
			$gui_a .='<label class="checkbox"><input  type="checkbox" name="'.$list_a[0].'" value="'.$list_a[1].'"';
			for($i=0;$i<$val_count;$i++){
				if($val[$i]==$list_a[1]){
					$gui_a .=' checked="" ';
				}
			}
			
			$gui_a .= '>'.ucwords($list_a[1]).'</label>';
			
		}
		$gui_manual .= $gui_a;
		$gui_manual .='</div>';
			
		echo $gui_manual;
	}
}





//pagination
function CreatePagination($DataPerPage,$media,$search,$tgl1,$tgl2,$status,$searched,$category){
	$WHERE="WHERE";
	if(!empty($media)){
		if($media!="all"){$WHERE .=" `media`='$media' AND ";}
		else{$WHERE .="";}
	}
	if(!empty($search)){
		$WHERE .=" (`judul` LIKE '%$search%' OR `waktu` LIKE '%$search%' OR `penulis` LIKE '%$search%' ) AND ";
	}
	if(!empty($tgl1) AND !empty($tgl2)){
		$WHERE .=" (`waktu` BETWEEN '$tgl1' and '$tgl2') AND ";
	}
	else{$WHERE .="";}
	
	if(isset($status)){
		if($status!="all" AND $status!=""){$WHERE .=" `status`='$status' AND ";}
		else{$WHERE .="";}
	}
	if(!empty($searched)){
		if($searched!="all"){$WHERE .=" `search` LIKE '%$searched%' AND ";}
		else{$WHERE .="";}
	}
	if(!empty($wilayah)){
		$WHERE .=" `wilayah` LIKE '%$wilayah%' AND length (`wilayah`) <=".strlen($wilayah);
	}
	
	//category  ------------------------
	if(!empty($category)){
		$WHERE_="";
		$category_ = explode(";",$category);
		$count_category = count($category_);
		for($i=1;$i<$count_category;$i++){
			$category__=explode(":",$category_[$i]);
			$category_name = $category__[0];
			$category_data = $category__[1];
			
			if($category_data!="all"){
				$WHERE_ .=" `$category_name` LIKE '%$category_data%' AND ";
			}
		}
		$WHERE .=$WHERE_;
	}
	//category  ------------------------
	

	$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
	
	$q="SELECT * FROM `data` $WHERE" ;
	$qry=mysql_query($q) or die(mysql_error());

	
   $pages =  ceil(mysql_num_rows($qry)/$DataPerPage);
		//if(empty($_GET['me'])){$me="all";}else{$me=$_GET['me'];}
   $url = '?m='.ifset('m').'&l='.ifset('l').'&me='.ifset('me').'&st='.ifset('st').'&searched='.ifset('searched').'&se='.ifset('se').'&tgl1='.ifset('tgl1').'&tgl2='.ifset('tgl2').'&wilayah='.ifset('wilayah');
   
  
	$pagination ='Pages: <select id="pagination"  class="btn btn-sm btn-default" onchange="window.location.href=$(this).val();">'; 
	for($i=1;$i<=$pages;$i++){
	  $pagination .= '<option value="'.$url.'&p='.$i.'"'; 
	      if(ifset('p')==$i){$pagination .='selected';}
	  $pagination .='>'.$i.'</option>';
	}
	$pagination .='</select>';
	$pagination .= ' '.mysql_num_rows($qry).' Total.';

	echo $pagination;

}
function CreateSearch(){
	echo ' 
	<form method="GET" action="">
	<table>
		<tr>
			<td>Search:</td>
		</tr>
		<tr>
			<td>
			  <input name="se" class="form-control" style="width:300px !important ;float:left;" type="text" value="'.ifset('se').'" placeholder="Search">
				<input type="hidden" name="m" value="'.ifset('m').'">
				<input type="hidden" name="l" value="'.ifset('l').'">
				<input type="hidden" name="st" value="'.ifset('st').'">
				<input type="hidden" name="tgl1" value="'.ifset('tgl1').'">
				<input type="hidden" name="tgl2" value="'.ifset('tgl2').'">
				<input type="hidden" name="searched" value="'.ifset('searched').'">
				<input type="hidden" name="me" value="'.ifset('me').'">
				<input type="hidden" name="wilayah" value="'.ifset('wilayah').'">
				<button class=" btn btn-me  search"   type="submit" style="float:left;"><i class="fa fa-search"></i> Find</button>
			</td>
		</tr>
	</table>
	</form>';
}
function CreateSearchDate(){
	echo ' 
	<form method="GET" action="">
		<table>
			<tr>
				<td>From:</td>
				<td>To:</td>
				<td></td>
			</tr>
			<tr>
				<td>
					<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="'.min_max('min','waktu').'" data-date-end-date="'.min_max('max','waktu').'">
						<input name="tgl1" class="form-control"  value="'.ifset('tgl1').'" placeholder="yyyy-mm-dd">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</td>
				<td>
					<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-end-date="'.min_max('max','waktu').'">
						<input name="tgl2" class="form-control" value="'.ifset('tgl2').'" placeholder="yyyy-mm-dd">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</td>
				<td>
					<input type="hidden" name="m" value="'.ifset('m').'">
				<input type="hidden" name="l" value="'.ifset('l').'">
				<input type="hidden" name="st" value="'.ifset('st').'">
				<input type="hidden" name="searched" value="'.ifset('searched').'">
				<input type="hidden" name="me" value="'.ifset('me').'">
				<input type="hidden" name="wilayah" value="'.ifset('wilayah').'">
					<button class=" btn btn-me"   type="submit" style="float:left;"><i class="fa fa-search"></i> Find</button>
				</td>
			</tr>
		
		</table>
	</form>';
}

function CreateWilayah($wilayah=null){
	if(ifset('l')=="View"){
		$class1 = "";
		$class2 = "form-control";
	}
	else{
		$class1 = "menu-cmb";
		$class2	= "";
	}
	$gui ='	<div class="'.$class1.'">
				<small>Provinsi</small>
				<select name="provinsi" id="prov" class="'.$class2.'"></select>
			</div><div class="'.$class1.'">
				<small>Kota / Kabupaten</small>
				<select name="kabupaten" id="kabkot" class="'.$class2.'"></select>
			</div>
			<input id="kode" type="hidden" name="wilayah">
			<input id="wilayah" type="hidden" value="'.$wilayah.'">';
	$gui .='<script>
	
	
	
	
	
	wilayah = $(\'#wilayah\').val();

	
	if(wilayah!=""){
		wilayah_ = wilayah.split(".");
		$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb&kode=\'+wilayah_[0]);
		$(\'#kabkot\').load(\'action.php\',\'op=get_kabkot_cmb&data=\'+wilayah_[0]+\'&kode=\'+wilayah);
	}else{
		$(\'#prov\').load(\'action.php\',\'op=get_prov_cmb\');
	}
	
	
	
	$(\'#prov\').change(function() { 
		$(\'#kabkot\').load(\'action.php\',\'op=get_kabkot_cmb&data=\'+$(this).val());
		$(\'#kode\').val($(this).val());
	});
	$(\'#kabkot\').change(function() {
		$(\'#kode\').val($(this).val());
	});
</script>';
	return $gui;
}



?>

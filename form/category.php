<?php
	$location = ifset('m').ifset('l');
	if(isset($_POST['add_category'])){
		$name = $_POST['name'];
		$automatic = $_POST['automatic'];

		$save =add_category($name,$automatic);
		if($save==0){
			send_notif("Sudah dipakai");
			setHistory($_SESSION['user_id'],$location,"Menambah Kategori [$name|$automatic|Sudah dipakai]",$NOW);
		}
		elseif($save==1){
			send_notif("Tersimpan");
			setHistory($_SESSION['user_id'],$location,"Menambah Kategori [$name|$automatic|Tersimpan]",$NOW);
		}
		else{
			send_notif("Gagal");
			setHistory($_SESSION['user_id'],$location,"Menambah Kategori [$name|$automatic|Gagal]",$NOW);
		}
	}
	elseif(isset($_POST['save_category'])){
		$category = $_POST['category'];
		$data = strtolower($_POST['data']);
		$save = save_category_data($category,$data);

		if($save==0){
			send_notif("Sudah dipakai");
			setHistory($_SESSION['user_id'],$location,"Menambah data Kategori [$category|$data|Sudah dipakai]",$NOW);
		}
		elseif($save==1){
			send_notif("Tersimpan");
			setHistory($_SESSION['user_id'],$location,"Menambah data Kategori [$category|$data|Tersimpan]",$NOW);
		}
		else{
			send_notif("Gagal");
			setHistory($_SESSION['user_id'],$location,"Menambah data Kategori [$category|$data|Gagal]",$NOW);
		}
	}
	//elseif(isset($_POST['delete_category'])){
		//$category = $_POST['category'];
		//$data = $_POST['data'];

		//$delete = delete_category_data($category,$data);
		//if($delete){		send_notif("Success");}
		//else{				send_notif("Gagal");}

	//}
	elseif(isset($_GET['op'])){
		$op=ifset('op');
		$data=ifset('data');
		$category=ifset('category');

		if($op=="delete_category"){
			setHistory($_SESSION['user_id'],$location,"Menghapus Kategori [$data]",$NOW);
			delete_category($data);
		}
		elseif($op=="delete_category_data"){
			delete_category_data($category,$data);
			setHistory($_SESSION['user_id'],$location,"Menghapus data Kategori [$category|$data]",$NOW);
		}
	}

?>

<div class="col-lg-12">
<div class="well-sm well-me ">
	<?php
	$no=0;

		$gui_b='';
		$gui = '<ul class="nav nav-tabs">';
		foreach(list_category("") as $list){
			$list = $list[0];
			$a = explode("_",$list);
			$a = str_replace("-"," ",$a);
			$name=ucwords($a[1]);

			$gui_b .= '<li><a data-toggle="tab" href="#'.$list.'">'.$name.'</a></li>';
		}
		$gui .=$gui_b;
		$gui .='<li><a data-toggle="tab" href="#add-new"><i class="fa fa-plus"></i> Add</a></li>';
		$gui .='</ul>

		<div class="tab-content">';


		foreach(list_category("") as $list_){
			$list = $list_[0];
			$list_type = $list_[1];
			$gui .=
			'<div id="'.$list.'" class="tab-pane fade">
				<h4>';
			$a = explode("_",$list);
			$a = str_replace("-"," ",$a);
			$gui .=ucwords($a[1]);
			//foreach (list_category("1") as $list_automatic){
				//if($list_automatic[0]==$list){
					//$gui .=' <small class="text-primary">(Automatic)</small>';
				//}
			//}
			if($list_type=="1"){
				$gui .=' <small class="text-primary">(Automatic)</small>';
			}
			elseif($list_type=="2"){
				$gui .=' <small class="text-primary">(Semi-Automatic)</small>';
			}else{
				$gui .=' <small class="text-primary">(Manual)</small>';
			}

			$gui .='<div class="pull-right"><a href="?m='.ifset('m').'&op=delete_category&data='.$list.'" class="btn btn-danger" title="delete category"><i class="fa fa-trash"></i></a></div><br>';


			$gui .='</h4>
				<form action="?m=Category" method="post">
					<div class="input-group">
						<input class="form-control" name="data" placeholder="Add new">
						<input type="hidden" name="category" value="'.$list.'" ">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-primary" name="save_category"><i class="fa fa-plus"></i> Add</button>
						</div>

					</div>
				</form>
				<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th width="50px">No.</th>
						<th>Data</th>
						<th width="50px">Delete</th>
					</tr></thead><tbody>';
					$gui_a="";
					$noo=1;
					foreach(show_category_data($list) as $data_category[$no]){
						$data_category = $data_category[$no];
						$gui_a .='<tr>
							<td align="right">'.$noo++.'. </td>
							<td>'.ucwords($data_category[1]).'</td>
							<td align="center">
								<a class="text-danger" href="?m=Category&op=delete_category_data&category='.$list.'&data='.$data_category[0].'"><i class="fa fa-trash"></i></a>
							</td>
						</tr>';
					}
					$gui .=$gui_a;
			$gui .='</tbody></table>
				</div>
				</div>';

		}
		//new
			$gui .=
			'<div id="add-new" class="tab-pane">
				<h4>Add New</h4>
				<form action="?m=Category" method="post">
					<div class="input-group">
						<input class="form-control" placeholder="Name Category" name="name">
						<div class="input-group-btn">
							<button type="submit" name="add_category" class="btn bbtn-primary"><i class="fa fa-plus"></i> Add</button>
						</div>
					</div>
					<label><input type="radio" name="automatic" value="0" checked>Manual</label>
					<label><input type="radio" name="automatic" value="1">Automatic</label>
					<label><input type="radio" name="automatic" value="2">Semi Automatic</label>
				</form>
			</div>';


		$gui .='</div>';
		echo $gui;

	?>
</div>
</div>



<?php


?>

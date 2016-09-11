<div class="col-lg-12">
<div class="well-sm well-me">
<?php
	$location = ifset('m').ifset('l');
	$op = ifset('op');
	$kode = ifset('kode');
	$ids = ifset('ids');

	if(isset($kode)){
		$media = get_data('kode',$kode,'media');
		$status = get_data('kode',$kode,'status');
		$artikel = get_data('kode',$kode,'artikel');

		if($op=="edit"){
			if($status==0){
				if(empty($artikel)){
					include("module/".$media."/get_content.php");
				}
				View();
			}
			else{
				View();
			}
			//setHistory($_SESSION['user_id'],$location,"melihat data $kode",$NOW);
		}
		elseif($op=="reload"){
			include("module/".$media."/get_content.php");
			View();
		}
		elseif($op=="update_category"){
			$kode = $_GET['kode'];
			$category = $_GET['category'];
			$category = explode(":",$category);
			$category_name = $category[0];
			$category_data = $category[1];

			echo update_category_from_view($kode,$category_name,$category_data);
			update_by($kode,$_SESSION['user_id']);
			setHistory($_SESSION['user_id'],$location,"merubah data [$kode] [$category_name|$category_data]",$NOW);
		}

		if(isset($_POST['simpan'])){
			$artikel = $_POST['artikel'];
			$status = $_POST['status'];
			$wilayah = $_POST['wilayah'];
			update_data($kode,$artikel,$status,$wilayah);
			update_by($kode,$_SESSION['user_id']);
			setHistory($_SESSION['user_id'],$location,"merubah data [$kode] [Status|$status][Wilayah|$wilayah]",$NOW);
		}
	}
	else{
		header("location:?m=Scrap&l=Data");
		setHistory($_SESSION['user_id'],$location,"melihat data kosong",$NOW);
	}




?>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo $URL;?>static/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector: "textarea"
});
</script>
<script type="text/javascript">
	$('div.category-view select').change(function() {
		locations = $(location).attr('href');
		locations_ = locations.replace('&op=edit','').replace('&op=reload','');
		split1 = locations.split("kode=");
		kode = split1[1];
		category_name = $(this).attr('name');
		category_data = $(this).val();
		datanya = "&category="+category_name+":"+category_data;

		//alert(locations_+"&op=update_category"+datanya);
		$.ajax({url: locations_ ,data: "op=update_category"+datanya,cache: false,
			success: function(msg){
				if(msg=="1"){
					alert("saved");
				}
				else if(msg=="0"){
					alert("error");
				}
			}
		});
	});

	$('label.checkbox input[type=radio]').click(function() {
		locations = $(location).attr('href');
		locations_ = locations.replace('&op=edit','').replace('&op=reload','');
		split1 = locations.split("kode=");
		kode = split1[1];
		category_name = $(this).attr('name');
		category_data = $(this).val();

		datanya = "&category="+category_name+":"+category_data;


		//alert(locations_+"&op=update_category"+datanya);


		$.ajax({url: locations_ ,data: "op=update_category"+datanya,cache: false,
			success: function(msg){
				if(msg=="1"){
					alert("saved");
				}
				else if(msg=="0"){
					alert("error");
				}
			}
		});
	});

	list = $('div.checkbox .list');
	list.hide();
	$('div.checkbox b')
	.append(' <i class="fa fa-caret-down pull-right"></i>')
	.click(function() {
		ini = $(this).parent().children('.list');
		if(ini.is(':visible')){ini.slideUp();}else{list.slideUp();ini.slideDown();		}

		itu = $('div.checkbox b i');if(itu.hasClass('fa-caret-up')){itu.addClass('fa-caret-down').removeClass('fa-caret-up');	}else{$(this).children('i').toggleClass('fa-caret-up').toggleClass('fa-caret-down');	}
	});







</script>






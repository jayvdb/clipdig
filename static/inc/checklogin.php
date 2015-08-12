<?php
//session_start();
//jika session username belum dibuat, atau session username kosong
if (!isset($_SESSION['login'])) {
    //redirect ke halaman login
    header('location:?m=Login');
}
else{
	$now= time();
		if($now > $_SESSION['timeout']){
			session_destroy();
			echo "<script>alert('Session Timeout !',document.location.href='?m=Login')</script>";
		}
		
	//cek akses
	if(isset($_GET['m'])){
		if($_GET['m']=="Setting"){
			if($_SESSION['group_id']!=1){ 
				header("location:?m=Dashboard");
			}
		}
	}
		

}
?>


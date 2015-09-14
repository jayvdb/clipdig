<?php

$filename_prefix = $_POST['csv_name'];
$filename = $filename_prefix."_(dowload_time_".date("Y-m-d_H.i.s").")";

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename.csv\"");
$data=stripcslashes($_REQUEST['csv_text']);
echo $data; 


?>

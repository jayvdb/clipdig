<?php
$out = '';
if (isset($_POST['csv_hdr'])) {
	$out .= $_POST['csv_hdr'];
	$out .= "\n";
}
if (isset($_POST['csv_output'])) {
	$out .= $_POST['csv_output'];
}
$filename_prefix = $_POST['csv_name'];
$filename = $filename_prefix."_(dowload_time_".date("Y-m-d_H.i").")";

//Generate the CSV file header
header("Content-type: application/vnd.ms-excel");
header("Content-Encoding: UTF-8");
header("Content-type: text/csv; charset=UTF-8");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv");
echo "\xEF\xBB\xBF"; // UTF-8 BOM
//Print the contents of out to the generated file.
print $out;

//Exit the script
exit;
?>

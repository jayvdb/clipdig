<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=result_file.csv");
header("Pragma: no-cache");
header("Expires: 0");

$data = array(
   array('aaa', 'bbb', 'ccc', 'dddd'),
   array('123', '456', '789'),
   array('aaa', 'bbb')
);

outputCSV($data);

function outputCSV($data) {
    $output = fopen("php://output", "a");
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
}

?>

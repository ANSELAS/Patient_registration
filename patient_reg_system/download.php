<?php
$file = file_get_contents('patient_data.json');
$dataList = json_decode($file,true);
$csvFile = 'patient.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$csvFile.'"');
$csv = fopen('php://output', 'w');
$firstTableRowData = ['ID', 'Name', 'Surname', 'Gender', 'Date of birth', 'Personal ID number',
    'Doctors speciality', 'Visit Date and Time', 'Health complaints'];
fputcsv($csv, $firstTableRowData, ';');
foreach ($dataList as $list) {
    fputcsv($csv, $list, ';');
}
fclose($csv);
<?php
$editID = $_POST['edit_Id'];
$file = './patient_data.json';
$oldContent = file_get_contents($file);
$dataArray = json_decode($oldContent, true);
$dataArray[$editID]['name'] = $_POST['new_name'];
$dataArray[$editID]['surname'] = $_POST['new_surname'];
$dataArray[$editID]['gender'] = $_POST['new_gender'];
$dataArray[$editID]['dob'] = $_POST['new_dob'];
$dataArray[$editID]['id_number'] = $_POST['new_id_number'];
$dataArray[$editID]['doctor'] = $_POST['new_doctor'];
$dataArray[$editID]['visit'] = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['new_visit'])->format('Y-m-d H:i');
$dataArray[$editID]['health_reason'] = $_POST['new_reason'];

$currentDate = date('Y-m-d H:i');
$registrationDate = $_POST['new_visit'];
//var_dump($dataArray);
try {
    if ($registrationDate < $currentDate) {
        throw new Exception('You cannot register for the previous day. ');
    } else {
        $newContent = json_encode($dataArray, JSON_PRETTY_PRINT);
        file_put_contents($file, $newContent);
        header("Location: data.php");
        exit();
    }
} catch (Exception $exception) {
    echo 'Error: '.$exception->getMessage().'Please <a href="data.php">go back</a>';
    exit();
}
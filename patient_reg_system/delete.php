<?php
$file = './patient_data.json';
$id = $_POST['id'];
$oldContent = file_get_contents($file);
$list = json_decode($oldContent, true);
unset($list[$id]);
$list = array_values($list);

foreach ($list as $key => $value) {
    $list[$key]['#'] = $key + 1;
}
$newContent = json_encode($list, JSON_PRETTY_PRINT);
file_put_contents($file, $newContent);
header("Location: data.php");
exit();
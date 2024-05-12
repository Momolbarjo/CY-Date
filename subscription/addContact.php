<?php

$userData = $_POST['asker'];
$inputLog = $_POST['receiver'];

$file = fopen('../data/request.csv', 'a'); 

fputcsv($file, array($userData, $inputLog)); 

fclose($file); 

?>
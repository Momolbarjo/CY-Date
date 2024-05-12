<?php

$asker = $_POST['asker'];
$receiver = $_POST['receiver'];


$file = fopen('../data/request.csv', 'r');
$lines = [];
while (($line = fgetcsv($file)) !== FALSE) {
	if ($line[0] != $asker || $line[1] != $receiver) {
		$lines[] = $line;
	}
}
fclose($file);


$file = fopen('../data/request.csv', 'w');
foreach ($lines as $line) {
	fputcsv($file, $line);
}
fclose($file);


?>
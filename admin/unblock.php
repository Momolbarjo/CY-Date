<?php
/* Programme PHP permettant de débloquer un utilisateur après l'avoir bloqué. */

session_start();
$asker = $_POST['asker'];
$receiver = $_POST['receiver'];


$file = fopen('../data/blocked.csv', 'r');
$lines = [];
while (($line = fgetcsv($file)) !== FALSE) {
	if ($line[0] != $asker || $line[1] != $receiver) {
		$lines[] = $line;
	}
}
fclose($file);


$file = fopen('../data/blocked.csv', 'w');
foreach ($lines as $line) {
	fputcsv($file, $line);
}
fclose($file);


?>

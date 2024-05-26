<?php
/* Programme PHP permettant la suppression d'un utilisateur du site (mode administrateur). */

$user = $_POST['username'];


$file = fopen('../data/users.csv', 'r');
$lines = [];
while (($line = fgetcsv($file)) !== FALSE) {
	if ($line[2] != $user ) {
		$lines[] = $line;
	}
}
fclose($file);


$file = fopen('../data/users.csv', 'w');
foreach ($lines as $line) {
	fputcsv($file, $line);
}
fclose($file);


?>

<?php
/* Programme PHP permettant la suppression d'un message envoyé par un utilisateur. */
    $msgId = $_POST['ID'];
    
    $file = fopen('../data/message.csv', 'r');
    $lines = [];
    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[3] != $msgId ) {
            $lines[] = $line;
        }
    }
    fclose($file);


    $file = fopen('../data/message.csv', 'w');
    foreach ($lines as $line) {
        fputcsv($file, $line);
    }
    fclose($file);



?>

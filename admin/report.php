<?php
/* Programme PHP permettant le signalement d'un utilisateur en y ajoutant la raison. */
    $reporter = $_POST['reporter'];
    $reported = $_POST['reported'];
    $reason = $_POST['reason'];


    $file = fopen('../data/reports.csv','r');

    $reportExists = false;
    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[0] == $reporter && $line[1] == $reported && $line[2] == $reason) {
            $reportExists = true;
            break;
        }
    }
    fclose($file);

    if (!$reportExists && $reason !== '' ) {
        $file = fopen('../data/reports.csv', 'a'); 
        fputcsv($file, array($reporter, $reported,$reason)); 
        fclose($file);  
        
    } 


?>

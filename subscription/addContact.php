<?php
/* Programme PHP permettant la gestion d'ajout de contacts sur le site (demande envoyé ou reçu). */

$userData = $_POST['asker'];
$inputLog = $_POST['receiver'];

$file = fopen('../data/request.csv', 'r'); 

$contactExists = false;
while (($line = fgetcsv($file)) !== FALSE) {
    if ($line[0] == $userData && $line[1] == $inputLog) {
        $contactExists = true;
        break;
    }
}
fclose($file);

if (!$contactExists) {
    $file = fopen('../data/request.csv', 'a'); 
    fputcsv($file, array($userData, $inputLog)); 
    fclose($file); 
    
} 
?>

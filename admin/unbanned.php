<?php
$bannedUser = $_POST['user'];
$unbanReason = $_POST['reason'];

$file = fopen('../data/unban.csv', 'r'); 

$unbannedRequestExist = false;
while (($line = fgetcsv($file)) !== FALSE) {
    if ($line[0] == $bannedUser) {
        $unbannedRequestExist = true;
        break;
    }
}
fclose($file);

if (!$unbannedRequestExist) {
    $file = fopen('../data/unban.csv', 'a'); 
    fputcsv($file, array($bannedUser, $unbanReason)); 
    fclose($file); 
    
} 
?>
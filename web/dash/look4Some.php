<?php
/* Programme PHP permettant la recherche de queulqu'un sur le site à l'aide de son nom d'utilisateur (barre de recherche). */

session_start(); 

if(isset($_GET['i'])){
    $input = $_GET['i'];
    $file = fopen('../../data/users.csv','r');
    $lines = file("../../data/blocked.csv", FILE_IGNORE_NEW_LINES);
    while(($line = fgetcsv($file)) !== FALSE){

        if($input == "" || strpos($line[2],$input) === 0){
            $username = $line[2];
            $profilePicPath = $line[9];

            if($username !== $_SESSION['input_log']['username']) {
                $isBlocked = false;
                foreach($lines as $line2){
                    $data = str_getcsv($line2);
                    if(count($data) >= 2) {
                        if($data[0] == $_SESSION['input_log']['username'] && $data[1] == $username){
                            echo "<a href='../profile/block/blocker.php?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                            $isBlocked = true;
                            break;
                        }
                        elseif($data[1] == $_SESSION['input_log']['username'] && $data[0] == $username){
                            echo "<a href='../profile/block/blocked.html?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                            $isBlocked = true;
                            break;
                        }
                    }
                }
                if(!$isBlocked){
                    echo "<a href='../profile/profilePage.php?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                }
                
            }
        }
    }
    fclose($file);
}

?>


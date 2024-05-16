<?php

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
                foreach($lines as $line2){
                    $data = str_getcsv($line2);
                    if($data[0] == $_SESSION['input_log']['username'] && $data[1] == $username){
                        echo "<a href='../profile/block/blocker.php?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                    }
                    elseif($data[1] == $_SESSION['input_log']['username'] && $data[0] == $username){
                        echo "<a href='../profile/block/blocked.php?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                    }
                    else{
                        echo "<a href='../profile/profilePage.php?user=$username'><div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div></a>";
                    }
                }
                
            }
        }
    }
    fclose($file);
}

?>

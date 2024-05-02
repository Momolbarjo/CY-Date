<?php

if(isset($_GET['i'])){
    $input = $_GET['i'];
    $file = fopen('../../data/users.csv','r');

    while(($line = fgetcsv($file)) !== FALSE){

        if($input == "" ||strpos($line[2],$input) === 0){
            $username = $line[2];
            $profilePicPath = $line[9];
            echo "<div class='profile'><img class='roundOther-image' src='$profilePicPath' alt='Profile Picture'><p>$username</p></div>";
        }
    }
    fclose($file);
}

?>
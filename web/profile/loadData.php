<?php
function loadUserData($username) {

    $file = fopen('../../data/users.csv', 'r');

    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[2] == $username) { 
            $userData = array(
                'username' => $line[2],
                'birthdate' => $line[4],
                'gender' => $line[6],
                'profilePicPath' => $line[9],
                'statut' => $line[8]
            );

        }
    }

    fclose($file);


    $file = fopen('../../data/description.csv', 'r');

    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[0] == $username) { 
            $userData['region'] = $line[1];
            $userData['height'] = $line[2];
            $userData['description'] = $line[3];
            break; 
        }
    }

    fclose($file);


    $pictures = glob("../../data/userPic/{$username}_*.{jpg,jpeg,png,gif}", GLOB_BRACE);

    $userData['pictures'] = $pictures;

    return $userData;
}

?>
<?php
/* Programme PHP permettant de récupérer les informations d'un utilisateur depuis users.csv pour pouvoir les utiliser. */

function loadUserData($username) {

    $file = fopen('../../data/users.csv', 'r');

    while (($line = fgetcsv($file)) !== FALSE) {
        if ($line[2] == $username) { 
            $userData = array(
                'name' => $line[0],
                'surname' => $line[1],
                'username' => $line[2],
                'email' => $line[3],
                'birthdate' => $line[4],
                'gender' => $line[6],
                'profilePicPath' => $line[9],
                'statut' => $line[8],
                'role' => $line[11]
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

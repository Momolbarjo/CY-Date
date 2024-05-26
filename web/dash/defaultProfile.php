<?php
/* Programme PHP permettant l'affichage des profils récents dans le menu principal. */

function getUsersData($filePath) {
    $users = [];
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $users[] = $data;
        }
        fclose($handle);
    }
    return $users;
}

function sortUsersByRegistrationDate($users) {
    usort($users, function($a, $b) {
        return strtotime($b[7]) - strtotime($a[7]);
    });
    return $users;
}


function getBlockedUsersData($filePath) {
    $blockedUsers = [];
    if (($handle = fopen($filePath, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $blockedUsers[] = $data;
        }
        fclose($handle);
    }
    return $blockedUsers;
}

function isUserBlocked($username, $blockedUsers, $currentUsername ) {
    foreach ($blockedUsers as $blocked) {
        if (($blocked[0] == $currentUsername  && $blocked[1] == $username) || ($blocked[0] == $username  && $blocked[1] == $currentUsername)) {
            return true;
        }
    }
    return false;
}

?>

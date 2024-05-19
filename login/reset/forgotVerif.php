<?php
session_start();
function verify_user($username, $email, $password, $confirm)
{
    $users = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingSurname, $existingName, $existingUsername, $existingEmail, $existingBirthday, $existingPassword, $existingProfilePic) = explode(",", $user);

        if ($existingUsername == $username && $existingEmail == $email) {
            if ($password != $confirm) {
                $_SESSION['error'] = '⚠️Password and confirmation do not match⚠️';
                return false;
            }
            if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
                $_SESSION['error'] = '⚠️Your password dont respect the norme⚠️ ';
                return false;
            }
            return true;
        }
    }

    $_SESSION['error'] = '⚠️Username or email incorrect⚠️';
    return false;
}

function replace_Pwd($username, $new_password)
{
    $lines = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $key => $line) {
        $user = str_getcsv($line);
        if ($user[2] == $username) { 
            $user[5] = $new_password; 
            $lines[$key] = implode(",", $user); 
            break;
        }
    }

    file_put_contents("../../data/users.csv", implode("\n", $lines));
}


?>
<?php

session_start();
function verify_user_data()
{
    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = $_POST["password"];

    if (!preg_match('/^[a-zA-Z]+$/', $surname) || !preg_match('/^[a-zA-Z]+$/', $name)) {
        $_SESSION['error'] = 'Surname/Name should be with  letters only';
        return false;
    }

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
        $_SESSION['error'] = 'Your password need to be at least 8 characters with at least : uppercase letter,lowercase letter, a number and a special character ';
        return false;
    }

    $birthday = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($birthday);
    $age = $interval->y;

    if ($age < 18) {
        $_SESSION['error'] = 'You need to be at least 18';
        return false;
    }

    $users = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingUsername, $existingEmail) = explode(",", $user);

        if ($existingUsername == $username) {
            $_SESSION['error'] = 'Username already exist';
            return false;
        }

        if ($existingEmail == $email) {
            $_SESSION['error'] = 'An account with this email already exist';
            return false;
        }
    }

    return true;
}

?>

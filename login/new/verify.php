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
        return 'Surname/Name should be with  letters only';
    }

    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
        return 'Your password need to be at least 8 characters with at least : uppercase letter,lowercase letter, a number and a special character ';
    }

    $birthday = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($birthday);
    $age = $interval->y;

    if ($age < 18) {
        return 'You need to be at least 18';
    }

    $users = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingUsername, $existingEmail) = explode(",", $user);

        if ($existingUsername == $username) {
            return 'Username already exist';
        }

        if ($existingEmail == $email) {
            return 'An account with this email already exist';
        }
    }

    return true;
}

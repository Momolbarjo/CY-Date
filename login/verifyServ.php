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

    if (!preg_match('/^[a-zA-Z]{1,12}$/', $surname)) {
        $_SESSION['error'] = '⚠️Surname should be with  letters only and between 1 to 12 characters⚠️';
        return false;
    }

    if (!preg_match('/^[a-zA-Z]{1,12}$/', $name)) {
        $_SESSION['error'] = '⚠️Name should be with  letters only and between 1 to 12 characters⚠️';
        return false;
    }

    if (strlen($email) > 30) {
        $_SESSION['error'] = '⚠️Your email should not exceed 15 characters⚠️';
        return false;
    }


    if (!preg_match("~@gmail\.com$~", $email)) {
        $_SESSION['error'] = '⚠️You should use an @gmail account⚠️';
        return false;
    }


    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z,])(?!.*\s).{8,16}$/', $password)) {
        $_SESSION['error'] = '⚠️Your password need to be at least 8 (up to 16) characters with at least : uppercase letter,lowercase letter, a number and a special character (, excluded)⚠️ ';
        return false;
    }

    if (!preg_match('/^[^,\s]{1,10}$/', $username)) {
        $_SESSION['error'] = '⚠️Your username should not contain a comma and be at the most 10 characters long⚠️';
        return false;
    }



    $birthday = new DateTime($birthday);
    $now = new DateTime();
    $interval = $now->diff($birthday);
    $age = $interval->y;

    if ($age < 18) {
        $_SESSION['error'] = '⚠️You need to be at least 18⚠️';
        return false;
    }



    $users = file("../../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingSurname, $existingName, $existingUsername, $existingEmail, $existingBirthday, $existingPassword, $existingProfilePic) = explode(",", $user);

        if ($existingUsername == $username) {
            $_SESSION['error'] = '⚠️Username already exist⚠️';
            return false;
        }

        if ($existingEmail == $email) {
            $_SESSION['error'] = '⚠️An account with this email already exist⚠️';
            return false;
        }
    }

    return true;
}

function verify_login($username, $password)
{
    $users = file("../data/users.csv", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($existingSurname, $existingName, $existingUsername, $existingEmail, $existingBirthday, $existingPassword, $existingGender, $existingDate, $existingSub, $existingProfilPath, $existingRole) = explode(",", $user);

        if ($existingUsername == $username && $existingPassword == $password) {
            $_SESSION['role'] = $existingRole;
            return $existingProfilPath;
        }
    }

    $_SESSION['error'] = '⚠️Username or password incorrect⚠️';
    return false;
}


function totitle($str){
    return ucfirst(strtolower($str));
  }
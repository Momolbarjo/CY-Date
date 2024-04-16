<?php
session_start();
require '../verifyServ.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $birthday = $_POST["birthday"];

    $_SESSION['input_forgot'] = [
        'username' => $username,
        'birthday' => $birthday
    ];

    if (verify_user($username, $birthday)) {
        header("Location: ../../index.php");
        exit(); 
    } else {
        header("Location: forgotHub.php?error=". urlencode($_SESSION['error']));
        exit();
    }
} else {
    header("Location:  forgotHub.php?error=". urlencode($_SESSION['error']));
    exit();
}
?>
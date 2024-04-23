<?php
session_start();
require 'forgotVerif.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $birthday = $_POST["birthday"];
    $pwd = $_POST["pwd"];
    $confirmPwd = $_POST["confirmPwd"];

    $_SESSION['input_forgot'] = [
        'username' => $username,
        'birthday' => $birthday,
        'pwd' => $pwd,
        'confirmPwd' => $confirmPwd
    ];

    if (verify_user($username, $birthday,$pwd,$confirmPwd)) {
        replace_Pwd($username, $pwd);
        header("Location: ../../index.php");
        exit(); 
    } else {
        header("Location: forgotHub.php?error=". urlencode($_SESSION['error']));
        exit();
    }
} else {
    $_SESSION['error'] = '⚠️Request method need to be POST⚠️';
    header("Location: forgotHub.php?error=". urlencode($_SESSION['error']));
    exit();
}
?>
<?php
session_start();
require 'verifyServ.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $_SESSION['input_log'] = [
        'username' => $username,
        'password' => $password
    ];

    $profile_pic = verify_login($username, $password);
    if ($profile_pic !== false) {
        $_SESSION['profile_pic'] = $profile_pic;
        header("Location: ../web/dashboard.php");
        exit(); 
    } else {
        header("Location: ../../index.php?error=". urlencode($_SESSION['error']));
        exit();
    }
} else {
    header("Location: ../../index.php?error=". urlencode($_SESSION['error']));
    exit();
}

?>

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

    if (verify_login($username, $password)) {
        header("Location: ../web/dashboard.html");
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

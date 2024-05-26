<?php
/* Programme PHP qui permet de stocker les nouvelles informations concernant le mot de passe d'un utilisateur. */

session_start();
require 'forgotVerif.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $confirmPwd = $_POST["confirmPwd"];

    $_SESSION['input_forgot'] = [
        'username' => $username,
        'email' => $email,
        'pwd' => $pwd,
        'confirmPwd' => $confirmPwd
    ];

    if (verify_user($username, $email,$pwd,$confirmPwd)) {
        replace_Pwd($username, $pwd);
        $_SESSION['success'] = '✅Your password has been reset✅';
        $_SESSION['input_forgot']='';
        header("Location: ../../index.php?success=". urlencode($_SESSION['success']));
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

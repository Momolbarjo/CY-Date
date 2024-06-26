<?php
/* Programme PHP qui permet la connexion d'un utilisateur sur le site à l'aide de son identifiant et de son mot de passe (si correctes -> la connexion au site réussi). */

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

        if($_SESSION['role'] == 'admin' && isset($_POST['admin'])){
            header("Location: ../admin/Dash.php");
        }
        else{
            header("Location: ../web/dash/dashboard.php");
        }
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

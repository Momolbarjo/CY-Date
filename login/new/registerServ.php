<?php
/* Programme PHP permettant la validation de la création d'un nouveau compte sur le serveur du site. */

session_start();
require '../verifyServ.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    $verificationResult = verify_user_data();

    $_SESSION['input_data'] = [
        'surname' => $surname,
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'birthday' => $birthday,
        'password' => $password,
        'gender' => $gender,
    ];

    if ($verificationResult === false) {
        header("Location: registerHub.php?error=" . urlencode($_SESSION['error']));
        exit();
    }

    if (isset($_FILES["profilPicture"]) && $_FILES["profilPicture"]["error"] == UPLOAD_ERR_OK) {

        $upload_Dir = "../../data/profilePic/";

        $profilepicName = uniqid() . "_" . $_FILES["profilPicture"]["name"];

        move_uploaded_file($_FILES["profilPicture"]["tmp_name"], $upload_Dir . $profilepicName);

        $profilepicPath = $upload_Dir . $profilepicName;

        $day = date("Y-m-d");
        $status = "unsub";
        $surname = strtoupper($surname);
        $name = totitle($name);
        
        if(strtolower($gender) == "female" ){
            $status = "sub";
        }

        $role = "user";
        $reports =0;

        $data = "$surname,$name,$username,$email,$birthday,$password,$gender,$day,$status,$profilepicPath,$reports,$role\n";
        file_put_contents("../../data/users.csv", $data, FILE_APPEND);

        $_SESSION['success'] = '✅Your account has been created✅';
        header("Location: ../../index.php?success=". urlencode($_SESSION['success']));
        unset($_SESSION['input_data']);
        exit();
    } else {
        $_SESSION['error'] = '⚠️An error occurs while downloading your profilePicture⚠️';
        header("Location: registerHub.php?error=". urlencode($_SESSION['error']));
        exit();
    }
} else {
    $_SESSION['error'] = '⚠️Request in POST only.⚠️';
    header("Location: registerHub.php?error=". urlencode($_SESSION['error']));
    exit();
}

?>

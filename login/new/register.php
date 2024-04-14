<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $surname = $_POST["surname"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = $_POST["password"];

    if (!empty($surname) && !empty($name) && !empty($username) && !empty($email) && !empty($birthday) && !empty($password)) {

        if (isset($_FILES["profilPicture"]) && $_FILES["profilPicture"]["error"] == UPLOAD_ERR_OK) {

            $upload_Dir = "../../data/profilePic/";

            $profilepicName = uniqid() . "_" . $_FILES["profilPicture"]["name"];

            move_uploaded_file($_FILES["profilPicture"]["tmp_name"], $upload_Dir . $profilepicName);

            $profilepicPath = $upload_Dir . $profilepicName;

            $data = "$surname,$name,$username,$email,$birthday,$password,$profilepicPath\n";
            file_put_contents("../../data/users.csv", $data, FILE_APPEND);

            header("Location: ../../web/dashboard.html");
            exit();
        } else {
            header("Location: register.html");
            exit();
        }
    } else {
        header("Location: register.html");
        exit();
    }
} else {
    header("Location: register.html");
    exit();
}
?>


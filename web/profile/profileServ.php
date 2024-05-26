<?php
/* Prgoramme PHP qui permet de valider la modification d'un profil par l'utilisateur lui-même sur le serveur de site. */

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['input_log']['username']; 
    $region = $_POST["region"];
    $size = $_POST["size"];
    $desc = $_POST["desc"];

    $_SESSION['input_profil'] = [
        'region' => $region,
        'size' => $size,
        'desc' => $desc  
    ];


    if (isset($_FILES['profilPicture']) && $_FILES['profilPicture']['error'] == 0) {
        $tmp_name = $_FILES['profilPicture']['tmp_name'];
        $name = $_SESSION['profile_pic'];
        move_uploaded_file($tmp_name, "../../data/profilePic/$name");
    }

    for($i=1;$i<7;$i++){
        if (isset($_FILES["addPicture$i"]) && $_FILES["addPicture$i"]['error'] == 0) {
            $upload_Dir = "../../data/userPic/";
            $profilepicName = $username . "_" . $_FILES["addPicture$i"]["name"];
            move_uploaded_file($_FILES["addPicture$i"]["tmp_name"], $upload_Dir . $profilepicName);
        }
    }
    

    $lines = file("../../data/description.csv", FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($lines as $i => $line) {
        $data = str_getcsv($line);
        if ($data[0] == $username) {
            $lines[$i] = "$username,$region,$size,$desc";
            $found = true;
            break;
        }
    }

    if (!$found) {
        $lines[] = "$username,$region,$size,$desc";
    }

    file_put_contents("../../data/description.csv", implode("\n", $lines));
    $_SESSION['success'] = '✅ your profile has been updated ✅';
    header("Location: ../dash/dashboard.php");
    exit();
        
} else {
    $_SESSION['error'] = '⚠️ Request in Post ONLY ⚠️';
    header("Location: customProfile.php?error=". urlencode($_SESSION['error']));
    exit();
}
?>

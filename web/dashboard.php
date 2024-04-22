<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header class="navMenu">
        <a href="#"><img class="logo" src="../Pictures/cupid.png"></a>
        <nav class="navigationBar">
            <a href="logOut.php">Log Out</a>
            <a href="#">Search</a>
            <a href="#">Subscription</a>
            <label for="imageUpload">
                <img src="<?php session_start();  if(!$_SESSION['role']){header('Location: ../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic">
            </label>
        </nav>
    </header>    
</body>

</html>
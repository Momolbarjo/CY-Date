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
        <a href="#"><img class="logo" src="../../Pictures/cupid.png"></a>
        <nav class="navigationBar">
            <a href="../logOut.php">Log Out<i class='bx bxs-log-out-circle'></i></a>
            <a href="#">Search<i class='bx bx-search-alt' ></i></a>
            <a href="#">Subscription<i class='bx bx-money' ></i></a>
            <label for="imageUpload">
                <img src="<?php session_start();  if(!$_SESSION['role']){header('Location: ../index.php');}echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic" id="profilePic">
                <div id="submenu" >
                    <a href="#">My Profile <i class='bx bxs-user-account'></i></a>
                    <a href="#">My Messages <i class='bx bx-message-square-dots' ></i></a>
                </div>
            </label>
        </nav>
    </header>   
    <script src="../../Browser/disable.js"></script>
    <script src="subMenu.js"></script>
</body>

</html>
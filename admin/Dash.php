<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adDash.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php session_start(); if(!$_SESSION['role']){header('Location: ../index.php');}?>
    <header class="navMenu">
        <a href="#"><img class="logo"  src="../Pictures/cupid.png"></a>
        <nav class="navigationBar">
            <a href="../web/logOut.php" id="out" >Log Out<i class='bx bxs-log-out-circle'></i></a>
            <a href="#" id="allUsers">All users<i class='bx bx-user-x'></i></a>
            <a href="#" id="report">Reports<i class='bx bxs-alarm-exclamation'></i></i></a>
            <a href="#" id="ban">Banned<i class='bx bx-cross' ></i></a>
        </nav>
    </header>
    <div id="userTable"></div>
    <script src="getUsers.js"></script>
</body>
</html>
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
    <label for="imageUpload">
        <img src="<?php session_start(); echo $_SESSION['profile_pic']; ?>" class="round-image" alt="cantFoundPic">
    </label>
</body>

</html>
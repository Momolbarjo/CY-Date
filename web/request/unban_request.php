<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="unban.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="box"> 
    <form action="../../admin/unbanned.php" method="POST">
        <div class="inputBox">
            <label for="username">Username:</label><br>
            <input type="textbox" id="username" name="user" value="<?php  echo $_SESSION['input_log']['username'] ?? '';?>" readonly /><br>
        </div>
        <div class="inputBox">
            <label for="reason">Reason for Unban:</label><br>
            <textarea id="reason" name="reason"  required></textarea><br>
        </div>
        <button type="submit" class="button">Submit</button>
    </form>
</div>
</body>
</html>
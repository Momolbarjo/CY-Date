
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login/log.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="box">
        <form action="login/logServ.php" method="POST">
            <?php
                session_start();

                if (isset($_GET['error'])){
                    echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
                    unset($_SESSION['error']);
                }
             ?>
            <img id="cupid" src="Pictures/cupid.png">
            <div class="inputBox">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_SESSION['input_log']['username'] ?? ''; ?>" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_SESSION['input_log']['password'] ?? ''; ?>" required>
                <i class='bx bxs-lock'></i>
            </div>
            <div class="remember">
                <label><input type="checkbox">Stay connected</label>
                <a href="login/reset/forgotHub.php">Forgot password?</a>
            </div>

            <button type="submit" class="button">Login</button>

            <div class="newAcc">
                <a href="login/new/registerHub.php">&nbspRegister</a>
                <i class='bx bxl-linkedin'></i>
                <i class='bx bxl-gmail'></i>
                <i class='bx bxl-github'></i>
            </div>
        </form>
    </div>


</body>

</html>
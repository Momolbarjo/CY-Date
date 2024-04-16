<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="forgot.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="box">
        <form action="forgotServ.php" method="POST">
            <?php
                session_start();
                if (isset($_GET['error'])){
                    echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
                    unset($_SESSION['error']);
                }
             ?>
            <h1>Forgot Password</h1>
            <img id="int" src="../../Pictures/interrogationPoint.png">
            <img id="reversedInt" src="../../Pictures/interrogationpointReversed.png">
            <div class="inputBox">
                <input type="text" placeholder="Username" name="username" value="<?php echo $_SESSION['input_forgot']['username'] ?? ''; ?>" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="date" placeholder="birthday" name="birthday" value="<?php echo $_SESSION['input_forgot']['birthday'] ?? ''; ?>" required>
                <i class='bx bx-cake'></i>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Password" name="pwd" value="<?php echo $_SESSION['input_forgot']['pwd'] ?? ''; ?>" required>
                <i class='bx bxs-lock'></i>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="confirm Password" name="confirmPwd" value="<?php echo $_SESSION['input_forgot']['confirmPwd'] ?? ''; ?>" required>
                <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" class="button">Submit</button>
        </form>
    </div>
</body>

</html>
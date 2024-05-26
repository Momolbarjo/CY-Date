<!DOCTYPE html>
<html>
<!-- /* Programme HTML/CSS/PHP qui permet à l'utilisateur d'essayer de se connecter malgré l'oublie de son mot de passe. Il met un nouveau mot de passe grâce à son adresse mail. */  -->

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
                    $_SESSION['error']='';
                }
                else if(isset($_GET['success'])){
                    echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
                    $_SESSION['success']='';
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
                <input type="email" placeholder="email" name="email" value="<?php echo $_SESSION['input_forgot']['email'] ?? ''; ?>" required>
                <i class='bx bx-envelope'></i>
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

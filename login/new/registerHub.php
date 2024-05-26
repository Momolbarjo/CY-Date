<?php
/* Programme HTML/CSS/PHP permettant l'enregistrement d'un nouvel utilisateur sur le site. */

session_start();

if (isset($_GET['error'])){
    echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
    unset($_SESSION['error']);
 }
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="regis.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="box">   
        <form action="registerServ.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="imageUpload" name="profilPicture" accept=".png, .jpg, .jpeg, .gif"
                style="display:none">
            <label for="imageUpload">
                <img src="../../Pictures/profilPic.png" class="round-image" alt="">
            </label>
            <div class="inputBox">
                <input type="text" placeholder="surname" name="surname" value="<?php echo $_SESSION['input_data']['surname'] ?? ''; ?>"required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="name" name="name" value="<?php echo $_SESSION['input_data']['name'] ?? ''; ?>" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <select name="gender" required >
                    <option value="">Gender</option>
                    <option value="male" <?php echo ($_SESSION['input_data']['gender'] ?? '') === 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($_SESSION['input_data']['gender'] ?? '') === 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="others" <?php echo ($_SESSION['input_data']['gender'] ?? '') === 'others' ? 'selected' : ''; ?>>Others</option>
                </select>
                <i class='bx bx-male-female'></i>
            </div>

            <div class="inputBox">
                <input type="text" placeholder="username" name="username" value="<?php echo $_SESSION['input_data']['username'] ?? ''; ?>" required>
                <i class='bx bxs-user-pin' ></i>
            </div>
            <div class="inputBox">
                <input type="email" placeholder="email" name="email" value="<?php echo $_SESSION['input_data']['email'] ?? ''; ?>" required>
                <i class='bx bxs-envelope' ></i>
            </div>
            <div class="inputBox">
                <input type="date" placeholder="birthday" name="birthday" value="<?php echo $_SESSION['input_data']['birthday'] ?? ''; ?>" required>
                <i class='bx bx-cake'></i>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="password" name="password" value="<?php echo $_SESSION['input_data']['password'] ?? ''; ?>" required>
                <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" class="button">Register</button>
        </form>
    </div>
    <script src="../picture.js"></script>

</body>

</html>


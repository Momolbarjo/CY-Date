
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
                <input type="text" placeholder="surname" name="surname" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="name" name="name" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="text" placeholder="username" name="username" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="email" placeholder="email" name="email" required>
                <i class='bx bxs-user-circle'></i>
            </div>
            <div class="inputBox">
                <input type="date" placeholder="birthday" name="birthday" required>
                <i class='bx bx-cake'></i>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="password" name="password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" class="button">Register</button>
        </form>
    </div>
    <script src="../picture.js"></script>

</body>

</html>
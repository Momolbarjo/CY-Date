<?php
    include 'loadData.php';

    $username = $_GET['user'];

    $userData = loadUserData($username);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Profile.css">
    <title>Profil of <?php echo $username; ?></title>
</head>
<body>
    <div class="profile">
        <img src="<?php echo $userData['profilePicPath']; ?>" alt="Profile pic">
        <h1><?php echo $username; ?></h1>
        <p>Birthday : <?php echo $userData['birthdate'] ?? 'No info'; ?></p>
        <p>Size : <?php echo $userData['height'] ?? 'No info'; ?> cm</p>
        <p>Description : <?php echo $userData['description'] ?? 'No info';  ?></p>
        <p>Region : <?php echo $userData['region'] ?? 'No info'; ?></p>
        <button id="optionsBtn">...</button>
        <div id="optionsMenu" style="display: none;">
            <a href="#">Report</a>
            <a href="#">Block</a>
            <a href="#">Add</a>
        </div>
    </div>

    <script>
        document.getElementById('optionsBtn').addEventListener('click', function () {
            var optionsMenu = document.getElementById('optionsMenu');
            if (optionsMenu.style.display === 'none') {
                optionsMenu.style.display = 'block';
            } else {
                optionsMenu.style.display = 'none';
            }
        });
    </script>
</body>
</html>
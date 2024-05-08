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
    	<div class="first">
        	<img src="<?php echo $userData['profilePicPath']; ?>" alt="Profile pic">
        	<h1><?php echo $username; ?></h1>
        </div>
        <div class="second">
        	<p id="p1">Birthday : </p> <p id="p2"> <?php echo $userData['birthdate'] ?? 'No info'; ?></p>
        	<p id="p1">Size : </p> <p id="p2"> <?php echo $userData['height'] ?? 'No info'; ?> cm</p>
        	<p id="p1">Description : </p> <p id="p2"> <?php echo $userData['description'] ?? 'No info';  ?></p>
        	<p id="p1">Region : </p> <p id="p2"> <?php echo $userData['region'] ?? 'No info'; ?></p>
        	        	
        </div>
        	<button id="optionsBtn">...</button>
        	<div id="optionsMenu" style="display: none;">
            		<a id="a1" href="#">Report</a>
            		<a id="a1" href="#">Block</a>
            		<a id="a1" href="#">Add</a>
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

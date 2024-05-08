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
        	<p id="p1">BIRTHDAY</p> <p id="p2"> <?php echo $userData['birthdate'] ?? 'No info'; ?></p>
        	<p id="p1">SIZE</p> <p id="p2"> <?php echo $userData['height'] ?? 'No info'; ?> cm</p>
        	<p id="p1">REGION</p> <p id="p2"> <?php echo $userData['region'] ?? 'No info'; ?></p>
        </div>
        
        <div class="third">
        	<p id="p1">DESCRPTION</p> <p id="p2"> <?php echo $userData['description'] ?? 'No info';  ?></p> 
        </div>
        
        <div class="four">
        	<button id="optionsBtn">ACTIONS</button>
        	<div id="optionsMenu" style="display: none;">
            		<a id="a1" href="#">Report</a>
            		<a id="a1" href="#">Block</a>
            		<a id="a1" href="#">Add</a>
        	</div>
        </div>
    
    	<div class="five">
    		<img id="img1" src="garen.jpeg" alt="image 1">
    		<img id="img2" src="darius.jpeg" alt="image 2">
    		<img id="img3" src="trynda.jpeg" alt="image 3">
    		<img id="img4" src="morde.jpeg" alt="image 4">
    		<img id="img5" src="aatrox.jpeg" alt="image 5">
    		<img id="img6" src="urgot.jpeg" alt="image 6">
    		<br>
    		
    		<button id="btn1" onclick="changeImg(-1)"><--</button>
    		<button id="btn2" onclick="changeImg(1)">--></button>
    	</div>

    </div>
  	  
    <script src="profilePage.js"></script>
</body>
</html>

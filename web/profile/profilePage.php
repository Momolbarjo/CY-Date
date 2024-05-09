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
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
			<?php for ($i = 0; $i < count($userData['pictures']); $i++): ?>
				<img src="<?php echo file_exists($userData['pictures'][$i] ?? '') ? $userData['pictures'][$i] : "../../Pictures/carréVide.png"; ?>" alt="cantFoundPic" id="img<?php echo $i+1;?>">
			<?php endfor; ?>
				<br>
	
    		<button id="btn1" onclick="changeImg(-1)"><i class='bx bx-left-arrow-alt'></i></button>
    		<button id="btn2" onclick="changeImg(1)"><i class='bx bx-right-arrow-alt' ></i></button>
    	</div>

    </div>
  	  
    <script src="profilePage.js"></script>
</body>
</html>
